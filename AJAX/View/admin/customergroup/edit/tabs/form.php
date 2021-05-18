<?php
$customerGroup = $this->getCustomerGroup();
$option = $customerGroup->getStatusOption();
?>
<form id="form" action="<?= $this->getUrl()->getUrl('save', NULL, ['groupId' => $customerGroup->groupId], true); ?>" method="POST">
    <center>
        <h1><?= $this->getTitle(); ?></h1>
        <table>
            <tr>
                <td>
                    Name:
                </td>
                <td>
                    <input type="text" name="customerGroup[name]" value="<?= $customerGroup->name; ?>">
                </td>
            </tr>
            <tr>
                <td>
                    Status:
                </td>
                <td>
                    <select name="customerGroup[status]">
                        <?php foreach ($option as $key => $value) : ?>
                            <option value="<?= $key; ?>" <?php if ($customerGroup->status == $key) {
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
                    <input type="button" class="btn btn-success" onclick="mage.setForm()" value="Submit">
                </td>
            </tr>
        </table>
    </center>
</form>