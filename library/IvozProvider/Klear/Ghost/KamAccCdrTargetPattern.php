<?php

class IvozProvider_Klear_Ghost_KamAccCdrTargetPattern extends KlearMatrix_Model_Field_Ghost_Abstract
{
    /**
     *
     * @param $model KamAccCdrs
     *            model
     * @return source number if inbound call
     */
    public function getData ($model)
    {
        if (!is_null ($model->getTargetPattern())) {
            return $model->getTargetPattern()->getName();
        } else {
            return $model->getTargetPatternName() . ' (borrado)';
        }
    }
}

