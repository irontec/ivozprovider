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
 * Data Mapper implementation for IvozProvider\Model\HuntGroupCallForwardSettings
 *
 * @package Mapper
 * @subpackage Sql
 * @author Luis Felipe Garcia
 */
namespace IvozProvider\Mapper\Sql;
class HuntGroupCallForwardSettings extends Raw\HuntGroupCallForwardSettings
{
    
    public function save(\IvozProvider\Model\Raw\HuntGroupCallForwardSettings $model)
    {
        $huntGroupCallTypeFilterConditions = array(
                $model->getCallTypeFilter()
        );
        
        if ($model->getCallTypeFilter() == "both") {
            $huntGroupCallTypeFilterConditions[] = "external";
            $huntGroupCallTypeFilterConditions[] = "internal";
        } else {
            $huntGroupCallTypeFilterConditions[] = "both";
        }

        $where = array( 
            "id != '".$model->getPrimaryKey()."'",
            "huntGroupId = '".$model->getHuntGroupId()."'",
            "callTypeFilter in ('".implode("','", $huntGroupCallTypeFilterConditions)."')",
         );
        
        $huntGroupCallForwards = $this->fetchList(implode(" AND ", $where));
        if (!empty($huntGroupCallForwards)) {
            $message = "There is a call forward with that call type. You can't add this call forward";
            throw new \Exception($message, 30200);
        }
        
        $nullableFields = array(
                "number" => "callNumberValue",
                "extension" => "callExtensionId",
                "voicemail" => "callVoiceMailUserId",
        );
        $routeType = $model->getCallTargetType();
        foreach ($nullableFields as $type => $fieldName) {
            if ($routeType == $type) {
                continue;
            }
            $setter = "set".ucfirst($fieldName);
            $model->{$setter}(null);
        }
        
        return parent::save($model);
    }

}
