<?php
 
use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\bootstrap\ActiveForm;
 
/* @var $this yii\web\View */
/* @var $model app\modules\user\models\User */
 
$this->title = 'Редактировать профиль';
yii\bootstrap\BootstrapAsset::register($this);
?>

<div class="user-profile-update">
	<h1><?= Html::encode($this->title) ?></h1>

<?php $form = ActiveForm::begin([]); ?>
 
<?= $form->field($model, 'email')->input('email', ['maxlength' => true]) ?>
 
<div class="form-group">
    <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary']) ?>
</div>
 
<?php ActiveForm::end(); ?>

<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>

    <?= $form->field($upload, 'imageFile')->fileInput() ?>

    <div class="form-group">
	    <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary']) ?>
	</div>

<?php ActiveForm::end() ?>
</div>