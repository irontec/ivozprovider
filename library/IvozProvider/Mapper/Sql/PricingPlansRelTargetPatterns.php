<?php

/**
 * Application Model Mapper
 *
 * @package Mapper
 * @subpackage Sql
 * @author Luis Felipe Garcia
 * @copyright ZF model generator
 * @license http://framework.zend.com/license/new-bsd     New BSD License
 */

/**
 * Data Mapper implementation for IvozProvider\Model\PricingPlansRelTargetPatterns
 *
 * @package Mapper
 * @subpackage Sql
 * @author Luis Felipe Garcia
 */
namespace IvozProvider\Mapper\Sql;
class PricingPlansRelTargetPatterns extends Raw\PricingPlansRelTargetPatterns
{


    protected function _save(\IvozProvider\Model\Raw\PricingPlansRelTargetPatterns $model,
            $recursive = false, $useTransaction = true, $transactionTag = null, $forceInsert = false
    )
    {
        if (is_null($model->getPrimaryKey())) {
            $planId = $model->getPricingPlanId();
            $where = "pricingPlanId = '".$planId."'";
            $prices = $this->fetchList($where, "metric desc");
            if (!empty($prices)) {
                $maxPrice = $prices[0]->getMetric();
                $model->setMetric($maxPrice+10);
            }
        }

        return parent::_save($model, $recursive, $useTransaction, $transactionTag, $forceInsert);
    }
}
