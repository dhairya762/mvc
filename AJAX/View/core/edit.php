<?php require_once('View\core\layout\message.php');?>
<center>
    <table width='100%' height='100%'>
        <tbody>
            <tr class="gridtr">
                <td class="gridtd"><?= $this->getTabHtml(); ?></td>
                <td class="gridtd"><?= $this->getTabContent(); ?></td>
            </tr>
        </tbody>
    </table>
</center>