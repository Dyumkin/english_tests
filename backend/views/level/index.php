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
            'header' => 'Settings',
            'icon' => Html::icon(Html::ICON_FA_LEVEL_UP),
            'togglebutton' => false,
            'deletebutton' => false,
            'fullscreenbutton' => false,
            'editbutton' => false,
            'sortable' => false,
            'body'   => GridView::widget([
                'dataProvider' => $dataProvider,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

                    'id',
                    'name',
                    'description:ntext',

                    ['class' => 'yii\grid\ActionColumn'],
                ],
            ]),
            'footer' => Html::a(Yii::t('app', 'Create Level'), ['create'], ['class' => 'btn btn-success']),
        ]); ?>
    </article>
</div>
