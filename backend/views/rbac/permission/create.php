<?php

use backend\components\smartform\Html;
use backend\components\smartform\Jarvis;

/**
 * @var $model dektrium\rbac\models\Role
 * @var $this  yii\web\View
 */

$this->title = Yii::t('rbac', 'Create new permission');
$this->params['breadcrumbs'][] = ['label' => Yii::t('user', 'Permissions'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>

<!-- row -->
<div class="row">
    <article class="col-sm-12">
        <!-- new widget -->
        <?= Jarvis::widget([
            'header' => Yii::t('user', 'Permissions'),
            'icon' => Html::icon(Html::ICON_FA_USERS),
            'body'   => $this->render('_form', ['model' => $model])
        ]); ?>
    </article>
</div>
