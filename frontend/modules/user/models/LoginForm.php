<?php

namespace frontend\modules\user\models;

use Yii;
use yii\base\Model;

/**
 * LoginForm is the model behind the login form.
 */
class LoginForm extends Model
{
    public $username;
    public $password;
    public $activation;
    public $access;
    public $rememberMe = true;

    private $_user = false;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['username', 'password', 'access', 'activation'], 'required', 'message' => 'error'],
            // rememberMe must be a boolean value
            ['rememberMe', 'boolean'],
            // password is validated by validatePassword()
            ['password', 'validatePassword'],
            ['activation', 'validateActivation'],
            ['access', 'validateAccess'],
        ];
    }

    public function attributeLabels() {
        return [
            'username' => 'Login',
            'password' => 'Password',
            'rememberMe' => 'Remember me',
        ];
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();
            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError($attribute, 'Неверный логин или пароль.');
            }
        }
    }

    public function validateActivation($attribute, $params)
    {
        // if (!$this->hasErrors()) {
        //     $user = $this->getUser();
        //     if ($user->access == 0) {
        //         $this->addError($attribute, 'Вам необходимо активировать свой аккаунт.');
        //     }
        // }
    }

    public function validateAccess($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();
            if ($user->access == 2) {
                $this->addError($attribute, 'Ваш доступ на сайт был закрыт администратором.');
            }
        }
    }

    /**
     * Logs in a user using the provided username and password.
     * @return boolean whether the user is logged in successfully
     */
    public function login()
    {
        if ($this->validate()) {
            return Yii::$app->user->login($this->getUser(), $this->rememberMe ? 3600*24*30 : 0);
        }
        return false;
    }

    /**
     * Finds user by [[username]]
     *
     * @return User|null
     */
    public function getUser()
    {
        if ($this->_user === false) {
            $this->_user = User::findByUsername($this->username);
        }

        return $this->_user;
    }
}