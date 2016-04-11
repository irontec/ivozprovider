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
 * Data Mapper implementation for Oasis\Model\PricingPlansRelCompanies
 *
 * @package Mapper
 * @subpackage Sql
 * @author Luis Felipe Garcia
 */
namespace Oasis\Mapper\Sql;
class PricingPlansRelCompanies extends Raw\PricingPlansRelCompanies
{

    protected function _save(\Oasis\Model\Raw\PricingPlansRelCompanies $model,
            $recursive = false, $useTransaction = true, $transactionTag = null, $forceInsert = false
    )
    {
        if (is_null($model->getPrimaryKey())) {
            $companyId = $model->getCompanyId();
            $where = "companyId = '".$companyId."'";
            $companyPlans = $this->fetchList($where, "metric desc");
            if (!empty($companyPlans)) {
                $maxMetric = $companyPlans[0]->getMetric();
                $model->setMetric($maxMetric+10);
            }
        }

        return parent::_save($model, $recursive, $useTransaction, $transactionTag, $forceInsert);
    }

}
