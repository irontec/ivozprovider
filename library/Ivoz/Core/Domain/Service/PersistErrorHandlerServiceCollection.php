<?php

namespace Ivoz\Core\Domain\Service;

class PersistErrorHandlerServiceCollection
{
    /**
     * @var array
     */
    protected $services = [];

    public function setServices(array $services)
    {
        foreach ($services as $service) {
            $this->addService($service);
        }
    }

    protected function addService(PersistErrorHandlerInterface $service)
    {
        $this->services[] = $service;
    }

    public function execute(\Exception $exception)
    {
        foreach ($this->services as $service) {
            $service->handle($exception);
        }

        throw $exception;
    }
}
