<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;
$this->registerCssFile('/admin/public/css/login.css', $options = [
    'depends' => [
        'backend\assets\MainAsset',
        ]
    ]);
$this->registerJsFile('/admin/public/js/jquery.particleground.min.js');
$this->registerJsFile('/admin/public/js/login.js');
$this->title = 'Вход в панель администратора';
?>

<div class="admin-default-login">
<div class="hero">
	<div id="logInBlock">
		<h1>AdminPanel</h1>
		
		<?php $form = ActiveForm::begin([
        	'id' => 'login-form',
    	]); ?>

        <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

        <?= $form->field($model, 'password')->passwordInput() ?>

        <?= $form->field($model, 'rememberMe')->checkbox(['class' => 'rememberMe']) ?>

        <div class="form-group">
            <?= Html::submitButton('Войти', ['class' => 'btn-send', 'name' => 'login-button']) ?>
        </div>

    <?php ActiveForm::end(); ?>
	</div>
</div>
</div>