<?php
$categories = $this->getCategories()->getData();
?>
<form id="form" action="javascript:void(0)" method="POST">
    <h2><?= $this->getTitle(); ?></h2>
    <input type="button" value="Add Question" class="btn btn-success" onclick="mage.changeAction('<?php echo $this->getUrl()->getUrl('editForm'); ?>').setForm()">
    <table border="1" cellspacing="0" cellpadding="0" class="table">
        <tr class="gridtr">
            <th style="text-align:center">CategoryId</th>
            <th style="text-align:center">Name</th>
            <th style="text-align:center">ParentId</th>
            <th style="text-align:center">Path</th>
            <th style="text-align:center">Status</th>
            <th style="text-align:center" class="gridth" colspan="2">Actions</th>
        </tr>
        <?php if ($categories) : ?>
            <?php foreach ($categories as $key => $value) : ?>
                <tr class="gridtr">
                    <td style="text-align:center" class="gridtd"><?php echo $value->categoryId ?></td>
                    <td style="text-align:center" class="gridtd"><?php echo $this->getName($value); ?></td>
                    <td style="text-align:center" class="gridtd"><?php echo $value->parentId ?></td>
                    <td style="text-align:center" class="gridtd"><?php echo $value->pathId; ?></td>
                    <td style="text-align:center" class="gridtd"><?php echo $value->status ?></td>
                    <td class="gridtr" style="text-align:center">
                        <input type="button" class="btn btn-success" value="Edit" onclick="mage.setUrl('<?= $this->getUrl()->getUrl('editForm', null, ['id' => $value->categoryId]); ?>').load()">
                    </td>
                    <td class="gridtr" style="text-align:center">
                        <input type="button" class="btn btn-danger" value="Delete" onclick="mage.setUrl('<?= $this->getUrl()->getUrl('delete', null, ['id' => $value->categoryId]); ?>').load();">
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else : ?>
            <tr>
                <td colspan="7">No category available.</td>
            </tr>
        <?php endif; ?>
    </table>
</form>