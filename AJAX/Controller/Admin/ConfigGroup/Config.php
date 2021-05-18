<?php

namespace Controller\Admin\ConfigGroup;

class Config extends \Controller\Core\Admin
{
    public function updateAction()
    {
        $config = \Mage::getModel('Model\ConfigGroup\Config');
        $id = $this->getRequest()->getGet('groupId');
        $query =  "SELECT `configId` FROM `config` WHERE `groupId`={$id}";
        $data = $config->fetchAll($query);
        if ($data) {
            foreach ($data->getData() as $key => $value) {
                $ids[] = $value->configId;
            }
        }
        if ($exist = $this->getRequest()->getPost('exist')) {

            foreach ($exist as $key => $value) {
                unset($ids[array_search($key, $ids)]);
                $query = "UPDATE `config` 
                    SET `title`='{$value['title']}',`code`= '{$value['code']}',`value`='{$value['value']}'
                    WHERE `configId` = {$key}";
                $config->save($query);
            }
        }
        if (isset($ids) && $ids) {
            $query = "DELETE FROM `config` WHERE `configId` IN (" . implode(",", $ids) . ")";
            $config->delete($query);
        }

        if ($new = $this->getRequest()->getPost('new')) {
            foreach ($new as $key => $value) {
                foreach ($value as $key2 => $value2) {
                    $newArray[$key2][$key] = $value2;
                }
            }
            foreach ($newArray as $key => $value) {
                $query = "INSERT INTO `config`(`groupId`, `title`, `code`, `value`) 
                    VALUES ($id,'{$value['title']}','{$value['code']}','{$value['value']}')";
                $config->save($query);
            }
        }
        $leftBlock = \Mage::getBlock('Block\Admin\ConfigGroup\Edit\Tabs');
        $editBlock = \Mage::getBlock('Block\Admin\ConfigGroup\Edit');
        $editBlock = $editBlock->setTab($leftBlock)->setTableRow($config)->toHtml();
        $this->makeResponse($editBlock);
    }
}
