<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "domain_i18n".
 *
 * @property integer $id
 * @property integer $domain_id
 * @property integer $lang_id
 * @property string $name
 * @property string $description
 *
 * @property Domain $domain
 * @property Lang $lang
 */
class DomainI18n extends ActiveRecord
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'domain_i18n';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['lang_id', 'name'], 'required'],
            [['domain_id', 'lang_id'], 'integer'],
            [['description'], 'string'],
            [['name'], 'string', 'max' => 255],
            [['domain_id'], 'exist', 'skipOnError' => true, 'targetClass' => Domain::className(), 'targetAttribute' => ['domain_id' => 'id']],
            [['lang_id'], 'exist', 'skipOnError' => true, 'targetClass' => Lang::className(), 'targetAttribute' => ['lang_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'name' => Yii::t('app', 'Domain'),
            'description' => Yii::t('app', 'Description'),
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
    public function getLang()
    {
        return $this->hasOne(Lang::className(), ['id' => 'lang_id']);
    }

    public function addError($attribute, $error = '')
    {
        $errorWithFlag = $this->lang->getFlagImg() . ' ' . $error;
        parent::addError($attribute, $errorWithFlag);
    }
}
