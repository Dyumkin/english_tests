<?php
/**
 * Created by PhpStorm.
 * User: yury
 * Date: 09.09.15
 * Time: 22:02
 */

namespace backend\components\smartform;


class ActiveForm extends \yii\widgets\ActiveForm
{
    /**
     * @inheritdoc
     */
    public $fieldClass = 'backend\components\smartform\ActiveField';
    /**
     * @inheritdoc
     */
    public function init()
    {
        Html::addCssClass($this->options, 'smart-form');

        parent::init();
    }
}