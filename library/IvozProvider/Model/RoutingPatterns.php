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
class RoutingPatterns extends Raw\RoutingPatterns
{
    /**
     * This method is called just after parent's constructor
     */
    public function init()
    {
        // Dont save changelog on this entities
        $this->_saveChanges = false;
    }

    public function getGenericLcrRulePerPattern()
    {
        $from_uri_condition = 'from_uri IS NULL';

        $lcrRules = $this->getLcrRules($from_uri_condition);
        if (empty($lcrRules)) {
            return null;
        } else {
            return $lcrRules[0];
        }
    }

    public function getCompanyLcrRulePerPattern(\IvozProvider\Model\Raw\Companies $company)
    {
        $from_uri = '^' . $company->getDomain() . '$';
        $from_uri_condition = "from_uri='".$from_uri."'";

        $lcrRules = $this->getLcrRules($from_uri_condition);
        if (empty($lcrRules)) {
            return null;
        } else {
            return $lcrRules[0];
        }
    }
}
