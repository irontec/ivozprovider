<?php

namespace Ivoz\Cgr\Domain\Service\TpLcrRule;

use Ivoz\Core\Domain\Service\LifecycleServiceCollectionInterface;
use Ivoz\Core\Domain\Service\LifecycleServiceCollectionTrait;

/**
 * @codeCoverageIgnore
 */
class TpLcrRuleLifecycleServiceCollection implements LifecycleServiceCollectionInterface
{
    use LifecycleServiceCollectionTrait;

    /**
     * @return void
     */
    protected function addService(TpLcrRuleLifecycleEventHandlerInterface $service)
    {
        $this->services[] = $service;
    }
}
