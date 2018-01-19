<?php

namespace frontend\assets;

use yii\web\AssetBundle;

class MainAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'public/modules/main/css/style.css',
    ];
    public $js = [
        'https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js',
        'https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.bundle.min.js',
        'public/modules/main/js/script.js'
    ];

    public $jsOptions = ['position' => \yii\web\View::POS_HEAD];
}