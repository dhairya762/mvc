<?php
$shipping = $this->getShipping();
$option = $shipping->getStatusOption();
?>


<form id="form" action="<?= $this->getUrl()->getUrl('save', NULL, ['methodId' => $shipping->methodId], true); ?>" method="POST">
    <center>
<h1><?= $this->getTitle();?></h1>
        <table>
            <tr>
                <td>
                    Name:
                </td>
                <td>
                    <input type="text" name="shipping[name]" value="<?= $shipping->name; ?>">
                </td>
            </tr>
            <tr>
                <td>
                    Code:
                </td>
                <td>
                    <input type="text" name="shipping[code]" value="<?= $shipping->code; ?>">
                </td>
            </tr>
            <tr>
                <td>
                    Amount:
                </td>
                <td>
                    <input type="text" name="shipping[amount]" value="<?= $shipping->amount; ?>">
                </td>
            </tr>
            <tr>
                <td>
                    Description:
                </td>
                <td>
                    <textarea name="shipping[description]"><?= $shipping->description; ?></textarea>
                </td>
            </tr>
            <tr>
                <td>
                    Status:
                </td>
                <td>
                    <select name="shipping[status]">
                        <?php foreach ($option as $key => $value) : ?>
                            <option value="<?= $key; ?>" <?php if ($shipping->status == $key) {
                                                                echo "selected";
                                                            } ?>><?= $value; ?></option>
                        <?php endforeach; ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td>
                </td>
                <td>
                    <input class="btn btn-success" type="button" onclick="mage.setForm()" value="Save">
                </td>
            </tr>
        </table>
    </center>
</form>