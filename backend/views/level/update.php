<?php

use backend\components\smartform\Html;
use backend\components\smartform\Jarvis;

/* @var $this yii\web\View */
/* @var $model common\models\Level */
/* @var $modelI18ns common\models\LevelI18n[] */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Level',
]) . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Levels'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
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
                'model' => $model, 'modelI18ns' => $modelI18ns
            ])
        ]); ?>
    </article>
</div>
