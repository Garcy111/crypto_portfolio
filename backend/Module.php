<?php

namespace backend\modules\admin;

use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;
use Yii;

class Module extends \yii\base\Module
{
    public $controllerNamespace = 'backend\modules\admin\controllers';

    public function init()
    {
        parent::init();

        // custom initialization code goes here
    }

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'except' => ['default/login'],
                'denyCallback' => function ($rule, $action) {
                    return Controller::redirect('/admin/login');
                },
                'rules' => [
                    [
                        'allow' => true,
                         // 'matchCallback' => function ($rule, $action) {
                         //    $user = Yii::$app->user->identity;
                         //    if ($user && $user->role === 'admin') {
                         //        return true;
                         //    }
                        'roles' => ['admin'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['logout'],
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }
}
