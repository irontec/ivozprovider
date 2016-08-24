<?php

/**
 * Application Model
 *
 * @package IvozProvider\Model
 * @subpackage Model
 * @author Luis Felipe Garcia
 * @copyright ZF model generator
 * @license http://framework.zend.com/license/new-bsd     New BSD License
 */

/**
 * [entity]
 *
 * @package IvozProvider\Model
 * @subpackage Model
 * @author Luis Felipe Garcia
 */

namespace IvozProvider\Model;
class HuntGroups extends Raw\HuntGroups
{
    /**
     * This method is called just after parent's constructor
     */
    public function init()
    {
    }

    /**
     * Get this Hungroup related users
     * return array of object of \IvozProvider\Model\Raw\Users
     */
    public function getHuntGroupUsersArray()
    {
        $huntGroupUsersArray = array();
        $huntGroupRelUsers = $this->getHuntGroupsRelUsers(null, "priority asc");
        foreach($huntGroupRelUsers as $huntGroupRelUser) {
            $user = $huntGroupRelUser->getUser();
            if(empty($user)) {
                continue;
            }
            $huntGroupUsersArray[] = $user;
        }
        return $huntGroupUsersArray;
    }

}
