<?php

use backend\components\smartform\Html;
use backend\components\smartform\Jarvis;

/* @var $this yii\web\View */
/* @var $model common\models\Domain */
/* @var $modelI18ns common\models\DomainI18n[] */
/* @var $hasError bool */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Domain',
]) . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Domains'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
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
            'body'   => $this->render('_form', [
                'model' => $model, 'modelI18ns' => $modelI18ns, 'hasError' => $hasError
            ])
        ]); ?>
    </article>
</div>
