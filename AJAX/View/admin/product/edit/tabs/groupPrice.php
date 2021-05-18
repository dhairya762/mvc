<?php
$groupPrice = $this->getGroupPrice();
?>
<center>
    <h1>Group Price</h1>
    <form id="form" action="#" method="POST">
        <input type="button" class="btn btn-success" onclick="mage.changeAction('<?php echo $this->getUrl()->getUrl('groupPrice','Product\GroupPrice'); ?>').setForm()" name="save" value="UPDATE">
        <table class="grid">
            <tr class="gridtr">
                <th style="text-align:center" class="gridth">Group Id</th>
                <th style="text-align:center" class="gridth">Group Name</th>
                <th style="text-align:center" class="gridth">Group Price</th>
                <th cstyle="text-align:center" lass="gridth">Version</th>
            </tr>
            <?php if (!$groupPrice) : ?>
                <tr>
                    <td colspan='4'>
                        <center>No data available.</center>
                    </td>
                </tr>
            <?php else : ?>
                <?php foreach ($groupPrice as $key => $value) : ?>
                    <?php $type = ($value->groupPrice) ? "old" : "new"; ?>
                    <tr class="gridtr">
                        <td style="text-align:center" class="gridtd"><?= $value->groupId ?></td>
                        <td style="text-align:center" class="gridtd"><?= $value->groupName ?></td>
                        <td style="text-align:center" class="gridtd"><input type="text" name="price[<?= $type; ?>][<?= $value->groupId ?>]" value="<?= $value->groupPrice ?>"></td>
                        <td style="text-align:center" class="gridtd"><?= $type; ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </table>
    </form>
</center>