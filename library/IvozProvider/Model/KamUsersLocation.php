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
        preg_match('/sips?:([^@]+@)?(?P<domain>[^;]+)/', $this->getContact(), $matches);
        return $matches['domain'];
    }

    public function getReceivedSrc()
    {
        $received = $this->getReceived();
        if ($received) {
            preg_match('/sips?:([^@]+@)?(?P<domain>[^;]+)/', $received, $matches);
            return $matches['domain'];
        }

        return null;
    }

}
