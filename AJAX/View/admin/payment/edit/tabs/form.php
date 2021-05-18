<?php
$payments = $this->getPayment();
$option = $payments->getStatusOption();
?>
<form id="form" action="<?= $this->getUrl()->getUrl('save', NULL, ['methodId' => $payments->methodId]); ?>" method="POST">
    <center>
            <h1><?= $this->getTitle(); ?></h1>
        <table class="grid">
            <tr class="gridtr">
                <td class="gridtd">
                    Name:
                </td>
                <td class="gridtd">
                    <input type="text" name="payment[name]" value="<?= $payments->name; ?>">
                </td>
            </tr>
            <tr class="gridtr">
                <td class="gridtd">
                    code:
                </td>
                <td class="gridtd">
                    <input type="text" name="payment[code]" value="<?= $payments->code; ?>">
                </td>
            </tr>
            <tr class="gridtr">
                <td class="gridtd">
                    Description:
                </td>
                <td class="gridtd">
                <textarea name="payment[description]"><?= $payments->description; ?></textarea>
                </td>
            </tr>
            <tr class="gridtr">
                <td class="gridtd">
                    Status:
                </td>
                <td class="gridtd">
                    <select name="payment[status]">
                        <?php foreach ($option as $key => $value) : ?>
                            <option value="<?= $key; ?>" <?php if ($payments->status == $key) {
                                                                echo "selected";
                                                            } ?>><?= $value; ?></option>
                        <?php endforeach; ?>
                    </select>
                </td>
            </tr>
            <tr class="gridtr">
                <td class="gridtd">
                </td>
                <td class="gridtd">
                    <input type='button' class="btn btn-success" onclick="mage.setForm()" name='submit' value='Submit'>
                </td>
            </tr>
        </table>
    </center>
</form>