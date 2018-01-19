<?php

namespace frontend\assets;

use yii\web\AssetBundle;

class SumoselectAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'public/libs/sumoselect/sumoselect.css',
    ];
    public $js = [
        'public/libs/sumoselect/jquery.sumoselect.min.js',
    ];
}