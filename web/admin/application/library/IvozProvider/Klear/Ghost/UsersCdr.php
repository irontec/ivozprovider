<?php

use Ivoz\Kam\Domain\Model\UsersCdr\UsersCdrDto;
use Ivoz\Core\Application\Service\DataGateway;
use Ivoz\Kam\Domain\Model\UsersCdr\UsersCdr;

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

    /**
     * @param UsersCdrDto $model
     * @return string with owner of the call
     * @throws Zend_Exception
     */
    public function getCallOwner($model)
    {
        /** @var DataGateway $dataGateway */
        $dataGateway = \Zend_Registry::get('data_gateway');

        return $dataGateway->remoteProcedureCall(
            UsersCdr::class,
            $model->getId(),
            'getOwner',
            []
        );
    }

    /**
     * @param UsersCdrDto $model
     * @return string with other party of the call
     * @throws Zend_Exception
     */
    public function getCallParty($model)
    {
        /** @var DataGateway $dataGateway */
        $dataGateway = \Zend_Registry::get('data_gateway');

        return $dataGateway->remoteProcedureCall(
            UsersCdr::class,
            $model->getId(),
            'getParty',
            []
        );
    }
}
