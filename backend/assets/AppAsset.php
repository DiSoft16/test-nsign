<?php

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/bootstrap.css',
        'css/font-awesome.css',
        'css/site.css',
    ];
    public $js = [
        'js/bootstrap.js',
        'js/main.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'backend\assets\JqueryFancyBoxAsset',
        'backend\assets\BootstrapFileinputAsset',
    ];
}
