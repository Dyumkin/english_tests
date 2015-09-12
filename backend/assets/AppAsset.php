<?php

namespace backend\assets;

use yii\web\AssetBundle;

class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';

    public $css = [
        'css/site.css'
    ];

    public $js = [
        'js/pages/login.js',
        'js/pages/dashboard.js'
    ];

    public $depends = [
        'backend\assets\SmartAdminAsset',
    ];
}
