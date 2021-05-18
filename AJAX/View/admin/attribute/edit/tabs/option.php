<?php
$options = $this->getOption()->getOptions();
?>
<form id="form" action="<?= $this->getUrl()->getUrl('update', 'Attribute\Option'); ?>" method="POST">
    <input type="button" class="btn btn-primary" onclick="mage.setForm()" name="update" value="Update">
    <input type="button" class="btn btn-primary" name="addOption" value="Add Option" onclick="addRow();">
    <table id='existingOption' class='grid'>
        <tbody>
            <?php if (!$options) : ?>
                <tr class="gridtr">
                    <td class="gridtd" colspan="3">
                        <center>No Option available.</center>
                    </td>
                </tr>
            <?php else : ?>
                <?php foreach ($options as $key => $option) : ?>
                    <tr class='gridtr'>
                        <td class='gridtd'><input type="text" name="exist[<?= $option->optionId; ?>][name]" value="<?= $option->name ?>"></td>
                        <td class='gridtd'><input type="text" name="exist[<?= $option->optionId; ?>][sortOrder]" value="<?= $option->sortOrder ?>"></td>
                        <td class='gridtd'><input type="button" name="removeOption" value="Remove Option" onclick="removeRow(this);" class="btn btn-danger"></td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
</form>
<div style="display:none">
    <table id='newOption'>
        <tbody>
            <tr class='gridtr'>
                <td class='gridtd'><input type="text" name="new[name][]" placeholder="Name"></td>
                <td class='gridtd'><input type="text" name="new[sortOrder][]" placeholder="SortOrder"></td>
                <td class='gridtd'><input type="button" name="new[removeOption][]" value="Remove Option" onclick="removeRow(this)" class="btn btn-danger"></td>
            </tr>
        </tbody>
    </table>
</div>

<script>
    function addRow() {
        var newOptionTable = document.getElementById('newOption');
        var existingOptionTable = document.getElementById('existingOption').children[0];
        existingOptionTable.prepend(newOptionTable.children[0].children[0].cloneNode(true));
    }

    function removeRow(button) {
        var objTr = button.parentElement.parentElement;
        objTr.remove();
        mage.setForm();

    }
</script>