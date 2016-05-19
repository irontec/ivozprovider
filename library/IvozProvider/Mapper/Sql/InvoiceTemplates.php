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
 * Data Mapper implementation for IvozProvider\Model\InvoiceTemplates
 *
 * @package Mapper
 * @subpackage Sql
 * @author Luis Felipe Garcia
 */
namespace IvozProvider\Mapper\Sql;
class InvoiceTemplates extends Raw\InvoiceTemplates
{

    protected function _save(\IvozProvider\Model\Raw\InvoiceTemplates $model,
                             $recursive = false, $useTransaction = true, $transactionTag = null, $forceInsert = false
    )
    {
        if (empty($model->getTemplate())) {
            throw new \Exception("Template not null", 80000);
        }
        return parent::_save($model, $recursive, $useTransaction, $transactionTag, $forceInsert);
    }
}
