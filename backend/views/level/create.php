<?php

use backend\components\smartform\Html;
use backend\components\smartform\Jarvis;


/* @var $this yii\web\View */
/* @var $model common\models\Level */
/* @var $modelI18ns common\models\LevelI18n[] */
/* @var $hasError bool */

$this->title = Yii::t('app', 'Create Level');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Levels'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<!-- row -->
<div class="row">
    <article class="col-sm-12">
        <!-- new widget -->
        <?= Jarvis::widget([
            'togglebutton' => false,
            'deletebutton' => false,
            'fullscreenbutton' => false,
            'editbutton' => false,
            'sortable' => false,
            'colorbutton' => false,
            'header' => 'Create',
            'icon' => Html::icon(Html::ICON_FA_EDIT),
            'body'   => $this->render('_form', [
                'model' => $model, 'modelI18ns' => $modelI18ns, 'hasError' => $hasError
            ])
        ]); ?>
    </article>
</div>