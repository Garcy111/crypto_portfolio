<?php
namespace frontend\modules\user\models;

use yii\base\Model;
use yii\web\UploadedFile;
use Yii;

class UploadForm extends Model
{
    /**
     * @var UploadedFile
     */
    public $imageFile;

    public function rules()
    {
        return [
            [['imageFile'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg', 'checkExtensionByMimeType'=>false],
        ];
    }
    
    public function upload()
    {
        if ($this->validate()) {
            $this->imageFile->saveAs('uploads/avatar/' . $this->imageFile->baseName . '.' . $this->imageFile->extension);
            $id = Yii::$app->user->identity->id;
            $user = User::findOne(['id' => $id]);
            $user->avatar = '/uploads/avatar/' . $this->imageFile->baseName . '.' . $this->imageFile->extension;
            $user->save();
            return true;
        } else {
            return false;
        }
    }
}