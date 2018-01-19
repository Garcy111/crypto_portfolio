<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Восстановление пароля';
$this->params['breadcrumbs'][] = $this->title;
$this->registerCssFile('/public/modules/user/css/recovery.css', $options = [
    'depends' => [
        'frontend\assets\MainAsset',
        ]
    ]);
?>

<div class="user-default-recovery">
<div class="wrapper-form">
    <h1><?= Html::encode($this->title) ?></h1>
    <?php $form = ActiveForm::begin([
        'id' => 'recovery-form',
    ]); ?>

        <?= $form->field($model, 'email')->textInput(['autofocus' => true, 'placeholder' => 'Email'])->label(false) ?>

        <?= $form->field($model, 'password_repeat')->passwordInput(['placeholder' => 'Пароль'])->label(false) ?>

        <?= $form->field($model, 'password')->passwordInput(['placeholder' => 'Повторите пароль'])->label(false) ?>

        <div class="form-group">
                <?= Html::submitButton('Далее', ['class' => 'btn-send', 'name' => 'recovery-button']) ?>
        </div>

    <?php ActiveForm::end(); ?>
</div>
</div>