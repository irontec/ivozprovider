<?php

/**
 * Application Model
 *
 * @package Oasis\Model
 * @subpackage Model
 * @author Luis Felipe Garcia
 * @copyright ZF model generator
 * @license http://framework.zend.com/license/new-bsd     New BSD License
 */

/**
 * [entity]
 *
 * @package Oasis\Model
 * @subpackage Model
 * @author Luis Felipe Garcia
 */

namespace Oasis\Model;
class PickUpGroups extends Raw\PickUpGroups
{
    /**
     * This method is called just after parent's constructor
     */
    public function init()
    {
    }
/**
 * @param  \Oasis\Model\Raw\Users $capturedUser
 */
    public function isPickUpAble($capturedUser)
    {
        $groupPickUpRelUsers = $this->getPickUpRelUsers();
        foreach($groupPickUpRelUsers as $groupPickUpRelUser) {
            $isCapturable = $capturedUser->getId()== $groupPickUpRelUser->getUserId();
            if($isCapturable) {
                return true;
            }
        }
        return false;
    }

}
