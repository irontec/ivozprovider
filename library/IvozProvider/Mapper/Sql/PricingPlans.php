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
 * Data Mapper implementation for IvozProvider\Model\PricingPlans
 *
 * @package Mapper
 * @subpackage Sql
 * @author Luis Felipe Garcia
 */
namespace IvozProvider\Mapper\Sql;
class PricingPlans extends Raw\PricingPlans
{

//     protected function _save(\IvozProvider\Model\Raw\PricingPlans $model,
//             $recursive = false, $useTransaction = true, $transactionTag = null, $forceInsert = false
//     )
//     {
//         $validFrom = $model->getValidFrom(true);
//         $validTo = $model->getValidTo(true);
//         $this->_logger->log("[PricingPlans Mapper] Valid From:".$validFrom, \Zend_Log::DEBUG);
//         $this->_logger->log("[PricingPlans Mapper] Valid To:".$validTo, \Zend_Log::DEBUG);
//         if ($validTo->compare($validFrom) <= 0) {
//             $message = "Valid From must be earlier than Valid to";
//             throw new \Exception($message, 4000);
//         }

//         $now = new \Zend_Date();
//         $now->setTimezone("UTC");
//         $this->_logger->log("[PricingPlans Mapper] Now:".$now, \Zend_Log::DEBUG);

//         if ($validFrom->compare($now) <= 0) {
//             $message = "You can't create a pricing plan that starts in de past";
//             throw new \Exception($message, 4001);
//         }

//         parent::_save($model, $recursive, $useTransaction, $transactionTag, $forceInsert);
//     }

}
