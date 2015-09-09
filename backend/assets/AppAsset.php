<?php

namespace backend\assets;

use yii\web\AssetBundle;

class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';

    public $css = [
    ];

    public $js = [
        'js/pages/login.js'
    ];

    public $depends = [
        'backend\assets\SmartAdminAsset',
    ];
}
