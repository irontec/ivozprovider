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
        $this->initServices();
    }

    /**
     * @return void
     */

    private function initServices()
    {
        $this->services = [];
        foreach (LifecycleEventHandlerInterface::EVENT_TYPES as $type) {
            $this->services[$type] = [];
        }
    }

    public function setServices(string $event, array $services)
    {
        if (!in_array($event, LifecycleEventHandlerInterface::EVENT_TYPES, true)) {
            throw new \Exception(
                'Unknown lifecycle event ' . $event
            );
        }

        $this->services[$event] = [];
        $isErrorHandler = $event ===  LifecycleEventHandlerInterface::EVENT_ON_ERROR;

        foreach ($services as $service) {
            if ($isErrorHandler) {
                $this->addErrorhandler($service);
                return;
            }

            $this->addService($event, $service);
        }
    }

    abstract protected function addService(string $event, $service);

    /**
     * @return void
     */
    protected function addErrorhandler(PersistErrorHandlerInterface $service)
    {
        $event = LifecycleEventHandlerInterface::EVENT_ON_ERROR;
        $this->services[$event][] = $service;
    }

    public function execute(string $event, EntityInterface $entity)
    {
        $services = $this->services[$event] ?? [];
        foreach ($services as $service) {
            $this->logger->debug(
                'A lifecycle service is about to be executed: ' . get_class($service)
            );
            $service->execute($entity);
        }
    }

    /**
     * @param \Exception $exception
     * @throws \Exception $exception
     * @return void
     */
    public function handle(\Exception $exception)
    {
        $event = CommonLifecycleEventHandlerInterface::EVENT_ON_ERROR;
        foreach ($this->services[$event] as $service) {
            $service->handle($exception);
        }
    }
}
