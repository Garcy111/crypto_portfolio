<?php

namespace frontend\assets;

use yii\web\AssetBundle;

class OwlcarouselAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'public/libs/owl-carousel/owl.carousel.css',
    ];
    public $js = [
        'public/libs/owl-carousel/owl.carousel.min.js',
    ];
}