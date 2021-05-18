<?php
$category = $this->getCategory();
$categories = $this->getCategories();
$option = $category->getStatusOption();
$categoryOptions = $this->getCategoryOptions();
?>

<form id='form' action="<?= $this->getUrl()->getUrl('save', NULL, ['categoryId' => $category->categoryId], true); ?>" method="POST">
    <center>
        <table>
            <h2 style="text-align:center ;"><?= $this->getTitle(); ?></h2>
            <tr>
                <td>

                </td>
                <td>
                    <select name="category[parentId]">
                        <?php if ($categoryOptions) : ?>
                            <?php foreach ($categoryOptions as $categoryId => $name) : ?>
                                <option value="<?= $categoryId; ?>" <?php if ($categoryId == $category->parentId) {
                                                                        echo 'selected';
                                                                    } ?>><?= $name; ?></option>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td>
                    Name:
                </td>
                <td>
                    <input type="text" class="form-control" name="category[name]" value="<?= $category->name; ?>">
                </td>
            </tr>
            <tr>
                <td>
                    Status:
                </td>
                <td>
                    <select name="category[status]">
                        <?php foreach ($option as $key => $value) : ?>
                            <option value="<?= $key; ?>" <?php if ($category->status == $key) {
                                                                echo "selected";
                                                            } ?>><?= $value; ?></option>
                        <?php endforeach; ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td>

                </td>
                <td>
                    <button type="button" name="save" class="btn btn-success" onclick="mage.setForm();">Save</button>
                </td>
            </tr>
        </table>
    </center>
</form>