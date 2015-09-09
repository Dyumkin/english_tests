<?php


namespace backend\assets\smartadmin;

use yii\web\AssetBundle;

class jQueryBootstrapSliderAsset extends AssetBundle
{
    public $sourcePath = '@bower/seiyria-bootstrap-slider/dist';
    public $js = [
        'bootstrap-slider.min.js'
    ];
}