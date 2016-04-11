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
 * Data Mapper implementation for Oasis\Model\DDIs
 *
 * @package Mapper
 * @subpackage Sql
 * @author Luis Felipe Garcia
 */
namespace Oasis\Mapper\Sql;
class DDIs extends Raw\DDIs
{
    protected function _save(\Oasis\Model\Raw\DDIs $model,
            $recursive = false, $useTransaction = true, $transactionTag = null, $forceInsert = false
    )
    {
        $nullableFields = array(
                "user" => "userId",
                "IVRCommon" => "IVRCommonId",
                "IVRCustom" => "IVRCustomId",
                "huntGroup" => "huntGroupId",
                "fax" => "faxId"
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
