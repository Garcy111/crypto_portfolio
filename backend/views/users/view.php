<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\DetailView;
use yii\widgets\Breadcrumbs;

/* @var $this yii\web\View */
/* @var $model app\modules\user\models\User */
$this->title = $model->username;
$this->params['breadcrumbs'][] = ['label' => 'Все пользователи', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-view">
<div class="content">
    <h1 class="title"><?= Html::encode($this->title) ?></h1>
    <?= Breadcrumbs::widget(['links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [], 'homeLink' => false]); ?>

    <p>
        <?= Html::a(Html::button('Изменить', ['class' => 'btn btn-primary']), ['update', 'id' => $model->id]) ?>
        <?= Html::a(Html::button('Удалить', ['class' => 'btn btn-danger']), ['delete', 'id' => $model->id], [
            'data' => [
                'confirm' => 'Вы уверены, что хотите удалить этот элемент?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            [
                'attribute' => 'username',
                'label' => 'Имя',
            ],
            'email:email',
            [
                'attribute' => 'access',
                'label' => 'Доступ',
                'value' => $model->getStatusName(),
            ],
            [
                'attribute' => 'soc',
                'label' => 'Соц. сеть',
            ],
            [
                'label' => 'Роль',
                'value' => implode(', ', ArrayHelper::map(Yii::$app->authManager->getRolesByUser($model->id), 'name', 'name')),
            ],
            [
                'attribute'=>'date',
                'label'=> 'Создан',
                'format'=> ['date', 'dd.MM.Y, HH:mm'],
            ],
        ],
    ]) ?>

</div>
</div>