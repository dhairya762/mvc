<?php

namespace Controller\Admin\Customer;


class Address extends \Controller\Core\Admin
{
    function saveAction()
    {
        try {
            $address = \Mage::getModel('Model\Customer\Address');
            $customer = \Mage::getModel('Model\Customer');
            $billing = $address;
            $shipping = $address;
            if (!$this->getRequest()->isPost()) {
                throw new \Exception("Invalide Request.");
            }
            $id = $this->getRequest()->getGet('customerId');
            if ($id) {
                $customer = $customer->load($id);
                if (!$customer) {
                    throw new \Exception("No Record Found.");
                }
                $query = "SELECT * FROM `customer_address` WHERE `customerId` = '{$id}';";
                $addresses = $address->fetchAll($query);
                if ($addresses) {
                    foreach ($addresses->getData() as $address) {
                        if ($address->addressType == 'billing') {
                            $billing = $address;
                        }
                        if ($address->addressType == 'shipping') {
                            $shipping = $address;
                        }
                    }
                }
            }
            $billingData = $this->getRequest()->getPost('billing');
            $billing->setData($billingData);
            $billing->addressType = 'billing';
            $billing->customerId = $id;
            $recordId = $billing->save();

            $shippingData = $this->getRequest()->getPost('shipping');
            $shipping->setData($shippingData);
            $shipping->addressType = 'shipping';
            $shipping->customerId = $id;
            $recordId = $shipping->save();

            if (!$recordId) {
                throw new \Exception("Please Enter Details First.");
            }
            $this->getMessage()->setSuccess('Address Added Successfully.');
        } catch (\Exception $e) {
            $this->getMessage()->setFailure($e->getMessage());
        }
        $this->redirect('grid', 'customer');
    }
}
