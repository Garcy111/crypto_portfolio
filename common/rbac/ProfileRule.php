<?php
namespace app\rbac;
 
use Yii;
use yii\rbac\Rule;
 
class ProfileRule extends Rule
{
    public $name = 'editProfile';
 
    public function execute($userId, $item, $params)
    {
        return $params['edit']->id == $userId;
    }
}