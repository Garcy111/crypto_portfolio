<?php $this->registerCssFile('/public/widgets/modal/modal.css', ['depends' => 'common\assets\FontawesomeAsset']) ?>
<?php $this->registerJsFile('/public/widgets/modal/modal.js') ?>
<?php if (isset($message['arcticmodal'])): ?>
<?php $this->registerJsFile('/public/widgets/modal/arcticmodal.js', ['depends' => 'common\assets\ArcticmodalAsset']) ?>
<div style="display: none;">
	<div class="box-modal" id="modal-arcticmodal">
		<p>
			<?= $message['arcticmodal'] ?>
		</p>
	</div>
</div>
<?php endif ?>

<?php if (isset($message['success'])): ?>
<div class="modal-widget modal-success">
	<p>
		<?= $message['success'] ?>
	</p>
	<div class="close-widget">
		<i class="fa fa-times"></i>
	</div>
</div>
<?php endif ?>

<?php if (isset($message['error'])): ?>
<div class="modal-widget modal-error">
	<p>
		<?= $message['error'] ?>
	</p>
	<div class="close-widget">
		<i class="fa fa-times"></i>
	</div>
</div>
<?php endif ?>