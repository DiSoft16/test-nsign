<?php
/**
 * Created by PhpStorm.
 * User: vaio_b970
 * Date: 13.04.2017
 * Time: 11:04
 */

namespace frontend\assets;

use yii\web\AssetBundle;

class DependentDropdownAsset extends AssetBundle
{
    public $sourcePath = '@bower/dependent-dropdown-master';
    public $css = [
        'css/dependent-dropdown.css',
    ];
    public $js = [
        'js/dependent-dropdown.js',
        'js/depdrop_locale_LANG.js',
        'js/depdrop_locale_ru.js',
    ];
}