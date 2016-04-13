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
     * return array
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
    /**
     * @param array of object of \IvozProvider\Model\Raw\Users
     * return array interfaces and callwaiting
     */
    public function getHuntGroupUsersInterfacesArray($users)
    {
        $ringAllInterfaces = array();
        
        foreach($users as $user) {
            $cfwSettings = $user->getCallForwardSettingsByUser("callForwardType='inconditional'");
            if(!empty($cfwSettings)){
                continue;
            }
            $interface = $user->getUserTerminalInterface();
            if(empty($interface)) {
                continue;
            }
            
            $ringAllInterfaces[] = array(
                    'interface' => "PJSIP/".$interface,
                    'callwaiting' => $user->getCallWaiting()
                    );
            
        }
        return $ringAllInterfaces;
    }

    public function hasHungGroupMoreUsers($loopCounter)
    {
        $huntGroupsRelUsers = $this->getHuntGroupsRelUsers(null, "priority asc");
        $totalUsers = count($huntGroupsRelUsers);
        $areMoreUsers = ($totalUsers> $loopCounter);
        return $areMoreUsers;
    }

    public function getHuntGroupLinearNextUser($currentPosition)
    {
        $huntGroupsRelUsers = $this->getHuntGroupsRelUsers(null, "priority asc");
        $huntGroupUser = $huntGroupsRelUsers[$currentPosition]->getUser();
        $extension = $huntGroupUser->getExtension();
        return $extension;
    }

    public function getHuntGroupRoundRobinNextUser($nextUserPosition)
    {
        $huntGroupsRelUsers = $this->getHuntGroupsRelUsers(null, "priority asc");
        $huntGroupUser = $huntGroupsRelUsers[$nextUserPosition]->getUser();
        $extension = $huntGroupUser->getExtension();

        $totalUsers = count($huntGroupsRelUsers);
        $nextUserPosition++;
        if($nextUserPosition== $totalUsers) {
            $nextUserPosition = 0;
        }
        $this->setNextUserPosition($nextUserPosition);
        $this->save();
        return $extension;
    }

    public function getHuntGroupRandomSequence()
    {
        $huntGroupsRelUsers = $this->getHuntGroupsRelUsers();
        $userIds = array();
        foreach($huntGroupsRelUsers as $huntGroupsRelUser) {
            $userIds[] = $huntGroupsRelUser->getUserId();
        }

        if(empty($userIds)) {
            return null;
        }

        shuffle($userIds);
        return implode(",", $userIds);
    }

}
