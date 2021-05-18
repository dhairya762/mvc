<?php
$product = $this->getProduct();
$option = $product->getStatusOption();
?>
<form id="form" action="<?= $this->getUrl()->getUrl('save', NULL, ['productId' => $product->productId], true); ?>" method="POST">
    <center>
        <h1><?= $this->getTitle(); ?></h1>
        <table class="grid">
            <tr>
                <td>SKU</td>
                <td><input type="text" name="product[sku]" value="<?= $product->sku; ?>"></td>
            </tr>
            <tr>
                <td>Name</td>
                <td><input type="text" name="product[name]" value="<?= $product->name; ?>"></td>
            </tr>
            <tr>
                <td>Price</td>
                <td><input type="text" name="product[price]" value="<?= $product->price; ?>"></td>
            </tr>
            <tr>
                <td>Discount</td>
                <td><input type="text" name="product[discount]" value="<?= $product->discount; ?>"></td>
            </tr>
            <tr>
                <td>Quantity</td>
                <td><input type="number" name="product[quantity]" value="<?= $product->quantity; ?>"></td>
            </tr>
            <tr>
                <td>Description</td>
                <td><textarea name="product[description]"><?= $product->description; ?></textarea></td>
            </tr>
            <tr>
                <td>Status</td>
                <td>
                    <select name="product[status]">
                        <?php foreach ($option as $key => $value) : ?>
                            <option value="<?= $key; ?>" <?php if ($product->status == $key) {
                                                                echo "selected";
                                                            } ?>><?= $value; ?></option>
                        <?php endforeach; ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td></td>
                <td><input type="button" onclick="mage.setForm()" value="Save" class="btn btn-success"></td>
            </tr>
        </table>
    </center>
</form>