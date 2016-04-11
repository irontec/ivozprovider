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
        $prices = $this->getPricingPlansRelTargetPatterns(null, "metric asc");
        foreach ($prices as $price) {
            $regExp = trim($price->getTargetPattern()->getRegExp());
            if($regExp[0] != $regExp[strlen($regExp)-1]){
                $this->_logger->log("[Model][PricingPlans] Regular expresion malformed", \Zend_Log::WARN);
                continue;
            }

            if (preg_match($regExp, $subject)){
                $matchedPrices[] = $price;
            }
        }

        if (empty($matchedPrices)) {
            return null;
        }

        return $matchedPrices;
    }
}
