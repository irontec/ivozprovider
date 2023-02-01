<?php

namespace Ivoz\Provider\Domain\Service\Company;

use Ivoz\Core\Domain\Assert\Assertion;
use Ivoz\Core\Domain\Service\DomainEventSubscriberInterface;
use Ivoz\Core\Domain\Service\LifecycleEventHandlerInterface;
use Ivoz\Core\Domain\Service\LifecycleServiceCollectionInterface;
use Ivoz\Core\Domain\Service\LifecycleServiceCollectionTrait;

/**
 * @codeCoverageIgnore
 */
class CompanyLifecycleServiceCollection implements LifecycleServiceCollectionInterface
{
    use LifecycleServiceCollectionTrait;

    /** @var array<array-key, array> $bindedBaseServices */
    public static $bindedBaseServices = [
        "pre_persist" =>
        [
            \Ivoz\Provider\Domain\Service\Company\SanitizeEmptyValues::class => 10,
            \Ivoz\Provider\Domain\Service\Company\SanitizeBillingMethod::class => 200,
        ],
        "post_persist" =>
        [
            \Ivoz\Provider\Domain\Service\Domain\UpdateByCompany::class => 10,
            \Ivoz\Provider\Domain\Service\MaxUsageNotification\SearchBrokenMaxDailyUsage::class => 10,
            \Ivoz\Cgr\Domain\Service\TpAccountAction\CreateByCompany::class => 20,
            \Ivoz\Provider\Domain\Service\CompanyService\PropagateBrandServices::class => 30,
            \Ivoz\Provider\Domain\Service\Administrator\CreatedByCompany::class => 200,
        ],
        "post_remove" =>
        [
            \Ivoz\Provider\Domain\Service\Domain\DeleteByCompany::class => 10,
        ],
        "on_commit" =>
        [
            \Ivoz\Provider\Domain\Service\Company\SearchBrokenThresholds::class => 10,
            \Ivoz\Provider\Domain\Service\Company\SendCgratesUpdateRequest::class => 200,
            \Ivoz\Provider\Domain\Service\Company\SendUsersAddressPermissionsReloadRequest::class => 200,
            \Ivoz\Provider\Domain\Service\Company\SendUsersTrustedPermissionsReloadRequest::class => 200,
        ],
    ];

    protected function addService(string $event, LifecycleEventHandlerInterface|DomainEventSubscriberInterface $service): void
    {
        Assertion::isInstanceOf($service, CompanyLifecycleEventHandlerInterface::class);
        $this->services[$event][] = $service;
    }
}
