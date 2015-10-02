<?php

use backend\components\smartform\Html;

/* @var $this yii\web\View */
/* @var $model common\models\LevelI18n */
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

    <?= $form->field($model, '[' . $i . ']description')->textarea(['rows' => 6]) ?>
</fieldset>

<footer>
    <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']); ?>
</footer>