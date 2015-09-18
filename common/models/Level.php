<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "level".
 *
 * @property integer $id
 * @property integer $date_update
 * @property integer $date_create
 *
 * @property LevelI18n[] $levelI18ns
 */
class Level extends ActiveRecord
{
    /** @var LevelI18n $content */
    public $content;

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
            [['date_update', 'date_create'], 'integer'],
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
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLevelI18ns()
    {
        return $this->hasMany(LevelI18n::className(), ['level_id' => 'id']);
    }

    /*public function loadLevelI18ns($levelI18ns)
    {
        $levels = [];
        foreach($levelI18ns as $lang => $data)
        {
            if(isset($data['id']) && !empty($data['id']))
            {
                $level = LevelI18n::findOne($data['id']);
                $level->setAttributes($data);
            } else {
                $level = new LevelI18n($data);
            }
            $levels[] = $level;
        }
        $this->setLevelI18ns($levels);
    }*/

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
}
