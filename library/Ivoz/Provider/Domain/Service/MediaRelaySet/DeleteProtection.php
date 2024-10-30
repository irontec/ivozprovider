<?php

namespace Ivoz\Provider\Domain\Service\MediaRelaySet;

use Ivoz\Provider\Domain\Model\MediaRelaySet\MediaRelaySet;
use Ivoz\Provider\Domain\Model\MediaRelaySet\MediaRelaySetInterface;

class DeleteProtection implements MediaRelaySetHandlerInterface
{
    const PRE_REMOVE_PRIORITY = self::PRIORITY_NORMAL;

    /** @return array<string, int> */
    public static function getSubscribedEvents(): array
    {
        return [
            self::EVENT_PRE_REMOVE => self::PRE_REMOVE_PRIORITY,
        ];
    }

    public function execute(MediaRelaySetInterface $mediaRelaySet): void
    {
        if ($mediaRelaySet->getId() !== MediaRelaySet::DEFAULT_MEDIA_RELAY_SET) {
            return;
        }

        throw new \DomainException(
            'Default media relay set cannot be deleted',
            403,
        );
    }
}
