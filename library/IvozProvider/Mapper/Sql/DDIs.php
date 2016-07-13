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
 * Data Mapper implementation for IvozProvider\Model\DDIs
 *
 * @package Mapper
 * @subpackage Sql
 * @author Luis Felipe Garcia
 */
namespace IvozProvider\Mapper\Sql;
class DDIs extends Raw\DDIs
{
    protected function _save(\IvozProvider\Model\Raw\DDIs $model,
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

        // Set standarized E164 number
        // FIXME Country IS MANDATODY
        $country = $model->getCountry();
        $model->setDDIE164($country->getCallingCode() . $model->getDDI());

        return parent::_save($model, $recursive, $useTransaction, $transactionTag, $forceInsert);
    }

}
