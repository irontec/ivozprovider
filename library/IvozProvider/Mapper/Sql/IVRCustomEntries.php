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
 * Data Mapper implementation for IvozProvider\Model\IVRCustomEntries
 *
 * @package Mapper
 * @subpackage Sql
 * @author Luis Felipe Garcia
 */
namespace IvozProvider\Mapper\Sql;
class IVRCustomEntries extends Raw\IVRCustomEntries
{
    protected function _save(\IvozProvider\Model\Raw\IVRCustomEntries  $model,
            $recursive = false, $useTransaction = true, $transactionTag = null, $forceInsert = false
    )
    {
        if ($model->hasChange("targetType")) {
            switch($model->getTargetType())
            {
                case "number":
                    $model->setTargetExtensionId(null);
                    $model->setTargetVoiceMailUserId(null);
                    $model->setTargetConditionalRouteId(null);
                    break;
                case "extension":
                    $model->setTargetNumberValue(null);
                    $model->setTargetVoiceMailUserId(null);
                    $model->setTargetConditionalRouteId(null);
                    break;
                case "voicemail":
                    $model->setTargetNumberValue(null);
                    $model->setTargetExtensionId(null);
                    $model->setTargetConditionalRouteId(null);
                    break;
                case "conditional":
                    $model->setTargetNumberValue(null);
                    $model->setTargetExtensionId(null);
                    $model->setTargetVoiceMailUserId(null);
                    break;
            }
        }

        return parent::_save($model, $recursive, $useTransaction, $transactionTag, $forceInsert);
    }
}
