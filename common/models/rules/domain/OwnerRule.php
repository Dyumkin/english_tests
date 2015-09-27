<?php
namespace common\models\rules\domain;

use yii\rbac\Item;

class OwnerRule extends Rule
{

    public $name = 'isDomainOwn';

    protected $domainRequired = true;

    /**
     * @param integer $userId the user ID.
     * @param Item $item the role or permission that this rule is associated with
     * @param array $params parameters passed to ManagerInterface::checkAccess().
     * @return boolean a value indicating whether the rule permits the role or permission it is associated with.
     */
    public function execute($userId, $item, $params)
    {
        parent::execute($userId, $item, $params);

        return ($this->domain->created_by == $userId) ? true : false;
    }
}
