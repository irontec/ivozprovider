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
 * Data Mapper implementation for Oasis\Model\ExternalCallFilters
 *
 * @package Mapper
 * @subpackage Sql
 * @author Luis Felipe Garcia
 */
namespace Oasis\Mapper\Sql;
class ExternalCallFilters extends Raw\ExternalCallFilters
{

    protected function _save(\Oasis\Model\Raw\ExternalCallFilters $model,
            $recursive = false, $useTransaction = true, $transactionTag = null, $forceInsert = false
    )
    {
        $holidayNullableFields = array(
                "number" => "holidayNumberValue",
                "extension" => "holidayExtensionId",
                "voicemail" => "holidayVoiceMailUserId",
        );
        
        $routeTypeHoliday = $model->getHolidayTargetType();
        $schedulerouteType = $model->getOutOfScheduleTargetType();
        
        foreach ($holidayNullableFields as $type => $fieldName) {
            if ($routeTypeHoliday == $type) {
                continue;
            }
            $setter = "set".ucfirst($fieldName);
            $model->{$setter}(null);
        }
        
        
        $scheduleNullableFields = array(
                "number" => "outOfScheduleNumberValue",
                "extension" => "outOfScheduleExtensionId",
                "voicemail" => "outOfScheduleVoiceMailUserId",
        );
        
        $schedulerouteType = $model->getOutOfScheduleTargetType();
        
        foreach ($scheduleNullableFields as $type => $fieldName) {
            if ($schedulerouteType == $type) {
                continue;
            }
            $setter = "set".ucfirst($fieldName);
            $model->{$setter}(null);
        }
        
        return parent::_save($model, $recursive, $useTransaction, $transactionTag, $forceInsert);
    }
}
