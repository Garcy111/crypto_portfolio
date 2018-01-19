<?php

namespace common\assets;

use yii\web\AssetBundle;

class BootstrapgridAsset extends AssetBundle
{

	public $sourcePath = '@bower';

    public $css = [
    	'bootstrap-grid/dist/bootstrap-grid.min.css',
    ];
}