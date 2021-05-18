<?php

namespace Controller\Admin;

class Customer extends \Controller\Core\Admin
{
    public function gridAction()
    {
        try {
            $grid = \Mage::getBlock('Block\Admin\Customer\Grid')->toHtml();
            $this->makeResponse($grid);
        } catch (\Exception $e) {
            $e->getMessage();
        }
    }

    public function editFormAction()
    {
        try {
            $customer = \Mage::getModel('Model\Customer');
            $id = (int)$this->getrequest()->getGet('customerId');
            if ($id) {
                $customer = $customer->load($id);
                if (!$customer) {
                    throw new \Exception('No Record Found!!');
                }
            }
        } catch (\Exception $e) {
            $this->getMessage()->setFailure($e->getMessage());
        }
        $leftBlock = \Mage::getBlock('Block\Admin\Customer\Edit\Tabs');
        $editBlock = \Mage::getBlock('Block\Admin\Customer\Edit');
        $editBlock = $editBlock->setTab($leftBlock)->setTableRow($customer)->toHtml();
        $this->makeResponse($editBlock);
    }

    public function saveAction()
    {
        try {
            $customer = \Mage::getModel('Model\Customer');
            $id = $this->getRequest()->getGet('customerId');
            $data = $this->getRequest()->getPost('customer');
            if ($id) {
                $customer = $customer->load($id);
                if (!$customer) {
                    throw new \Exception("Record Not Found.");
                }
            }
            $customer = $customer->setData($data);
            if ($customer->save()) {
                if ($id) {
                    $this->getMessage()->setSuccess("Successfully Updated");
                } else {
                    $this->getMessage()->setSuccess("Successfully Inserted");
                }
            } else {
                if ($id) {
                    $this->getMessage()->setFailure("Unable to Updated");
                } else {
                    $this->getMessage()->setFailure("Unable to Inserted");
                }
            }
        } catch (\Exception $e) {
            $this->getMessage()->setFailure($e->getMessage());
        }
        $grid = \Mage::getBlock('Block\Admin\Customer\Grid')->toHtml();
        $this->makeResponse($grid);
    }

    public function deleteAction()
    {
        try {
            $customer = \Mage::getModel('Model\Customer');
            $customerAddress = \Mage::getModel('Model\Customer\Address');
            $id = $this->getRequest()->getGet('customerId');
            if (!$id) {
                throw new \Exception("Customer not found in database.");
            }
            $customer = $customer->load($id);
            if (!$customer) {
                throw new \Exception('Id is Invalid');
            }
            $query = "DELETE FROM `{$customerAddress->getTableName()}` WHERE `customerId` = '{$id}';";
            if ($customer->delete()) {
                if ($customerAddress->delete($query)) {
                    $this->getMessage()->setSuccess("Delete Succcessfuly");
                }
            }
        } catch (\Exception $e) {
            $this->getMessage()->setFailure($e->getMessage());
        }
        $grid = \Mage::getBlock('Block\Admin\Customer\Grid')->toHtml();
        $this->makeResponse($grid);
    }

    public function statusAction()
    {
        $customer = \Mage::getModel('Model\Customer');
        $id = $this->getRequest()->getGet('customerId');
        if ($id) {
            $customer = $customer->load($id);
            if (!$customer) {
                throw new \Exception("Invalid Id is given");
            }
        }
        else {
            throw new \Exception("Id is invalid");
        }
        if ($customer->status == 'Enable') {
            $customer->status = 'Disable';
        }
        else {
            $customer->status = 'Enable';
        }
        if ($customer->save()) {
            $this->getMessage()->setSuccess("Status changed Successfully");
        }
        else {
            $this->getMessage()->setFailure('Unable to change status');
        }
        $grid = \Mage::getBlock('Block\Admin\Customer\Grid')->toHtml();
        $this->makeResponse($grid);
        
    }

    public function filterAction()
    {
        $filterData = $this->getRequest()->getPost('field');
        $this->getFilter()->setFilters($filterData);
        $grid = \Mage::getBlock('Block\Admin\Customer\Grid')->toHtml();
        $this->makeResponse($grid);
    }
}
