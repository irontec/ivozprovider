<?php

use \Ivoz\Provider\Domain\Model\User\UserDTO;

class IvozProvider_Klear_Ghost_DDITarget extends KlearMatrix_Model_Field_Ghost_Abstract
{

    /**
     * @param \Ivoz\Domain\Model\Extension\ExtensionDTO $model
     * @return name of target based on DDI type
     */
    public function getData ($model)
    {

        // Get DDI Route Type
        $routeType = $model->getRouteType();

        // We already have the route destination
        if ($routeType == 'number') {
            return $model->getNumberValue();
        } else if ($routeType == 'friend') {
            return $model->getFriendValue();
        } else if ($routeType == 'conditional') {
            $routeType = 'conditionalRoute';
        }

        if ($routeType) {
            // Get Target Type
            $targetGetter = 'get' . ucfirst($routeType) . 'Id';
            $target = $model->{$targetGetter}();

            // If Target is assigned, get its name
            if ($target) {

                $dataGateway = \Zend_Registry::get('data_gateway');
                $entityClass = ucfirst($routeType);


                $targetEntity = $dataGateway->find(
                    "Ivoz\\Provider\\Domain\\Model\\$entityClass\\$entityClass",
                    $target
                );

                if ($targetEntity instanceof UserDTO) {
                    return $targetEntity->getName() . ' ' . $targetEntity->getLastname();
                }

                return $targetEntity->getName();
            }
        }

        // DDI without route or target assigned
        return null;
    }
}
