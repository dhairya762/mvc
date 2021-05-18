<?php

namespace Controller\Admin\Cart;

class PlaceOrder extends \Controller\Core\Admin
{


    public function placeOrderAction()
    {
        $id = $this->getRequest()->getGet('cartId');
        $placeOrder = \Mage::getModel('Model\PlaceOrder');
        $cart = \Mage::getModel('Model\Cart');
        $cart = $cart->load($id);
        $placeOrder->cartId = $cart->cartId;
        $placeOrder->customerId = $cart->customerId;
        $placeOrder->total = $cart->total;
        $placeOrder->discount = $cart->discount;
        $placeOrder->paymentMethodId = $cart->paymentMethodId;
        $placeOrder->shippingMethodId = $cart->shippingMethodId;
        $placeOrder->shippingAmount = $cart->shippingAmount;
        $placeOrder->save();
        
        $cartAddress = \Mage::getModel('Model\Cart\Address');
        $placeOrderAddress = \Mage::getModel('Model\PlaceOrder\Address');
        $query = "SELECT * FROM `{$cartAddress->getTableName()}` WHERE `cartId` = '{$id}'";
        $cartAddress = $cartAddress->fetchAll($query)->getData();
        $placeOrder = $placeOrder->load($id, 'cartId');
        foreach ($cartAddress as $key => $value) {
            $placeOrderAddress->placeOrderId = $placeOrder->placeOrderId;
            $placeOrderAddress->address = $value->address;
            $placeOrderAddress->addressType = $value->addressType;
            $placeOrderAddress->city = $value->city;
            $placeOrderAddress->state = $value->state;
            $placeOrderAddress->country = $value->country;
            $placeOrderAddress->zipCode = $value->zipCode;
            $placeOrderAddress->sameAsBilling = $value->sameAsBilling;
            $placeOrderAddress->save();
        }

        $placeOrderItem = \Mage::getModel('Model\PlaceOrder\Item');
        $cartItem = \Mage::getModel('Model\Cart\Item');
        $query = "SELECT * FROM `{$cartItem->getTableName()}` WHERE `cartId` = '{$id}'";
        $cartItem = $cartItem->fetchAll($query)->getData();
        foreach ($cartItem as $key => $value) {
            $placeOrderItem->placeOrderId = $placeOrder->placeOrderId;
            $placeOrderItem->productId = $value->productId;
            $placeOrderItem->basePrice = $value->basePrice;
            $placeOrderItem->quantity = $value->quantity;
            $placeOrderItem->price = $value->price;
            $placeOrderItem->discount = $value->discount;
            $placeOrderItem->save();
        }
        
        $placeOrder = \Mage::getBlock('Block\Admin\Cart\PlaceOrder')->toHtml();
        $this->makeresponse($placeOrder);
    }
}
