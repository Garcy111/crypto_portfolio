<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Sign up';
$this->params['breadcrumbs'][] = $this->title;
$this->registerCssFile('/public/modules/user/css/reg.css', $options = [
    'depends' => [
        'frontend\assets\MainAsset'
        ]
    ]);

?>
<div class="user-default-reg">
<div class="wrapper-form">
    <h1><?= Html::encode($this->title) ?></h1>

    <?php $form = ActiveForm::begin([
        'id' => 'reg-form',
    ]); ?>

        <?= $form->field($model, 'username')->textInput(['placeholder' => 'Username'])->label(false) ?>

        <?= $form->field($model, 'password_repeat')->passwordInput(['placeholder' => 'Password'])->label(false) ?>

        <?= $form->field($model, 'password')->passwordInput(['placeholder' => 'Repeat password'])->label(false) ?>

        <?= $form->field($model, 'email')->textInput(['placeholder' => 'Email'])->label(false) ?>

        <div class="form-group">
                <?= Html::submitButton('Sign up', ['class' => 'btn-send', 'name' => 'reg-button']) ?>
        </div>

    <?php ActiveForm::end(); ?>
</div>
</div>