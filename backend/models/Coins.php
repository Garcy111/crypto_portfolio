<?php
namespace backend\models;

use yii\db\ActiveRecord;
use Yii;

class Coins extends ActiveRecord {

	public static function tableName()
	{
		return '{{%coins}}';
	}

	public function rules()
	{
		return [
			['name', 'required'],
			[['icon', 'color', 'coin_index'], 'safe'],
		];
	}

	public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'icon' => 'Иконка',
            'name' => 'Название',
            'color' => 'Цвет',
            'coin_index' => 'Индекс',
        ];
    }
}