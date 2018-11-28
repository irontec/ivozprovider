<?php

namespace Ivoz\Core\Domain\Service;

use Ivoz\Core\Domain\Model\EntityInterface;

interface LifecycleServiceCollectionInterface
{
    public function setServices(array $services);

    /**
     * @param EntityInterface $entity
     * @return mixed
     */
    public function execute(EntityInterface $entity);
}
