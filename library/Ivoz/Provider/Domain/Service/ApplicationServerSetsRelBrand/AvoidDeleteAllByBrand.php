<?php

namespace Ivoz\Provider\Domain\Service\ApplicationServerSetsRelBrand;

use Ivoz\Provider\Domain\Model\ApplicationServerSetsRelBrand\ApplicationServerSetsRelBrandInterface;

class AvoidDeleteAllByBrand implements ApplicationServerSetsRelBrandLifecycleEventHandlerInterface
{
    const PRE_REMOVE_PRIORITY = self::PRIORITY_NORMAL;

    /**
     * @return array<string, int>
     */
    public static function getSubscribedEvents(): array
    {
        return [
            self::EVENT_PRE_REMOVE => self::PRE_REMOVE_PRIORITY,
        ];
    }

    public function execute(ApplicationServerSetsRelBrandInterface $applicationServerSetsRelBrand): void
    {
        $brand = $applicationServerSetsRelBrand->getBrand();

        if (is_null($brand)) {
            return;
        }

        $isEmptyApplicationServerSets = empty($brand->getRelApplicationServerSets());
        if (!$isEmptyApplicationServerSets) {
            return;
        }

        throw new \DomainException(
            'Application Server Sets cannot be empty'
        );
    }
}
