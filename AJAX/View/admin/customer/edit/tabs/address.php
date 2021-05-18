<?php

$billing = $this->getBillingAddress();
$shipping = $this->getShippingAddress();

?>
<h1>Customer Address Form</h1>
<form id="form" action="<?= $this->getUrl()->getUrl('save', 'Customer\Address' , ['customerId' => $this->getRequest()->getGet('customerId')], true); ?>" method="POST">
    <center>
        <p>Billing Address</p>
        <?php if($billing):?>
        <table>
            <tr>
                <td>
                    Address:
                </td>
                <td>
                    <input type="text" name="billing[address]" value="<?= $billing->address; ?>">
                </td>
            </tr>
            <tr>
                <td>
                    City:
                </td>
                <td>
                    <input type="text" name="billing[city]" value="<?= $billing->city; ?>">
                </td>
            </tr>
            <tr>
                <td>
                    State:
                </td>
                <td>
                    <input type="text" name="billing[state]" value="<?= $billing->state; ?>">
                </td>
            </tr>
            <tr>
                <td>
                    Zip Code:
                </td>
                <td>

                    <input type="text" name="billing[zipCode]" value="<?= $billing->zipCode; ?>">
                </td>
            </tr>
            <tr>
                <td>
                    Country:
                </td>
                <td>
                    <input type="text" name="billing[country]" value="<?= $billing->country; ?>">
                </td>
            </tr>
        </table>
        <?php else:?>
            <table>
            <tr>
                <td>
                    Address:
                </td>
                <td>
                    <input type="text" name="billing[address]">
                </td>
            </tr>
            <tr>
                <td>
                    City:
                </td>
                <td>
                    <input type="text" name="billing[city]">
                </td>
            </tr>
            <tr>
                <td>
                    State:
                </td>
                <td>
                    <input type="text" name="billing[state]">
                </td>
            </tr>
            <tr>
                <td>
                    Zip Code:
                </td>
                <td>

                    <input type="text" name="billing[zipCode]">
                </td>
            </tr>
            <tr>
                <td>
                    Country:
                </td>
                <td>
                    <input type="text" name="billing[country]">
                </td>
            </tr>
        </table>
        <?php endif;?>
        <p>Shipping Address</p>
        <?php if($shipping):?>
        <table>
            <tr>
                <td>
                    Address:
                </td>
                <td>
                    <input type="text" name="shipping[address]" value="<?= $shipping->address; ?>">
                </td>
            </tr>
            <tr>
                <td>
                    City:
                </td>
                <td>
                    <input type="text" name="shipping[city]" value="<?= $shipping->city; ?>">
                </td>
            </tr>
            <tr>
                <td>
                    State:
                </td>
                <td>
                    <input type="text" name="shipping[state]" value="<?= $shipping->state; ?>">
                </td>
            </tr>
            <tr>
                <td>
                    Zip Code:
                </td>
                <td>
                    <input type="text" name="shipping[zipCode]" value="<?= $shipping->zipCode; ?>">
                </td>
            </tr>
            <tr>
                <td>
                    Country:
                </td>
                <td>
                    <input type="text" name="shipping[country]" value="<?= $shipping->country; ?>">
                </td>
            </tr>
        <?php else:?>
            <table>
            <tr>
                <td>
                    Address:
                </td>
                <td>
                    <input type="text" name="shipping[address]">
                </td>
            </tr>
            <tr>
                <td>
                    City:
                </td>
                <td>
                    <input type="text" name="shipping[city]">
                </td>
            </tr>
            <tr>
                <td>
                    State:
                </td>
                <td>
                    <input type="text" name="shipping[state]">
                </td>
            </tr>
            <tr>
                <td>
                    Zip Code:
                </td>
                <td>
                    <input type="text" name="shipping[zipCode]">
                </td>
            </tr>
            <tr>
                <td>
                    Country:
                </td>
                <td>
                    <input type="text" name="shipping[country]">
                </td>
            </tr>
        <?php endif;?>
            <tr>
                <td>
                </td>
                <td>
                    <input type="button" class="btn btn-success" onclick="mage.setForm();" value="Save">
                </td>
            </tr>
        </table>
    </center>
</form>