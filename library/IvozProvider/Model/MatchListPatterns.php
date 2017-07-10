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
class MatchListPatterns extends Raw\MatchListPatterns
{
    /**
     * This method is called just after parent's constructor
     */
    public function init()
    {
    }


    /**
     * Get Number value in E.164 format
     */
    public function getNumberE164($prefix = '')
    {
        return $prefix .
            $this->getNumberCountry()->getCallingCode() .
            $this->getNumberValue();
    }

}
