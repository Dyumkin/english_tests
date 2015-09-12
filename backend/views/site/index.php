<?php
/* @var $this yii\web\View */

$this->title = 'Dashboard';
$this->params['breadcrumbs'][] = $this->title;
?>

<!-- row -->
<div class="row">
    <article class="col-sm-12">
        <!-- new widget -->
        <?= backend\components\smartform\Jarvis::widget([
            'header' => 'Hello!',

/*                "colorbutton" => true,
                "editbutton" => true,
                "togglebutton" => true,
                "deletebutton" => true,
                "fullscreenbutton" => true,
                "custombutton" => true,
                "collapsed" => false,
                "sortable" => true,
                "refreshbutton" => false*/

        ]); ?>
    </article>
</div>