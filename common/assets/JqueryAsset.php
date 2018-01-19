<?php

namespace common\assets;

use yii\web\AssetBundle;

class JqueryAsset extends AssetBundle
{

	public $sourcePath = '@bower';

    public $js = [
    	'jquery/dist/jquery.min.js',
    ];
    public $jsOptions = ['position' => \yii\web\View::POS_HEAD];
}