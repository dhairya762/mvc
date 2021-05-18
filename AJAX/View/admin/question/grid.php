<?php
require_once("View/core/layout/message.php");
$questions = $this->getQuestion();

?>
<div class="container">
    <form id="form" action="javascript:void(0)" method="POST">
        <h2 style="text-align: center;"><strong><?= $this->getTitle() ?></strong></h2>
        <input type="button" value="Add Question" class="btn btn-success" onclick="mage.changeAction('<?php echo $this->getUrl()->getUrl('editForm'); ?>').setForm()">
        <table border="1" cellspacing="0" cellpadding="0" class="table">
            <tr class="gridtr">
                <th>Question Id</th>
                <th>Option1</th>
                <th>Option2</th>
                <th>Option3</th>
                <th>Option4</th>
                <th>Status</th>
                <th>CorectAns</th>
                <th colspan='2'>Action</th>
            </tr>
            <?php if (!$questions) : ?>
                <tr class="gridtr">
                    <td class="gridtr" style="text-align:center" colspan="8">No Record Found</td>
                </tr>
            <?php else : ?>
                <?php foreach ($questions->getData() as $key => $question) : ?>
                    <tr class="gridtr">
                        <td class="gridtr" style="text-align:center"><?php echo $question->question; ?></td>
                        <td class="gridtr" style="text-align:center"><?php echo $question->getOptions($question->questionId)['option1']; ?></td>
                        <td class="gridtr" style="text-align:center"><?php echo $question->getOptions($question->questionId)['option2']; ?></td>
                        <td class="gridtr" style="text-align:center"><?php echo $question->getOptions($question->questionId)['option3']; ?></td>
                        <td class="gridtr" style="text-align:center"><?php echo $question->getOptions($question->questionId)['option4']; ?></td>
                        <!-- <td class="gridtr" style="text-align:center"><?php //echo $question->status;
                                                                            ?></td> -->
                        <td>
                            <input type="button" value="<?= $question->status ?>" onclick="mage.setUrl('<?= $this->getUrl()->getUrl('status', null, ['id' => $question->questionId], true); ?>').load()" class="<?php if ($question->status == "Enable") {
                                                                                                                                                                                                                                            echo "btn btn-success";
                                                                                                                                                                                                                                        } else {
                                                                                                                                                                                                                                            echo "btn btn-danger";
                                                                                                                                                                                                                                        } ?>">
                        </td>
                        <td class="gridtr" style="text-align:center"><?php echo $question->getCorrectAns($question->questionId); ?></td>
                        <td class="gridtr" style="text-align:center">
                            <input type="button" class="btn btn-success" value="Edit" onclick="mage.setUrl('<?= $this->getUrl()->getUrl('editForm', null, ['id' => $question->questionId], true); ?>').load()">
                        </td>
                        <td class="gridtr" style="text-align:center">
                            <input type="button" class="btn btn-danger" value="Delete" onclick="mage.setUrl('<?= $this->getUrl()->getUrl('delete', null, ['id' => $question->questionId], true); ?>').load();">
                        </td>

                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </table>
    </form>
</div>