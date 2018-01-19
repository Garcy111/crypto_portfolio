<?php
namespace frontend\modules\user\controllers;
 
use frontend\modules\user\models\LoginForm;
use frontend\modules\user\models\RegForm;
use frontend\modules\user\models\RecoveryForm;
use frontend\modules\user\models\User;
use yii\filters\AccessControl;
use yii\web\Controller;
use Yii;
 
class DefaultController extends Controller
{

    public $layout = 'main';

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['reg', 'login', 'recovery'],
                        'verbs' => ['GET', 'POST'],
                        'roles' => ['?'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['logout', 'index'],
                        'roles' => ['@'],
                    ],
                ],
            ],
            'eauth' => array(
                    // required to disable csrf validation on OpenID requests
                    'class' => \nodge\eauth\openid\ControllerBehavior::className(),
                    'only' => array('login'),
                ),
        ];
    }

    public function actionIndex()
    {
        return $this->redirect(['/profile'], 301);
    }

    public function actionReg()
    {
        $model = new RegForm(['scenario' => RegForm::SCENARIO_REGISTER]);
        if ($model->load(Yii::$app->request->post())) {
        	if ($model->validate()) {
        		$model->saveUser();
                $model->sendEmailActivation();
        		Yii::$app->session->setFlash('success', 'You have successfully registered on the site. You now need to activate your account. Activation letter will come to your specified Email address.');
        		return $this->redirect('/');
        	}
        }
        return $this->render('reg', ['model' => $model]);
    }
 
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $serviceName = Yii::$app->getRequest()->getQueryParam('service');
        if (isset($serviceName)) {
            /** @var $eauth \nodge\eauth\ServiceBase */
            $eauth = Yii::$app->get('eauth')->getIdentity($serviceName);
            $eauth->setRedirectUrl(Yii::$app->getUser()->getReturnUrl());
            $eauth->setCancelUrl(Yii::$app->getUrlManager()->createAbsoluteUrl('user/default/login'));
            
            try {
                if ($eauth->authenticate()) {
                //  var_dump($eauth->getIsAuthenticated(), $eauth->getAttributes()); exit;

                    $identity = User::findByEAuth($eauth);
                    if (!User::existsSocUser($identity)) {
                        User::saveSocUser($identity);
                    }
                    Yii::$app->getUser()->login($identity, 3600*24*30);
                    // special redirect with closing popup window
                    $eauth->redirect();
                }
                else {
                    // close popup window and redirect to cancelUrl
                    $eauth->cancel();
                }
            }
            catch (\nodge\eauth\ErrorException $e) {
                // var_dump($eauth->getIsAuthenticated(), $eauth->getAttributes()); exit;
                // save error to show it later
                Yii::$app->getSession()->setFlash('error', 'EAuthException: '.$e->getMessage());
 
                // close popup window and redirect to cancelUrl
                //  $eauth->cancel();
                $eauth->redirect($eauth->getCancelUrl());
            }
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goHome();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    public function actionRecovery($id = null, $pass = null)
    {
        $model = new RecoveryForm();

        if (isset($id) && isset($pass)) {
            $model->recoveryPassword($id, $pass);
            Yii::$app->session->setFlash('success', 'Теперь вы можете войти на сайт под новым паролем.');
            return $this->redirect('/login');
        }

        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate()) {
                $model->saveNewPassword();
                $model->sendEmailRecovery();
                Yii::$app->session->setFlash('success', 'Ваш запрос на восстановление пароля успешно отправлен. Вам необходимо подтвердить восстановление пароля. Ссылка для подтверждения отправлена на ваш email адрес. ');
                return $this->redirect('/login');
            }
        }
        return $this->render('recovery', ['model' => $model]);
    }
 
    public function actionLogout()
    {
        Yii::$app->user->logout();
        return $this->goHome();
    }

   	public function actionActivation($id = null, $hash = null)
   	{
   		if (isset($id) && isset($hash)) {
            $user = User::findOne(['id' => $id]);
        }

        $session = Yii::$app->session;
        if (!empty($user) && ($user->activation === $hash)) {
            $user->activation = null;
            $user->access = 1;
            $user->save();
            $session->setFlash('success', 'Ваш аккаунт успешно активирован. Теперь вы можете войти на сайт под своим логином и паролем.');
        } else {
            $session->setFlash('error', 'При активации вашего аккаунта произошла ошибка. Возможно активация была совершена ранее.');
        }

        return $this->redirect('/login');
   	}
}