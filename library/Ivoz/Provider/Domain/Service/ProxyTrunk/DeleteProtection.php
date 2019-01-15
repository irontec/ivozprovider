<?php

namespace Ivoz\Provider\Domain\Service\ProxyTrunk;

use Ivoz\Provider\Domain\Model\ProxyTrunk\ProxyTrunk;
use Ivoz\Provider\Domain\Model\ProxyTrunk\ProxyTrunkInterface;

/**
 * Class DeleteProtection
 */
class DeleteProtection implements ProxyTrunkLifecycleEventHandlerInterface
{
    const PRE_REMOVE_PRIORITY = self::PRIORITY_NORMAL;

    public static function getSubscribedEvents()
    {
        return [
            self::EVENT_PRE_REMOVE => self::PRE_REMOVE_PRIORITY
        ];
    }

    /**
     * @param ProxyTrunkInterface $proxyTrunk
     */
    public function execute(ProxyTrunkInterface $proxyTrunk)
    {
        $isMainAddress = $proxyTrunk->getId() == ProxyTrunk::MAIN_ADDRESS_ID;
        if ($isMainAddress) {
            throw new \DomainException("Main ProxyTrunk can not be removed.");
        }
    }
}
