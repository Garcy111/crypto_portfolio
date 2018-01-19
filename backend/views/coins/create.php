<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Coins */

$this->title = 'Create Coins';
$this->params['breadcrumbs'][] = ['label' => 'Coins', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="content">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
