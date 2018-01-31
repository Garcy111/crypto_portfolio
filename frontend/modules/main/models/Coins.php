<?php
namespace frontend\modules\main\models;

use Yii;
use yii\db\ActiveRecord;
use common\components\SearchClass;
use frontend\modules\main\models\CoinsUsers;

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

    public function getDataCoins($coins, $cur) {
        $all_coins = file_get_contents("https://api.coinmarketcap.com/v1/ticker/?limit=200&convert=" . $cur);
        $all_coins = json_decode($all_coins);

        $data_coins = [];
        for ($i=0; count($coins) > $i; $i++) {
            $name_coin = $coins[$i]['name'];

            $coin = [];
            for ($c=0; count($all_coins) > $c; $c++) {

                if ($name_coin == $all_coins[$c]->id) {
                    $coin[0] = $all_coins[$c];
                    break;
                }
            }

            if (empty($coin)) {
                $href_api = "https://api.coinmarketcap.com/v1/ticker/" . $name_coin . "/";
                $get = file_get_contents($href_api);
                $coin = json_decode($get);
            }

            $coin_name = $coin[0]->id;
            $coin_symbol = $coin[0]->symbol;

            if ($cur == 'USD') {
                $coin_price = $coin[0]->price_usd;
            }
            if ($cur == 'RUB') {
                $coin_price = $coin[0]->price_rub;
            }
            if ($cur == 'EUR') {
                $coin_price = $coin[0]->price_eur;
            }
            if ($cur == 'CNY') {
                $coin_price = $coin[0]->price_cny;
            }
            if ($cur == 'BTC') {
                $coin_price = $coin[0]->price_btc;
            }

            $coin_percent = $coin[0]->percent_change_24h;
            $coin_count = $coins[$i]['quan'];
            $coin_usd = $coin_price * $coin_count;
            $coin_status = $this->getStatus($coin_percent);

            $data_coins[$i]['icon'] = $coins[$i]['icon'];
            $data_coins[$i]['symbol'] = $coin_symbol;
            $data_coins[$i]['name'] = $coin_name;
            $data_coins[$i]['price'] = $coin_price;
            $data_coins[$i]['percent'] = $coin_percent;
            $data_coins[$i]['count'] = $coin_count;
            $data_coins[$i]['usd'] = $coin_usd;
            $data_coins[$i]['status'] = $coin_status;
            $data_coins[$i]['color'] = $coins[$i]['color'];
        }
        return $data_coins;
    }

    public function getStatus($percent) {
        $sub = substr($percent, 0, 1);
        if ($sub != '-') return false;
        return true;
    }

    public function getColor() {
        return sprintf( '#%02X%02X%02X', rand(0, 255), rand(0, 255), rand(0, 255) );
    }

    public function getCoins()
    {
        $coins = $this->find()->orderBy('id DESC')->asArray()->all();
        return $coins;
    }

    public function getDataSearch($query) {
        if ( !empty($query) ) {
            $searchObj  = new SearchClass();
            $indexQuery = ( $searchObj -> make_index($query) );

            $data = self::find()->asArray()->all();
            $count = count($data);
            $range = 0;
            for ( $i=0; $count > $i; $i++ ) {
                $index = json_decode($data[$i]["coin_index"]);
                if ( !empty($index) ) {
                    $range = $searchObj->search($indexQuery, $index);
                }

                if ( $range > 0 ) {
                    // $result[ $data[$i][ 'id' ] ] = $range;
                    $result[] = $data[$i];
                }
            }
        }

        // Если что-нибудь нашлось //
        if ( isset( $result ) ) {
            // Сортировка по убыванию //
            arsort( $result );
            
            return $result;
        }
        else {
            return false;
        }
    }
}
