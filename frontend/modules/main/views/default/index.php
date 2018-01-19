<?php

header('Access-Control-Allow-Origin: *');

/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\widgets\Pjax;
use frontend\modules\main\models\Coins;

$this->title = 'Portfolio';

?>

<?php

    // $start = microtime(true);
    // echo 'Время выполнения скрипта: '.(microtime(true) - $start).' сек.';

    // Sort
    function cmp($a, $b)  
    { 
    // return strnatcmp($a["usd"], $b["usd"]); //по возрастанию
    return strnatcmp($b["usd"], $a["usd"]); //по убыванию
    } 
    usort($data_coins, "cmp");


    // Курс долара к рублю.
    $dollar = 57.6;
    $usd_rub = $dollar;
    // Вложено в крипту
    // $invested = 1200;

    $global = file_get_contents("https://api.coinmarketcap.com/v1/global/");
    $global = json_decode($global);
    $total_market = $global->total_market_cap_usd;
    $total_market_24h = $global->total_24h_volume_usd;
    $bitcoin_percentage = $global->bitcoin_percentage_of_market_cap;

    $total_money = 0;
    for ($i=0; count($data_coins) > $i; $i++) {
        $total_money += $data_coins[$i]['usd'];
    }

    $total_money = floor($total_money);

?>
    
<div class="container">
    <div class="top_bar">
        <div class="item">
            <div class="value">Market Cap: <span>$<?= $total_market; ?></span> | </div>
        </div>
        <div class="item">
            <div class="value">24h Vol: <span>$<?= $total_market_24h; ?></span> | </div>
        </div>
        <div class="item">
            <div class="value">BTC Dominance: <span><?= $bitcoin_percentage; ?>%</span></div>
        </div>
        <div class="item">
            <div class="value">Dollar: <span><?= $dollar; ?> rub</span></div>
        </div>
        <a class="logout" href="/user/default/logout/">Logout</a>
    </div>

    <h2 class="total_sum" id="total_usd">$<?= number_format($total_money, 0, '.', ' '); ?></h2>
    <h2 class="total_sum" id="total_rub"><?= number_format(floor($total_money * $usd_rub), 0, '.', ' '); ?> руб.</h2>

    
    <div class="left_col">
    <?php Pjax::begin(['enablePushState' => false, 'timeout' => 10000]); ?>

    <?= Html::beginForm(['/main/default/search/'], 'post', ['data-pjax' => '', 'class' => 'searchCoinsForm']); ?>
        <?= Html::input('text', 'query', '', ['class' => 'search_field', 'placeholder' => 'Search']) ?>
        <?= Html::submitButton('', ['class' => 'sendSearch', 'name' => 'send_search']) ?>
    <?= Html::endForm() ?>

    <div class="clear"></div>

    <?php if (isset($result) && !empty($result)): ?>
    <div class="search_results">
        <?php for ($i=0; count($result) > $i; $i++): ?>
            <div class="row_result">
                <p class="img_coin">
                    <img src="<?php echo "https://files.coinmarketcap.com/static/img/coins/32x32/" . $result[$i]['name'] . ".png" ?>" alt="coin name">
                </p>
                <p class="name_coin"><?= $result[$i]['name']; ?></p>

                <?= Html::beginForm(['/main/default/add/'], 'post', ['data-pjax' => '', 'class' => 'addCoinForm']); ?>
                <?= Html::input('text', 'count_coin', '', ['class' => 'count_field']) ?>
                <?= Html::input('hidden', 'coin_id', $result[$i]['id']) ?>
                <?= Html::submitButton('Add', ['class' => 'addCoin', 'name' => 'add_coin']) ?>
                <?= Html::endForm() ?>

            </div>
        <?php endfor; ?>
    </div>
    <?php endif; ?>

    <?php
        if (isset($a)) {
            echo $a;
        }
    ?>

    <?php Pjax::end(); ?>

    
    <div class="prices">
        
        <div class="curency head-curency">
            <div class="col col-0">#</div>
            <div class="col col-1">coin</div>
            <div class="col col-2">price</div>
            <div class="col col-3">profit</div>
            <div class="col col-4">quantity</div>
            <div class="col col-5">balance</div>
            <div class="col col-6">percent</div>
            <div class="col col-7">edit</div>
        </div>

        <?php for ($i=0; count($data_coins) > $i; $i++): ?>
        <div class="curency body-curency">
            <div class="col col-0">
                <img src="<?= $data_coins[$i]['icon']; ?>">
            </div>
            <div class="col col-1">
                <p><?= $data_coins[$i]['symbol']; ?></p> 
            </div>
            <div class="col col-2">
                <p>$<?= number_format($data_coins[$i]['price'], 3, '.', ''); ?></p>
            </div>
            <div class="col col-3">
                <p class="proc <?php if ($data_coins[$i]['status']) { echo 'red'; } ?>"><?= $data_coins[$i]['percent']; ?>%</p>
            </div>
            <div class="col col-4">
                <p><?= $data_coins[$i]['count']; ?></p>
            </div>
            <div class="col col-5">
                <p>$<?= number_format($data_coins[$i]['usd'], 2, '.', ''); ?></p>
            </div>
            <div class="col col-6">
                <?php
                    $procent = 0;
                    if ($total_money != 0) {
                        $procent = number_format($data_coins[$i]['usd'] / $total_money * 100, 2, '.', '');
                    }
                ?>
                <p><?= $procent; ?>%</p>
            </div>
            <div class="col col-7">
                <div class="edit"></div>
            </div>
            <div class="clear"></div>
            <div class="edit-block">
                <?= Html::beginForm(['/main/default/edit/'], 'post', ['data-pjax' => '', 'class' => 'editCoin']); ?>
                <?= Html::input('text', 'count_coin', $data_coins[$i]['count'], ['class' => 'count_field']) ?>
                <?= Html::input('hidden', 'name_coin', $data_coins[$i]['name']) ?>
                <?= Html::submitButton('save', ['class' => 'edit', 'name' => 'edit_coin']) ?>
                <?= Html::endForm() ?>
                <?= Html::a('Delete', ['/main/default/del', 'name_coin' => $data_coins[$i]['name']], ['class' => 'delCoin']); ?>
            </div>
        </div>
        <?php endfor; ?>
        
    </div>
    </div>
    
    <div class="right_col">
        <div id="canvas-holder">
            <canvas id="chart-area" />
        </div>
    </div>

    <div class="clear"></div>

    <form class="coins_form">
        <?php for ($i=0; count($data_coins) > $i; $i++): ?>
            <input type="hidden" id="<?= $data_coins[$i]['symbol']; ?>" data-name="<?= $data_coins[$i]['symbol']; ?>" data-color="<?= $data_coins[$i]['color']; ?>" value="<?= $data_coins[$i]['usd']; ?>">
        <?php endfor; ?>
    </form>
</div>