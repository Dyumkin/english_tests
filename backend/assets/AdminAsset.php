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
class AdminAsset extends AssetBundle
{
    public $sourcePath = '@vendor/almasaeed2010';

    public $css = [
        'adminlte/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css',
        'adminlte/plugins/datepicker/datepicker3.css',
        'adminlte/plugins/daterangepicker/daterangepicker-bs3.css',
        'adminlte/plugins/jvectormap/jquery-jvectormap-1.2.2.css',
        'adminlte/plugins/morris/morris.css'

    ];

    public $js = [
        'adminlte/dist/js/pages/dashboard.js',
        'adminlte/plugins/slimScroll/jquery.slimscroll.js',
        'adminlte/plugins/iCheck/icheck.min.js',
        'adminlte/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js',
        'adminlte/plugins/datepicker/bootstrap-datepicker.js',
        'adminlte/plugins/daterangepicker/daterangepicker.js',
        'adminlte/plugins/knob/jquery.knob.js',
        'adminlte/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js',
        'adminlte/plugins/jvectormap/jquery-jvectormap-world-mill-en.js',
        'adminlte/plugins/morris/morris.min.js',
        'adminlte/plugins/sparkline/jquery.sparkline.min.js',
        'adminlte/plugins/jQueryUI/jquery-ui-1.10.3.min.js'
    ];

    public $depends = [
        'dmstr\web\AdminLteAsset',
    ];
}
