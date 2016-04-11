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
 * Data Mapper implementation for Oasis\Model\ProxyTrunks
 *
 * @package Mapper
 * @subpackage Sql
 * @author Luis Felipe Garcia
 */
namespace Oasis\Mapper\Sql;
class ProxyTrunks extends Raw\ProxyTrunks
{
    protected function _save(\Oasis\Model\Raw\ProxyTrunks $model,
            $recursive = false, $useTransaction = true, $transactionTag = null, $forceInsert = false
    )
    {
        $model->setContact('sip:' . $model->getIp());
        $response = parent::_save($model, $recursive, $useTransaction, $transactionTag, $forceInsert);
        return $response;
    }
}
