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
 * Data Mapper implementation for IvozProvider\Model\OutgoingDDIRules
 *
 * @package Mapper
 * @subpackage Sql
 * @author Luis Felipe Garcia
 */
namespace IvozProvider\Mapper\Sql;
class OutgoingDDIRules extends Raw\OutgoingDDIRules
{
    protected function _save(\IvozProvider\Model\Raw\OutgoingDDIRules $model,
            $recursive = false, $useTransaction = true, $transactionTag = null, $forceInsert = false
    )
    {
        $nullableFields = array(
                "force"        => "forcedDDIId",
        );
        $defaultAction = $model->getDefaultAction();
        foreach ($nullableFields as $type => $fieldName) {
            if ($defaultAction == $type) {
                continue;
            }
            $setter = "set".ucfirst($fieldName);
            $model->{$setter}(null);
        }

        return parent::_save($model, $recursive, $useTransaction, $transactionTag, $forceInsert);
    }
}
