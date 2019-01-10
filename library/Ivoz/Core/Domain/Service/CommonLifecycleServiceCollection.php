<?php

namespace Ivoz\Core\Domain\Service;

use Ivoz\Core\Domain\Model\EntityInterface;

class CommonLifecycleServiceCollection implements LifecycleServiceCollectionInterface
{
    use LifecycleServiceCollectionTrait;

    public function setServices(array $services)
    {
        foreach ($services as $service) {
            $this->addService($service);
        }
    }

    protected function addService(CommonLifecycleEventHandlerInterface $service)
    {
        $this->services[] = $service;
    }

    /**
     * @param EntityInterface $entity
     */
    public function execute(EntityInterface $entity)
    {
        foreach ($this->services as $service) {
            $service->handle($entity);
        }
    }
}
