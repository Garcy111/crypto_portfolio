<?php
namespace frontend\modules\user\models;
 
use yii\base\Model;
use Yii;

class ProfileUpdateForm extends Model {

	public $email;
    public $avatar;
    /**
     * @var User
     */
    private $_user;
 
    public function __construct(User $user, $config = [])
    {
        $this->_user = $user;
        parent::__construct($config);
    }
 
    public function init()
    {
        $this->email = $this->_user->email;
        $this->avatar = $this->_user->avatar;
        parent::init();
    }
 
    public function rules()
    {
        return [
            ['email', 'required'],
            ['email', 'email'],
            ['avatar', 'safe'],
            ['email', 'string', 'max' => 255],
        ];
    }

    public function update()
    {
        if ($this->validate()) {
            $user = $this->_user;
            $user->email = $this->email;
            return $user->save();
        } else {
            return false;
        }
    }
}