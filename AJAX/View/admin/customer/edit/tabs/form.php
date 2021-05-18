<?php
$customers = $this->getCustomer();
$option = $customers->getStatusOption();
$group = $this->getGroup();
// print_r($group);
// die;
?>
<form id='form' action="<?= $this->getUrl()->getUrl('save', NULL, ['customerId' => $customers->customerId], true); ?>" method="POST">
    <center>
        <h1><?= $this->getTitle(); ?></h1>
        <table>
            <tr>
                <td>
                    Group:
                </td>
                <td>
                    <select name="customer[groupId]">
                        <?php foreach ($group->getData() as $key => $value) : ?>
                            <option value="<?= $value->groupId ?>"><?= $value->name; ?></option>
                        <?php endforeach; ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td>
                    First Name:
                </td>
                <td>
                    <input type="text" name="customer[firstName]" value="<?= $customers->firstName; ?>">
                </td>
            </tr>
            <tr>
                <td>
                    Last Name:
                </td>
                <td>
                    <input type="text" name="customer[lastName]" value="<?= $customers->lastName; ?>">
                </td>
            </tr>
            <tr>
                <td>
                    Email:
                </td>
                <td>
                    <input type="text" name="customer[email]" value="<?= $customers->email; ?>">
                </td>
            </tr>
            <tr>
                <td>
                    Passsword:
                </td>
                <td>
                    <input type="password" name="customer[password]" value="<?= $customers->password; ?>">
                </td>
            </tr>
            <tr>
                <td>
                    Status:
                </td>
                <td>
                    <select name="customer[status]">
                        <?php foreach ($option as $key => $value) : ?>
                            <option value="<?= $key; ?>" <?php if ($customers->status == $key) {
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
                    <input type="button" class="btn btn-success" onclick="mage.setForm()" value="Save">
                </td>
            </tr>
        </table>
    </center>
</form>