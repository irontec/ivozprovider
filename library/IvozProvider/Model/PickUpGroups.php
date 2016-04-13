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
class PickUpGroups extends Raw\PickUpGroups
{
    /**
     * This method is called just after parent's constructor
     */
    public function init()
    {
    }
/**
 * @param  \IvozProvider\Model\Raw\Users $capturedUser
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
