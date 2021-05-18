<?php

namespace Controller\Admin;

class Cart extends \Controller\Core\Admin
{

    public function addItemToCartAction()
    {
        try {
            $productId = $this->getRequest()->getGet('productId');
            if ($productId) {
                $product = \Mage::getModel('Model\Product')->load($productId);
                if (!$product) {
                    throw new \Exception("Product is not valid");
                }
                $cart = $this->getCart();
                $cart = $cart->addItemToCart($product, 1, true);
                if (!$cart) {
                    $this->redirect('grid', 'cart');
                }
            }
            $this->redirect('grid', 'cart', [], true);
        } catch (\Exception $e) {
            $this->getMessage()->setFailure($e->getMessage());
        }
    }

    public function selectCustomerAction()
    {
        $customerId = $this->getRequest()->getGet('customerId');
        $this->getCart($customerId);

        $this->redirect('grid');
    }

    protected function getCart($customerId = null)
    {
        try {
            $session = \Mage::getModel('Model\Admin\Session');
            $customer = \Mage::getModel('Model\Customer');
            $query = "SELECT * FROM `{$customer->getTableName()}`";
            $customer = $customer->fetchRow($query);
            $session->customerId = $customer->customerId;
            $cart = \Mage::getModel('Model\Cart');
            if (!$customerId && !$session->customerId) {
                return $cart;
            }
            if ($customerId) {
                $session->customerId = $customerId;
            }
            
            $query = "SELECT * FROM `cart` WHERE `customerId` = '{$session->customerId}'";
            $cart = $cart->fetchRow($query);
            if ($cart) {
                return $cart;
            }
            $cart = \Mage::getModel('Model\Cart');
            $cart->customerId = $session->customerId;
            
            return $cart;
        } catch (\Exception $e) {
            $this->getMessage()->setFailure($e->getMessage());
        }
    }

    public function gridAction()
    {
        try {
            $grid = \Mage::getBlock('Block\Admin\Cart\Grid');
            $layout = $this->getLayout()->getContent()->addChild($grid);
            $cart = $this->getCart();
            $grid = $grid->setCart($cart)->toHtml();
            $this->makeResponse($grid);
        } catch (\Exception $e) {
            $this->getMessage()->setFailure($e->getMessage());
        }
    }

    public function deleteAction()
    {
        try {
            $id = $this->getRequest()->getGet('cartItemId');
            $cartItem = \Mage::getModel("Model\Cart\Item")->load($id);
            $cartItem->delete();

            $grid = \Mage::getBlock('Block\Admin\Cart\Grid');
            $cart = $this->getCart();
            $grid = $grid->setCart($cart)->toHtml();
            $this->makeResponse($grid);
        } catch (\Exception $e) {
            $this->getMessage()->setFailure($e->getMessage());
        }
    }

    public function updateAction()
    {
        try {
            $quantities = $this->getRequest()->getPost('quantity');
            $cartItem = \Mage::getModel('Model\Cart\Item');
            $price = 0;
            foreach ($quantities as $cartItemId => $quantity) {
                $cartItem = $cartItem->load($cartItemId);
                if (!($quantity > 0)) {
                    if ($quantity < 0) {
                        $this->getMessage()->setFailure("Invalid quantity given.");
                        break;
                    }
                    else{
                        $query = "DELETE FROM `cartitem` WHERE `cartItemId` = '{$cartItemId}' AND `productId` = '{$cartItem->productId}'";
                        $cartItem->delete($query);
                        $this->getMessage()->setSuccess("Quantity is 0 given so delete successfully.");
                        // $cartItem->save();
                    }
                } else {
                    if (!$cartItem) {
                        throw new \Exception('Item With This Cart Is Not Found');
                    }
                    $cartItem->quantity = $quantity;
                    $cartItem->price = $cartItem->getRowTotal();
                    if ($cartItem->save()) {
                        $this->getMessage()->setSuccess('Quantity updated successfully');
                    }
                }

            }
            $grid = \Mage::getBlock('Block\Admin\Cart\Grid');
            $layout = $this->getLayout()->getContent()->addChild($grid);
            $cart = $this->getCart();
            $grid = $grid->setCart($cart)->toHtml();
            $this->makeResponse($grid);
        } catch (\Exception $e) {
            $this->getMessage()->setFailure($e->getMessage());
        }
    }

    public function deliveryAction()
    {
        try {
            $cart = \Mage::getModel('Model\Cart');
            $option = $this->getRequest()->getPost('delivery');
            if ($option) {
                foreach ($option as $key => $value) {
                    $cart = $cart->load($key);
                    $cart->shippingMethodId = $value;
                    $cart->shippingAmount = $cart->getShippingAmount();
                    $cart->save();
                    $this->getMessage()->setSuccess('Shipping Method successfully Updated.');
                }
            }

            $grid = \Mage::getBlock('Block\Admin\Cart\Grid');
            $layout = $this->getLayout()->getContent()->addChild($grid);
            $cart = $this->getCart();
            $grid = $grid->setCart($cart)->toHtml();
            $this->makeResponse($grid);
        } catch (\Exception $e) {
            $this->getMessage()->setFailure($e->getMessage());
        }
    }

