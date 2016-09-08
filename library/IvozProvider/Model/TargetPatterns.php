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
class TargetPatterns extends Raw\TargetPatterns
{
    /**
     * This method is called just after parent's constructor
     */
    public function init()
    {
        // Dont save changelog on this entities
        $this->_saveChanges = false;
    }
}
