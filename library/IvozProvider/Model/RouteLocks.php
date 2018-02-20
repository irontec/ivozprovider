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
class RouteLocks extends Raw\RouteLocks
{
    /**
     * This method is called just after parent's constructor
     */
    public function init()
    {
    }

    /**
     * Return in current lock status is open
     *
     * @return boolean
     */
    public function isOpen()
    {
        return $this->getOpen() == '1';
    }
}
