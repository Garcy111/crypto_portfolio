<?php
	use yii\helpers\Html;
?>

<div class="tags">
	<h1 class="title">Метки</h1>
	<?php foreach ($tags as $tag): ?>
		<span><i class="fa fa-tag"></i><?= Html::a($tag->name, ['/blog/default/index', 'tag' => $tag->name]) ?></span>
	<?php endforeach ?>
	<div class="separator"></div>
</div>