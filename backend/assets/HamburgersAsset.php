<?php

namespace backend\assets;

use yii\web\AssetBundle;

class HamburgersAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'public/libs/hamburgers/hamburgers.css',
    ];
    public $js = [
       'public/libs/hamburgers/hamburgers.js',
    ];
}