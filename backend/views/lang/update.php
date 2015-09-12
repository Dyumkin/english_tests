<?php

use backend\components\smartform\Html;
use backend\components\smartform\Jarvis;

/* @var $this yii\web\View */
/* @var $model common\models\Lang */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Lang',
]) . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Langs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>

<!-- row -->
<div class="row">
    <article class="col-sm-12">
        <!-- new widget -->
        <?= Jarvis::widget([
            'editbutton' => false,
            'header' => 'Update',
            'icon' => Html::icon(Html::ICON_FA_EDIT),
            'body'   => $this->render('_form', [
                'model' => $model,
            ]),
            'footer' => Html::submitButton(Yii::t('app', 'Update'), ['class' => 'btn btn-success']),
        ]); ?>
    </article>
</div>
