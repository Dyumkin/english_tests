<?php

use backend\components\smartform\Html;
use backend\components\smartform\Jarvis;
use yii\grid\GridView;
use common\models\question\Question;
use common\models\Domain;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\QuestionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Questions');
$this->params['breadcrumbs'][] = $this->title;
?>

<!-- row -->
<div class="row">
    <article class="col-sm-12">
        <!-- new widget -->
        <?= Jarvis::widget([
            'header' => 'Questions',
            'icon' => Html::icon(Html::ICON_FA_QUESTION_CIRCLE),
            'togglebutton' => false,
            'deletebutton' => false,
            'fullscreenbutton' => false,
            'editbutton' => false,
            'sortable' => false,
            'body'   => GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

                    [
                        'attribute'=>'domain_id',
                        'value' => 'domain.content.name',
                        'filter' => Domain::getDomainsData(true)
                    ],
                    [
                        'attribute'=>'type',
                        'value' => function($model) {return Question::getTypes()[$model->type];},
                        'filter' => Question::getTypes()
                    ],
                    [
                        'attribute'=>'update_at',
                        'format' => 'datetime',
                        'filter' => \yii\jui\DatePicker::widget([
                                // write model again
                                'model' => $searchModel,
                                // write attribute again
                                'attribute' => 'update_at',
                                'dateFormat' => 'dd-MM-yyyy'
                        ]),
                    ],
                    [
                        'attribute'=>'create_at',
                        'format' => 'datetime',
                        'filter' => \yii\jui\DatePicker::widget([
                            // write model again
                            'model' => $searchModel,
                            // write attribute again
                            'attribute' => 'create_at',
                            'dateFormat' => 'dd-MM-yyyy'
                        ]),
                    ],
                    [
                        'attribute'=>'created_by',
                        'value' => function($model) {return $model->createdBy->getUserName();},
                        'filter' => \yii\jui\AutoComplete::widget([ //todo change
                            // write model again
                            'model' => $searchModel,
                            // write attribute again
                            'attribute' => 'created_by',
                        ]),
                    ],
                    [
                        'attribute'=>'updated_by',
                        'value' => function($model) {return $model->updatedBy->getUserName();},
                        'filter' => \yii\jui\AutoComplete::widget([ //todo change
                            // write model again
                            'model' => $searchModel,
                            // write attribute again
                            'attribute' => 'updated_by',
                        ]),
                    ],

                    ['class' => 'yii\grid\ActionColumn'],
                ],
            ]),
            'footer' => $this->render('_buttons'),
        ]); ?>
    </article>
</div>