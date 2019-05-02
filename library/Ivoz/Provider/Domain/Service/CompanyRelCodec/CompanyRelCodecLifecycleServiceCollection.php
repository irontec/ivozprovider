<?php

namespace Ivoz\Provider\Domain\Service\CompanyRelCodec;

use Ivoz\Core\Domain\Service\LifecycleServiceCollectionInterface;
use Ivoz\Core\Domain\Service\LifecycleServiceCollectionTrait;

/**
 * @codeCoverageIgnore
 */
class CompanyRelCodecLifecycleServiceCollection implements LifecycleServiceCollectionInterface
{
    use LifecycleServiceCollectionTrait;

    /**
     * @return void
     */
    protected function addService(CompanyRelCodecLifecycleEventHandlerInterface $service)
    {
        $this->services[] = $service;
    }
}
