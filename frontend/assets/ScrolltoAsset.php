<?php

namespace frontend\assets;

use yii\web\AssetBundle;

class ScrolltoAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $js = [
        'public/libs/scrollto/jquery.scrollTo.min.js',
    ];
}