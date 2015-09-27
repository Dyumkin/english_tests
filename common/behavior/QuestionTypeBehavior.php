<?php
namespace common\behavior;

use Yii;
use yii\base\Event;
use yii\db\BaseActiveRecord;
use yii\behaviors\AttributeBehavior;
use common\models\question\iQuestion;

class QuestionTypeBehavior extends AttributeBehavior
{

    public $typeAttribute = 'type';

    public $value;

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        if (empty($this->attributes)) {
            $this->attributes = [
                BaseActiveRecord::EVENT_BEFORE_INSERT => $this->typeAttribute,
            ];
        }
    }

    /**
     * Evaluates the value of the question.
     * The return result of this method will be assigned to the current attribute(s).
     * @param Event $event
     * @return mixed the value of the question.
     */
    protected function getValue($event)
    {
        if ($this->value === null) {
            $relations = $this->owner->getRelatedRecords();
            /** @var iQuestion $question */
            if ($question = array_shift($relations)) {
                return $question->getType();
            }
            return null;
        } else {
            return call_user_func($this->value, $event);
        }
    }
}
