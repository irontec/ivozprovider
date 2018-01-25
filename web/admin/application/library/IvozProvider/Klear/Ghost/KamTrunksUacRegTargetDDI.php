<?php

use Ivoz\Kam\Domain\Model\TrunksUacreg\TrunksUacregDto;

class IvozProvider_Klear_Ghost_KamTrunksUacRegTargetDDI extends KlearMatrix_Model_Field_Ghost_Abstract
{
    /**
     * @param $model TrunksUacregDto
     * @return string
     */
    public function getData ($model)
    {
        if (!$model->getMultiDdi()) {
            return $model->getLUuid();
        } else {
            return 'Multi-DDI';
        }
    }
}

