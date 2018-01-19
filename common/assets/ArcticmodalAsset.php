<?php

namespace common\assets;

use yii\web\AssetBundle;

class ArcticmodalAsset extends AssetBundle
{
    public $sourcePath = '@bower';

    public $css = [
        'arcticmodalbw/arcticmodal/jquery.arcticmodal.css',
        // 'libs/arcticmodal/themes/simple.css',
    ];
    public $js = [
        'arcticmodalbw/arcticmodal/jquery.arcticmodal.min.js',
    ];
}