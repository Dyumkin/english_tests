<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Level */

$this->title = $model->content->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Levels'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'date_update:datetime',
            'date_create:datetime',
        ],
    ]) ?>

