<?php

namespace backend\assets\smartadmin;

use yii\web\AssetBundle;
class jQuerySelect2Asset extends AssetBundle
{
    public $sourcePath = '@bower/select2';
    public $js = [
        'dist/js/select2.full.min.js',
        'dist/js/i18n/ru.js',
        'dist/js/i18n/en.js',
    ];

    public $css = [
        'dist/css/select2.min.css',
    ];
}