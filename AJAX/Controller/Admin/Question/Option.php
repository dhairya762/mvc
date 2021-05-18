<?php

namespace Controller\Admin\Question;

class Option extends \Controller\Core\Admin
{
    public function updateAction()
    {
        $option = \Mage::getModel('Model\Question\Option');
        $question = \Mage::getModel('Model\Question');
        $questionId = $this->getRequest()->getGet('id');
        $query =  "SELECT `{$option->getPrimaryKey()}` FROM `{$option->getTableName()}` WHERE `{$question->getPrimaryKey()}` = '{$questionId}';";
        $data = $option->fetchAll($query);
        if ($data) {
            foreach ($data->getData() as $key => $value) {
                $ids[] = $value->optionId;
            }
        }
        if ($exist = $this->getRequest()->getPost('exist')) {
            foreach ($exist as $key => $value) {
                if (gettype($key) == "integer") {
                    $query = "UPDATE `{$option->getTableName()}` SET `optionName` = '{$value['optionName']}',`questionId`= '{$questionId}' , ";
                    unset($ids[array_search($key, $ids)]);
                    $query .= "`is_right_choice` = 0 WHERE `optionId` = '{$key}'";
                    $option->save($query);
                }
                if (gettype($key) != 'integer') {
                    $query = "UPDATE `{$option->getTableName()}` SET `is_right_choice` = 1 WHERE `optionId` = '{$value}'";
                    $option->save($query);
                }
            }
        }
        if ($new = $this->getRequest()->getPost('new')) {
            foreach ($new as $key => $value) {
                foreach ($value as $key2 => $value2) {
                    $newArray[$key2][$key] = $value2;
                }
            }
            foreach ($newArray as $key => $value) {
                $query = "INSERT INTO `{$option->getTableName()}`(`optionName`, `questionId`) 
                    VALUES ('{$value['option']}','{$questionId}');";
                $option->save($query);
            }
        }
        if (isset($ids) && $ids) {
            if (empty($_POST)) {
                $ids = [];
            }
            $query = "DELETE FROM `{$option->getTableName()}` WHERE `{$option->getPrimaryKey()}` IN (" . implode(",", $ids) . ");";
            $option->delete($query);
        }
        $leftBlock = \Mage::getBlock('Block\Admin\Question\Edit\Tabs');
        $editBlock = \Mage::getBlock('Block\Admin\Customer\Edit');
        $editBlock = $editBlock->setTab($leftBlock)->setTableRow($question)->toHtml();
        $this->makeResponse($editBlock);
    }
}
