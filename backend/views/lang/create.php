<?php

use backend\components\smartform\Html;
use backend\components\smartform\Jarvis;


/* @var $this yii\web\View */
/* @var $model common\models\Lang */

$this->title = Yii::t('app', 'Create Lang');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Langs'), 'url' => ['index']];
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
            'header' => 'Create',
            'icon' => Html::icon(Html::ICON_FA_EDIT),
            'body'   => $this->render('_form', [
                'model' => $model,
            ]),
            'footer' => Html::submitButton(Yii::t('app', 'Create'), ['class' => 'btn btn-success']),
        ]); ?>
    </article>
</div>
