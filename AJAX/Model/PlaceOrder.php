<?php

namespace Model;

class PlaceOrder extends \Model\Core\Table
{
    protected $customer = null;
    protected $allCustomer = null;
    protected $items = null;
    protected $billingAddress = null;
    protected $shippingAddress = null;
    protected $placeOrderBilling = null;
    protected $placeOrderShipping = null;
    protected $shippingMethod = null;
    protected $paymentMethod = null;

    public function __construct()
    {
        $this->setTableName('placeOrder');
        $this->setPrimaryKey('placeOrderId');
    }

    public function setShippingMethod(\Model\Core\Table\Collection $shippingMethod)
    {
        $this->shippingMethod = $shippingMethod;
        return $this;
    }

    public function getShippingMethod()
    {
        $shippingMethod = \Mage::getModel('Model\Shipping')->fetchAll();
        if ($shippingMethod) {
            $this->setShippingMethod($shippingMethod);
            return $this->shippingMethod;
        }
        return null;
    }

    public function setPaymentMethod(\Model\Core\Table\Collection $paymentMethod)
    {
        $this->paymentMethod = $paymentMethod;
        return $this;
    }

    public function getPaymentMethod()
    {
        $paymentMethod = \Mage::getModel('Model\Payment')->fetchAll();
        if ($paymentMethod) {
            $this->setPaymentMethod($paymentMethod);
            return $this->paymentMethod;
        }
        return null;
    }

    public function setCustomer(\Model\Customer $customer)
    {
        $this->customer = $customer;
        return $this;
    }

    public function getCustomer()
    {
        if ($this->customer) {
            return $this->customer;
        }
        if (!$this->customerId) {
            return false;
        }
        $customer = \Mage::getModel('Model\Customer')->load($this->customerId);
        $this->setCustomer($customer);
        return $this->customer;
    }

    // public function setAllCustomer(\Model\Core\Table\Collection $allCustomer)
    // {
    //     $this->allCustomer = $allCustomer;
    //     return $this;
    // }

    // public function getAllCustomer()
    // {
    //     $allCustomer = \Mage::getModel('Model\Customer')->fetchAll();
    //     $this->setAllCustomer($allCustomer);
    //     return $this->allCustomer;
    // }

    public function setItems(\Model\Core\Table\Collection $items)
    {
        $this->items = $items;
        return $this;
    }

    public function getItems()
    {
        if (!$this->cartId) {
            return false;
        }
        $query = "SELECT * FROM `placeOrderItem` WHERE `placeOrder` = '{$this->placeOrderId}'";
        $items = \Mage::getModel('Model\PlaceOrder\Item')->fetchAll($query);
        if (!$items) {
            return false;
        }
        $this->setItems($items);
        return $items;
    }

    public function setPlaceOrderBilling(\Model\Cart\Address $placeOrderBilling)
    {
        $this->placeOrderBilling = $placeOrderBilling;
        return $this;
    }

    public function getPlaceOrderBilling()
    {
        $query = "SELECT * FROM `placeorderaddress` WHERE `placeOrder` = '{$this->placeOrderId}' AND `addressType` = '" . \Model\PlaceOrder\Address::ADDRESS_TYPE_BILLING . "'";
        $placeOrderBilling = \Mage::getModel('Model\Cart\Address')->fetchRow($query);
        if ($placeOrderBilling) {
            $this->setPlaceOrderBilling($placeOrderBilling);
            return $this->placeOrderBilling;
        }
        return null;
    }

    public function setPlaceOrderShipping(\Model\PlaceOrder\Address $placeOrderShipping)
    {
        $this->placeOrderShipping = $placeOrderShipping;
        return $this;
    }

    public function getPlaceOrderShipping()
    {
        $query = "SELECT * FROM `placeorderaddress` WHERE `placeOrder` = '{$this->placeOrderId}' AND `addressType` = '" . \Model\Cart\Address::ADDRESS_TYPE_SHIPPING . "'";
        $placeOrderShipping = \Mage::getModel('Model\Cart\Address')->fetchRow($query);
        if ($placeOrderShipping) {
            $this->setPlaceOrderShipping($placeOrderShipping);
            return $this->placeOrderShipping;
        }
        return null;
    }

    public function setBillingAddress($address)
    {
        $this->billingAddress = $address;
        return $this;
    }

    public function getBillingAddress()
    {
        if (!$this->placeOrderId) {
            return false;
        }
        $billingAddress = $this->getPlaceOrderBilling();
        if ($billingAddress) {
            $this->setBillingAddress($billingAddress);
            return $this->billingAddress;
        }
        // if ($billingAddress = $this->getCartBillingAddress()) {
            // $this->setBillingAddress($billingAddress);
            // return $this->billingAddress;
        // }
        // if ($address = $this->getCustomer()->getBillingAddress()) {
            // $this->setBillingAddress($address);
            // return $this->billingAddress;
        // }
        return null;
    }

    public function setShippingAddress($address)
    {
        $this->shippingAddress = $address;
        return $this;
    }
    
    public function getShippingAddress()
    {
        if (!$this->placeOrderId) {
            return false;
        }
        if ($shippingAddress = $this->getPlaceOrderShipping()) {
            $this->setShippingAddress($shippingAddress);
            return $this->shippingAddress;
        }
        // if ($address = $this->getCustomer()->getShippingAddress()) {
            // $this->setShippingAddress($address);
            // return $this->shippingAddress;
        // }
        return null;
    }

    public function getAddressValue($address, $value)
    {
        $address .= 'Address';
        if ($this->$address && array_key_exists($value, $this->$address->getOriginalData())) {
            return $this->$address->$value;
        }
        return null;
    }
}
