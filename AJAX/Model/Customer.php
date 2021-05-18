<?php

namespace Model;

class Customer extends \Model\Core\Table
{

    const STATUS_ENABLED = 'Enable';
    const  STATUS_DISABLED = 'Disable';
    protected $billingAddress = null;
    protected $shippingAddress = null;

    public function __construct()
    {
        $this->setTableName("customer");
        $this->setPrimaryKey("customerId");
    }

    public function getStatusOption()
    {
        return [
            self::STATUS_ENABLED => "Enabled",
            self::STATUS_DISABLED => "Disabled",
        ];
    }

    public function setBillingAddress($address)
    {
        $this->billingAddress = $address;
        return $this;
    }
    public function getBillingAddress()
    {
        if (!$this->customerId) {
            return false;
        }
        $query = "SELECT * FROM `customer_address` WHERE `customerId` = '{$this->customerId}' AND `addressType` = 'billing'";
        $billingAddress = \Mage::getModel('Model\Customer\Address')->fetchRow($query);
        if ($billingAddress) {
            $this->setBillingAddress($billingAddress);
        }
        return $this->billingAddress;
    }

    public function setShippingAddress($address)
    {
        $this->shippingAddress = $address;
        return $this;
    }
    public function getShippingAddress()
    {
        if (!$this->customerId) {
            return false;
        }
        $query = "SELECT * FROM `customer_address` WHERE `customerId` = '{$this->customerId}' AND `addressType` = 'shipping'";
        $shippingAddress = \Mage::getModel('Model\Customer\Address')->fetchRow($query);
        if ($shippingAddress) {
            $this->setShippingAddress($shippingAddress);
        }
        return $this->shippingAddress;
    }

    public function getAddressValue($address, $value)
    {
        $address .= 'Address';
        if ($this->$address && array_key_exists($value, $this->$address->getOriginalData())) {
            return $this->$address->$value;
        }
        return null;
    }

    public function getCustomerBillingAddress()
    {
        if (!$this->customerId) {
            return false;
        }
        $customerAddress = \Mage::getModel('Model\Customer\Address');
        $query = "SELECT * FROM `{$customerAddress->getTableName()}` WHERE `customerId` = '{$this->customerId}' AND `addressType` = 'billing'";
        $billingAddress = $customerAddress->fetchRow($query);
        if ($billingAddress) {
            $this->setCustomerBillingAddress($billingAddress);
            return $this->billingAddress;
        }
        return null;
    }

    public function setCustomerBillingAddress(\Model\Customer\Address $address)
    {
        $this->billingAddress = $address;
        return $this;
    }

    public function getCustomerShippingAddress()
    {
        if (!$this->customerId) {
            return false;
        }
        $customerAddress = \Mage::getModel('Model\Customer\Address');
        $query = "SELECT * FROM `{$customerAddress->getTableName()}` WHERE `customerId` = '{$this->customerId}' AND `addressType` = 'Shipping'";
        $shippingAddress = $customerAddress->fetchRow($query);
        if ($shippingAddress) {
            $this->setCustomerShippingAddress($shippingAddress);
        }
        return $this->shippingAddress;
    }

    public function setCustomerShippingAddress(\Model\Customer\Address $address)
    {
        $this->shippingAddress = $address;
        return $this;
    }
}
