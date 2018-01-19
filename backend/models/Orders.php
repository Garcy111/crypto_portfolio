<?php

namespace backend\models;
use backend\models\Address;
// use app\modules\user\models\User;

use Yii;

/**
 * This is the model class for table "{{%orders}}".
 *
 * @property integer $id
 * @property integer $order_id
 * @property integer $user_id
 * @property string $products
 * @property string $quantity
 * @property integer $shipping
 * @property integer $active
 * @property integer $date
 */
class Orders extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%orders}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['order_id', 'products', 'quantity', 'total', 'date'], 'required'],
            [['order_id', 'user_id', 'shipping', 'total', 'active', 'date'], 'integer'],
            [['products', 'quantity'], 'string']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'order_id' => 'Номер заказа',
            'user_id' => 'Польз.',
            'products' => 'Продукты',
            'quantity' => 'Количество',
            'shipping' => 'Доставка',
            'active' => 'Статус',
            'date' => 'Создан',
        ];
    }

    public function getAddress()
    {
        return $this->hasOne(Address::className(), ['order_id' => 'order_id']);
    }

    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
