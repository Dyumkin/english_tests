<?php

use backend\components\smartform\Html;
use backend\components\smartform\Jarvis;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Levels');
$this->params['breadcrumbs'][] = $this->title;
?>

<!-- row -->
<div class="row">
    <article class="col-sm-12">
        <!-- new widget -->
        <?= Jarvis::widget([
            'header' => 'Domains',
            'icon' => Html::icon(Html::ICON_FA_CUBES),
            'togglebutton' => false,
            'deletebutton' => false,
            'fullscreenbutton' => false,
            'editbutton' => false,
            'sortable' => false,
            'body'   => GridView::widget([
                'dataProvider' => $dataProvider,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    'content.name',
                    [
                        'attribute' => 'type',
                        'value' => function($model) {
                            return \common\models\Domain::getDomainsData()[$model->id];
                        },
                    ],
                    'timer',
                    'level.content.name',
                    'update_at:datetime',
                    'create_at:datetime',

                    ['class' => 'yii\grid\ActionColumn'],
                ],
            ]),
            'footer' => Html::a(Yii::t('app', 'Create Domain'), ['create'], ['class' => 'btn btn-success']),
        ]); ?>
    </article>
</div>
