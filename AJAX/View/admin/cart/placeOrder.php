<?php
$id = $this->getRequest()->getGet('cartId');
$cart = $this->getCart()->load($id);
$cartItems = $this->getCartItems();
$customer = $this->getCustomer();
$paymentMethod = $this->getPaymentMethod();
$shipmentMethod = $this->getShipmentMethod();
$billingAddress = $this->getBillingAddress();
$shippingAddress = $this->getShippingAddress();
?>

<h1>Hello <?= $customer->firstName ?> <?= $customer->lastName; ?></h1>
<br><br>
<center>
    <table border="1px solid black" width="100%" height="100%">
        <tr class="gridtr">
            <th class="gridth" style="text-align:center">Cart Id</th>
            <th class="gridth" style="text-align:center">Product Id</th>
            <th class="gridth" style="text-align:center">Quantity</th>
            <th class="gridth" style="text-align:center">Base Price</th>
            <th class="gridth" style="text-align:center">Row Total</th>
            <th class="gridth" style="text-align:center">Discount</th>
            <th class="gridth" style="text-align:center">Final Total</th>
        </tr>
        <?php foreach ($cartItems->getData() as $key => $item) : ?>
            <tr class="gridtr">
                <td class="gridtd" style="text-align:center"><?php echo $item->cartId; ?></td>
                <td class="gridtd" style="text-align:center"><?php echo $item->productId; ?></td>
                <td class="gridtd" style="text-align:center"><?php echo $item->quantity; ?></td>
                <td class="gridtd" style="text-align:center"><?php echo $item->basePrice; ?></td>
                <td class="gridtd" style="text-align:center"><?php echo $item->getRowTotal(); ?></td>
                <td class="gridtd" style="text-align:center"><?php echo $item->getDiscount(); ?></td>
                <td class="gridtd" style="text-align:center"><?php echo $item->getFinalTotal(); ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
    <br><br>
    <h2>Billing Address</h2>
    <table border="1px solid black" width="100%" height="100%">
        <tr>
            <td class="gridtd">Address</td>
            <td class="gridtd"><?= $billingAddress->address ?></td>
        </tr>
        <tr>
            <td class="gridtd">City</td>
            <td class="gridtd"><?= $billingAddress->city ?></td>
        </tr>
        <tr>
            <td class="gridtd">State</td>
            <td class="gridtd"><?= $billingAddress->state ?></td>
        </tr>
        <tr>
            <td class="gridtd">Country</td>
            <td class="gridtd"><?= $billingAddress->country ?></td>
        </tr>
        <tr>
            <td class="gridtd">Zip Code</td>
            <td class="gridtd"><?= $billingAddress->zipCode ?></td>
        </tr>
    </table>
    <br><br>
    <h2>Shipping Address</h2>
    <table border="1px solid black" width="100%" height="100%">
        <tr>
            <td class="gridtd">Address</td>
            <td class="gridtd"><?= $shippingAddress->address ?></td>
        </tr>
        <tr>
            <td class="gridtd">City</td>
            <td class="gridtd"><?= $shippingAddress->city ?></td>
        </tr>
        <tr>
            <td class="gridtd">State</td>
            <td class="gridtd"><?= $shippingAddress->state ?></td>
        </tr>
        <tr>
            <td class="gridtd">Country</td>
            <td class="gridtd"><?= $shippingAddress->country ?></td>
        </tr>
        <tr>
            <td class="gridtd">Zip Code</td>
            <td class="gridtd"><?= $shippingAddress->zipCode ?></td>
        </tr>
    </table>
    <br><br>
    <h2>Payment Method</h2>
    <table border="1px solid black" width="100%" height="100%">
        <tr>
            <td class="gridtd"><strong>Payment Method</strong></td>
            <td class="gridtd"><?= $paymentMethod; ?></td>
        </tr>
    </table>
    <br><br>
    <h2>Shipping Method</h2>
    <table border="1px solid black" width="100%" height="100%">
        <tr>
            <td class="gridtd"><strong>Shipping Method</strong></td>
            <td class="gridtd"><?= $shipmentMethod->name; ?></td>
        </tr>
    </table>
    <br>
    <br>
    <table border="1px" width="100%" height="100%">
        <tr>
            <th class="gridtd">Total Price</th>
            <td class="gridtd"><?= $cart->getTotal($cartItems); ?></td>
        </tr>
        <tr>
            <th class="gridtd">Total Discount</th>
            <td class="gridtd"><?= $cart->getTotalDiscount($cartItems); ?></td>
        </tr>
        <tr>
            <th class="gridtd">Shipping Charge</th>
            <td class="gridtd"><?= $shipmentMethod->amount; ?></td>
        </tr>
        <tr>
            <th class="gridtd">Final Price</th>
            <td class="gridtd"><?= $cart->getFinalPrice($cartItems);?></td>
        </tr>
    </table>
</center>
<?php
    $this->getDelete();
?>
<center><h1>Thank You .</h1></center>