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
 * Data Mapper implementation for IvozProvider\Model\ConferenceRooms
 *
 * @package Mapper
 * @subpackage Sql
 * @author Luis Felipe Garcia
 */
namespace IvozProvider\Mapper\Sql;
class ConferenceRooms extends Raw\ConferenceRooms
{

    protected function _save(\IvozProvider\Model\Raw\ConferenceRooms $model,
                    $recursive = false, $useTransaction = true, $transactionTag = null, $forceInsert = false
                    )
    {

        if (!$model->getPinProtected()) {
            $model->setPinCode(null);
        }

        return parent::_save($model, $recursive, $useTransaction, $transactionTag, $forceInsert);
    }


}
