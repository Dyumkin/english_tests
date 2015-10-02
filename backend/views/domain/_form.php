<?php

use backend\components\smartform\Html;
use backend\components\smartform\ActiveForm;
use common\models\Domain;
use common\models\question\Question;
use common\models\Level;

/* @var $this yii\web\View */
/* @var $model common\models\Domain */
/* @var $form yii\widgets\ActiveForm */
/* @var $modelI18ns common\models\DomainI18n[] */
/* @var $form yii\widgets\ActiveForm */
/* @var $hasError bool */

$items = [];

$form = ActiveForm::begin([
    'id' => 'domain',
    'enableClientValidation' => false,
    'encodeErrorSummary' => false
]);

if ($hasError) {

    if ($model->hasErrors()) {
        Yii::$app->session->setFlash('error', $form->errorSummary($model));
    } else {
        Yii::$app->session->setFlash('error', $form->errorSummary($modelI18ns));
    }
}

foreach ($modelI18ns as $i => $modelI18n) {
    $items['items'][] = [
        'label' => $modelI18n->lang->name,
        'content' => $this->render('_fields', [
            'model' => $modelI18n, 'form' => $form, 'i' => $i
        ]),
    ];
}

$items['navType'] = 'nav-tabs bordered';

?>

<div class="tabbable">
    <?= \yii\bootstrap\Tabs::widget($items); ?>
</div>

<header></header>

<fieldset>
    <div class="row">
        <section class="col col-4">
            <?= $form->field($model, 'timer')->textInput() ?>
        </section>

        <section class="col col-4">
            <?= $form->field($model, 'level_id')->dropDownList(Level::getLevels()) ?>
        </section>

        <section class="col col-4">
            <?= $form->field($model, 'domain_id')->dropDownList(Domain::getDomainsData()) ?>
        </section>
    </div>

    <div class="row">
        <section class="col col-2">
            <?= $form->field($model, 'status')->checkbox() ?>
        </section>

        <section class="col col-2">
            <?= $form->field($model, 'is_trial')->checkbox() ?>
        </section>
    </div>
</fieldset>

<footer>
    <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']); ?>
</footer>

<? ActiveForm::end(); ?>
