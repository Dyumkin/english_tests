<?php

namespace common\filters;

use Yii;
use yii\web\User;
use yii\db\ActiveRecordInterface;

/**
 * This class represents an access rule defined by the [[AccessControl]] action filter
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AccessRule extends \yii\filters\AccessRule
{

    public $modelClass;

    /**
     * @param User $user the user object
     * @return boolean whether the rule applies to the role
     */
    protected function matchRole($user)
    {
        if (empty($this->roles)) {
            return true;
        }

        $model = null;

        if ($this->modelClass) {
            $model = $this->findModel(Yii::$app->getRequest()->get('id'));
        }

        foreach ($this->roles as $role) {
            if ($role === '?') {
                if ($user->getIsGuest()) {
                    return true;
                }
            } elseif ($role === '@') {
                if (!$user->getIsGuest()) {
                    return true;
                }
            } elseif ($user->can($role, ['model' => $model])) {
                return true;
            }
        }

        return false;
    }

    /**
     * @param $id
     * @return null|static
     */
    protected function findModel($id)
    {
        /** @var ActiveRecordInterface $class */
        $class = $this->modelClass;
        if (($model = $class::findOne($id)) !== null) {
            return $model;
        }

        return null;
    }
}
