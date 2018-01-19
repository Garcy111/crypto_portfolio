<?php

namespace frontend\modules\user\models;

use Yii;
use yii\base\Model;
use backend\models\Notification;

class RegForm extends Model
{
    public $username;
    public $password;
    public $password_repeat;
    public $email;
    public $role;
    public $date;

    private $_user = false;

    const SCENARIO_REGISTER = 'reg';
    const SCENARIO_REGISTER_IN_AP = 'reg_in_adminpanel';

    public function scenarios()
    {
        return [
            self::SCENARIO_REGISTER => [
                'id',
                'username',
                'password',
                'password_repeat',
                'email',
                'date',
            ],
            self::SCENARIO_REGISTER_IN_AP => [
                'id',
                'username',
                'password',
                'password_repeat',
                'email',
                'role',
                'date',
            ],
        ];
    }

    public function rules()
    {
        return [
            [['username', 'password', 'password_repeat', 'email'], 'required', 'message' => 'can\'t be empty'],
            ['password', 'compare', 'message' => 'error'],
            [['date', 'role'], 'safe'],
            ['password_repeat', 'string', 'length' => [6, 25], 'tooShort' => 'error', 'tooLong' => 'error'],
            ['email', 'email', 'message' => 'not correct email address'],
            ['username', 'match', 'pattern' => '/^([a-zA-Z0-9_]{3,25})?$/', 'message' => 'error'],
            ['username', 'validateUsername'],
            ['email', 'validateEmail']
        ];
    }

    public function validateUsername($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();
            if ($user) {
                $this->addError($attribute, 'User with this name exists');
            }
        }
    }

    public function validateEmail($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = User::findOne(['email' => $this->email]);
            if ($user) {
                $this->addError($attribute, 'User with this email exists');
            }
        }
    }

    public function attributeLabels() {
        return [
            'username' => 'Username:',
            'password' => 'Repeat password:',
            'password_repeat' => 'Password:',
            'email' => 'Email:',
        ];
    }

    public function getUser()
    {
        if ($this->_user === false) {
            $this->_user = User::findByUsername($this->username);
        }

        return $this->_user;
    }

    public function saveUser()
    {
        $user = new User();
        $user->username = $this->username;
        $user->password = $this->hashPassword($this->password);
        $user->email = $this->email;
        $user->authKey = $this->generateRandomString();
        $user->activation = $this->generateRandomString();
        $user->date = time();
        if ($user->save()) {
            $auth = Yii::$app->getAuthManager();
            $role = !empty($this->role) ? $this->role : 'user';
            $auth->assign($auth->getRole($role), $user->id);
            // A notification for admin panel
            $notification = new Notification();
            $notification->name = 'Новый пользователь: ' . $this->username;
            $notification->link = '/admin/users/view/?id=' . $user->id;
            $notification->date = date("d/m/Y, H:i");
            $notification->save();
        }
    }

    public function sendEmailActivation()
    {
        $username = $this->username;
        $email = $this->email;

        $user = User::findOne(['username' => $username]);
        if ($user):
        return Yii::$app->mailer->compose('activationUser', ['user' => $user])
                ->setFrom(['support@cryptomoon.ru' => 'Message about activation on cryptomoon.ru'])
                ->setTo($email)
                ->setSubject('Activation')
                ->send();
        endif;
        return false;
    }

    public function generateRandomString()
    {
        return Yii::$app->getSecurity()->generateRandomString();
    }

    public function hashPassword($password)
    {
        return Yii::$app->getSecurity()->generatePasswordHash($password);
    }

}