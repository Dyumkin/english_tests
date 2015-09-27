<?php

namespace common\models\question;

use common\behavior\QuestionTypeBehavior;
use Yii;
use yii\db\ActiveRecord;
use common\models\Domain;
use common\models\User;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;

/**
 * This is the model class for table "question".
 *
 * @property integer $id
 * @property integer $domain_id
 * @property string $type
 * @property integer $update_at
 * @property integer $create_at
 * @property integer $created_by
 * @property integer $updated_by
 *
 * @property Domain $domain
 * @property User $createdBy
 * @property User $updatedBy
 * @property QuestionSimple $questionSimple
 */
class Question extends ActiveRecord
{
    const TYPE_SIMPLE = 'simple';
    const TYPE_MULTIPLE_CHOICE = 'multiple_choice';
    const TYPE_ALTERNATIVE_CHOICE = 'alternative_choice';
    const TYPE_MATCHING = 'matching';
    const TYPE_REARRANGEMENT = 'rearrangement';
    const TYPE_FREE_PRESENTATION = 'free_presentation';
    const TYPE_ADDITION = 'addition';
    const TYPE_CLOZE_TEST = 'cloze_test';

    public static function getTypes ()
    {
        return [
            self::TYPE_SIMPLE => Yii::t('app', 'Simple'),
            self::TYPE_MULTIPLE_CHOICE => Yii::t('app', 'Multiple Choice'),
            self::TYPE_ALTERNATIVE_CHOICE => Yii::t('app', 'Alternative Choice'),
            self::TYPE_MATCHING => Yii::t('app', 'Matching'),
            self::TYPE_REARRANGEMENT => Yii::t('app', 'Rearrangement'),
        ];
    }

    public static function getRelationClassNames()
    {
        $namespace = 'common\models\question';

        return [
            self::TYPE_SIMPLE => $namespace . '\QuestionSimple',
            self::TYPE_MULTIPLE_CHOICE => $namespace . '\QuestionMultipleChoice',
            self::TYPE_ALTERNATIVE_CHOICE => $namespace . '\QuestionAlternativeChoice',
            /*self::TYPE_MATCHING => $namespace . '\QuestionSimple',
            self::TYPE_REARRANGEMENT => $namespace . '\QuestionSimple',*/
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'question';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['domain_id'], 'required'],
            [['domain_id', 'update_at', 'create_at', 'created_by', 'updated_by'], 'integer'],
            [['type'], 'string', 'max' => 255],
            [['domain_id'], 'exist', 'skipOnError' => true, 'targetClass' => Domain::className(), 'targetAttribute' => ['domain_id' => 'id']],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['created_by' => 'id']],
            [['updated_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['updated_by' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'domain_id' => Yii::t('app', 'Domain'),
            'type' => Yii::t('app', 'Type'),
            'update_at' => Yii::t('app', 'Update At'),
            'create_at' => Yii::t('app', 'Create At'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_by' => Yii::t('app', 'Updated By'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDomain()
    {
        return $this->hasOne(Domain::className(), ['id' => 'domain_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCreatedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'created_by']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUpdatedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'updated_by']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getQuestionSimple()
    {
        return $this->hasOne(QuestionSimple::className(), ['question_id' => 'id']);
    }

    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['create_at', 'update_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['update_at'],
                ],
            ],
            'author' => [
                'class' => BlameableBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_by', 'updated_by'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_by'],
                ]
            ],
            'type' => [
                'class' => QuestionTypeBehavior::className(),
            ]
        ];
    }

    /**
     * @param iQuestion $question
     */
    public function setRelationQuestion($question)
    {
        $this->populateRelation($question->getRelationName(), $question);
    }

    public function afterSave($insert, $changedAttributes)
    {
        $relatedRecords = $this->getRelatedRecords();

        /** @var iQuestion|array $relation */
        foreach($relatedRecords as $relation) {
            if (is_array($relation)) {
                /** @var iQuestion $model */
                foreach ($relation as $model) {
                    $this->link($model->getRelationName(), $model);
                }
            } else {
                $this->link($relation->getRelationName(), $relation);
            }
        }

        parent::afterSave($insert, $changedAttributes);
    }
}
