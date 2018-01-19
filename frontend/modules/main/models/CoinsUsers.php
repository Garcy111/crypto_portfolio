<?php
namespace frontend\modules\main\models;

use Yii;
use yii\db\ActiveRecord;
use frontend\modules\main\models\Coins;

class CoinsUsers extends ActiveRecord {

    public static function tableName()
    {
        return '{{%coins_users}}';
    }

    public function rules()
    {
        return [
            [['user_id', 'coin_id', 'quan'], 'safe'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'coin_id' => 'Coin ID',
            'quan' => 'Quantity',
        ];
    }

    public function getCoinsByUser()
    {
        $user_id = Yii::$app->user->id;
        $coins_user = $this->find()->where(['user_id' => $user_id])->orderBy('id DESC')->asArray()->all();
        $ids = [];
        $quans = [];
        for ($i=0; count($coins_user) > $i; $i++) {
            $ids[$i] = $coins_user[$i]['coin_id'];
        }
        $coins_model = new Coins();
        $coins = $coins_model->find()->where(['id' => $ids])->orderBy('id DESC')->asArray()->all();

        for ($c=0; count($coins) > $c; $c++) {
            $coin_id = $coins[$c]['id'];
            for ($n=0; count($coins_user) > $n; $n++) {
                if ($coin_id == $coins_user[$n]['coin_id']) {
                    $coins[$c]['quan'] = $coins_user[$n]['quan'];
                }
            }
        }

        return $coins;
    }

}
