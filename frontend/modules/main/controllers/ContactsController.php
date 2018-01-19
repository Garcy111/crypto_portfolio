<?php

namespace frontend\modules\main\controllers;

use yii\web\Controller;
use Yii;

class ContactsController extends Controller {

	public function actionIndex()
    {   
        return $this->render('contacts');
    }
}