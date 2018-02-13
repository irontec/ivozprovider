<?php

use Ivoz\Kam\Domain\Model\UsersCdr\UsersCdrDto;

class IvozProvider_Klear_Ghost_UsersCdr extends KlearMatrix_Model_Field_Ghost_Abstract
{
    /**
     * @param UsersCdrDto $model
     * @return int with rounded duration of the call
     * @throws Zend_Exception
     */
    public function getDuration($model)
    {
        return round($model->getDuration());
    }

}
