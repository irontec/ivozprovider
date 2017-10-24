<?php

use \Ivoz\Provider\Domain\Model\Extension\Extension;

class IvozProvider_Klear_Ghost_RouteTarget extends KlearMatrix_Model_Field_Ghost_Abstract
{

    public function getTarget ($entity)
    {
        // Get DDI Route Type
        $routeType = $entity->getRouteType();

        switch ($routeType) {
            case 'number':
                return $entity->getNumberValueE164();
                break;

            case 'user':
                return sprintf("%s %s",
                    $entity->getUser()->getName(),
                    $entity->getUser()->getLastname()
                );
                break;

            case 'conditional':
                return $entity
                        ->getConditionalRoute()
                        ->getName();
                break;

            default:
                // Get Generic Target Type
                $targetGetter = 'get' . ucfirst($routeType);
                $targetEntity = $entity->{$targetGetter}();

                // If Target is assigned, get its name
                if ($targetEntity) {
                    return $targetEntity->getName();
                }
                break;
        }

        // Object without routable object assigned
        return null;
    }

    /**
     * @param \Ivoz\Provider\Domain\Model\Extension\ExtensionDTO $model
     * @return name of target based on route type
     */
    public function getExtensionTarget($model)
    {
        return ucfirst($model->getRouteType()) . " " . $model->get;
        $dataGateway = \Zend_Registry::get('data_gateway');


        $extension = $dataGateway->find(
            \Ivoz\Provider\Domain\Model\Extension\Extension::class,
            $model->getId()
        );


        return $this->getTarget($extension);
    }
}
