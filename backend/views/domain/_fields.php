<?php
/* @var $this yii\web\View */
/* @var $model common\models\DomainI18n */
/* @var $form yii\widgets\ActiveForm */
/* @var $i int */
?>

<fieldset>
    <div class="row">
        <?= $form->field($model, '[' . $i . ']lang_id')->hiddenInput()->label('') ?>
        <section class="col col-4">
            <?= $form->field($model, '[' . $i . ']name')->textInput(['maxlength' => true])->error(['encode' => false]) ?>
        </section>
    </div>

    <div class="row">
        <section class="col col-10">
            <?= $form->field($model, '[' . $i . ']description')->textarea(['rows' => 6]) ?>
        </section>
    </div>

</fieldset>