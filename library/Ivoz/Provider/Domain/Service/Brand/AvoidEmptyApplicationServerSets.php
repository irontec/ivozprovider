<?php

namespace Ivoz\Provider\Domain\Service\Brand;

use Ivoz\Provider\Domain\Model\Brand\BrandInterface;

class AvoidEmptyApplicationServerSets implements BrandLifecycleEventHandlerInterface
{
    const PRIORITY_PRE_PERSIST = self::PRIORITY_NORMAL;

    /** @return array<string, int> */
    public static function getSubscribedEvents(): array
    {
        return [
            self::EVENT_PRE_PERSIST => self::PRIORITY_PRE_PERSIST,
        ];
    }

    public function execute(BrandInterface $brand): void
    {
        $relApplicationServerSets = $brand->getRelApplicationServerSets();

        if (!empty($relApplicationServerSets)) {
            return;
        }

        throw new \DomainException(
            'Application Server Sets cannot be empty'
        );
    }
}
