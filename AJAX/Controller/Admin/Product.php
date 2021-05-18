<?php

namespace Controller\Admin;

class Product extends \Controller\Core\Admin
{
    public function gridAction()
    {
        try {
            $grid = \Mage::getBlock('Block\Admin\Product\Grid')->toHtml();
            $this->makeResponse($grid);
        } catch (\Exception $e) {
            $this->getMessage()->setFailure($e->getMessage());
        }
    }

    public function editFormAction()
    {
        try {
            $product = \Mage::getModel('Model\Product');
            $id = $this->getrequest()->getGet('productId');
            if ($id) {
                $product = $product->load($id);
                if (!$product) {
                    throw new \Exception('No Record Found!!');
                }
            }
            $leftBlock = \Mage::getBlock('Block\Admin\Product\Edit\Tabs');
            $editBlock = \Mage::getBlock('Block\Admin\Product\Edit');
            $editBlock = $editBlock->setTab($leftBlock)->setTableRow($product)->toHtml();
            $this->makeResponse($editBlock);
        } catch (\Exception $e) {
            $this->getMessage()->setFailure($e->getMessage());
        }
    }

    public function saveAction()
    {
        try {
            $product = \Mage::getModel('Model\Product');
            $id = $this->getRequest()->getGet('productId');
            $data = $this->getRequest()->getPost('product');
            if ($id) {
                $product = $product->load($id);
                if (!$product) {
                    throw new \Exception("Record Not Found.");
                }
            }
            $product = $product->setData($data);
            if ($product->save()) {
                if ($id) {
                    $this->getMessage()->setSuccess("Successfully Updated");
                } else {
                    $this->getMessage()->setSuccess('Successfully Inserted');
                }
            } else {
                if ($id) {
                    $this->getMessage()->setSuccess("Unable to Update");
                } else {
                    $this->getMessage()->setSuccess("Unable to Insert");
                }
            }
        } catch (\Exception $e) {
            $this->getMessage()->setFailure($e->getMessage());
        }
        $grid = \Mage::getBlock('Block\Admin\Product\Grid')->toHtml();
        $this->makeResponse($grid);
    }

    public function deleteAction()
    {
        try {
            $product = \Mage::getModel("Model\Product");
            $media = \Mage::getModel('Model\Product\Media');
            $groupPrice = \Mage::getModel('Model\Product\Group\Price');

            $id = $this->getRequest()->getGet('productId');
            if (!$id) {
                throw new \Exception("Product not found in database.");
            }
            $product = $product->load($id);
            if (!$product) {
                throw new \Exception('Id is Invalid');
            }
            $mediaQuery = "DELETE FROM `{$media->getTableName()}` WHERE `productId` = '{$id}';";
            $groupPriceQuery = "DELETE FROM `{$groupPrice->getTableName()}` WHERE `productId` = '{$id}';";
            if ($product->delete()) {
                if ($media->delete($mediaQuery) && $groupPrice->delete($groupPriceQuery)) {
                    $this->getMessage()->setSuccess("Delete Successfully");
                }
            }
            $grid = \Mage::getBlock('Block\Admin\Product\Grid')->toHtml();
            $this->makeResponse($grid);
        } catch (\Exception $e) {
            $this->getMessage()->setFailure($e->getMessage());
        }
    }

    public function statusAction()
    {
        $product = \Mage::getModel('Model\Product');
        $id = $this->getRequest()->getGet('productId');
        if ($id) {
            $product = $product->load($id);
            if (!$product) {
                throw new \Exception("Invalid Id is given");
            }
        }
        else {
            throw new \Exception("Id is invalid");
        }
        if ($product->status == 'Enable') {
            $product->status = 'Disable';
        }
        else {
            $product->status = 'Enable';
        }
        if ($product->save()) {
            $this->getMessage()->setSuccess("Status changed Successfully");
        }
        else {
            $this->getMessage()->setFailure('Unable to change status');
        }
        $grid = \Mage::getBlock('Block\Admin\Product\Grid')->toHtml();
        $this->makeResponse($grid);
        
    }

    public function filterAction()
    {
        $filterData = $this->getRequest()->getPost('field');
        $this->getFilter()->setFilters($filterData);
        $grid = \Mage::getBlock('Block\Admin\Product\Grid')->toHtml();
        $this->makeResponse($grid);
    }
}