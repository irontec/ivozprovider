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
 * Data Mapper implementation for IvozProvider\Model\IVRCustom
 *
 * @package Mapper
 * @subpackage Sql
 * @author Luis Felipe Garcia
 */
namespace IvozProvider\Mapper\Sql;
class IVRCustom extends Raw\IVRCustom
{
    protected function _save(\IvozProvider\Model\Raw\IVRCustom  $model,
            $recursive = false, $useTransaction = true, $transactionTag = null, $forceInsert = false
    )
    {
        $nullableFields = array(
                "number" => "timeoutNumberValue",
                "extension" => "timeoutExtensionId",
                "voicemail" => "timeoutVoiceMailUserId"
        );
        $routeType = $model->getTimeoutTargetType();
        foreach ($nullableFields as $type => $fieldName) {
            if ($routeType == $type) {
                continue;
            }
            $setter = "set".ucfirst($fieldName);
            $model->{$setter}(null);
        }
        
        
        $nullableErrorFields = array(
                "number" => "errorNumberValue",
                "extension" => "errorExtensionId",
                "voicemail" => "errorVoiceMailUserId"
        );
        $routeErrorType = $model->getErrorTargetType();
        foreach ($nullableErrorFields as $type => $fieldName) {
            if ($routeErrorType == $type) {
                continue;
            }
            $setter = "set".ucfirst($fieldName);
            $model->{$setter}(null);
        }
        
        return parent::_save($model, $recursive, $useTransaction, $transactionTag, $forceInsert);
    }

}
