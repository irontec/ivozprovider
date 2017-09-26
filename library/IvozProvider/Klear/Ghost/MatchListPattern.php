<?php

use Ivoz\Provider\Domain\Model\MatchListPattern\MatchListPattern;

class IvozProvider_Klear_Ghost_MatchListPattern extends KlearMatrix_Model_Field_Ghost_Abstract
{

    /**
     *
     * @param Ivoz\Provider\Domain\Model\MatchListPattern\MatchListPatternDTO $model
     * @return match value based on pattern type
     */
    public function getMatchValue($model)
    {
        switch($model->getType()) {
            case 'number':

                $dataGateway = \Zend_Registry::get('data_gateway');
                return
                    $dataGateway->remoteProcedureCall(
                        MatchListPattern::class,
                        $model->getId(),
                        'getNumberE164',
                        ['+']
                    );

            case 'regexp':
                return $model->getRegExp();
            default:
                return '';
        }
    }
}
