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
 * Data Mapper implementation for IvozProvider\Model\KamRtpproxy
 *
 * @package Mapper
 * @subpackage Sql
 * @author Luis Felipe Garcia
 */
namespace IvozProvider\Mapper\Sql;
class KamRtpproxy extends Raw\KamRtpproxy
{
    protected function _save(\IvozProvider\Model\Raw\KamRtpproxy $model,
        $recursive = false, $useTransaction = true, $transactionTag = null, $forceInsert = false
    )
    {
        $model->setSetid($model->getMediaRelaySetsId());
        $pk = parent::_save($model, true, $useTransaction, $transactionTag, $forceInsert);
        return $pk;
    }
}
