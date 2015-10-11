<?php

namespace frontend\assets;

use yii\web\AssetBundle;
use yii\web\View;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class RequireJsAsset extends AssetBundle
{
    public $js = [
        'require.js',
    ];
    public $sourcePath = '@npm/requirejs';
    public function registerAssetFiles($view)
    {
        $manager = $view->getAssetManager();
        $this->jsOptions = [
            'data-main' => $manager->getAssetUrl($this, '/built/common'),
            'position' => View::POS_HEAD
        ];
        parent::registerAssetFiles($view);
    }
}
