<?php
namespace common\models\question;

use yii\db\ActiveRecordInterface;

interface iQuestion extends ActiveRecordInterface
{

    public static function getRelationName();

    public function getOptions();

    public function getType();

}