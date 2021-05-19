`<?php $product = $this->getProduct(); ?>
<?php $attributes = $this->getAttribute()->getData(); ?>
<?php if ($product) : ?>
    <div class="container-fluid m-0 p-4 col justify-content-center">
        <form action="<?= $this->getUrl()->getUrl('save', 'Product\Attribute', ['productId' => $product->productId], true); ?>" method="post" id="form">
            <input type="button" value="Save" onclick="mage.setForm();" class="btn btn-success">
            <div class="col m-0 p-1">
                <?php if (count($attributes)) : ?>
                    <?php foreach ($attributes as $key => $attribute) : ?>
                        <?php if ($attribute->inputType) : // == 'select') : 
                        ?>
                            <div class="row m-0 p-1">
                                <div class="col-4 m-0 p-1">
                                    <h5><?php echo $attribute->name; ?></h5>
                                </div>
                                <div class="col-7 m-0 p-0">
                                    <select name="attribute[<?php echo $attribute->code; ?>]">
                                        <?php $options = $this->getAttributeOption($attribute->attributeId); ?>
                                        <?php if ($options) :?>
                                        <?php foreach ($options as $key => $option) : ?>
                                            <option value="<?php echo $option->name; ?>" <?php if ($product->{$option->code} == $option->name) {
                                                echo "selected";
                                            } ?>>
                                                <?php echo $option->name; ?>
                                            </option>
                                        <?php endforeach; ?>
                                        <?php else:?>
                                            <option selected disabled>Select</option>
                                        <?php endif;?>
                                    </select>
                                </div>
                            </div>
                        <?php endif; ?>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </form>
    </div>
<?php else : ?>
    <center>
        <h5>Add Product First</h5>
    </center>
<?php endif; ?>