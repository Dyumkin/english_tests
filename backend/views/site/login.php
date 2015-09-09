<?php
use backend\components\smartform\ActiveForm;
use \backend\components\smartform\Html;

/* @var $this \yii\web\View */
/* @var $form backend\components\smartform\ActiveForm */
/* @var $model backend\models\SignInForm */

$this->title = 'Sign In';
?>

<?php $form = ActiveForm::begin(['id' => 'login-form']); ?>
    <header>
        Sign In
    </header>

    <fieldset>

        <section>
            <?= $form->field($model, 'email')->textInput([
                'tooltip' => 'Please enter email address/username',
                'icon' => Html::ICON_FA_USER
            ]) ?>
        </section>

        <section>
            <?= $form->field($model, 'password')->passwordInput([
                'tooltip' => '<i class="fa fa-lock txt-color-teal"></i> Enter your password',
                'icon' => Html::ICON_FA_LOCK
            ]) ?>
            <div class="note">
                <a href="/forgotpassword.php">Forgot password?</a>
            </div>
        </section>

        <section>
            <?= $form->field($model, 'rememberMe')->checkbox() ?>
        </section>
    </fieldset>
    <footer>
        <?= Html::submitButton('Sign in', ['class' => 'btn btn-primary']) ?>
    </footer>
<?php ActiveForm::end(); ?>