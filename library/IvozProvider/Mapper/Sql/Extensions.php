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
 * Data Mapper implementation for IvozProvider\Model\Extensions
 *
 * @package Mapper
 * @subpackage Sql
 * @author Luis Felipe Garcia
 */
namespace IvozProvider\Mapper\Sql;
class Extensions extends Raw\Extensions
{
    protected function _save(\IvozProvider\Model\Raw\Extensions $model,
            $recursive = false, $useTransaction = true, $transactionTag = null, $forceInsert = false
    )
    {
        $nullableFields = array(
                "IVRCommon"     => "IVRCommonId",
                "IVRCustom"     => "IVRCustomId",
                "huntGroup"     => "huntGroupId",
                "user"          => "userId",
                "conferenceRoom" => "conferenceRoomId",
                "number"        => "numberValue",
                "friend"        => "friendValue",
                "queue"         => "queueId",
                "conditional"   => "conditionalRouteId",
        );

        $routeType = $model->getRouteType();
        $original = $this->find($model->getPrimaryKey());
        foreach ($nullableFields as $type => $fieldName) {
            if ($routeType == $type) {
                continue;
            }
            $setter = "set".ucfirst($fieldName);
            $model->{$setter}(null);
        }

        $pk = parent::_save($model, $recursive, $useTransaction, $transactionTag, $forceInsert);

        // If this extension was pointing to a user and number has changed
        if (!is_null($original) && $original->getUserId() != $model->getUserId()) {
            // If there was an user and it was its screen extension
            $olduser = $original->getUser();
            if (!is_null($olduser) && $olduser->getExtensionId() == $model->getId()) {
                // Remove its screen extension
                $olduser->setExtensionId(NULL)->save();
            }
        }

        // If there is a new user and new user has no extension
        if ($routeType == 'user') {
            $user = $model->getUser();
            if (!is_null($user) && is_null($user->getExtension())) {
                // Set this as its screen extension
                $user->setExtension($model)->save();
            }
        }

        // If this extension was pointing to a user and number has changed
        if ($routeType == 'user' && $model->hasChange('number')) {
            // Check if this extension belongs to a user
            $user = $model->getUser();
            if (!empty($user)) {
                // Update endpoint data
                $user->updateEndpoint();
            }
        }

        return $pk;
    }

    /**
     * @inheritdoc
     */
    public function delete(\IvozProvider\Model\Raw\ModelAbstract $model)
    {
        // IVRCustom
        $customIvrsByTimeoutExtension = $model->getIVRCustomByTimeoutExtension();
        foreach ($customIvrsByTimeoutExtension as $ivrByTimeoutExtension) {
            $ivrByTimeoutExtension
                ->setTimeoutTargetType(null)
                ->setTimeoutExtensionId(null)
                ->save();
        }

        $customIvrsByErrorExtension = $model->getIVRCustomByErrorExtension();
        foreach ($customIvrsByErrorExtension as $ivrByErrorExtension) {
            $ivrByErrorExtension
                ->setErrorTargetType(null)
                ->setErrorExtensionId(null)
                ->save();
        }

        // IVRCommon
        $commonIvrsByTimeoutExtension = $model->getIVRCommonByTimeoutExtension();
        foreach ($commonIvrsByTimeoutExtension as $ivrByTimeoutExtension) {
            $ivrByTimeoutExtension
                ->setTimeoutTargetType(null)
                ->setTimeoutExtensionId(null)
                ->save();
        }

        $commonIvrsByErrorExtension = $model->getIVRCommonByErrorExtension();
        foreach ($commonIvrsByErrorExtension as $ivrByErrorExtension) {
            $ivrByErrorExtension
                ->setErrorTargetType(null)
                ->setErrorExtensionId(null)
                ->save();
        }

        return parent::delete($model);
    }

}
