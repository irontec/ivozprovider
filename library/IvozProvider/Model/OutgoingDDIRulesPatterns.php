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
class OutgoingDDIRulesPatterns extends Raw\OutgoingDDIRulesPatterns
{
    /**
     * This method is called just after parent's constructor
     */
    public function init()
    {
    }

    /**
     * Return forced DDI for this rule pattern
     */
    public function getForcedDDI($where = null, $orderBy = null, $avoidLoading = false)
    {
        $ddi = parent::getForcedDDI($where, $orderBy, $avoidLoading);
        if (empty($ddi)) {
            $ddi = $this->getOutgoingDDIRule()
                        ->getCompany()
                        ->getOutgoingDDI($where, $orderBy, $avoidLoading);
        }
        return $ddi;
    }
}
