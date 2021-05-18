<?php
require_once "View\core\layout\message.php";
$cart = $this->getCart();
$cartItems = $cart->getItems();
$currentCustomer = $cart->getCustomer();
$billing = $cart->getBillingAddress();
$shipping = $cart->getShippingAddress();
$allCustomer = $cart->getAllCustomer()->getData();
$payment = $cart->getPaymentMethod()->getData();
$shipping = $cart->getShippingMethod()->getData();
$this->save($cartItems);
// $currentCustomer = $cart->customerId;
$paymentMethod = $cart->paymentMethodId;
$shippingMethod = $cart->shippingMethodId;
$cartAddress = \Mage::getModel('Model\Cart\Address');
$query = "SELECT * FROM `{$cartAddress->getTableName()}` WHERE `addressType` = 'Billing' AND `cartId`= '{$cart->cartId}'";
$billingAddress = $cartAddress->fetchROw($query);
$query = "SELECT * FROM `{$cartAddress->getTableName()}` WHERE `addressType` = 'Shipping' AND `cartId`= '{$cart->cartId}'";
$shippingAddress = $cartAddress->fetchROw($query);
$cartItem = \mage::getModel('Model\Cart\Item');
$query = "SELECT * FROM `{$cartItem->getTableName()}` WHERE `cartId` = '$cart->cartId'"
?>
<form id="form" action="" method="POST">
    <span>Select Customer : </span>
    <select id='customers' onchange="mage.showCartItems().setForm()">
        <option disabled selected>Select Customer</option>
        <?php if ($allCustomer) : ?>
            <?php foreach ($allCustomer as $key => $customer) : ?>
                <option value="<?php echo $this->getUrl()->getUrl('selectCustomer', 'cart', ['customerId' => $customer->customerId], false); ?>" <?php if ($currentCustomer && $currentCustomer->customerId == $customer->customerId) {
                                                                                                                                                        echo "selected";
                                                                                                                                                    } ?>>
                    <?php echo $customer->firstName . ' ' . $customer->lastName; ?>
                </option>
            <?php endforeach; ?>
        <?php endif; ?>
    </select><br><br>
    <input class="btn btn-success" type="button" onclick="mage.setUrl('<?= $this->getUrl()->getUrl('grid', 'product') ?>').resetParams().load();" value="Back to Item">
    <input class="btn btn-success" type="button" onclick="mage.changeAction('<?php echo $this->getUrl()->getUrl('update', 'cart'); ?>').setForm();" value="Update">
    <table border="1px solid black" width="100%" height="100%">
        <tr>
            <th>Cart Id</th>
            <th>Product Id</th>
            <th>Quantity</th>
            <th>Base Price</th>
            <th>Row Total</th>
            <th>Discount</th>
            <th>Final Total</th>
            <th>Action</th>
        </tr>
        <?php if ($cartItems) : ?>
            <?php foreach ($cartItems->getData() as $key => $item) : ?>
                <tr>
                    <td><?php echo $item->cartId; ?></td>
                    <td><?php echo $item->productId; ?></td>
                    <td><input type="number" value="<?php echo $item->quantity; ?>" name="quantity[<?php echo $item->cartItemId; ?>]"></td>
                    <td><?php echo $item->basePrice; ?></td>
                    <td><?php echo $item->getRowTotal(); ?></td>
                    <td><?php echo $item->getDiscount(); ?></td>
                    <td><?php echo $item->getFinalTotal(); ?></td>
                    <td>
                        <a class="btn btn-danger" onclick="mage.setUrl('<?php echo $this->getUrl()->getUrl('delete', 'cart', ['cartItemId' => $item->cartItemId]); ?>').load();">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else : ?>
            <tr>
                <td colspan=8>No Record Found</td>
            </tr>
        <?php endif; ?>
    </table>
    <br><br>
    <table border="1px" width="100%" height="100%">
        <tr>
            <td>
                <table width="100%" height="100%">
                    <tr>
                        <th colspan=2>Billing Address</th>
                    </tr>
                    <tr>
                        <td>Address</td>
                        <td><input type="text" name="billing[address]" value="<?php echo $cart->getAddressValue('billing', 'address'); ?>"></td>
                    </tr>
                    <tr>
                        <td>City</td>
                        <td><input type="text" name="billing[city]" value="<?php echo $cart->getAddressValue('billing', 'city'); ?>"></td>
                    </tr>
                    <tr>
                        <td>State</td>
                        <td><input type="text" name="billing[state]" value="<?php echo $cart->getAddressValue('billing', 'state'); ?>"></td>
                    </tr>
                    <tr>
                        <td>Country</td>
                        <td><input type="text" name="billing[country]" value="<?php echo $cart->getAddressValue('billing', 'country'); ?>"></td>
                    </tr>
                    <tr>
                        <td>Zip Code</td>
                        <td><input type="text" name="billing[zipCode]" value="<?php echo $cart->getAddressValue('billing', 'zipCode'); ?>"></td>
                    </tr>
                    <tr>
                        <td>Save to Address Book</td>
                        <td><input type=checkbox name="billingSave" checked></td>
                    </tr>
                    <tr>
                        <td>
                            <input class="btn btn-success" onclick="mage.changeAction('<?php echo $this->getUrl()->getUrl('billingAddress', 'cart', ['cartId' => $cart->cartId]) ?>').setForm();" type="button" value="Save">
                        </td>
                    </tr>
                </table>
            </td>
            <td>
                <table width="100%" height="100%">
                    <tr>
                        <th colspan=2>Shipping Address</th>
                    </tr>
                    <tr>
                        <td>Address</td>
                        <td><input type="text" name="shipping[address]" value="<?php echo $cart->getAddressValue('shipping', 'address'); ?>"></td>
                    </tr>
                    <tr>
                        <td>City</td>
                        <td><input type="text" name="shipping[city]" value="<?php echo $cart->getAddressValue('shipping', 'city'); ?>"></td>
                    </tr>
                    <tr>
                        <td>State</td>
                        <td><input type="text" name="shipping[state]" value="<?php echo $cart->getAddressValue('shipping', 'state'); ?>"></td>
                    </tr>
                    <tr>
                        <td>Country</td>
                        <td><input type="text" name="shipping[country]" value="<?php echo $cart->getAddressValue('shipping', 'country'); ?>"></td>
                    </tr>
                    <tr>
                        <td>Zip Code</td>
                        <td><input type="text" name="shipping[zipCode]" value="<?php echo $cart->getAddressValue('shipping', 'zipCode'); ?>"></td>
                    </tr>
                    <?php if($billingAddress):?>
                    <tr>
                        <td>Same As Billing</td>
                        <td><input type=checkbox name="shipping[sameAsBilling]" checked></td>
                    </tr>
                    <?php endif;?>
                    <tr>
                        <td>Save to Address Book</td>
                        <td><input type=checkbox name="shippingSave" checked></td>
                    </tr>
                    <tr>
                        <td>
                            <input class="btn btn-success" onclick="mage.changeAction('<?php echo $this->getUrl()->getUrl('shippingAddress', 'cart', ['cartId' => $cart->cartId]) ?>').setForm();" type="button" value="Save">
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td>
                <table width="100%" height="100%">
                    <tr>
                        <th>Payment Method</th>
                    </tr>
                    <?php foreach ($payment as $key => $obj) : ?>
                        <tr>
                            <td>
                                <input type="radio" name="payment[<?php echo $cart->cartId; ?>]" <?php if ($obj->methodId == $cart->paymentMethodId) echo "checked" ?> value="<?php echo $obj->methodId; ?>" required>
                                <?php echo $obj->name ?>
                            <td>
                        </tr>
                    <?php endforeach; ?>
                    <tr>
                        <td><input class="btn btn-success" onclick="mage.changeAction('<?php echo $this->getUrl()->getUrl('payment', 'cart') ?>').setForm();" type="button" value="Save"></td>
                    </tr>
                </table>
            </td>
            <td>
                <table width="100%" height="100%">
                    <tr>
                        <th>Select Delivery Type</th>
                    </tr>
                    <?php foreach ($shipping as $key => $obj) : ?>
                        <tr>
                            <td><input type="radio" name="delivery[<?php echo $cart->cartId; ?>]" value="<?php echo $obj->methodId; ?>" <?php if ($cart->shippingMethodId == $obj->methodId) echo "checked " ?> required><?php echo $obj->name . '(' . $obj->description . ')'; ?>
                            <td>
                            <td>Charge : <?php echo $obj->amount; ?>$</td>
                        </tr>
                    <?php endforeach; ?>
                    <tr>
                        <td><input class="btn btn-success" onclick="mage.changeAction('<?php echo $this->getUrl()->getUrl('delivery', 'cart') ?>').setForm();" type="button" value="Save"></td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
    <br><br>
    <table border="1px" width="100%" height="100%">
        <tr>
            <th>Total Price</th>
            <td><?php echo $cart->getTotal($cartItems); ?></td>
        </tr>
        <tr>
            <th>Total Discount</th>
            <td><?php echo $cart->getTotalDiscount($cartItems); ?></td>
        </tr>
        <tr>
            <th>Shipping Charge</th>
            <td><?php echo $cart->shippingAmount; ?></td>
        </tr>
        <tr>
            <th>Final Price</th>
            <td><?php echo $cart->getFinalPrice($cartItems); ?></td>
        </tr>
    </table>
    <br><br>
    <center>
        <?php if ($cartItems) : ?>
            <?php if ($currentCustomer) : ?>
                <?php if ($billingAddress) : ?>
                    <?php if ($shippingAddress) : ?>
                        <?php if ($paymentMethod) : ?>
                            <?php if ($shippingMethod) : ?>
                                <center><input type="button" class="btn btn-success" onclick="mage.setUrl('<?php echo $this->getUrl()->getUrl('placeOrder', 'cart\PlaceOrder', ['cartId' => $cart->cartId]); ?>').load();" value="Place Order"></center>
                            <?php else : ?>
                                <?php echo 'Please select Shipping Method'; ?>
                            <?php endif; ?>
                        <?php else : ?>
                            <?php echo 'Please select Payment Method'; ?>
                        <?php endif; ?>
                    <?php else : ?>
                        <?php echo 'Please save Shipping Address.'; ?>
                    <?php endif; ?>
                <?php else : ?>
                    <?php echo 'Please save Billing Address.'; ?>
                <?php endif; ?>
            <?php else : ?>
                <?php echo 'Please select Customer.'; ?>
            <?php endif; ?>
        <?php else : ?>
            <?php echo 'Please Add Item into Cart'; ?>
        <?php endif; ?>
    </center>
</form>