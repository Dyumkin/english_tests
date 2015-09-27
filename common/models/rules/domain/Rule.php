<?php
namespace common\models\rules\domain;

use common\models\Domain;
use yii\base\InvalidParamException;
use yii\rbac\Item;

class Rule extends \yii\rbac\Rule
{
    /**
     * @var Domain
     */
    protected $domain;

    protected $domainRequired = false;

    /**
     * Executes the rule.
     *
     * @param string|integer $user the user ID. This should be either an integer or a string representing
     * the unique identifier of a user. See [[\yii\web\User::id]].
     * @param Item $item the role or permission that this rule is associated with
     * @param array $params parameters passed to [[ManagerInterface::checkAccess()]].
     * @return boolean a value indicating whether the rule permits the auth item it is associated with.
     */
    public function execute($user, $item, $params)
    {
        if ($this->domainRequired) {
            if (!isset($params['domain']) || !$params['domain'] instanceof Domain) {
                throw new InvalidParamException('Invalid domain param');
            }

            $this->domain = $params['domain'];
        }
    }
}
