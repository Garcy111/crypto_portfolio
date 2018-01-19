<?php
 
use yii\helpers\Html;
use yii\widgets\DetailView;
 
/* @var $this yii\web\View */
/* @var $model app\modules\user\models\User */
 
$this->title = 'Профиль ' . $model->username;
$this->params['breadcrumbs'][] = $this->title;
yii\bootstrap\BootstrapAsset::register($this);
?>
<div class="user-profile">
 
    <h1><?= Html::encode($this->title) ?></h1>
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'username',
            'email',
        ],
    ]) ?>
 
</div>