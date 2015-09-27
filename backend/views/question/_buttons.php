<?php

use backend\components\smartform\Html;
use common\models\question\Question;

echo Html::a(Yii::t('app', 'Create Simple'), ['create', 'type' => Question::TYPE_SIMPLE ], ['class' => 'btn btn-success']);
echo '&nbsp;';
echo Html::a(Yii::t('app', 'Create Multiple Choice'), '#', ['class' => 'btn btn-success']);

