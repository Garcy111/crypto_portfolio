<?php

namespace frontend\modules\user\models;

use Yii;
use yii\base\Model;

/**
 * LoginForm is the model behind the login form.
 */
class RecoveryForm extends Model
{
    public $email;
    public $password;
    public $password_repeat;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['email', 'password', 'password_repeat'], 'required', 'message' => 'Поле должно быть заполнено'],
            ['password', 'compare', 'message' => 'Пароли не совпадают'],
            ['password_repeat', 'string', 'length' => [6, 25], 'tooShort' => 'Пароль не должен быть меньше 6 символов', 'tooLong' => 'Пароль не должен привышать 25 символов'],
            ['email', 'email', 'message' => 'Введите коректный email адрес'],
            ['email', 'validateEmail'],
        ];
    }

    // public function attributeLabels() {
    //     return [
    //         'username' => 'Логин',
    //         'password' => 'Пароль',
    //         'password_repeat' => 'Повторите пароль',
    //     ];
    // }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validateEmail($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();
            if (empty($user->email)) {
                $this->addError($attribute, 'Пользователя с таким Email адресом не существует');
            }
        }
    }

    public function saveNewPassword()
    {
        $user = $this->getUser();
        $user->recovery = $this->hashPassword($this->password);
        $user->save();
    }

    public function sendEmailRecovery()
    {
        $user = $this->getUser();
        if (!empty($user)):
        return Yii::$app->mailer->compose('recoveryUser', ['user' => $user])
                ->setFrom([Yii::$app->params['supportEmail'] => 'Восстановление пароля'])
                ->setTo($this->email)
                ->setSubject('Восстановление пароля')
                ->send();
        endif;
        return false;
    }

    public function recoveryPassword($id, $pass)
    {
        $user = User::findOne(['id' => $id]);
        $user->password = $pass;
        $user->save();
    }

    public function getUser()
    {
        return User::findOne(['email' => $this->email]);
    }

    public function hashPassword($password)
    {
        return Yii::$app->getSecurity()->generatePasswordHash($password);
    }
}
