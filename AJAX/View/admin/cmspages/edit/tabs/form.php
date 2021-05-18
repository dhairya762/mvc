<?php $cmsPages = $this->getCmsPages(); ?>
<?php $options = $cmsPages->getStatusOption(); ?>

<h1><?= $this->getTitle();?></h1>
<form id="form" action='<?php echo $this->getUrl()->getUrl('save', null, ['pageId' => $cmsPages->pageId], false)?>' method='POST'>
    <table>
        <tr>
            <td>
                Title:
            </td>
            <td>
                <input name='cmsPages[title]' type='text' value='<?php echo $cmsPages->title; ?>'>
            </td>
        </tr>
        <tr>
            <td>
                Identifier:
            </td>
            <td>
                <input name='cmsPages[identifier]' type='text' value='<?php echo $cmsPages->identifier; ?>'>
            </td>
        </tr>
        <tr>
            <td>Content</td>
            <td><textarea name="cmsPages[content]" id="cmsPages"><?php echo $cmsPages->content;?></textarea>
                <script>
                    CKEDITOR.replace('cmsPages[content]');
                </script>
            </td>
        </tr>
        <tr>
            <td>
                Status:
            </td>
            <td>
                <select name='cmsPages[status]'>
                    <?php foreach ($options as $key => $value) : ?>
                        <option value='<?php echo $key; ?>' <?php if ($cmsPages->status) echo 'selected'; ?>><?php echo $value ?></option>
                    <?php endforeach; ?>
                </select>
            </td>
        </tr>
        <tr>
            <td></td>
            <td>
                <input type='button' class="btn btn-success" onclick="mage.setForm()" name='submit' value='Submit'>
            </td>
        </tr>
    </table>
</form>