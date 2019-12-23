<?php

namespace Ivoz\Core\Domain\Service;

use Ivoz\Core\Domain\Model\EntityInterface;

interface LifecycleServiceCollectionInterface
{
    public function setServices(string $event, array $services);

    /**
     * @param string $event
     * @param EntityInterface $entity
     * @return mixed
     */
    public function execute(string $event, EntityInterface $entity);

    /**
     * @param \Exception $exception
     * @throws \Exception $exception
     * @return void
     */
    public function handle(\Throwable $exception);
}
