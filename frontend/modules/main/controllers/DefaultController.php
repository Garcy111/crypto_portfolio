<?php

namespace frontend\modules\main\controllers;
 
use Yii;
use yii\web\Controller;
use common\components\SearchClass;
use frontend\modules\main\models\Coins;
use frontend\modules\main\models\CoinsUsers;
 
class DefaultController extends Controller
{
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }
 
    public function actionIndex()
    {
        if (Yii::$app->user->id == null) {
            return $this->redirect('/login');
        }
        $coins_users_model = new CoinsUsers();
        $coins_user = $coins_users_model->getCoinsByUser();

        $coins_model = new Coins();
        $data_coins = $coins_model->getDataCoins($coins_user);

        // set the data in session
        $session = Yii::$app->session;
        $session->open();
        $session->set('data_coins', $data_coins);
        $session->close();

        return $this->render('index', ['data_coins' => $data_coins]);
    }

    public function actionSearch() {

        $data_coins = [];

        // $session = Yii::$app->session;
        // $session->open();
        // $data_coins = $session->get('data_coins');
        // $session->close();
        // $session->destroy();

        $result = "";
        $query = Yii::$app->request->post('query');
        if (!empty($query)) {
            $model = new Coins();
            $result = $model->getDataSearch($query);
        }

        return $this->render('index', ['data_coins' => $data_coins, 'result' => $result]);
    }

    public function actionAdd() {

        $user_id = Yii::$app->user->id;
        $coin_id = Yii::$app->request->post('coin_id');
        $count_coin = Yii::$app->request->post('count_coin');

        $model = new CoinsUsers();

        $coin = $model->find()->where(['coin_id' => $coin_id, 'user_id' => $user_id])->asArray()->one();

        if (empty($coin)) {
            $model->user_id = $user_id;
            $model->coin_id = $coin_id;
            $model->quan = $count_coin;
            $model->save();
        }

        return Yii::$app->response->redirect(['/']);
    }

    public function actionEdit() {

        $user_id = Yii::$app->user->id;
        $name_coin = Yii::$app->request->post('name_coin');
        $count_coin = Yii::$app->request->post('count_coin');

        $model_coins = new Coins();
        $coin = $model_coins->find()->where(['name' => $name_coin])->one();

        $coin_id = $coin->id;

        $model = new CoinsUsers();
        $_coin = $model->find()->where(['user_id' => $user_id, 'coin_id' => $coin_id])->one();

        $_coin->quan = $count_coin;
        $_coin->save();

        return Yii::$app->response->redirect(['/']);
    }

    public function actionDel($name_coin) {

        $user_id = Yii::$app->user->id;

        $model_coins = new Coins();
        $coin = $model_coins->find()->where(['name' => $name_coin])->one();

        $coin_id = $coin->id;

        $model = new CoinsUsers();
        $_coin = $model->find()->where(['user_id' => $user_id, 'coin_id' => $coin_id])->one();
        $_coin->delete();

        return Yii::$app->response->redirect(['/']);
    }

    public function actionSync()
    {
        $cmc_coins = file_get_contents("https://api.coinmarketcap.com/v1/ticker/?limit=10000");
        $cmc_coins = json_decode($cmc_coins);

        $coins_model = new Coins();
        $db_coins = $coins_model->getCoins();

        $coin_ids = [];
        for ($i=0; count($db_coins) > $i; $i++) {
             $coin_ids[$i] = $db_coins[$i]['name'];
        }

        for ($c=0; count($cmc_coins) > $c; $c++) {
            $coin_id = $cmc_coins[$c]->id;
            $coin_symbol = $cmc_coins[$c]->symbol;
            if (!array_search($coin_id, $coin_ids)) {
                $coins_model = new Coins();

                $searchObj  = new SearchClass();
                $index_string = $coin_id . " " . $coin_symbol;
                $index = ( $searchObj -> make_index($index_string) );
                $index = json_encode($index);

                $coins_model->coin_index = $index;

                $color = $coins_model->getColor();
                $coins_model->icon = "https://files.coinmarketcap.com/static/img/coins/32x32/" . $coin_id . ".png";
                $coins_model->name = $coin_id;
                $coins_model->color = $color;
                $coins_model->save();
            }
        }

        return false;
    }
}