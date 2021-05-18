<?php

namespace Controller\Admin;

class Admin extends \Controller\Core\Admin
{

    public function gridAction()
    {
        try {
            $grid = \Mage::getBlock('Block\Admin\Admin\Grid')->toHtml();
            $this->makeResponse($grid);
        } catch (\Exception $e) {
            $this->getMessage()->setFailure($e->getMessage());
        }
    }

    public function editFormAction()
    {
        try {
            $admin = \Mage::getModel('Model\Admin');
            $id = $this->getRequest()->getGet('adminId');
            if ($id) {
                $admin = $admin->load($id);
                if (!$admin) {
                    throw new \Exception("Id is invalid");
                }
            }
            $leftBlock = \Mage::getBlock('Block\Admin\Admin\Edit\Tabs');
            $editBlock = \Mage::getBlock('Block\Admin\Admin\Edit');
            $editBlock = $editBlock->setTab($leftBlock)->setTableRow($admin)->toHtml();
            $this->makeResponse($editBlock);
        } catch (\Exception $e) {
            $this->getRequest()->setFailure($e->getMessage());
        }
    }

    public function saveAction()
    {
        try {
            $admin = \Mage::getModel('Model\Admin');
            $id = $this->getRequest()->getGet('adminId');
            $data = $this->getRequest()->getPost('admin');
            if ($id) {
                $admin = $admin->load($id);
                if (!$admin) {
                    throw new \Exception("Invalid Id given.");
                }
            }
            $admin = $admin->setData($data);
            if ($admin->save()) {
                if ($id) {
                    $this->getMessage()->setSuccess('Successfully Updated.');
                } else {
                    $this->getMessage()->setSuccess('Successfully Inserted.');
                }
            } else {
                if ($id) {
                    $this->getMessage()->setFailure('Unable to Update.');
                } else {
                    $this->getMessage()->setFailure('Unable to Insert.');
                }
            }
        } catch (\Exception $e) {
            $this->getMessage()->setFailure($e->getMessage());
        }
        $grid = \Mage::getBlock('Block\Admin\Admin\Grid')->toHtml();
        $this->makeResponse($grid);
    }

    public function deleteAction()
    {
        try {
            $admin = \Mage::getModel('Model\Admin');
            $id = $this->getRequest()->getGet('adminId');
            if (!$id) {
                throw new \Exception("Invalid Id given.");
            }
            $admin = $admin->load($id);
            if (!$admin) {
                throw new \Exception("No data available");
            }
            if ($admin->delete()) {
                $this->getMessage()->setSuccess('Successfully Deleted');
            } else {
                $this->getMessage()->setFailure('Unable to Delete.');
            }
        } catch (\Exception $e) {
            $this->getMessage()->setFailure($e->getMessage());
        }
        $grid = \Mage::getBlock('Block\Admin\Admin\Grid')->toHtml();
        $this->makeResponse($grid);
    }

    public function statusAction()
    {
        $admin = \Mage::getModel('Model\Admin');
        $id = $this->getRequest()->getGet('adminId');
        if ($id) {
            $admin = $admin->load($id);
            if (!$admin) {
                throw new \Exception("Invalid Id is given");
            }
        }
        else {
            throw new \Exception("Id is invalid");
        }
        if ($admin->status == 'Enable') {
            $admin->status = 'Disable';
        }
        else {
            $admin->status = 'Enable';
        }
        if ($admin->save()) {
            $this->getMessage()->setSuccess("Status changed Successfully");
        }
        else {
            $this->getMessage()->setFailure('Unable to change status');
        }
        $grid = \Mage::getBlock('Block\Admin\Admin\Grid')->toHtml();
        $this->makeResponse($grid);
        
    }

    public function filterAction()
    {
        $filterData = $this->getRequest()->getPost('field');
        $this->getFilter()->setFilters($filterData);
        $grid = \Mage::getBlock('Block\Admin\Admin\Grid')->toHtml();
        $this->makeResponse($grid);
    }
}
