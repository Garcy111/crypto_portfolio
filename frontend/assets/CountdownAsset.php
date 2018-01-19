<?php

namespace frontend\assets;

use yii\web\AssetBundle;

class CountdownAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'public/libs/countdown/jquery.countdown.css',
    ];
    public $js = [
    'public/libs/countdown/jquery.countdown.min.js',
    'public/libs/countdown/jquery.countdown-ru.js',
    'public/libs/countdown/jquery.plugin.js',
    ];
    public $depends = [
    ];
}