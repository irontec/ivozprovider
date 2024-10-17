<?php

namespace Ivoz\Provider\Domain\Service\Brand;

use Ivoz\Provider\Domain\Model\Brand\BrandInterface;

class AvoidEmptyMediaRelaySets implements BrandLifecycleEventHandlerInterface
{
    const PRIORITY_PRE_PERSIST = self::PRIORITY_NORMAL;

    /** @return array<string, int> */
    public static function getSubscribedEvents()
    {
        return [
            self::EVENT_PRE_PERSIST => self::PRIORITY_PRE_PERSIST       ,
        ];
    }

    public function execute(BrandInterface $brand): void
    {
        $relMediaRelaySets = $brand->getRelMediaRelaySets();

        $isEmptyMediaRelaySets = empty($relMediaRelaySets);
        if (!$isEmptyMediaRelaySets) {
            return;
        }

        throw new \DomainException(
            'Media Relay Sets cannot be empty'
        );
    }
}
