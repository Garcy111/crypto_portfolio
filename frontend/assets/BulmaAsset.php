<?php

namespace frontend\assets;

use yii\web\AssetBundle;

class BulmaAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'public/libs/bulma/css/bulma.min.css',
    ];
}