<?php
/**
 * Created by PhpStorm.
 * User: vaio_b970
 * Date: 20.04.2017
 * Time: 1:23
 */

namespace backend\assets;

use yii\web\AssetBundle;

class BootstrapFileinputAsset extends AssetBundle
{
    public $sourcePath = '@bower/bootstrap-fileinput-master';
    public $css = [
        'css/fileinput.css',
    ];
    public $js = [
        'js/fileinput.js',
        'js/locales/LANG.js',
        'js/locales/ru.js',
    ];
}