<?php

namespace frontend\assets;

use yii\web\AssetBundle;

class EauthAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'public/widgets/eauth/eauth.css',
    ];
    public $js = [
        'public/widgets/eauth/eauth.js',
    ];
    public $depends = [
    ];
}