<?php

class IvozProvider_Klear_Ghost_KamAccCdrTargetPattern extends KlearMatrix_Model_Field_Ghost_Abstract
{
    /**
     *
     * @param $model \Kam\Domain\Model\AccCdr\AccCdrDTO
     *            model
     * @return source number if inbound call
     */
    public function getData ($model)
    {
        if (!$model->getMetered()) {
            return null;
        }

        if (!is_null($model->getTargetPattern())) {
            return $model->getTargetPattern()->getName();
        } else {
            if ($model->getExternallyRated()) {
                return $model->getTargetPatternName();
            } else {
                return $model->getTargetPatternName() . ' (borrado)';
            }
        }
    }
}

