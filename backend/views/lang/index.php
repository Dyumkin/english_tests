<?php

use yii\grid\GridView;
use backend\components\smartform\Html;
use backend\components\smartform\Jarvis;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Languages Settings');
$this->params['breadcrumbs'][] = $this->title;
?>

<!-- row -->
<div class="row">
    <article class="col-sm-12">
        <!-- new widget -->
        <?= Jarvis::widget([
            'header' => 'Settings',
            'icon' => Html::icon(Html::ICON_FA_LANGUAGE),
            'body'   => GridView::widget([
                'dataProvider' => $dataProvider,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

                    'id',
                    'url:url',
                    'local',
                    'name',
                    'default',
                    // 'date_update',
                    // 'date_create',

                    ['class' => 'yii\grid\ActionColumn'],
                ],
            ]),
            'footer' => Html::a(Yii::t('app', 'Add'), ['create'], ['class' => 'btn btn-success']),
        ]); ?>
    </article>
</div>
