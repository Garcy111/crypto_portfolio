<?php

namespace frontend\assets;

use yii\web\AssetBundle;

class BlocksitAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'public/libs/blocksit/grid.css',
    ];
    public $js = [
        'public/libs/blocksit/blocksit.min.js',
        'public/libs/blocksit/setting-grid.js',
    ];
}