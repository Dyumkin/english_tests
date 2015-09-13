<?php

use dektrium\user\models\User;
use backend\components\smartform\Html;
use backend\components\smartform\Jarvis;
use yii\web\View;

/**
 * @var View $this
 * @var User $user
 */

$this->title = Yii::t('user', 'Create a user account');
$this->params['breadcrumbs'][] = ['label' => Yii::t('user', 'Users'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>


<!-- row -->
<div class="row">
    <article class="col-sm-12">
        <!-- new widget -->
        <?= Jarvis::widget([
            'header' => 'Users',
            'icon' => Html::icon(Html::ICON_FA_PENCIL),
            'body'   => $this->render('_create', ['user' => $user])
        ]); ?>
    </article>
</div>