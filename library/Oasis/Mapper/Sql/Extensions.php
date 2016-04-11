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
 * Data Mapper implementation for Oasis\Model\Extensions
 *
 * @package Mapper
 * @subpackage Sql
 * @author Luis Felipe Garcia
 */
namespace Oasis\Mapper\Sql;
class Extensions extends Raw\Extensions
{
    protected function _save(\Oasis\Model\Raw\Extensions $model,
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
        return parent::_save($model, $recursive, $useTransaction, $transactionTag, $forceInsert);
    }

}
