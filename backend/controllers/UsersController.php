<?php

namespace backend\controllers;

use frontend\modules\user\models\User;
use frontend\modules\user\models\RegForm;

use backend\models\UserSearch;

use yii\web\NotFoundHttpException;
use backend\controllers\BehaviorsController;
use Yii;
/**
 * UsersController implements the CRUD actions for User model.
 */
class UsersController extends BehaviorsController
{

    public $layout = 'admin';
    /**
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single User model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new RegForm(['scenario' => RegForm::SCENARIO_REGISTER_IN_AP]);

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $model->sendEmailActivation();
            $model->saveUser();
            // return $this->redirect(['view', 'id' => $model->id]);
            Yii::$app->session->setFlash('success', 'Пользователь успешно создан.');
            return $this->redirect(['/admin/users']);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        if ($id == Yii::$app->user->identity->id) {
            Yii::$app->session->setFlash('error', 'Вы не можете изменять свой контроль доступа.');
            return $this->redirect(['/admin/users']);
        }
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $auth = Yii::$app->authManager;
            $auth->revokeAll($model->id);
            $auth->assign($auth->getRole($model->role), $model->id);
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing User model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $user = $this->findModel($id);
        if ($id == Yii::$app->user->identity->id) {
            Yii::$app->session->setFlash('error', 'Вы не можете себя удалить.');
            return $this->redirect(['index']);
        }

        Yii::$app->authManager->revokeAll($id);
        $user->delete();
        return $this->redirect(['index']);
    }

    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
