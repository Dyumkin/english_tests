<?php
use backend\widgets\Alert;

/* @var $this \yii\web\View */
/* @var $content string */
?>

<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <h1 class="page-title txt-color-blueDark">
            <?php
            if ($this->title !== null) {
                echo $this->title;
            } else {
                echo \yii\helpers\Inflector::camel2words(\yii\helpers\Inflector::id2camel($this->context->module->id));
                echo ($this->context->module->id !== \Yii::$app->id) ? '<small>Module</small>' : '';
            } ?>
        </h1>
    </div>
</div>

<?= Alert::widget(); ?>
<section id="widget-grid">
    <?= $content; ?>
</section>