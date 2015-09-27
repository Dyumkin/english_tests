<?php

use backend\components\smartform\Html;
use backend\components\smartform\Jarvis;

/* @var $this yii\web\View */
/* @var $model common\models\question\Question */
/* @var $question common\models\question\iQuestion */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Question',
]) . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Questions'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
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
            'body'   => $this->render('_' . $question->getType(), [
                'model' => $model, 'question' => $question
            ])
        ]); ?>
    </article>
</div>
