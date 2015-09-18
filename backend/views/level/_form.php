<?php

use backend\components\smartform\Html;
use backend\components\smartform\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Level */
/* @var $modelI18ns common\models\LevelI18n[] */
/* @var $form yii\widgets\ActiveForm */

$items = [];

$form = ActiveForm::begin([
    'id' => 'level',
]);

foreach ($modelI18ns as $i => $modelI18n) {
    $items['items'][] = [
        'label' => $modelI18n->lang->name,
        'content' => $this->render('_fields', [
            'model' => $modelI18n, 'form' => $form, 'i' => $i
        ]),
    ];
}
?>

<?= \yii\bootstrap\Tabs::widget($items); ?>


<?php ActiveForm::end(); ?>