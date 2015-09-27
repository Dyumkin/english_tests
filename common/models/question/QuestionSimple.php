<?php

namespace common\models\question;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "question_simple".
 *
 * @property integer $id
 * @property integer $question_id
 * @property integer $qlang_id
 * @property integer $active
 * @property integer $difficult
 * @property string $text
 * @property array $options
 * @property integer $correct
 * @property array $explanation
 *
 * @property Question $question
 * @property QuestionLang $qlang
 */
class QuestionSimple extends ActiveRecord implements iQuestion
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'question_simple';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['text', 'correct'], 'required'],
            [['question_id', 'active', 'difficult', 'correct', 'qlang_id'], 'integer'],
            [['text'], 'string'],
            [['options', 'explanation'], 'each', 'rule' => ['string']],
            [['question_id'], 'exist', 'skipOnError' => true, 'targetClass' => Question::className(), 'targetAttribute' => ['question_id' => 'id']],
            [['qlang_id'], 'exist', 'skipOnError' => true, 'targetClass' => QuestionLang::className(), 'targetAttribute' => ['qlang_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
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
    public function getQuestion()
    {
        return $this->hasOne(Question::className(), ['id' => 'question_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getQlang()
    {
        return $this->hasOne(QuestionLang::className(), ['id' => 'qlang_id']);
    }

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

        return true;
    }

    public function afterFind()
    {
        parent::afterFind();

        $this->options = json_decode($this->options, true);
        $this->explanation = json_decode($this->explanation, true);
    }

    public function getOptions()
    {
        return $this->options;
    }

    public function getType()
    {
        return Question::TYPE_SIMPLE;
    }

    public function getRelationName()
    {
        return 'questionSimple';
    }
}
