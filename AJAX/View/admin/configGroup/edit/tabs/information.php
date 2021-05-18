<?php $configGroup = $this->getConfigGroup(); ?>
<h1>Config Group Form</h1>
<form id="form" action="<?= $this->getUrl()->getUrl('save'); ?>" method="POST">
    <center>
        <table>
            <tr>
                <td>
                    Name:
                </td>
                <td>
                    <input type="text" name="configGroup[name]" value="<?= $configGroup->name; ?>">
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