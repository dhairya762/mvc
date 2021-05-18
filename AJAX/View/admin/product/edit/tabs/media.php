  
<?php $media = $this->getMedia();
?>
<h1>Product Media</h1>
<form id="form" action="#" enctype="multipart/form-data" method="POST">
    <table class="grid">
        <tr>
            <td colspan="5"></td>
            <td><input type="button" class="btn btn-success" onclick="mage.changeAction('<?php echo $this->getUrl()->getUrl('updateImage','Product\Media'); ?>').setForm()" name="update" value="Update"></td>
            <td><input type="button" class="btn btn-danger" onclick="mage.changeAction('<?php echo $this->getUrl()->getUrl('removeImage', 'Product\Media'); ?>').setForm()" name="remove" value="Remove"></td>
        </tr>
        <tr class="gridtr">
            <th style="text-align:center" class="gridth"></th>
            <th style="text-align:center" class="gridth">Label</th>
            <th style="text-align:center" class="gridth">Small</th>
            <th style="text-align:center" class="gridth">Thumb</th>
            <th style="text-align:center" class="gridth">Base</th>
            <th style="text-align:center" class="gridth">Gallery</th>
            <th style="text-align:center" class="gridth">Remove</th>
        </tr>
        <?php if(!$media):?>
        <tr>
            <td colspan="7"><center>No Image Found.</center></td>
        </tr>
        <?php else: ?>
        <?php foreach($media as $key=>$value):?>
            <tr class="gridtr">
                <td style="text-align:center" class="gridtd"><image src="<?php echo $value->image; ?>" height="100" width="100"></td>
                <td style="text-align:center" class="gridtd"><input type="text" name="label[<?php echo $value->imageId ?>]" value="<?php echo $value->label;?>"></td>
                <td style="text-align:center" class="gridtd"><input type="radio" name="small" value="<?php echo $value->imageId; ?>" <?php if($value->small){echo "checked";}?>></td>
                <td style="text-align:center" class="gridtd"><input type="radio" name="thumb" value="<?php echo $value->imageId; ?>" <?php if($value->thumb){echo "checked";}?>></td>
                <td style="text-align:center" class="gridtd"><input type="radio" name="base" value="<?php echo $value->imageId; ?>" <?php if($value->base){echo "checked";}?>></td>
                <td style="text-align:center" class="gridtd"><input type="checkbox" name="gallery[<?php echo $value->imageId; ?>]" <?php if($value->gallery){echo "checked";}?>></td>
                <td style="text-align:center" class="gridtd"><input type="checkbox" name="delete[<?php echo $value->imageId; ?>]"></td>
            </tr>
        <?php endforeach; ?>
        <?php endif;?>
    </table><br><br>
    <input type="file" name="image" id="image">
    <input type="button" class="btn btn-success" name="image" onclick="mage.changeAction('<?php echo $this->getUrl()->getUrl('addImage', 'Product\Media'); ?>').setImage()" value="Upload">
</form>