<?php

namespace Controller\Admin;

class CmsPages extends \Controller\Core\Admin
{

    public function gridAction()
    {
        try {
            $grid = \Mage::getBlock('Block\Admin\CmsPages\Grid')->toHtml();
            $this->makeResponse($grid);
        } catch (\Exception $e) {
            $this->getMessage()->setFailure($e->getMessage());
        }
    }

    public function editFormAction()
    {
        try {
            $cmsPages = \Mage::getModel('Model\CmsPages');
            $id = $this->getrequest()->getGet('pageId');
            if ($id) {
                $cmsPages = $cmsPages->load($id);
                if (!$cmsPages) {
                    throw new \Exception('No Record Found!!');
                }
            }
        } catch (\Exception $e) {
            $this->getMessage()->setFailure($e->getMessage());
        }
        $leftBlock = \Mage::getBlock('Block\Admin\CmsPages\Edit\Tabs');
        $editBlock = \Mage::getBlock('Block\Admin\CmsPages\Edit');
        $editBlock = $editBlock->setTab($leftBlock)->setTableRow($cmsPages)->toHtml();
        $this->makeResponse($editBlock);
    }

    public function saveAction()
    {
        try {
            $cmsPages = \Mage::getModel('Model\CmsPages');
            $id = $this->getRequest()->getGet('pageId');
            $data = $this->getRequest()->getPost('cmsPages');
            if ($id) {
                $cmsPages = $cmsPages->load($id);
                if (!$cmsPages) {
                    throw new \Exception("Record Not Found.");
                }
            }
            $cmsPages = $cmsPages->setData($data);
            if ($cmsPages->save()) {
                if ($id) {
                    $this->getMessage()->setSuccess('Successfully Updated.');
                } else {
                    $this->getMessage()->setSuccess("Successfully Inserted");
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
        $grid = \Mage::getBlock('Block\Admin\CmsPages\Grid')->toHtml();
        $this->makeResponse($grid);
    }

    public function deleteAction()
    {
        try {
            $cmsPages = \Mage::getModel("Model\CmsPages");
            $id = $this->getRequest()->getGet('pageId');
            if (!$id) {
                throw new \Exception("CmsPage not found in database.");
            }
            $cmsPages = $cmsPages->load($id);
            if (!$cmsPages) {
                throw new \Exception('Id is Invalid');
            }
            if ($cmsPages->delete()) {
                $this->getMessage()->setSuccess("Delete Successfully");
            }
        } catch (\Exception $e) {
            $this->getMessage()->setFailure($e->getMessage());
        }
        $grid = \Mage::getBlock('Block\Admin\CmsPages\Grid')->toHtml();
        $this->makeResponse($grid);
    }

    public function statusAction()
    {
        $cmsPage = \Mage::getModel('Model\CmsPages');
        $id = $this->getRequest()->getGet('pageId');
        if ($id) {
            $cmsPage = $cmsPage->load($id);
            if (!$cmsPage) {
                throw new \Exception("Invalid Id is given");
            }
        }
        else {
            throw new \Exception("Id is invalid");
        }
        if ($cmsPage->status == 'Enable') {
            $cmsPage->status = 'Disable';
        }
        else {
            $cmsPage->status = 'Enable';
        }
        if ($cmsPage->save()) {
            $this->getMessage()->setSuccess("Status changed Successfully");
        }
        else {
            $this->getMessage()->setFailure('Unable to change status');
        }
        $grid = \Mage::getBlock('Block\Admin\CmsPages\Grid')->toHtml();
        $this->makeResponse($grid);
        
    }

    public function filterAction()
    {
        $filterData = $this->getRequest()->getPost('field');
        $this->getFilter()->setFilters($filterData);
        $grid = \Mage::getBlock('Block\Admin\CmsPages\Grid')->toHtml();
        $this->makeResponse($grid);
    }
}
