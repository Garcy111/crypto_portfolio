<?php
namespace frontend\modules\user\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\AccessControl;
use frontend\modules\user\models\User;
use frontend\modules\user\models\ProfileUpdateForm;
use frontend\modules\user\models\UploadForm;
use yii\web\UploadedFile;

class ProfileController extends Controller {

     public $layout = 'main';

	 public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
    	return $this->render('index', [
            'model' => $this->findModel(),
        ]);
    }

    public function actionUpdate()
    {
        $user = $this->findModel();
        $model = new ProfileUpdateForm($user);

         $upload = new UploadForm();
         if (Yii::$app->request->isPost) {
            $upload->imageFile = UploadedFile::getInstance($upload, 'imageFile');
            if ($upload->upload()) {
                // file is uploaded successfully
                return $this->refresh();
            }
        }

        if ($model->load(Yii::$app->request->post()) && $model->update()) {
            return $this->redirect(['/profile'], 301);
        } else {
            return $this->render('update', [
                'model' => $model,
                'upload' => $upload,
            ]);
        }
    }

	/**
	* @return User the loaded model
	*/
    private function findModel()
    {
        return User::findOne(Yii::$app->user->identity->getId());
    }
}