    public function paymentAction()
    {
        try {
            $cart = \Mage::getModel('Model\Cart');
            $option = $this->getRequest()->getPost('payment');
            if ($option) {
                foreach ($option as $key => $value) {
                    $cart = $cart->load($key);
                    $cart->paymentMethodId = $value;
                    $cart->save();
                    $this->getMessage()->setSuccess('Payment Method is successfully updated.');
                }
            }

            $grid = \Mage::getBlock('Block\Admin\Cart\Grid');
            $layout = $this->getLayout()->getContent()->addChild($grid);
            $cart = $this->getCart();
            $grid = $grid->setCart($cart)->toHtml();
            $this->makeResponse($grid);
        } catch (\Exception $e) {
            $this->getMessage()->setFailure($e->getMessage());
        }
    }

    public function shippingAddressAction()
    {
        $data = $this->getRequest()->getPost('shipping');
        $id = $this->getRequest()->getGet('cartId');
        $saveToAddress = $this->getRequest()->getPost('shippingSave');

        $cart = \Mage::getModel('Model\Cart')->load($id);
        $shippingAddress = \Mage::getModel('Model\Cart\Address');

        if (array_key_exists('sameAsBilling', $data)) {
            $billingAddress = $cart->getCartBillingAddress();

            if ($availableAddress = $cart->getCartShippingAddress()) {
                $shippingAddress = $availableAddress;
                $shippingAddress->setData($billingAddress->getOriginalData());
                unset($shippingAddress->cartAddressId);
                $shippingAddress->addressType = 'shipping';
            } else {
                $shippingAddress->setData($billingAddress->getOriginalData());
                unset($shippingAddress->cartAddressId);
                $shippingAddress->addressType = 'shipping';
            }
            $shippingAddress->sameAsBilling = 1;
        } else {
            if ($availableAddress = $cart->getCartShippingAddress()) {
                $shippingAddress = $availableAddress;
                $shippingAddress->setData($data);
            } else {
                $shippingAddress->setData($data);
                $shippingAddress->cartId = $cart->cartId;
                $shippingAddress->addressType = 'shipping';
            }
        }
        $shippingAddress->save();
        if ($saveToAddress) {
            $customerAddress = $cart->getCustomer()->getShippingAddress();
            if (!$customerAddress) {
                $customerAddress = \Mage::getModel('Model\Customer\Address');
                $customerAddress->customerId = $cart->customerId;
                $customerAddress->addressType = 'shipping';
            }
            $customerAddress->address = $shippingAddress->address;
            $customerAddress->city = $shippingAddress->city;
            $customerAddress->state = $shippingAddress->state;
            $customerAddress->zipCode = $shippingAddress->zipCode;
            $customerAddress->country = $shippingAddress->country;
        }
        if ($customerAddress->save()) {
            $this->getMessage()->setSuccess('Shipping Address is successfully updated and address is also saved in AddressBook.');
        }
        else {
            $this->getMessage()->setSuccess('Shipping Address is successfully updated.');
        }
        
        
        $grid = \Mage::getBlock('Block\Admin\Cart\Grid');
        $layout = $this->getLayout()->getContent()->addChild($grid);
        $cart = $this->getCart();
        $grid = $grid->setCart($cart)->toHtml();
        $this->makeResponse($grid);
    }
    
    public function billingAddressAction()
    {
        $data = $this->getRequest()->getPost('billing');
        $id = $this->getRequest()->getGet('cartId');
        $saveToAddress = $this->getRequest()->getPost('billingSave');
        
        $cart = \Mage::getModel('Model\Cart')->load($id);
        $billingAddress = \Mage::getModel('Model\Cart\Address');
        
        if ($availableAddress = $cart->getCartBillingAddress()) {
            $billingAddress = $availableAddress;
            $billingAddress->setData($data);
        } else {
            $billingAddress->setData($data);
            $billingAddress->cartId = $cart->cartId;
            $billingAddress->addressType = 'billing';
        }
        $billingAddress->save();
        
        if ($saveToAddress) {
            $customerAddress = $cart->getCustomer()->getBillingAddress();
            if (!$customerAddress) {
                $customerAddress = \Mage::getModel('Model\Customer\Address');
                $customerAddress->customerId = $cart->customerId;
                $customerAddress->addressType = 'billing';
            }
            $customerAddress->address = $billingAddress->address;
            $customerAddress->city = $billingAddress->city;
            $customerAddress->state = $billingAddress->state;
            $customerAddress->zipCode = $billingAddress->zipCode;
            $customerAddress->country = $billingAddress->country;
        }
        if ($customerAddress->save()) {
            $this->getMessage()->setSuccess('Billing Address is successfully updated and address is also saved in AddressBook.');
        }
        else {
            $this->getMessage()->setSuccess('Billing Address is successfully updated.');
        }
        if ($customerAddress->save()) {
        }

        $grid = \Mage::getBlock('Block\Admin\Cart\Grid');
        $layout = $this->getLayout()->getContent()->addChild($grid);
        $cart = $this->getCart();
        $grid = $grid->setCart($cart)->toHtml();
        $this->makeResponse($grid);
    }
}
