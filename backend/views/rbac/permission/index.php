<?php

use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\helpers\Url;
use backend\components\smartform\Html;
use backend\components\smartform\Jarvis;

/**
 * @var $dataProvider array
 * @var $this         yii\web\View
 * @var $filterModel  dektrium\rbac\models\Search
 */


$this->title = Yii::t('rbac', 'Permissions');
$this->params['breadcrumbs'][] = $this->title;

?>

<?php $body = $this->render('_menu') ?>

<?php $body .= GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel'  => $filterModel,
    'layout'       => "{items}\n{pager}",
    'columns'      => [
        [
            'attribute' => 'name',
            'header'    => Yii::t('rbac', 'Name'),
            'options'   => [
                'style' => 'width: 20%'
            ],
        ],
        [
            'attribute' => 'description',
            'header'    => Yii::t('rbac', 'Description'),
            'options'   => [
                'style' => 'width: 55%'
            ],
        ],
        [
            'attribute' => 'rule_name',
            'header'    => Yii::t('rbac', 'Rule name'),
            'options'   => [
                'style' => 'width: 20%'
            ],
        ],
        [
            'class'      => ActionColumn::className(),
            'template'   => '{update} {delete}',
            'urlCreator' => function ($action, $model) {
                return Url::to(['/rbac/permission/' . $action, 'name' => $model['name']]);
            },
            'options'   => [
                'style' => 'width: 5%'
            ],
        ]
    ],
]) ?>

<!-- row -->
<div class="row">
    <article class="col-sm-12">
        <!-- new widget -->
        <?= Jarvis::widget([
            'header' => 'Users',
            'icon' => Html::icon(Html::ICON_FA_USERS),
            'body'   => $body
        ]); ?>
    </article>
</div>