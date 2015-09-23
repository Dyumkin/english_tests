<?php

use backend\components\smartform\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Level */
/* @var $modelI18ns common\models\LevelI18n[] */
/* @var $form yii\widgets\ActiveForm */
/* @var $hasError bool */

$items = [];

$form = ActiveForm::begin([
    'id' => 'level',
    'enableClientValidation' => false,
    'encodeErrorSummary' => false
]);

if ($hasError) {
    Yii::$app->session->setFlash('error', $form->errorSummary($modelI18ns));
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

<? ActiveForm::end(); ?>