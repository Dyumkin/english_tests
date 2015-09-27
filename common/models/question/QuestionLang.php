<?php

namespace common\models\question;

use Yii;

/**
 * This is the model class for table "question_lang".
 *
 * @property integer $id
 * @property string $iso
 * @property string $local
 * @property string $name
 *
 * @property QuestionSimple[] $questionSimples
 */
class QuestionLang extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'question_lang';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['iso', 'local', 'name'], 'required'],
            [['iso'], 'string', 'max' => 5],
            [['local', 'name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'iso' => Yii::t('app', 'Iso'),
            'local' => Yii::t('app', 'Local'),
            'name' => Yii::t('app', 'Name'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getQuestionSimples()
    {
        return $this->hasMany(QuestionSimple::className(), ['qlang_id' => 'id']);
    }
}
