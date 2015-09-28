<?php

namespace common\models;

use Yii;
use yii\behaviors\BlameableBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "level".
 *
 * @property integer $id
 * @property integer $date_update
 * @property integer $date_create
 * @property integer $created_by
 * @property integer $updated_by
 *
 * @property LevelI18n[] $levelI18ns
 * @property LevelI18n $content
 * @property User $createdBy
 * @property User $updatedBy
 * @property Domain[] $domains
 */
class Level extends ActiveRecord
{

    const PERMISSION_CREATE = 'createLevel';
    const PERMISSION_VIEW = 'viewLevel';
    const PERMISSION_VIEW_OWN = 'viewOwnLevel';
    const PERMISSION_EDIT = 'editLevel';
    const PERMISSION_EDIT_OWN = 'editOwnLevel';
    const PERMISSION_DELETE = 'deleteLevel';
    const PERMISSION_DELETE_OWN = 'deleteOwnLevel';

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'level';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['date_update', 'date_create', 'created_by', 'updated_by'], 'integer'],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['created_by' => 'id']],
            [['updated_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['updated_by' => 'id']],
        ];
    }

    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => 'yii\behaviors\TimestampBehavior',
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['date_create', 'date_update'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['date_update'],
                ],
            ],
            'author' => [
                'class' => BlameableBehavior::className()
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'date_update' => Yii::t('app', 'Date Update'),
            'date_create' => Yii::t('app', 'Date Create'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_by' => Yii::t('app', 'Updated By'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDomains()
    {
        return $this->hasMany(Domain::className(), ['level_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLevelI18ns()
    {
        return $this->hasMany(LevelI18n::className(), ['level_id' => 'id']);
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


    public function setLevelI18ns($levels)
    {
        $this->populateRelation('levelI18ns', $levels);
    }

    public function afterSave($insert, $changedAttributes)
    {
        $relatedRecords = $this->getRelatedRecords();
        if (isset($relatedRecords['levelI18ns'])) {
            foreach($relatedRecords['levelI18ns'] as $level){
                $this->link('levelI18ns', $level);
            }
        }
    }

    /**
     * @param null $lang_id
     *
     * @return $this
     */
    public function getContent($lang_id = null)
    {
        $lang_id = ($lang_id === null)? Lang::getCurrent()->id: $lang_id;
        return $this->hasOne(LevelI18n::className(), ['level_id' => 'id'])->where('lang_id = :lang_id', [':lang_id' => $lang_id]);
    }

    /**
     * @return array for drop down [id => name]
     */
    public static function getLevels()
    {
        $levels = Level::find()->where(['created_by' => Yii::$app->user->id])->each();

        $data = [];
        /** @var Level $level */
        foreach ($levels as $level)
        {
            $data[$level->id] = $level->content->name;
        }

        return $data;
    }
}
