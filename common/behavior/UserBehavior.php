<?php
/**
 * Created by PhpStorm.
 * User: yury
 * Date: 03.06.15
 * Time: 22:50
 */

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