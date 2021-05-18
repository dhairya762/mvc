<?php $question = $this->getQuestion();
$option = $question->getStatusOption();
?>
<form action="<?= $this->getUrl()->getUrl('save', null, ['id' => $question->questionId]); ?>" method="POST" id="form">
<table class="grid">
    <tr class="gridtr">
        <td class="gridtr">
            Question;
        </td>
        <td class="gridtr">
            <input type="text" name="question[question]" value="<?= $question->question; ?>" placeholder="Question">
        </td>
    </tr>
    <tr class="gridtr">
        <td class="gridtr">Status</td>
        <td class="gridtr">
            <select name="question[status]">
                <?php foreach ($option as $key => $value) : ?>
                    <option value="<?= $key; ?>" <?php if ($question->status == $key) {
                                                        echo "selected";
                                                    } ?>><?= $value; ?></option>
                <?php endforeach; ?>
            </select>
        </td>
    </tr>
    <tr class="gridtr">
        <td class="gridtr"></td>
        <?php if ($question->questionId) : ?>
            <td class="gridtr">
                <input type="button" onclick="mage.setForm()" value="Edit" class="btn btn-success">
            </td>
        <?php else : ?>
            <td class="gridtr">
                <input type="button" onclick="mage.setForm()" value="Add" class="btn btn-success">
            </td>
        <?php endif; ?>
    </tr>
</table>
</form>