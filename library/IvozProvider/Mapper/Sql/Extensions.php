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
                "IVRCommon" => "IVRCommonId",
                "IVRCustom" => "IVRCustomId",
                "huntGroup" => "huntGroupId"
        );
        $routeType = $model->getRouteType();
        foreach ($nullableFields as $type => $fieldName) {
            if ($routeType == $type) {
                continue;
            }
            $setter = "set".ucfirst($fieldName);
            $model->{$setter}(null);
        }

        $pk = parent::_save($model, $recursive, $useTransaction, $transactionTag, $forceInsert);

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

}
