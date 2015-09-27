<?php

namespace common\models;

use Yii;
use yii\behaviors\BlameableBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "domain".
 *
 * @property integer $id
 * @property integer $domain_id
 * @property integer $level_id
 * @property integer $update_at
 * @property integer $create_at
 * @property string $type
 * @property integer $status
 * @property integer $is_trial
 * @property integer $timer
 * @property integer $created_by
 * @property integer $updated_by
 *
 * @property Domain $domain
 * @property Domain[] $domains
 * @property Level $level
 * @property User $createdBy
 * @property User $updatedBy
 * @property DomainI18n[] $domainI18ns
 * @property DomainI18n $content
 */
class Domain extends ActiveRecord
{
    const STATUS_ACTIVE = 1;
    const STATUS_INACTIVE = 0;

    const PERMISSION_CREATE = 'createDomain';
    const PERMISSION_VIEW = 'viewDomain';
    const PERMISSION_VIEW_OWN = 'viewOwnDomain';
    const PERMISSION_EDIT = 'editDomain';
    const PERMISSION_EDIT_OWN = 'editOwnDomain';
    const PERMISSION_DELETE = 'deleteDomain';
    const PERMISSION_DELETE_OWN = 'deleteOwnDomain';

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'domain';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['update_at', 'create_at', 'status', 'is_trial', 'timer','created_by', 'updated_by'], 'integer'],
            [['type', 'level_id', 'timer'], 'required'],
            [['type'], 'string', 'max' => 255],
            [['domain_id'], 'exist', 'skipOnError' => true, 'targetClass' => Domain::className(), 'targetAttribute' => ['domain_id' => 'id']],
            [['level_id'], 'exist', 'skipOnError' => true, 'targetClass' => Level::className(), 'targetAttribute' => ['level_id' => 'id']],
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
            'level_id'  => Yii::t('app', 'Level'),
            'domain_id'  => Yii::t('app', 'Parent Domain'),
            'update_at' => Yii::t('app', 'Update At'),
            'create_at' => Yii::t('app', 'Create At'),
            'type' => Yii::t('app', 'Type'),
            'status' => Yii::t('app', 'Active'),
            'is_trial' => Yii::t('app', 'Is Trial'),
            'timer' => Yii::t('app', 'Timer'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_by' => Yii::t('app', 'Updated By'),
        ];
    }

    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => 'yii\behaviors\TimestampBehavior',
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['create_at', 'update_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['update_at'],
                ],
            ],
            'author' => [
                'class' => BlameableBehavior::className()
            ],
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
    public function getDomains()
    {
        return $this->hasMany(Domain::className(), ['domain_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLevel()
    {
        return $this->hasOne(Level::className(), ['id' => 'level_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDomainI18ns()
    {
        return $this->hasMany(DomainI18n::className(), ['domain_id' => 'id']);
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

    public function setDomainI18ns($domains)
    {
        $this->populateRelation('domainI18ns', $domains);
    }

    public function afterSave($insert, $changedAttributes)
    {
        $relatedRecords = $this->getRelatedRecords();
        if (isset($relatedRecords['domainI18ns'])) {
            foreach($relatedRecords['domainI18ns'] as $domain){
                $this->link('domainI18ns', $domain);
            }
        }
    }

    /**
     * @param null $lang_id
     * @return $this
     */
    public function getContent($lang_id = null)
    {
        $lang_id = ($lang_id === null)? Lang::getCurrent()->id: $lang_id;
        return $this->hasOne(DomainI18n::className(), ['domain_id' => 'id'])->where('lang_id = :lang_id', [':lang_id' => $lang_id]);
    }

    /**
     * @param bool $filter use for grid filter
     * @return array for drop down [id => name]
     */
    public static function getDomainsData($filter = false)
    {
        $domains = Domain::find()->all();
        $data = [];
        if (!$filter) {
            $data = ['' => ''];
        }

        /** @var Domain $domain */
        foreach ($domains as $domain)
        {
            if ($domain->status == self::STATUS_ACTIVE) {
                $data[$domain->id] = $domain->content->name;
            }
        }

        return $data;
    }
}
