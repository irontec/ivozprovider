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
 * [entity][rest]
 *
 * @package IvozProvider\Model
 * @subpackage Model
 * @author Luis Felipe Garcia
 */
 
namespace IvozProvider\Model;
class KamUsersLocation extends Raw\KamUsersLocation
{
    /**
     * This method is called just after parent's constructor
     */
    public function init()
    {
    }

    public function getContactSrc()
    {
        $src = explode('@', $this->getContact());
        return array_pop($src);
    }

    public function getReceivedSrc()
    {
        $src = explode('sip:', $this->getReceived());
        return array_pop($src);
    }

}
