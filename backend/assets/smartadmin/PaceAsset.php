<?php


namespace backend\assets\smartadmin;

use yii\web\AssetBundle;

class PaceAsset extends AssetBundle
{
    public $sourcePath = '@bower/pace';
    public $js = [
        'pace.min.js'
    ];
}