<?php
use yii\helpers\Html;
?>
<div class="categories-post">
	<h1 class="title">Разделы блога</h1>
	<ul class="categories">
	<?php foreach ($categories as $category): ?>
		<li><?= Html::a($category->name, ['/blog/default/index', 'ctg' => $category->id]) ?></li>
	<?php endforeach ?>
	</ul>
	<div class="separator"></div>
</div>