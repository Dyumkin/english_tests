<?php

namespace backend\assets\smartadmin;

use yii\web\AssetBundle;
class jQuerySparklineAsset extends AssetBundle
{
    public $sourcePath = '@bower/kapusta-jquery.sparkline/dist';
    public $js = [
        'jquery.sparkline.min.js'
    ];
}