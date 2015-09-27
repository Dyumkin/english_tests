<?php

use backend\components\smartform\Html;
use backend\components\smartform\Jarvis;


/* @var $this yii\web\View */
/* @var $model common\models\question\Question */
/* @var $question common\models\question\iQuestion */

$this->title = Yii::t('app', 'Create {type}', ['type' => $question->getType()]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Questions'), 'url' => ['index']];
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
            'body'   => $this->render('_' . $question->getType(), [
                'model' => $model, 'question' => $question
            ])
        ]); ?>
    </article>
</div>
