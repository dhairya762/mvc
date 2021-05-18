<?php

namespace Block\Admin\Cart;
class PlaceOrder extends \Block\Core\Template{
    protected $cart = null;

    public function __construct(){
        $this->setTemplate('./View/admin/cart/placeOrder.php');
    }

    public function setCart(\Model\Cart $cart = null){
        if ($cart) {
            $this->cart = $cart;
            return $this;
        }
        $cart = \Mage::getModel('Model\Cart');
        $this->cart = $cart;
        return $this;
    }

    public function getCart(){
        if(!$this->cart){
            $this->setCart();
        }
        return $this->cart;
    }

    public function getCustomer()
    {
        $cartId = $this->getRequest()->getGet('cartId');
        $customerId = \Mage::getModel('Model\Cart')->load($cartId)->customerId;
        $customer = \Mage::getModel('Model\Customer')->load($customerId);
        return $customer;
    }

    public function getBillingAddress()
    {
        $cartId = $this->getRequest()->getGet('cartId');
        $cartAddress = \Mage::getModel('Model\Cart\Address');
        $query = "SELECT * FROM `{$cartAddress->getTableName()}` WHERE `cartId` =  '$cartId' AND `addressType` = 'Billing'";
        $cartAddress = $cartAddress->fetchRow($query);
        return $cartAddress;
    }
    
    public function getShippingAddress()
    {
        $cartId = $this->getRequest()->getGet('cartId');
        $cartAddress = \Mage::getModel('Model\Cart\Address');
        $query = "SELECT * FROM `{$cartAddress->getTableName()}` WHERE `cartId` =  '$cartId' AND `addressType` = 'Shipping'";
        $cartAddress = $cartAddress->fetchRow($query);
        return $cartAddress;
    }

    public function getPaymentMethod()
    {
        $cartId = $this->getRequest()->getGet('cartId');
        $paymentMethodId = \Mage::getModel('Model\Cart')->load($cartId)->paymentMethodId;
        $payment = \Mage::getModel('Model\Payment')->load($paymentMethodId)->name;
        return $payment;
    }
    
    public function getShipmentMethod()
    {
        $cartId = $this->getRequest()->getGet('cartId');
        $shippingMethodId = \Mage::getModel('Model\Cart')->load($cartId)->shippingMethodId;
        $shipment = \Mage::getModel('Model\Shipping')->load($shippingMethodId);
        return $shipment;
    }

    public function getCartItems()
    {
        $cartId = $this->getRequest()->getGet('cartId');
        $cartItems = \mage::getModel('Model\Cart\Item');
        $query = "SELECT * FROM `{$cartItems->getTableName()}` WHERE `cartId` = '{$cartId}'";
        $cartItems = $cartItems->fetchAll($query);
        return $cartItems;
    }

    public function getDelete()
    {
        $id = $this->getRequest()->getGet('cartId');
        $cart = \Mage::getModel('Model\Cart')->load($id);
        $cart->delete();
    }
}