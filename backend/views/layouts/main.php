<?php
use yii\helpers\Html;
use backend\components\smartui\SmartUI;

/* @var $this \yii\web\View */
/* @var $content string */

$bodyParams = $this->params['bodyParams']; // array like ["id"=>"extr-page", "class"=>"animated fadeInDown"]
$assetsPath = Yii::$app->assetManager->basePath;

// register smartadmin UI plugins
SmartUI::register('widget', 'backend\components\smartui\Widget');
SmartUI::register('datatable', 'backend\components\smartui\DataTable');
SmartUI::register('button', 'backend\components\smartui\Button');
SmartUI::register('tab', 'backend\components\smartui\Tab');
SmartUI::register('accordion', 'backend\components\smartui\Accordion');
SmartUI::register('carousel', 'backend\components\smartui\Carousel');
SmartUI::register('smartform', 'backend\components\smartui\SmartForm');
SmartUI::register('nav', 'backend\components\smartui\Nav');

backend\assets\AppAsset::register($this);
?>
<?php $this->beginPage() ?>
    <!DOCTYPE html>
    <html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>"/>
        <meta name="description" content="">
        <meta name="author" content="">

        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>

        <!-- FAVICONS -->
        <link rel="shortcut icon" href="<?= $assetsPath ?>/img/favicon/favicon.ico" type="image/x-icon">
        <link rel="icon" href="<?= $assetsPath; ?>/img/favicon/favicon.ico" type="image/x-icon">

        <!-- GOOGLE FONT -->
        <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,700italic,300,400,700">

        <!-- Specifying a Webpage Icon for Web Clip
             Ref: https://developer.apple.com/library/ios/documentation/AppleApplications/Reference/SafariWebContent/ConfiguringWebApplications/ConfiguringWebApplications.html -->
        <link rel="apple-touch-icon" href="<?= $assetsPath; ?>/img/splash/sptouch-icon-iphone.png">
        <link rel="apple-touch-icon" sizes="76x76" href="<?= $assetsPath; ?>/img/splash/touch-icon-ipad.png">
        <link rel="apple-touch-icon" sizes="120x120" href="<?= $assetsPath; ?>/img/splash/touch-icon-iphone-retina.png">
        <link rel="apple-touch-icon" sizes="152x152" href="<?= $assetsPath; ?>/img/splash/touch-icon-ipad-retina.png">

        <!-- iOS web-app metas : hides Safari UI Components and Changes Status Bar Appearance -->
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-status-bar-style" content="black">

        <!-- Startup image for web apps -->
        <link rel="apple-touch-startup-image" href="<?= $assetsPath; ?>/img/splash/ipad-landscape.png"
              media="screen and (min-device-width: 481px) and (max-device-width: 1024px) and (orientation:landscape)">
        <link rel="apple-touch-startup-image" href="<?= $assetsPath; ?>/img/splash/ipad-portrait.png"
              media="screen and (min-device-width: 481px) and (max-device-width: 1024px) and (orientation:portrait)">
        <link rel="apple-touch-startup-image" href="<?= $assetsPath; ?>/img/splash/iphone.png"
              media="screen and (max-device-width: 320px)">
        <?php $this->head() ?>
    </head>
    <body<?php echo implode(' ', array_map(function ($prop, $value) {
        return $prop . '="' . $value . '"';
    }, array_keys($bodyParams), $bodyParams));?>>
    <!-- POSSIBLE CLASSES: minified, fixed-ribbon, fixed-header, fixed-width
     You can also add different skin classes such as "smart-skin-1", "smart-skin-2" etc...-->
    <?php $this->beginBody() ?>

    <?php if (Yii::$app->controller->action->id === 'login'): ?>
        <?php echo $this->render(
            'login',
            ['content' => $content, 'assetsPath' => $assetsPath]
        ); ?>
    <?php else: ?>

        <?= $this->render('header.php', ['assetsPath' => $assetsPath]); ?>

        <?= $this->render('nav.php'); ?>

        <!-- ==========================CONTENT STARTS HERE ========================== -->
        <!-- MAIN PANEL -->
        <div id="main" role="main">
            <?= $this->render('ribbon.php'); ?>

            <!-- MAIN CONTENT -->
            <div id="content">
                <?=
                $this->render(
                    'content.php',
                    ['content' => $content]
                ) ?>
            </div>
            <!-- END MAIN CONTENT -->

        </div>
        <!-- END MAIN PANEL -->

        <!-- FOOTER -->
        <?= $this->render('footer.php'); ?>
        <!-- END FOOTER -->

    <?php endif; ?>
    <!-- ==========================CONTENT ENDS HERE ========================== -->

    <?php $this->endBody() ?>
    </body>
    </html>
<?php $this->endPage() ?>