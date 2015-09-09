<?php


namespace backend\assets\smartadmin;

use yii\web\AssetBundle;

class jQueryEasyPieChartAsset extends AssetBundle
{
    public $sourcePath = '@bower/jquery.easy-pie-chart/dist';
    public $js = [
        'jquery.easypiechart.min.js'
    ];
}