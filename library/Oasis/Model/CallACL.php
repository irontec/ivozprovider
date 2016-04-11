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
class CallACL extends Raw\CallACL
{
    /**
     * This method is called just after parent's constructor
     */
    public function init()
    {
    }

    public function dstIsCallable($dst)
    {
        $defaultPolicy = $this->getDefaultPolicy();
        $aclRelPatterns = $this->getCallACLRelPatterns(null, 'priority ASC');
        foreach($aclRelPatterns as $aclRelPattern) {
            $aclPattern = $aclRelPattern->getCallACLPattern();
            $policy = $aclRelPattern->getPolicy();
            $pattern = $aclPattern->getRegExp();
            $match = preg_match('/'.$pattern.'/', $dst);
            if($match) {
                return "allow"== $policy;
            }
        }
        return "allow"== $defaultPolicy;
    }

}
