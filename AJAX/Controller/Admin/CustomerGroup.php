<?php

namespace Controller\Admin;

class CustomerGroup extends \Controller\Core\Admin
{

    public function gridAction()
    {
        try {
            $grid = \Mage::getBlock('Block\Admin\CustomerGroup\Grid')->toHtml();
            $this->makeResponse($grid);
        } catch (\Exception $e) {
            $this->getMessage()->setFailure($e->getMessage());
        }
    }

    public function editFormAction()
    {
        try {
            $group = \Mage::getModel('Model\CustomerGroup');
            $id = $this->getrequest()->getGet('groupId');
            if ($id) {
                $group = $group->load($id);
                if (!$group) {
                    throw new \Exception('No Record Found!!');
                }
            }

        } catch (\Exception $e) {
            $this->getMessage()->setFailure($e->getMessage());
        }
        $leftBlock = \Mage::getBlock('Block\Admin\CustomerGroup\Edit\Tabs');
        $editBlock = \Mage::getBlock('Block\Admin\CustomerGroup\Edit');
        $editBlock = $editBlock->setTab($leftBlock)->setTableRow($group)->toHtml();
        $this->makeResponse($editBlock);
    }

    public function saveAction()
    {
        try {
            $customerGroup = \Mage::getModel('Model\CustomerGroup');
            $id = $this->getRequest()->getGet('groupId');
            $data = $this->getRequest()->getPost('customerGroup');
            if ($id) {
                $customerGroup = $customerGroup->load($id);
                if (!$customerGroup) {
                    throw new \Exception("Record Not Found.");
                }
            }
            $customerGroup = $customerGroup->setData($data);
            if ($customerGroup->save()) {
                if ($id) {
                    $this->getMessage()->setSuccess('Successfully Updated');
                } else {
                    $this->getMessage()->setSuccess("Successfully Insert");
                }
            } else {
                if ($id) {
                    $this->getMessage()->setFailure('Unable to Update');
                } else {
                    $this->getMessage()->setFailure('Unable to Insert');
                }
            }
        } catch (\Exception $e) {
            $this->getMessage()->setFailure($e->getMessage());
        }
        $grid = \Mage::getBlock('Block\Admin\CustomerGroup\Grid')->toHtml();
        $this->makeResponse($grid);
    }

    public function deleteAction()
    {
        try {
            $group = \Mage::getModel('Model\CustomerGroup');
            $id = $this->getRequest()->getGet('groupId');
            if (!$id) {
                throw new \Exception("CustomerGroup not found in database.");
            }
            $group = $group->load($id);
            if (!$group) {
                throw new \Exception('Id is Invalid!');
            }
            if ($group->delete()) {
                $this->getMessage()->setSuccess("Delete Successfully");
            }
        } catch (\Exception $e) {
            $this->getMessage()->setFailure($e->getMessage());
        }
        $grid = \Mage::getBlock('Block\Admin\CustomerGroup\Grid')->toHtml();
        $this->makeResponse($grid);
    }

    public function statusAction()
    {
        $customerGroup = \Mage::getModel('Model\CustomerGroup');
        $id = $this->getRequest()->getGet('groupId');
        if ($id) {
            $customerGroup = $customerGroup->load($id);
            if (!$customerGroup) {
                throw new \Exception("Invalid Id is given");
            }
        }
        else {
            throw new \Exception("Id is invalid");
        }
        if ($customerGroup->status == 'Enable') {
            $customerGroup->status = 'Disable';
        }
        else {
            $customerGroup->status = 'Enable';
        }
        if ($customerGroup->save()) {
            $this->getMessage()->setSuccess("Status changed Successfully");
        }
        else {
            $this->getMessage()->setFailure('Unable to change status');
        }
        $grid = \Mage::getBlock('Block\Admin\CustomerGroup\Grid')->toHtml();
        $this->makeResponse($grid);
        
    }

    public function filterAction()
    {
        $filterData = $this->getRequest()->getPost('field');
        $this->getFilter()->setFilters($filterData);
        $grid = \Mage::getBlock('Block\Admin\CustomerGroup\Grid')->toHtml();
        $this->makeResponse($grid);
    }
}