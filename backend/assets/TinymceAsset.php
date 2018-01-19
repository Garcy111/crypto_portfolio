<?php

namespace backend\assets;

use yii\web\AssetBundle;

class TinymceAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';

    public $js = [
        'public/libs/tinymce/tinymce.min.js',
        'public/libs/tinymce/init.js',
    ];

   public $jsOptions = ['position' => \yii\web\View::POS_HEAD];
}