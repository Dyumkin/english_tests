<?php


namespace backend\assets\smartadmin;

use yii\web\AssetBundle;
use yii;

class ChartAsset extends AssetBundle
{

    public $js = [
        'js/plugin/flot/jquery.flot.cust.min.js',
        'js/plugin/flot/jquery.flot.resize.min.js',
        'js/plugin/flot/jquery.flot.time.min.js',
        'js/plugin/flot/jquery.flot.tooltip.min.js',
    ];

    public $depends = [
        'yii\web\JqueryAsset',
    ];
}