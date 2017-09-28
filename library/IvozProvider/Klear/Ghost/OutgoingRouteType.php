<?php

class IvozProvider_Klear_Ghost_OutgoingRouteType extends KlearMatrix_Model_Field_Ghost_Abstract
{
    /**
     *
     * @param $model OutgoingRoute
     * @return name of target based on outgoing route type
     */
    public function getData ($model)
    {
        $outgoingRouteType = $model->getType();
        $dataGateway = \Zend_Registry::get('data_gateway');

        if ($outgoingRouteType == 'group') {

            /**
             * @var \Ivoz\Provider\Domain\Model\RoutingPatternGroup\RoutingPatternGroup $routingPatternGroup
             */
            $routingPatternGroup = $dataGateway->find(
                'Ivoz\\Provider\\Domain\\Model\\RoutingPatternGroup\\RoutingPatternGroup',
                $model->getRoutingPatternGroupId()
            );

            return $routingPatternGroup->getName();

        } elseif ($outgoingRouteType == 'pattern') {

            /**
             * @var \Ivoz\Provider\Domain\Model\RoutingPattern\RoutingPatternDTO $routingPattern
             */
            $routingPattern = $dataGateway->find(
                'Ivoz\\Provider\\Domain\\Model\\RoutingPattern\\RoutingPattern',
                $model->getRoutingPatternId()
            );

            $currentLanguage = Zend_Registry::get('defaultLang');
            $nameGetter = 'getName' . $currentLanguage;

            return $routingPattern->{$nameGetter}();
        }

        return null;
    }
}
