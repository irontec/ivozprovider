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
 * Data Mapper implementation for Oasis\Model\Terminals
 *
 * @package Mapper
 * @subpackage Sql
 * @author Luis Felipe Garcia
 */
namespace Oasis\Mapper\Sql;
class Terminals extends Raw\Terminals
{
    protected function _save(\Oasis\Model\Raw\Terminals $model,
            $recursive = false, $useTransaction = true, $transactionTag = null, $forceInsert = false
    )
    {
        $mac = $model->getMac();
        $mac = strtolower($mac);
        $mac = preg_replace("/[^A-Za-z0-9]/", '', $mac);
        if( preg_match('/^[a-f0-9]*$/', $mac) ){
            $model->setMac($mac);
            $model->setSubscribecontext($model->getCompanyId());
            return parent::_save($model, $recursive, $useTransaction, $transactionTag, $forceInsert);
        }
        else {
            throw new \Exception('Invalid mac', 417);
        }
        
    }
}
