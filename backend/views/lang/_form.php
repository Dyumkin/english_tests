<?php

use backend\components\smartform\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Lang */
/* @var $form yii\widgets\ActiveForm */
?>

<fieldset>

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <section class="col col-6">
            <?= $form->field($model, 'url')->textInput(['maxlength' => true]) ?>
        </section>
        <section class="col col-6">
            <?= $form->field($model, 'local')->textInput(['maxlength' => true]) ?>
        </section>
    </div>

    <div class="row">
        <section class="col col-6">
            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
        </section>
        <section class="col col-6">
            <?= $form->field($model, 'default')->textInput() ?>
        </section>
    </div>
    <?php ActiveForm::end(); ?>

</fieldset>
