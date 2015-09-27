<?php

namespace common\behavior;


use yii\base\Behavior;

class UserBehavior extends Behavior
{
    public function checkRole($roles)
    {
        $roles = (array)$roles;
        foreach ($roles as $role) {
            if($this->owner->can($role)){
                return true;
            }
        }
        return false;
    }
}