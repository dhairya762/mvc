<?php
	$this->setController(\Mage::getController('Controller\Core\Admin'));
	$message = $this->getMessage();
	if ($success = $message->getSuccess()) {
        ?>
			<div class="sufee-alert alert with-close alert-success alert-dismissible fade show">
				<?php echo $success; ?>
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				</button>
			</div>
		<?php
		unset($message->success);
	} else if ($failure = $message->getFailure()) {
        ?>
			<div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
				<?php echo $failure; ?>
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				</button>
			</div>
		<?php
		unset($message->failure);
	} else if ($notice = $message->getNotice()) {
		unset($message->notice);
		?>
			<div class="sufee-alert alert with-close alert-warning alert-dismissible fade show">
				<?php echo $notice; ?>
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
			</div>
		<?php
	}
?>