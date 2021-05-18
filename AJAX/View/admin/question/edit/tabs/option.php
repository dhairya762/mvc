<?php
$options = $this->getOptions();
?>
<form id="form" action="<?= $this->getUrl()->getUrl('update', 'Question\Option'); ?>" method="POST">
    <input type="button" class="btn btn-primary" onclick="mage.setForm(); " name="update" value="Update">
    <input type="button" class="btn btn-primary" name="addOption" value="Add Option" onclick="addRow();">
    <table id='existingOption' class='grid'>
        <tbody class="optionRowBody" id="optionBody">
            <?php if (!$options) : ?>
                <tr class="gridtr">
                    <td class="gridtd" colspan="3">
                        <center>No Option available.</center>
                    </td>
                </tr>
            <?php else : ?>
                <?php foreach ($options as $key => $option) : ?>
                    <?php if ($option != "null") : ?>
                        <tr class='gridtr'>
                            <td class='gridtd'><input class="option" type="text" name="exist[<?= $option->optionId; ?>][optionName]" value="<?= $option->optionName ?>"></td>
                            <td style="text-align:center" class="gridtd"><input type="radio" name="exist[answer]" value="<?= $option->optionId ?>" <?php if ($option->is_right_choice) {
                                                                                                                                                        echo "checked";
                                                                                                                                                    } ?>></td>
                            <td class='gridtd'><input type="button" name="removeOption" value="Remove Option" onclick="removeRow(this);" class="btn btn-danger"></td>
                        </tr>
                    <?php endif; ?>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
</form>
<div style="display:none">
    <table id='newOption'>
        <tbody>
            <tr class='gridtr'>
                <td class='gridtd'><input class="option" type="text" name="new[option][]" placeholder="Option"></td>
                <td class='gridtd'><input type="button" name="new[removeOption][]" value="Remove Option" onclick="removeRow(this)" class="btn btn-danger"></td>
            </tr>
        </tbody>
    </table>
</div>

<script>
    function addRow() {
        var num = document.getElementById('optionBody').querySelectorAll('.option');
        if (num.length < 4) {
            var newOptionTable = document.getElementById('newOption');
            var existingOptionTable = document.getElementById('existingOption').children[0];
            existingOptionTable.prepend(newOptionTable.children[0].children[0].cloneNode(true));
        }
    }

    function removeRow(button) {
        var objTr = button.parentElement.parentElement;
        objTr.remove();
        mage.setForm();

    }
</script>