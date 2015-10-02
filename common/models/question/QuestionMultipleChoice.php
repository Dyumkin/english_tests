<?php

namespace common\models\question;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "question_multiple_choice".
 *
 * @property integer $id
 * @property integer $question_id
 * @property integer $qlang_id
 * @property integer $active
 * @property integer $difficult
 * @property string $text
 * @property string $options
 * @property integer $correct
 * @property string $explanation
 *
 * @property QuestionLang $qlang
 * @property Question $question
 */
class QuestionMultipleChoice extends ActiveRecord implements iQuestion
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'question_multiple_choice';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['text', 'correct'], 'required'],
            [['question_id', 'qlang_id', 'active', 'difficult'], 'integer'],
            [['text'], 'string'],
            [['options', 'explanation', 'correct'], 'each', 'rule' => ['string']],
            [['qlang_id'], 'exist', 'skipOnError' => true, 'targetClass' => QuestionLang::className(), 'targetAttribute' => ['qlang_id' => 'id']],
            [['question_id'], 'exist', 'skipOnError' => true, 'targetClass' => Question::className(), 'targetAttribute' => ['question_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'qlang_id' => Yii::t('app', 'Qlang ID'),
            'active' => Yii::t('app', 'Active'),
            'difficult' => Yii::t('app', 'Difficult'),
            'text' => Yii::t('app', 'Text'),
            'options' => Yii::t('app', 'Options'),
            'correct' => Yii::t('app', 'Correct'),
            'explanation' => Yii::t('app', 'Explanation'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getQlang()
    {
        return $this->hasOne(QuestionLang::className(), ['id' => 'qlang_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getQuestion()
    {
        return $this->hasOne(Question::className(), ['id' => 'question_id']);
    }

    /**
     * @inheritdoc
     */
    public function beforeSave($insert)
    {
        if (!parent::beforeSave($insert)) {
            return false;
        }

        if ($this->options){
            $this->options = json_encode($this->options);
        }

        if ($this->explanation){
            $this->explanation = json_encode($this->explanation);
        }

        if ($this->correct){
            $this->correct = json_encode($this->correct);
        }

        return true;
    }

    /**
     * @inheritdoc
     */
    public function afterFind()
    {
        parent::afterFind();

        $this->options = json_decode($this->options, true);
        $this->explanation = json_decode($this->explanation, true);
        $this->correct = json_decode($this->correct, true);
    }

    public function getOptions()
    {
        return $this->options;
    }

    public function getType()
    {
        return Question::TYPE_MULTIPLE_CHOICE;
    }

    public static function getRelationName()
    {
        return 'questionMultiChoices';
    }
}
