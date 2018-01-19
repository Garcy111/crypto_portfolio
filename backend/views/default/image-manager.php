<?php
use yii\helpers\Html;
use yii\helpers\Url;
use backend\models\ImageManager;
use yii\widgets\LinkPager;
use yii\widgets\Pjax;

$this->registerCssFile('/admin/public/css/uploader.css');
$this->registerJsFile(
    '/admin/public/js/uploader.js',
    ['depends' => [
        'backend\assets\AjaxuploadAsset',
        'common\assets\ArcticmodalAsset',
    ]
]);

// Подменяю переданный параметр
function getUrl($path, $param) {
	$params = Yii::$app->request->get();
	array_unshift($params, $path);
	return $params = array_replace($params, $param);
}

$model = new ImageManager();
// $data = $model->getImages();
?>

<div style="display: none;">
<div class="box-modal" id="im-modal">
    <div class="img-manager">
    <h1 class="mi-title">Менеджер изображений</h1>
	
	<div class="upload-process">
		<button id="uploadBtn"><i class="fa fa-plus"></i></button>
		<!-- Drag and Drop -->
		<div id="dragbox"><p>Перетащите изображения в выделенную область, чтобы их загрузить</p></div>
		<div id="progressBox"></div>
		<div id="msgBox"></div>
	</div>
    
<?php Pjax::begin(['enablePushState' => false, 'timeout' => 10000]); ?>
<?= Html::beginForm(getUrl('', []), 'post', ['data-pjax' => '', 'id' => 'update-form']); ?>
    <!-- Обновить страницу в фоновом режиме (pjax) -->
	<?= Html::endForm() ?>
<?php $data = $model->getImages(); ?>
	<!-- Left -->
	<div class="leftCol">

<?php
	$name = Yii::$app->request->get('img');
	if (!empty($name)) {
		$imgInfo = $model->getImage($name);
	}
?>
    <div id="imgs-prev">
    <?php if (empty($data['imgs'])): ?>
		<p class="empty-mi">Тут ничего нет :(</p>
    <?php endif; ?>
    <?php foreach ($data['imgs'] as $img): ?>
        <div class="img-prev">
           <?= Html::a(Html::img('/uploads/min/'.$img['name'], ['alt' => $img['name']]), getUrl('', ['img' => $img['name']])); ?>
        </div>
    <?php endforeach; ?>
    </div>
    </div>
    <!-- End Left -->
	
	<!-- Right -->
	<div class="rightCol">

    	<?php if (isset($imgInfo)): ?>
    	<div class="img-info">
    		<?= Html::img('/uploads/min/'.$imgInfo['name'], ['class' => 'image-min']); ?>
    		<p>Источник:</p>
			<?= Html::input('text', null, '/uploads/'.$imgInfo['name'], ['class' => 'sourse']); ?>
			<div style="display: none;">
			<div class="box-modal" id="org-img-modal">
				<?= Html::img('/uploads/'.$imgInfo['name'], ['class' => 'image-org']); ?>
			</div>
			</div>
			<?= Html::button('Удалить', ['class' => 'del-img', 'data-img' => $imgInfo['name']]); ?>
		</div>
		<?php else: ?>
			<div class="img-info-empty"><i class="fa fa-picture-o"></i></div>
		<?php endif; ?>
    </div>
	<!-- End Right -->
	
    <?= LinkPager::widget([
    		'pagination' => $data['pages'],
		]);
	?>
	<?php Pjax::end(); ?>

    </div>
</div>
</div>