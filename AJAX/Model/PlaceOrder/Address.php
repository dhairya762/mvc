<?php

namespace Model\PlaceOrder;

class Address extends \Model\Core\Table
{

    const ADDRESS_TYPE_BILLING = "billing";
    const ADDRESS_TYPE_SHIPPING = "shipping";

    protected $placeOrder = null;
    protected $shippingAddress = null;
    protected $billingAddress = null;

    public function __construct()
    {
        parent::__construct();
        $this->setTableName("placeorderaddress");
        $this->setPrimaryKey("placeOrderAddressId");
    }

    public function setPlaceOrder(\Model\PlaceOrder $placeOrder)
    {
        $this->placeOrder = $placeOrder;
        return $this;
    }
    public function getPlaceOrder()
    {
        if (!$this->placeOrderId) {
            return false;
        }
        $cartId = $_GET['cartId'];
        $placeOrder = \Mage::getModel('Model\PlaceOrder')->load($cartId);
        $this->setPlaceOrder($placeOrder);
        return $this->placeOrder;
    }
}
