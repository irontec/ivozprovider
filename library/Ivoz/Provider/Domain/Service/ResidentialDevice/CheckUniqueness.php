<?php

namespace Ivoz\Provider\Domain\Service\ResidentialDevice;

use Ivoz\Provider\Domain\Model\ResidentialDevice\ResidentialDeviceInterface;
use Ivoz\Provider\Domain\Model\RetailAccount\RetailAccountRepository;

/**
 * Class CheckUniqueness
 * @package Ivoz\Provider\Domain\Service\ResidentialDevice
 */
class CheckUniqueness implements ResidentialDeviceLifecycleEventHandlerInterface
{
    public const PRE_PERSIST_PRIORITY = self::PRIORITY_NORMAL;

    public function __construct(
        private RetailAccountRepository $retailAccountRepository
    ) {
    }

    public static function getSubscribedEvents()
    {
        return [
            self::EVENT_PRE_PERSIST => self::PRE_PERSIST_PRIORITY
        ];
    }

    /**
     * Check username and domain is unique in the whole platform
     *
     * @param ResidentialDeviceInterface $residentialDevice
     *
     * @return void
     */
    public function execute(ResidentialDeviceInterface $residentialDevice)
    {
        $retailAccount = $this->retailAccountRepository
            ->findOneByNameAndDomain(
                $residentialDevice->getName(),
                $residentialDevice->getDomain()
            );

        if ($retailAccount) {
            throw new \DomainException("There is already a retail account with that name.", 30005);
        }
    }
}
