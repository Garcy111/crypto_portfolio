<?php

namespace common\assets;

use yii\web\AssetBundle;

class FontawesomeAsset extends AssetBundle
{

	public $sourcePath = '@bower';

    public $css = [
    	'font-awesome/css/font-awesome.min.css',
    ];
}