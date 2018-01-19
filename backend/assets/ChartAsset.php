<?php

namespace backend\assets;

use yii\web\AssetBundle;

class ChartAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $js = [
        'public/libs/chart/Chart.bundle.min.js',
        'public/libs/chart/chart.line.init.js',
    ];
}