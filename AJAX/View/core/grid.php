<?php
require_once('View\core\layout\message.php');
$collection = $this->getCollection();
$columns = $this->getColumns();
$actions = $this->getActions();
$buttons = $this->getButtons();
?>

<h1><?php echo $this->getTitle(); ?></h1>
<form id="form" action="<?php echo $this->getFormUrl('filter', null, [], true); ?>" method="POST">
    <?php if ($buttons) : ?>
        <?php foreach ($buttons as $key => $button) : ?>
            <input type="button" class="<?= $button['class'] ?>" value="<?= $button['label'] ?>" onclick="mage.setUrl(<?= $this->getButtonUrl($button['method']); ?>);">
        <?php endforeach; ?>
    <?php endif; ?>
    <table class="grid">
        <?php if ($columns) : ?>
            <tr class="gridtr">
                <?php foreach ($columns as $key => $value) : ?>
                    <th style="text-align:center" class="gridth"><?php echo $value['label']; ?></th>
                <?php endforeach; ?>
                <th style="text-align:center" class="gridth" colspan="2">Actions</th>
            </tr>
            <tr class="gridtr">
                <?php foreach ($columns as $field => $value) : ?>
                    <td style="text-align:center" class="gridtd"><input type="text" name="field[<?php echo $value['type']; ?>][<?php echo $field; ?>]" value="<?php echo $this->getFilter()->getFilterValue($value['type'], $field); ?>"></td>
                <?php endforeach; ?>
            </tr>
        <?php endif; ?>
        <?php if ($collection) : ?>
            <?php foreach ($collection as $key => $row) : ?>
                <tr class="gridtr">
                    <?php if ($columns) : ?>
                        <?php foreach ($columns as $field => $value) : ?>
                            <?php if ($field == 'status') : ?>
                                <td style="text-align:center"><input type="button" class="<?php if ($this->getFieldValue($row, 'status') == 'Enable') {
                                                                                                echo 'btn btn-success';
                                                                                            } else {
                                                                                                echo "btn btn-danger";
                                                                                            } ?>" value=" <?= $this->getFieldValue($row, 'status'); ?>" onclick="<?= $this->getStatusUrl($row); ?>"></td>
                            <?php else : ?>
                                <td style="text-align:center" class="gridtd"><?php echo $this->getFieldValue($row, $field); ?></td>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    <?php endif; ?>
                    <?php if ($actions) : ?>
                        <?php foreach ($actions as $key => $action) : ?>
                            <td>
                                <input type="button" class="<?= $action['class'] ?>" value="<?= $action['label'] ?>" onclick="mage.setUrl(<?= $this->getMethodUrl($row, $action['method']) ?>);">
                            </td>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>
    </table>
</form>

<?php $this->getFilter()->clearFilters(); ?>