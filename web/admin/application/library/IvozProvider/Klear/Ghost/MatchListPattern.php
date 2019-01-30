<?php

use Ivoz\Provider\Domain\Model\MatchListPattern\MatchListPattern;
use Ivoz\Provider\Domain\Model\MatchListPattern\MatchListPatternDto;

class IvozProvider_Klear_Ghost_MatchListPattern extends KlearMatrix_Model_Field_Ghost_Abstract
{
    /**
     * @param MatchListPatternDto $model
     * @return string Match value based on pattern type
     * @throws Zend_Exception
     */
    public function getMatchValue($model)
    {
        switch ($model->getType()) {
            case 'number':
                $dataGateway = \Zend_Registry::get('data_gateway');

                return
                    $dataGateway->remoteProcedureCall(
                        MatchListPattern::class,
                        $model->getId(),
                        'getNumberE164',
                        []
                    );

            case 'regexp':
                return $model->getRegExp();
            default:
                return '';
        }
    }
}
