<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;

yii\web\YiiAsset::register($this);

common\assets\FontawesomeAsset::register($this);
common\assets\JqueryAsset::register($this);

backend\assets\HamburgersAsset::register($this);
$this->registerCssFile('/admin/public/css/adminpanel.css');
$this->registerCssFile('/admin/public/widgets/modal/modal.css');
$this->registerCssFile('/admin/public/css/fonts.css');
$this->registerJsFile('/admin/public/js/adminpanel.js');
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/react/15.0.1/react.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/react/15.0.1/react-dom.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/babel-core/5.8.23/browser.min.js"></script>

    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
<div class="container">
    <div class="hero">
    <?= common\widgets\ModalWidget::widget() ?>
    <div class="layout-panel"></div>
    <div class="panel">
        <div class="logo">
            <span>AdminPanel</span>
        </div>
        
        <div class="menu">
        <div class="hamburger hamburger--elastic">
            <div class="hamburger-box">
                <div class="hamburger-inner"></div>
            </div>
        </div></div>
        
        <!-- Logout -->
        <?= Html::a(
                Html::button(
                    '<i class="fa fa-sign-out" aria-hidden="true"></i>',
                    ['class' => 'logOut', 'title' => 'Выход']
                ),
            ['/default/logout']
        ) ?>

        <!-- Settings -->
        <?= Html::a(
                Html::button(
                    '<i class="fa fa-cog"></i>',
                    ['class' => 'settings', 'title' => 'Настройки']
                ),
            ['/default/settings']
        ) ?>
        
        <!-- Image manager -->
        <div class="im-btn" title="Менеджер изображений">
            <i class="fa fa-file" aria-hidden="true"></i>
        </div>
    
        <!-- Notifications -->
        <div id="wrap-notification"></div>
        <script type="text/babel" src="/admin/public/ui/notification.js"></script>
        <!-- End -->
        
    </div>
    <div class="wrapper">
     <?= $this->render('/default/nav') ?>
        <?= $content ?>
    </div>
    </div>

</div>
<?= $this->render('/default/image-manager') ?>
<audio id="notice" src="/admin/public/audio/notice.wav" type="audio/wav" preload="auto"></audio>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
