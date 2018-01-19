<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\grid\GridView;
use frontend\modules\user\models\User;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$this->title = 'Пользователи';
?>
<div class="user-index">
<div class="content">
    <h1 class="title"><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Html::button('Создать', ['class' => 'btn btn-success']), ['create']) ?>
    </p>
<?php Pjax::begin(['enablePushState' => false, 'timeout' => 3000]); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'attribute' => 'avatar',
                'label' => 'Авка',
                'format' => 'raw',
                'value' => function($data){
                    $img = Html::img($data->avatar,[
                        'alt'=>'Аватар',
                        'style' => 'width:100px;'
                    ]);
                    $data = empty($data->avatar) ? Yii::t('yii', '(not set)') : $img;
                    return $data;
                },
            ],
            [
                'attribute' => 'username',
                'label' => 'Имя',
            ],
            'email:email',
            [
                'attribute' => 'soc',
                'label' => 'Соц. сеть',
            ],
            [
                'label' => 'Роль',
                'value' => function($data){
                    return implode(',', ArrayHelper::map(Yii::$app->authManager->getRolesByUser($data->id), 'name', 'name'));
                }
            ],
            [
                'attribute' => 'access',
                'label' => 'Доступ',
                'format' => 'raw',
                'filter' => User::getStatusesArray(),
                'value' => function($model, $key, $index, $column) {
                    /** @var User $model */
                    /** @var \yii\grid\DataColumn $column */
                    $value = $model->{$column->attribute};
                    switch ($value) {
                        case User::STATUS_ACTIVE:
                            $class = 'status-success';
                            break;
                        case User::STATUS_WAIT:
                            $class = 'status-warning';
                            break;
                        case User::STATUS_BLOCKED:
                            $class = 'status-fail';
                            break;
                        default:
                            $class = 'default';
                    };
                    $html = Html::tag('p', Html::encode($model->getStatusName()), ['class' => $class]);
                    return $value === null ? $column->grid->emptyCell : $html;
                }
            ],

            ['class' => 'backend\models\MyActionColumn'],
            [
                'attribute' => 'date',
                'label' => 'Создан',
                'format'=> ['date', 'dd.MM.Y, HH:mm'],
            ],
        ],
    ]); ?>
<?php Pjax::end(); ?>
</div>
</div>