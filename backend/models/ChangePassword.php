<?php
namespace backend\models;

use Yii;
use backend\models\User;

class ChangePassword extends yii\base\Model {

	public $username;
	public $password_old;
	public $password_new;
	public $password_new_repeat;

	public function rules()
	{
		return [
			[['username', 'password_old', 'password_new', 'password_new_repeat'], 'required', 'message' => 'Поле не должно быть пустым'],
			['username', 'match', 'pattern' => '/^([a-zA-Z0-9_]{3,25})?$/', 'message' => 'Только буквы (A-Z a-z) и цифры (0-9), не меньше 3 и не больше 25 символов'],
			['password_new_repeat', 'string', 'length' => [6, 25], 'tooShort' => 'Пароль не должен быть меньше 6 символов', 'tooLong' => 'Пароль не должен привышать 25 символов'],
			['password_new', 'compare', 'message' => 'Пароли не совпадают'],
			['password_old', 'validatePasswordOld'],
		];
	}

	public function validatePasswordOld($attribute, $params)
	{
		if (!$this->hasErrors()) {
            if (!$this->validatePassword($this->password_old)) {
                $this->addError($attribute, 'Пароль введен не верно');
            }
        }
	}

	public function changePassword()
	{
		$id = Yii::$app->user->identity->id;
		$user = User::findOne(['id' => $id]);
		$user->username = $this->username;
		$user->password = $this->hashPassword($this->password_new);
		$user->save();
	}

	/**
	 * @param  string  $password from form
	 * @return boolean
	 */
	public function validatePassword($password)
	{
		$user = Yii::$app->user->identity;
		$hash = $user->password;
        if (Yii::$app->getSecurity()->validatePassword($password, $hash)) {
            // всё хорошо, пользователь может войти
            return true;
        } else {
            return false;
        }
	}

	public function hashPassword($password)
    {
        return Yii::$app->getSecurity()->generatePasswordHash($password);
    }
}