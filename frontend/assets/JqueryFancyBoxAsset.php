<?php
/**
 * Created by PhpStorm.
 * User: vaio_b970
 * Date: 13.04.2017
 * Time: 23:22
 */

namespace frontend\assets;

use yii\web\AssetBundle;

class JqueryFancyBoxAsset extends AssetBundle
{
    public $sourcePath = '@bower/jquery.fancybox';
    public $css = [
        'css/jquery.fancybox-1.3.4.css',
    ];
    public $js = [
        'js/jquery.easing-1.3.pack.js',
        'js/jquery.mousewheel-3.0.4.pack.js',
        'js/jquery.fancybox-1.3.4.js',
    ];
}