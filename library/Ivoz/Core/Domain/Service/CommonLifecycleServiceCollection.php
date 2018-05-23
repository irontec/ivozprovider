<?php

namespace Ivoz\Core\Domain\Service;

use Ivoz\Core\Domain\Model\EntityInterface;

class CommonLifecycleServiceCollection implements LifecycleServiceCollectionInterface
{
    use LifecycleServiceCollectionTrait;

    /**
     * @var array
     */
    protected $services;

    public function __construct() {
        $this->services = array();
    }

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
    public function execute(EntityInterface $entity, $isNew)
    {
        foreach ($this->services as $service) {
            $service->handle($entity, $isNew);
        }
    }
}