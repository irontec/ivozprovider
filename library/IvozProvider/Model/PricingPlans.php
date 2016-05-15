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
class PricingPlans extends Raw\PricingPlans
{
    /**
     * This method is called just after parent's constructor
     */
    public function init()
    {

    }

    public function getMatchedPrices($subject)
    {
        $matchedPrices = array();
        $dbAdapter = $this->getMapper()->getDbTable()->getAdapter();
        $query =    "select Rel.* from PricingPlansRelTargetPatterns Rel LEFT JOIN TargetPatterns Patterns ON (Rel.targetPatternId = Patterns.id)".
                    "where Rel.pricingPlanId = '".$this->getPrimaryKey()."' AND '".$subject."' LIKE CONCAT(Patterns.`regExp`, '%')".
                    "order by length(Patterns.`regExp`) desc";
        $prices = $dbAdapter->fetchAssoc($query);
        foreach ($prices as $price) {
            $priceModel = new \IvozProvider\Model\PricingPlansRelTargetPatterns();
            $priceModel->populateFromArray($price);
            $matchedPrices[] = $priceModel;
        }

        if (empty($matchedPrices)) {
            return null;
        }

        return $matchedPrices;
    }
}
