<?php

/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */
/* @var $model app\models\LoginForm */
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
$this->registerCssFile('/public/modules/user/css/login.css', $options = [
    'depends' => [
        'frontend\assets\MainAsset',
        'frontend\assets\EauthAsset',
        ]
    ]);
?>
<div class="user-default-login">
<div class="wrapper-form">
    <h1>Login</h1>
    <?= \nodge\eauth\Widget::widget(array('action' => '/user/default/login')); ?>
    <?php $form = ActiveForm::begin([
        'id' => 'login-form',
    ]); ?>

        <?= $form->field($model, 'username')->textInput(['autofocus' => true, 'placeholder' => 'Username'])->label(false) ?>

        <?= $form->field($model, 'password')->passwordInput(['placeholder' => 'Password'])->label(false) ?>

        <?= $form->field($model, 'activation')->hiddenInput(['value' => 'activation'])->label(false) ?>
        <?= $form->field($model, 'access')->hiddenInput(['value' => 'access'])->label(false) ?>

        <?= $form->field($model, 'rememberMe')->checkbox(['class' => 'rememberMe']) ?>

        <?= Html::a('Sign up', ['/user/default/reg'], ['class' => 'recovery-password']); ?>

        <div class="form-group">
                <?= Html::submitButton('Login', ['class' => 'btn-send', 'name' => 'login-button']) ?>
        </div>

    <?php ActiveForm::end(); ?>
</div>
</div>