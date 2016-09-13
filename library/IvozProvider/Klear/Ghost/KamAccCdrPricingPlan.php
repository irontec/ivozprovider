<?php

class IvozProvider_Klear_Ghost_KamAccCdrPricingPlan extends KlearMatrix_Model_Field_Ghost_Abstract
{
    /**
     *
     * @param $model KamAccCdrs
     *            model
     * @return source number if inbound call
     */
    public function getData ($model)
    {
        if (!is_null($model->getPricingPlan())) {
            return $model->getPricingPlan()->getName();
        } else {
            if ($model->getExternallyRated()) {
                return $model->getPricingPlanName();
            } else {
                return $model->getPricingPlanName() . ' (borrado)';
            }
        }
    }
}
