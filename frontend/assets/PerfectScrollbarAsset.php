<?php

namespace frontend\assets;

use yii\web\AssetBundle;

class PerfectScrollbarAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'public/libs/perfect-scrollbar/css/perfect-scrollbar.min.css',
    ];
    public $js = [
        'public/libs/perfect-scrollbar/js/min/perfect-scrollbar.jquery.min.js',
    ];
}