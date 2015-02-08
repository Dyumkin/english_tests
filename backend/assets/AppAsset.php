<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $sourcePath = '@bower/';

    public $css = [
        'admin-lte/dist/css/AdminLTE.css',
        'font-awesome/css/font-awesome.min.css',
        'admin-lte/dist/css/skins/skin-blue.min.css',
        'admin-lte/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css',
        'admin-lte/plugins/datepicker/datepicker3.css',
        'admin-lte/plugins/daterangepicker/daterangepicker-bs3.css',
        'admin-lte/plugins/jvectormap/jquery-jvectormap-1.2.2.css',
        'admin-lte/plugins/morris/morris.css'

    ];

    public $js = [
        'admin-lte/dist/js/app.js',
        'admin-lte/dist/js/pages/dashboard.js',
        'admin-lte/plugins/slimScroll/jquery.slimscroll.js',
        'admin-lte/plugins/iCheck/icheck.min.js',
        'admin-lte/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js',
        'admin-lte/plugins/datepicker/bootstrap-datepicker.js',
        'admin-lte/plugins/daterangepicker/daterangepicker.js',
        'admin-lte/plugins/jqueryKnob/jquery.knob.js',
        'admin-lte/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js',
        'admin-lte/plugins/jvectormap/jquery-jvectormap-world-mill-en.js',
        'admin-lte/plugins/morris/morris.min.js',
        'admin-lte/plugins/sparkline/jquery.sparkline.min.js',
        'admin-lte/plugins/jQueryUI/jquery-ui-1.10.3.min.js'

    ];

    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
        'yii\bootstrap\BootstrapPluginAsset',
    ];
}
