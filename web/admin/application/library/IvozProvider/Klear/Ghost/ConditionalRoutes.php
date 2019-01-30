<?php

use Ivoz\Core\Application\Service\DataGateway;
use Ivoz\Provider\Domain\Model\ConditionalRoutesCondition\ConditionalRoutesCondition;
use Ivoz\Provider\Domain\Model\ConditionalRoutesCondition\ConditionalRoutesConditionDto;

class IvozProvider_Klear_Ghost_ConditionalRoutes extends KlearMatrix_Model_Field_Ghost_Abstract
{
    /**
     * @param $model ConditionalRoutesConditionDto
     * @return string concatenated names of match data
     * @throws \Zend_Exception
     */
    public function getMatchData($model)
    {
        /** @var DataGateway $dataGateway */
        $dataGateway = \Zend_Registry::get('data_gateway');

        return $dataGateway->remoteProcedureCall(
            ConditionalRoutesCondition::class,
            $model->getId(),
            'getMatchData',
            []
        );
    }
}
