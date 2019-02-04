<?php

namespace Ivoz\Provider\Domain\Service\ProxyUser;

use Ivoz\Provider\Domain\Model\ProxyUser\ProxyUser;
use Ivoz\Provider\Domain\Model\ProxyUser\ProxyUserInterface;

/**
 * Class DeleteProtection
 */
class DeleteProtection implements ProxyUserLifecycleEventHandlerInterface
{
    const PRE_REMOVE_PRIORITY = self::PRIORITY_NORMAL;

    public static function getSubscribedEvents()
    {
        return [
            self::EVENT_PRE_REMOVE => self::PRE_REMOVE_PRIORITY
        ];
    }

    /**
     * @param ProxyUserInterface $proxyUser
     */
    public function execute(ProxyUserInterface $proxyUser)
    {
        $isMainAddress = $proxyUser->getId() == ProxyUser::MAIN_ADDRESS_ID;
        if ($isMainAddress) {
            throw new \DomainException("Main ProxyUser can not be removed.");
        }
    }
}
