<div class="nav flex-column nav-pills" id="tabs" role="tablist" aria-orientation="vertical" style="width:200px; margin-left: 20px; margin-top: 80px;">
	<?php $tabs = $this->getTabs(); ?>

	<?php foreach ($tabs as $key => $value) : ?>
		<a class="nav-link active" href="javascript:void(0);" onclick="mage.setUrl('<?= $this->getUrl()->getUrl(null, null, ['tab' => $key]) ?>').resetParams().load();" role="tab"><?= $value['label']; ?></a><br>
	<?php endforeach ?>
</div>