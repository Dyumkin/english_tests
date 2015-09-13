<?php

use backend\components\smartform\Html;
use backend\components\smartform\Jarvis;

/**
 * @var $model dektrium\rbac\models\Role
 * @var $this  yii\web\View
 */

$this->title = Yii::t('rbac', 'Update role');
$this->params['breadcrumbs'][] = ['label' => Yii::t('user', 'Roles'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>

<!-- row -->
<div class="row">
    <article class="col-sm-12">
        <!-- new widget -->
        <?= Jarvis::widget([
            'header' => Yii::t('user', 'Roles'),
            'icon' => Html::icon(Html::ICON_FA_USERS),
            'body'   => $this->render('_form', ['model' => $model])
        ]); ?>
    </article>
</div>