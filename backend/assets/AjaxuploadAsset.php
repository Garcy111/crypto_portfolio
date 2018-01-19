<?php

namespace backend\assets;

use yii\web\AssetBundle;

class AjaxuploadAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $js = [
    'public/libs/ajaxupload/SimpleAjaxUploader.min.js',
    ];
}