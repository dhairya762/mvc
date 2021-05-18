<?php

namespace Controller\Admin;

class Payment extends \Controller\Core\Admin
{
    public function gridAction()
    {
        try {
            $grid = \Mage::getBlock('Block\Admin\Payment\Grid')->toHtml();
            $this->makeResponse($grid);
        } catch (\Exception $e) {
           $this->getMessage()->setFailure($e->getMessage());
        }
    }

    public function editFormAction()
    {
        try {
            $payment = \Mage::getModel('Model\Payment');
            $id = $this->getrequest()->getGet('methodId');
            if ($id) {
                $payment = $payment->load($id);
                if (!$payment) {
                    throw new \Exception('No Record Found!!');
                }
            }
        } catch (\Exception $e) {
            $this->getMessage()->setFailure($e->getMessage());
        }
        $leftBlock = \Mage::getBlock('Block\Admin\Payment\Edit\Tabs');
        $editBlock = \Mage::getBlock('Block\Admin\Payment\Edit');
        $editBlock = $editBlock->setTab($leftBlock)->setTableRow($payment)->toHtml();
        $this->makeResponse($editBlock);
    }

    public function saveAction()
    {
        try {
            $payment = \Mage::getModel('Model\Payment');
            $id = $this->getRequest()->getGet('methodId');
            $data = $this->getRequest()->getPost('payment');
            if ($id) {
                $payment = $payment->load($id);
                if (!$payment) {
                    throw new \Exception("Record Not Found.");
                }
            }
            $payment = $payment->setData($data);
            if ($payment->save()) {
                if ($id) {
                    $this->getMessage()->setSuccess('Successfully Updated.');
                } else {
                    $this->getMessage()->setSuccess('Successfully Inserted');
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
        $grid = \Mage::getBlock('Block\Admin\Payment\Grid')->toHtml();
        $this->makeResponse($grid);
    }

    public function deleteAction()
    {
        try {
            $payment = \Mage::getModel("Model\Payment");
            $id = (int)$this->getRequest()->getGet('methodId');
            if (!$id) {
                throw new \Exception("Payment not found in database.");
            }
            $payment = $payment->load($id);
            if (!$payment) {
                throw new \Exception('Id is Invalid');
            }
            if ($payment->delete()) {
                $this->getMessage()->setSuccess("Delete Successfully");
            }
        } catch (\Exception $e) {
            $this->getMessage()->setFailure($e->getMessage());
        }
        $grid = \Mage::getBlock('Block\Admin\Payment\Grid')->toHtml();
        $this->makeResponse($grid);
    }

    public function statusAction()
    {
        $payment = \Mage::getModel('Model\Payment');
        $id = $this->getRequest()->getGet('methodId');
        if ($id) {
            $payment = $payment->load($id);
            if (!$payment) {
                throw new \Exception("Invalid Id is given");
            }
        }
        else {
            throw new \Exception("Id is invalid");
        }
        if ($payment->status == 'Enable') {
            $payment->status = 'Disable';
        }
        else {
            $payment->status = 'Enable';
        }
        if ($payment->save()) {
            $this->getMessage()->setSuccess("Status changed Successfully");
        }
        else {
            $this->getMessage()->setFailure('Unable to change status');
        }
        $grid = \Mage::getBlock('Block\Admin\Payment\Grid')->toHtml();
        $this->makeResponse($grid);
        
    }

    public function filterAction()
    {
        $filterData = $this->getRequest()->getPost('field');
        $this->getFilter()->setFilters($filterData);
        $grid = \Mage::getBlock('Block\Admin\Payment\Grid')->toHtml();
        $this->makeResponse($grid);
    }
}
