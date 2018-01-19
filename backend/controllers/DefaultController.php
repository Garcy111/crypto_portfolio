<?php

namespace backend\controllers;

use backend\models\LoginForm;
use backend\models\ChangePassword;

use frontend\modules\user\models\User;

use backend\controllers\BehaviorsController;
use Yii;

class DefaultController extends BehaviorsController
{

	public $layout = 'admin';

	public $enableCsrfValidation = false;

	public function actionIndex()
	{
		return $this->render('index');
	}

	public function actionSettings()
	{
		$model = new ChangePassword();
		if ($model->load(Yii::$app->request->post())) {
			if ($model->validate()) {
				$model->changePassword();
				Yii::$app->session->setFlash('success', 'Пароль успешно изменен');
				return $this->refresh();
			}
		}
		return $this->render('settings', ['model' => $model]);
	}

    public function actionLogin()
	{	
		$this->layout = 'main';
		if (Yii::$app->user->can('admin')) {
            return $this->redirect('/admin');
        }

		$model = new LoginForm();
		if ($model->load(Yii::$app->request->post()) && $model->login()) {
			return $this->redirect('/admin');
		}
		return $this->render('login', ['model' => $model]);
	}

	public function actionLogout()
    {
        Yii::$app->user->logout();
        return $this->redirect('/admin/default/login');
    }
}
