<?php
namespace frontend\modules\user\models;

use yii\helpers\ArrayHelper;
use Yii;

class User extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{
    const STATUS_WAIT = 0;
    const STATUS_ACTIVE = 1;
    const STATUS_BLOCKED = 2;

    public $profile;
    public $role;

     public static function tableName() {
        return '{{%users}}';
    }

    public function rules()
    {
        return [
            [['username', 'email', 'soc', 'activation', 'access', 'avatar', 'role'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */

     public static function findIdentity($id)
    {
        $user = self::findOne(['id' => $id]);
        if (!empty($user)) {
            return $user;
        } else {
            $user = self::findOne(['soc' => $id]);
            return !empty($user) ? $user : null;
        }
    }

    /**
     * @param \nodge\eauth\ServiceBase $service
     * @return User
     * @throws ErrorException
     */

    public static function findByEAuth($service) {
        if (!$service->getIsAuthenticated()) {
            throw new ErrorException('EAuth user should be authenticated before creating identity.');
        }
 
        $id = $service->getServiceName().'-'.$service->getId();
        $attributes = [
            'id' => $id,
            'username' => $service->getAttribute('name'),
            'email' => $service->getAttribute('email'),
            'authKey' => self::getSocAuthKey($id),
            'profile' => $service->getAttributes(),
        ];
        $attributes['profile']['service'] = $service->getServiceName();
        return new self($attributes);
    }

    public static function getSocAuthKey($id)
    {
        $user = self::findOne(['soc' => $id]);
        if (isset($user->authKey)) {
            return $user->authKey;
        }
        return Yii::$app->getSecurity()->generateRandomString();
    }

    public static function existsSocUser($identity)
    {
        $id = $identity->id;
        $user = self::findOne(['soc' => $id]);
        return empty($user) ? false : true;
    }

    public static function saveSocUser($identity)
    {
        $user = new self;
        $user->soc = $identity->id;
        if ($identity->email !== null) {
            $user->email = $identity->email;
        }
        $user->username = $identity->username;
        $user->authKey = $identity->authKey;
        $user->save();
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return null;
    }

    /**
     * Finds user by username
     *
     * @param  string      $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return self::findOne(['username' => $username]);
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->authKey;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
    }

    /**
     * Validates password
     *
     * @param  string  $password password to validate
     * @return boolean if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        $hash = $this->password;
        if (Yii::$app->getSecurity()->validatePassword($password, $hash)) {
            // всё хорошо, пользователь может войти
            return true;
        } else {
            return false;
        }
    }

    public function getStatusName()
    {
        return ArrayHelper::getValue(self::getStatusesArray(), $this->access);
    }
 
    public static function getStatusesArray()
    {
        return [
            self::STATUS_WAIT => 'Ожидает подтверждения',
            self::STATUS_ACTIVE => 'Активен',
            self::STATUS_BLOCKED => 'Заблокирован',
        ];
    }

}
