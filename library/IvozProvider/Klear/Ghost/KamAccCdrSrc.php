<?php

class IvozProvider_Klear_Ghost_KamAccCdrSrc extends KlearMatrix_Model_Field_Ghost_Abstract
{
    /**
     *
     * @param $model KamAccCdrs
     *            model
     * @return source number if inbound call
     */
    public function getData ($model)
    {
        if ($model->getDirection() == 'inbound') {
            return $model->getCaller();
        } else {
            return null;
        }
    }
}
