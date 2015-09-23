<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Domain */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Domains'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'update_at:datetime',
            'create_at:datetime',
            'type',
            'status',
            'is_trial',
            'timer',
        ],
    ]) ?>

