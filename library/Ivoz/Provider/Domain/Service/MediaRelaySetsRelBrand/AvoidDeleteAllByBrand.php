<?php

namespace Ivoz\Provider\Domain\Service\MediaRelaySetsRelBrand;

use Ivoz\Provider\Domain\Model\MediaRelaySet\MediaRelaySetInterface;
use Ivoz\Provider\Domain\Model\MediaRelaySetsRelBrand\MediaRelaySetsRelBrand;
use Ivoz\Provider\Domain\Model\MediaRelaySetsRelBrand\MediaRelaySetsRelBrandInterface;
use Ivoz\Provider\Domain\Service\MediaRelaySetsRelBrand\MediaRelaySetsRelBrandHandlerInterface;

class AvoidDeleteAllByBrand implements MediaRelaySetsRelBrandHandlerInterface
{
    const PRE_REMOVE_PRIORITY = self::PRIORITY_NORMAL;

    /**
     * @return array<string, int>
     */
    public static function getSubscribedEvents(): array
    {
        return [
            self::EVENT_PRE_REMOVE => self::PRIORITY_NORMAL
        ];
    }

    public function execute(MediaRelaySetsRelBrandInterface $mediaRelaySetsRelBrand): void
    {
        $brand = $mediaRelaySetsRelBrand->getBrand();

        if (is_null($brand)) {
            return;
        }

        $isEmptyMediaRelaySets = empty($brand->getRelMediaRelaySets());
        if (!$isEmptyMediaRelaySets) {
            return;
        }

        throw new \DomainException(
            'Brand cannot be left without a corresponding Media Relay Set'
        );
    }
}
