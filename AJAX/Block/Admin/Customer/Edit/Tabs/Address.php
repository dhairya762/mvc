<?php

namespace Block\Admin\Customer\Edit\Tabs;

class Address extends \Block\Core\Template
{
    protected $billingAddress = null;
    protected $shippingAddress = null;

    function __construct()
    {
        $this->setTemplate('./View/admin/customer/edit/tabs/address.php');
    }

    public function getBillingAddress()
    {
        if (!$this->billingAddress) {
            $this->setBillingAddress();
        }
        return $this->billingAddress;
    }

    public function setBillingAddress(\Model\Customer\Address $billingAddress = null)
    {
        if (!$billingAddress) {
            $billingAddress = \Mage::getModel('Model\Customer\Address');
        }
        $id = $this->getRequest()->getGet('customerId');
        if ($id) {
            $query = "SELECT * FROM `{$billingAddress->getTableName()}` WHERE `customerId` = '{$id}' AND `addressType` = 'billing';";
            $billingAddress = $billingAddress->fetchRow($query);
        }
        $this->billingAddress = $billingAddress;
        return $this;
    }

    public function getShippingAddress()
    {
        if (!$this->shippingAddress) {
            $this->setShippingAddress();
        }
        return $this->shippingAddress;
    }

    public function setShippingAddress(\Model\Customer\Address $shippingAddress = null)
    {
        if (!$shippingAddress) {
            $shippingAddress = \Mage::getModel('Model\Customer\Address');
        }
        $id = $this->getRequest()->getGet('customerId');
        if ($id) {
            $query = "SELECT * FROM `{$shippingAddress->getTableName()}` WHERE `customerId` = '{$id}' AND `addressType` = 'shipping'";
            $shippingAddress = $shippingAddress->fetchRow($query);
        }
        $this->shippingAddress = $shippingAddress;
        return $this;
    }
}
