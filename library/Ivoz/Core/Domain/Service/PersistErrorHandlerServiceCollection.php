<?php

namespace Ivoz\Core\Domain\Service;

class PersistErrorHandlerServiceCollection
{
    /**
     * @var array
     */
    protected $services = [];

    /**
     * @return void
     */
    public function setServices(array $services)
    {
        foreach ($services as $service) {
            $this->addService($service);
        }
    }

    /**
     * @return void
     */
    protected function addService(PersistErrorHandlerInterface $service)
    {
        $this->services[] = $service;
    }

    /**
     * @return void
     */
    public function execute(\Exception $exception)
    {
        foreach ($this->services as $service) {
            $service->handle($exception);
        }
    }
}
