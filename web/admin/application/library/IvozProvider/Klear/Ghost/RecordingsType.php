<?php

class IvozProvider_Klear_Ghost_RecordingsType extends KlearMatrix_Model_Field_Ghost_Abstract
{
    /**
     *
     * @param $model Recordings $model
     * @return type
     */
    public function getData($model)
    {
        $type = $model->getType() == 'ondemand'
            ? 'On-demand'
            : 'DDI';
        $recorder = $model->getRecorder();
        if (!$recorder) {
            return $type;
        }
        return $type . ' (' . $recorder . ')';
    }
}
