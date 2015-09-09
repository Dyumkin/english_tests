<?php


namespace backend\assets\smartadmin;

use yii\web\AssetBundle;

class jQueryMaskedinputAsset extends AssetBundle
{
    public $sourcePath = '@bower/jquery-maskedinputs/dist';
    public $js = [
        'jquery.maskedinput.min.js'
    ];
}