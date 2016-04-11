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
 * Data Mapper implementation for Oasis\Model\IVRCustomEntries
 *
 * @package Mapper
 * @subpackage Sql
 * @author Luis Felipe Garcia
 */
namespace Oasis\Mapper\Sql;
class IVRCustomEntries extends Raw\IVRCustomEntries
{
    protected function _save(\Oasis\Model\Raw\IVRCustomEntries  $model,
            $recursive = false, $useTransaction = true, $transactionTag = null, $forceInsert = false
    )
    {
        if ($model->hasChange("targetType")) {
            switch($model->getTargetType())
            {
                case "number":
                    $model->setTargetExtensionId(null);
                    $model->setTargetVoiceMailUserId(null);
                    break;
                case "extension":
                    $model->setTargetNumberValue(null);
                    $model->setTargetVoiceMailUserId(null);
                    break;
                case "voicemail":
                    $model->setTargetNumberValue(null);
                    $model->setTargetExtensionId(null);
                    break;
            }
        }
    
        return parent::_save($model, $recursive, $useTransaction, $transactionTag, $forceInsert);
    }
}
