<?php
	use yii\helpers\Html;
	use yii\widgets\ActiveForm;
?>

<div class="content">
<h1 class="title">Настройки</h1>
<h2 class="title">Изменить логин / пароль</h2>

<?php $form = ActiveForm::begin(['id' => 'change-password-form']); ?>

<?= $form->field($model, 'username')->textInput(['placeholder' => 'Логин'])->label(false); ?>
<?= $form->field($model, 'password_old')->passwordInput(['placeholder' => 'Старый пароль'])->label(false); ?>
<?= $form->field($model, 'password_new_repeat')->passwordInput(['placeholder' => 'Новый пароль'])->label(false); ?>
<?= $form->field($model, 'password_new')->passwordInput(['placeholder' => 'Повторите новый пароль'])->label(false); ?>
<div class="form-group">
	<?= Html::submitButton('Изменить', ['class' => 'btn btn-primary']) ?>
</div>
<?php ActiveForm::end(); ?>
</div>