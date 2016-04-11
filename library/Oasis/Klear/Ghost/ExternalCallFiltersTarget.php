<?php
class Oasis_Klear_Ghost_ExternalCallFiltersTarget extends KlearMatrix_Model_Field_Ghost_Abstract {
    
    /**
     * @param $model ExternalCallFilters model
     * @return name of target based on Holiday
     */
    public function getHolidayData($model) {
        return $this->getData($model, 'Holiday');
    }
    
    /**
     * @param $model ExternalCallFilters model
     * @return name of target based on out of schedule
     */
    public function getOutOfScheduleData($model) {
        return $this->getData($model, 'OutOfSchedule');
    }
    
    public function getData($model, $prefix) {
    
        // Build getters
        $typeGetter = 'get' . $prefix . 'TargetType';
        $numberGetter = 'get' . $prefix . 'NumberValue';
        $extensionGetter = 'get' . $prefix . 'Extension';
        $voicemailGetter = 'get' . $prefix . 'VoiceMailUser';
    
        // Get No answer handler type
        $naTargetType = $model->{$typeGetter}();
        switch($naTargetType) {
            case 'number':
                return $model->{$numberGetter}();
            case 'extension':
                $extension = $model->{$extensionGetter}();
                if ($extension) {
                    return $extension->getNumber();
                }
                break;
            case 'voicemail':
                $voicemail = $model->{$voicemailGetter}();
                if ($voicemail) {
                    return $voicemail->getName() . ' ' . $voicemail->getLastName();
                }
                break;
        }
        // No noanswer handler assigned
        return null;
    }
}