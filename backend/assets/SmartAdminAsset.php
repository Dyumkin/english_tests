<?php

namespace backend\assets;

use yii\web\AssetBundle;

class SmartAdminAsset extends AssetBundle
{
    public $basePath = '@webroot';

    public $css = [
        'css/smartadmin-production-plugins.min.css',
        'css/smartadmin-production.min.css',
        'css/smartadmin-skins.min.css',
        'css/smartadmin-rtl.min.css',
    ];

    public $js = [
        'js/app.config.js',
        'js/app.min.js',
    ];

    public $depends = [
        'yii\jui\JuiAsset',
        'backend\assets\smartadmin\PaceAsset',
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
        'yii\bootstrap\BootstrapPluginAsset',
        'backend\assets\smartadmin\FontAwesomeAsset',
        //'backend\assets\smartadmin\jQueryUITouchPunchAsset',
        'backend\assets\smartadmin\SmartNotificationAsset',
        'backend\assets\smartadmin\JarvisWidgetAsset',
        'backend\assets\smartadmin\jQueryEasyPieChartAsset',
        'backend\assets\smartadmin\jQuerySparklineAsset',
        'backend\assets\smartadmin\jQueryMaskedinputAsset',
        'backend\assets\smartadmin\jQuerySelect2Asset',
        'backend\assets\smartadmin\jQueryBootstrapSliderAsset',
        'backend\assets\smartadmin\jQueryMbBrowserAsset',
        'backend\assets\smartadmin\FastclickAsset',
    ];
}
