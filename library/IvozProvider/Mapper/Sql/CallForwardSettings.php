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
 * Data Mapper implementation for IvozProvider\Model\CallForwardSettings
 *
 * @package Mapper
 * @subpackage Sql
 * @author Luis Felipe Garcia
 */
namespace IvozProvider\Mapper\Sql;
class CallForwardSettings extends Raw\CallForwardSettings
{
    protected function _save(\IvozProvider\Model\Raw\CallForwardSettings $model,
            $recursive = false, $useTransaction = true, $transactionTag = null, $forceInsert = false
    )
    {
        if (!$model->isEnabled()) {
            return parent::_save($model, $recursive, $useTransaction, $transactionTag, $forceInsert);
        }

        // Avoid incompatible type of cfw settings
        if ($model->getUserId()) {
            // User cfw
            $objectId = $model->getUserId();
            $objectName = 'userId';
        } else {
            // RetailAccount cfw
            $objectId = $model->getRetailAccountId();
            $objectName = 'retailAccountId';
        }

        $callTypeFilterConditions = array(
            $model->getCallTypeFilter()
        );

        if ($model->getCallTypeFilter() == "both") {
            $callTypeFilterConditions[] = "external";
            $callTypeFilterConditions[] = "internal";
        } else {
            $callTypeFilterConditions[] = "both";
        }
        $inconditionalCallForwardsConditions = array(
            "id != '".$model->getPrimaryKey()."'",
            "$objectName = $objectId",
            "enabled = '1'",
            "callTypeFilter in ('".implode("','", $callTypeFilterConditions)."')",
            "callForwardType = 'inconditional'"
        );
        $inconditionalCallForwards = $this->fetchList(implode(" AND ", $inconditionalCallForwardsConditions));
        if (!empty($inconditionalCallForwards)) {
            $message = "There is an inconditional call forward with that call type. You can't add call forwards";
            throw new \Exception($message, 30000);
        }

        $isInconditional = ($model->getCallForwardType() == "inconditional");
        if ($isInconditional) {
            $callForwardsConditions = array(
                "id != '".$model->getPrimaryKey()."'",
                "$objectName = $objectId",
                "enabled = '1'",
                "callTypeFilter in ('".implode("','", $callTypeFilterConditions)."')",
            );
            $callForwards = $this->fetchList(implode(" AND ", $callForwardsConditions));
            if (!empty($callForwards)) {
                $message = "There are already call forwards with that call type. You can't add inconditional call forward";
                throw new \Exception($message, 30001);
            }
        }

        $isBusy = ($model->getCallForwardType() == "busy");
        if ($isBusy) {
            $busyCallForwardsConditions = array(
                "id != '".$model->getPrimaryKey()."'",
                "$objectName = $objectId",
                "enabled = '1'",
                "callTypeFilter in ('".implode("','", $callTypeFilterConditions)."')",
                "callForwardType = 'busy'"
            );
            $busyCallForwards = $this->fetchList(implode(" AND ", $busyCallForwardsConditions));
            if (!empty($busyCallForwards)) {
                $message = "There is already a busy call forward with that call type.";
                throw new \Exception($message, 30002);
            }
        }

        $isNoAnswer = ($model->getCallForwardType() == "noAnswer");
        if ($isNoAnswer) {
            $noAnswerCallForwardsConditions = array(
                "id != '".$model->getPrimaryKey()."'",
                "$objectName = $objectId",
                "enabled = '1'",
                "callTypeFilter in ('".implode("','", $callTypeFilterConditions)."')",
                "callForwardType = 'noAnswer'",
            );
            $noAnswerCallForwards = $this->fetchList(implode(" AND ", $noAnswerCallForwardsConditions));
            if (!empty($noAnswerCallForwards)) {
                $message = "There is already a noAnswer call forward with that call type.";
                throw new \Exception($message, 30003);
            }
        }

        $isUserNotRegistered = ($model->getCallForwardType() == "userNotRegistered");
        if ($isUserNotRegistered) {
            $userNotRegisteredCallForwardsConditions = array(
                "id != '".$model->getPrimaryKey()."'",
                "$objectName = $objectId",
                "enabled = '1'",
                "callTypeFilter in ('".implode("','", $callTypeFilterConditions)."')",
                "callForwardType = 'userNotRegistered'",
            );
            $userNotRegisteredCallForwards = $this->fetchList(implode(" AND ", $userNotRegisteredCallForwardsConditions));
            if (!empty($userNotRegisteredCallForwards)) {
                $message = "There is already a userNotRegistered call forward with that call type.";
                throw new \Exception($message, 30004);
            }
        }

        return parent::_save($model, $recursive, $useTransaction, $transactionTag, $forceInsert);
    }
}
