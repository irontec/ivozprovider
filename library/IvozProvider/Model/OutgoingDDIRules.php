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
class OutgoingDDIRules extends Raw\OutgoingDDIRules
{
    /**
     * This method is called just after parent's constructor
     */
    public function init()
    {
    }

    /**
     * Return forced DDI for this rule
     */
    public function getForcedDDI($where = null, $orderBy = null, $avoidLoading = false)
    {
        $ddi = parent::getForcedDDI($where, $orderBy, $avoidLoading);
        if (empty($ddi)) {
            $ddi = $this->getCompany()->getOutgoingDDI($where, $orderBy, $avoidLoading);
        }
        return $ddi;
    }

    /**
     * Check final outgoing DDI presentation for given destination
     */
    public function getOutgoingDDI($originalDDI, $e164destination)
    {
        // Default Rule action
        if ($this->getDefaultAction() == 'keep') {
            $finalDDI = $originalDDI;
        } else if ($this->getDefaultAction() == 'force') {
            $finalDDI = $this->getForcedDDI();
        }

        // Check rule patterns
        $rulePatterns = $this->getOutgoingDDIRulesPatterns(null, 'priority ASC');
        foreach ($rulePatterns as $rulePattern) {
            $list = $rulePattern->getMatchList();
            // If rule pattern matches, apply action and leave
            if ($list->numberMatches($e164destination)) {
                if ($rulePattern->getAction() == 'force')  {
                    $finalDDI = $rulePattern->getForcedDDI();
                }
                break;
            }
        }

        return $finalDDI;
    }

}
