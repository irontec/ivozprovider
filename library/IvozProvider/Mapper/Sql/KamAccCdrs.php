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
 * Data Mapper implementation for IvozProvider\Model\KamAccCdrs
 *
 * @package Mapper
 * @subpackage Sql
 * @author Luis Felipe Garcia
 */
namespace IvozProvider\Mapper\Sql;
class KamAccCdrs extends Raw\KamAccCdrs
{
    protected function _save(\IvozProvider\Model\Raw\KamAccCdrs $model,
                             $recursive = false, $useTransaction = true, $transactionTag = null, $forceInsert = false
    )
    {
        if ($model->getPricingPlanId()) {
            $pricingPlanName = $model->getPricingPlan()->getName();
            $model->setPricingPlanName($pricingPlanName);
        }

        if ($model->getTargetPatternId()) {
            $targetPatternName = $model->getTargetPattern()->getName();
            $model->setTargetPatternName($targetPatternName);
        }

        $result = parent::_save(
            $model,
            $recursive,
            $useTransaction,
            $transactionTag
        );

        return $result;
    }

    public function fetchTarificableList(array $where = array(), $order = null, $limit = null, $offset = null)
    {

        $where[] = "peeringContractId IS NOT NULL AND peeringContractId != ''";
        return $this->fetchList(implode(" AND ", $where), $order, $limit, $offset);
    }

    public function countTarificableByQuery(array $where = array())
    {

        $where[] = "peeringContractId IS NOT NULL AND peeringContractId != ''";
        return $this->countByQuery(implode(" AND ", $where));
    }
}
