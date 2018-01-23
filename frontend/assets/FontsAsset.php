<?php

namespace frontend\assets;

use yii\web\AssetBundle;

class FontsAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'public/modules/main/css/fonts.css',
    ];
}