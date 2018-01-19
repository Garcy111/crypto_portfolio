<?php
namespace console\controllers;
 
use Yii;
use yii\console\Controller;
 
class RbacController extends Controller
{
    public function actionInit()
    {
        $auth = Yii::$app->getAuthManager();
        $auth->removeAll();

        // Just example
        $rule = new \common\rbac\ProfileRule();
        $auth->add($rule);

        $editProfile = $auth->createPermission('editProfile');
        $editProfile->ruleName = $rule->name;
        $auth->add($editProfile);


        $user = $auth->createRole('user');
        $auth->add($user);

        $admin = $auth->createRole('admin');
        $auth->add($admin);
        $auth->addChild($user, $editProfile);
        $auth->addChild($admin, $user);
    }

     public function actionGarcy()
     {
        echo "Hello Garcy!\n\r";
     }

    public function actionTest()
    {
        $auth = Yii::$app->getAuthManager();

        Yii::$app->set('request', new \yii\web\Request());

        $user = \frontend\modules\user\models\User::findByUsername('Admin');

        $auth->revokeAll($user->id);

        Yii::$app->user->login($user);

        // Yii::$app->user->logout($user);

        // var_dump(Yii::$app->user->id);

        // $auth->revoke($auth->getRole('admin'), $user->id);

        $auth->assign($auth->getRole('admin'), $user->id);

        var_dump(Yii::$app->user->can('editProfile', ['edit' => $user]));
    }
}