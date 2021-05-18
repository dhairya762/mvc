<?php

namespace Controller\Admin;

class Shipping extends \Controller\Core\Admin
{
    public function gridAction()
    {
        try {
            $grid = \Mage::getBlock('Block\Admin\Shipping\Grid')->toHtml();
            $this->makeResponse($grid);
        } catch (\Exception $e) {
            $e->getMessage();
        }
    }

    public function editFormAction()
    {
        try {
            $shipping = \Mage::getModel('Model\Shipping');
            $id = $this->getrequest()->getGet('methodId');
            if ($id) {
                $shipping = $shipping->load($id);
                if (!$shipping) {
                    throw new \Exception('No Record Found!!');
                }
            }
            $leftBlock = \Mage::getBlock('Block\Admin\Shipping\Edit\Tabs');
            $editBlock = \Mage::getBlock('Block\Admin\Shipping\Edit');
            $editBlock = $editBlock->setTab($leftBlock)->setTableRow($shipping)->toHtml();
            $this->makeResponse($editBlock);
        } catch (\Exception $e) {
            $this->getMessage()->setFailure($e->getMessage());
        }
    }

    public function saveAction()
    {
        try {
            $shipping = \Mage::getModel('Model\Shipping');
            $id = $this->getRequest()->getGet('methodId');
            $data = $this->getRequest()->getPost('shipping');
            if ($id) {
                $shipping = $shipping->load($id);
                if (!$shipping) {
                    throw new \Exception("Record Not Found.");
                }
            }
            $shipping = $shipping->setData($data);
            if ($shipping->save()) {
                if ($id) {
                    $this->getMessage()->setSuccess('Successfully Updated.');
                } else {
                    $this->getMessage()->setSuccess('Successfully Inserted');
                }
            } else {
                if ($id) {
                    $this->getMessage()->setFailure('Unable to Update');
                } else {
                    $this->getMessage()->setFailure('Unable to Insert.');
                }
            }
        } catch (\Exception $e) {
            $this->getMessage()->setFailure($e->getMessage());
        }
        $grid = \Mage::getBlock('Block\Admin\Shipping\Grid')->toHtml();
        $this->makeResponse($grid);
    }

    public function deleteAction()
    {
        try {
            $shipping = \Mage::getModel("Model\Shipping");
            $id = $this->getRequest()->getGet('methodId');
            if (!$id) {
                throw new \Exception("Shipping not found in database.");
            }
            $shipping = $shipping->load($id);
            if (!$shipping) {
                throw new \Exception('Id is Invalid');
            }
            if ($shipping->delete()) {
                $this->getMessage()->setSuccess("Delete Successfully");
            }
        } catch (\Exception $e) {
            $this->getMessage()->setFailure($e->getMessage());
        }
        $grid = \Mage::getBlock('Block\Admin\Shipping\Grid')->toHtml();
        $this->makeResponse($grid);
    }

    public function statusAction()
    {
        $shipment = \Mage::getModel('Model\Shipping');
        $id = $this->getRequest()->getGet('methodId');
        if ($id) {
            $shipment = $shipment->load($id);
            if (!$shipment) {
                throw new \Exception("Invalid Id is given");
            }
        }
        else {
            throw new \Exception("Id is invalid");
        }
        if ($shipment->status == 'Enable') {
            $shipment->status = 'Disable';
        }
        else {
            $shipment->status = 'Enable';
        }
        if ($shipment->save()) {
            $this->getMessage()->setSuccess("Status changed Successfully");
        }
        else {
            $this->getMessage()->setFailure('Unable to change status');
        }
        $grid = \Mage::getBlock('Block\Admin\Shipping\Grid')->toHtml();
        $this->makeResponse($grid);
        
    }

    public function filterAction()
    {
        $filterData = $this->getRequest()->getPost('field');
        $this->getFilter()->setFilters($filterData);
        $grid = \Mage::getBlock('Block\Admin\Shipping\Grid')->toHtml();
        $this->makeResponse($grid);
    }
}