<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\CoinsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Coins';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="content">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Html::button('Создать', ['class' => 'btn btn-success']), ['create']) ?>
    </p>
    
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            [
                'attribute' => 'icon',
                'label' => 'Иконка',
                'format' => 'raw',
                'value' => function($data){
                    $img = Html::img($data->icon,[
                        'alt'=>'Аватар',
                        'style' => 'width:22px;'
                    ]);
                    $data = empty($data->icon) ? Yii::t('yii', '(not set)') : $img;
                    return $data;
                },
            ],
            'name',
            'color',

            ['class' => 'backend\models\MyActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
