<?php

use backend\components\smartform\Html;
use backend\components\smartform\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Level */
/* @var $form yii\widgets\ActiveForm */
?>

<?php $form = ActiveForm::begin(); ?>
<fieldset>
    <div class="row">

        <section class="col col-4">
            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
        </section>
    </div>

    <div class="row">
        <section class="col col-10">
            <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>
        </section>
    </div>

</fieldset>

<footer>
    <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']); ?>
</footer>
<?php ActiveForm::end(); ?>