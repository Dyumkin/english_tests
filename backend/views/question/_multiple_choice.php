<?php

use backend\components\smartform\Html;
use backend\components\smartform\ActiveForm;
use common\models\Domain;

/* @var $this yii\web\View */
/* @var $model common\models\question\Question */
/* @var $question common\models\question\QuestionMultipleChoice */
/* @var $form yii\widgets\ActiveForm */
?>

<?php $form = ActiveForm::begin(); ?>

    <fieldset>
        <?= $form->field($question, 'qlang_id')->hiddenInput(['value' => 1])->label('') ?>
        <div class="row">
            <?= $form->field($model, 'domain_id', ['options' => ['class' => 'col col-5']])->dropDownList(Domain::getDomainsData()) ?>
            <?= $form->field($question, 'difficult', ['options' => ['class' => 'col col-5']])->textInput() ?>
            <?= $form->field($question, 'active', ['options' => ['class' => 'col col-2']])->checkbox()->label('&nbsp;') ?>
        </div>

        <?= $form->field($question, 'text')->textarea(['rows' => 6]) ?>
    </fieldset>

<?php for ($i = 1; $i < 7; $i++): //todo change logic ?>
    <fieldset>
        <section>
            <label class="label"><?= Yii::t('app', 'Option {i}', ['i' => $i]); ?></label>
            <?= $form->field($question, 'options[' . $i . ']')->textInput(['placeholder' => 'option ' . $i])->label(''); ?>
            <?= $form->field($question, 'explanation[' . $i . ']')->textarea(['rows' => 3, 'placeholder' => 'explanation ' . $i])->label(''); ?>
        </section>
    </fieldset>
<?php endfor; ?>

    <fieldset>
        <section>
            <label class="label"><?= Yii::t('app', 'Correct Variant'); ?></label>
            <?= $form->field($question, 'correct', [
                'inline' => true
            ])->checkboxList([
                1 => 'Option 1',
                2 => 'Option 2',
                3 => 'Option 3',
                4 => 'Option 4',
                5 => 'Option 5',
                6 => 'Option 6',
            ])->label('') ?>
        </section>
    </fieldset>

    <footer>
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']); ?>
    </footer>

<?php ActiveForm::end(); ?>