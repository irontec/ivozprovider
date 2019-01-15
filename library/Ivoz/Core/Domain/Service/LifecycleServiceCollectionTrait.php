<?php

namespace Ivoz\Core\Domain\Service;

use Ivoz\Core\Domain\Model\EntityInterface;
use Psr\Log\LoggerInterface;

trait LifecycleServiceCollectionTrait
{
    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * @var array
     */
    protected $services = [];

    public function __construct(
        LoggerInterface $logger
    ) {
        $this->logger = $logger;
    }

    public function setServices(array $services)
    {
        foreach ($services as $service) {
            $this->addService($service);
        }
    }

    abstract protected function addService($service);

    /**
     * @param EntityInterface $entity
     */
    public function execute(EntityInterface $entity)
    {
        foreach ($this->services as $service) {
            $this->logger->debug(
                'A lifecycle service is about to be executed: ' . get_class($service)
            );
            $service->execute($entity);
        }
    }
}
