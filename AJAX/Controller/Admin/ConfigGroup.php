<?php

namespace Controller\Admin;

class ConfigGroup extends \Controller\Core\Admin
{
    public function gridAction()
    {
        try {
            $grid = \Mage::getBlock('Block\Admin\ConfigGroup\Grid')->toHtml();
            $this->makeResponse($grid);
        } catch (\Exception $e) {
            $this->getMessage()->setFailyre($e->getMessage());
        }
    }

    public function editFormAction()
    {
        try {
            $configGroup = \Mage::getModel('Model\ConfigGroup');
            $id = $this->getRequest()->getGet('groupId');
            if ($id) {
                $configGroup = $configGroup->load($id);
                if (!$configGroup) {
                    throw new \Exception('No Record Found!!');
                }
            }
        } catch (\Exception $e) {
            $this->getMessage()->setFailure($e->getMessage());
        }
        $leftBlock = \Mage::getBlock('Block\Admin\ConfigGroup\Edit\Tabs');
        $editBlock = \Mage::getBlock('Block\Admin\ConfigGroup\Edit');
        $editBlock = $editBlock->setTab($leftBlock)->setTableRow($configGroup)->toHtml();
        $this->makeResponse($editBlock);
    }

    public function saveAction()
    {
        try {
            $configGroup = \Mage::getModel('Model\ConfigGroup');
            $id = $this->getRequest()->getGet('groupId');
            $data = $this->getRequest()->getPost('configGroup');
            if ($id) {
                $configGroup = $configGroup->load($id);
                if (!$configGroup) {
                    throw new \Exception("Record Not Found.");
                }
            }
            $configGroup = $configGroup->setData($data);
            if ($configGroup->save()) {
                if ($id) {
                    $this->getMessage()->setSuccess('Successfullu Updated');
                } else {
                    $this->getMessage()->setSuccess('Successfully Inserted');
                }
            } else {
                if ($id) {
                    $this->getMessage()->setFailure('Unable to Update');
                } else {
                    $this->getMessage()->setFailure("Unable to Insert");
                }
            }
        } catch (\Exception $e) {
            $this->getMessage()->setFailure($e->getMessage());
        }
        $grid = \Mage::getBlock('Block\Admin\ConfigGroup\Grid')->toHtml();
        $this->makeResponse($grid);
    }

    public function deleteAction()
    {
        try {
            $configGroup = \Mage::getModel('Model\ConfigGroup');
            $config = \Mage::getModel('Model\ConfigGroup\Config');
            $id = $this->getRequest()->getGet('groupId');
            if (!$id) {
                throw new \Exception("ConfigGroup not found in database.");
            }
            $configGroup = $configGroup->load($id);
            if (!$configGroup) {
                throw new \Exception("Invalid Id");
            }
            $query = " DELETE FROM `{$config->getTableName()}` WHERE `groupId` = '{$id}';";
            if ($configGroup->delete()) {
                if ($config->delete($query)) {
                    $this->getMessage()->setSuccess('Delete Successfully');
                }
            }
        } catch (\Exception $e) {
            $this->getMessage()->setFailure($e->getMessage());
        }
        $grid = \Mage::getBlock('Block\Admin\ConfigGroup\Grid')->toHtml();
        $this->makeResponse($grid);
    }

    public function filterAction()
    {
        $filterData = $this->getRequest()->getPost('field');
        $this->getFilter()->setFilters($filterData);
        $grid = \Mage::getBlock('Block\Admin\ConfigGroup\Grid')->toHtml();
        $this->makeResponse($grid);
    }
}
