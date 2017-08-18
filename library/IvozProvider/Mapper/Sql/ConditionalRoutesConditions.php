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
 * Data Mapper implementation for IvozProvider\Model\ConditionalRoutesConditions
 *
 * @package Mapper
 * @subpackage Sql
 * @author Luis Felipe Garcia
 */
namespace IvozProvider\Mapper\Sql;
class ConditionalRoutesConditions extends Raw\ConditionalRoutesConditions
{
    protected function _save(\IvozProvider\Model\Raw\ConditionalRoutesConditions $model,
            $recursive = false, $useTransaction = true, $transactionTag = null, $forceInsert = false
    )
    {
        $nullableFields = array(
                "IVRCommon"     => "IVRCommonId",
                "IVRCustom"     => "IVRCustomId",
                "huntGroup"     => "huntGroupId",
                "voicemail"     => "voiceMailUserId",
                "user"          => "userId",
                "number"        => "numberValue",
                "friend"        => "friendValue",
                "queue"         => "queueId",
                "conferenceRoom" => "conferenceRoomId",
                "extension"     => "extensionId",
        );

        $routeType = $model->getRouteType();
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
