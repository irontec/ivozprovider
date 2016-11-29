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
 * Data Mapper implementation for IvozProvider\Model\HuntGroups
 *
 * @package Mapper
 * @subpackage Sql
 * @author Luis Felipe Garcia
 */
namespace IvozProvider\Mapper\Sql;
class HuntGroups extends Raw\HuntGroups
{
    protected function _save(\IvozProvider\Model\Raw\HuntGroups $model,
            $recursive = false, $useTransaction = true, $transactionTag = null, $forceInsert = false
    )
    {
        $nullableFields = array(
                "number"    => "noAnswerNumberValue",
                "extension" => "noAnswerExtensionId",
                "voicemail" => "noAnswerVoiceMailUserId"
        );
        $routeType = $model->getNoAnswerTargetType();
        foreach ($nullableFields as $type => $fieldName) {
            if ($routeType == $type) {
                continue;
            }
            $setter = "set".ucfirst($fieldName);
            $model->{$setter}(null);
        }

        return parent::_save($model, $recursive, $useTransaction, $transactionTag, $forceInsert);
    }

}
