<?php

class IvozProvider_Klear_Ghost_RecordingsType extends KlearMatrix_Model_Field_Ghost_Abstract
{
    /**
     *
     * @param $model Recordings
     *            model
     * @return type
     */
    public function getData ($model)
    {
        if ($model->getType() == 'ondemand') {
            return 'On-demand (' . $model->getRecorder() . ')';
        } else {
            return 'DDI';
        }
    }
}

