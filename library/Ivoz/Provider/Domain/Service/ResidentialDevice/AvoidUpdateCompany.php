<?php

namespace Ivoz\Provider\Domain\Service\ResidentialDevice;

use Ivoz\Core\Domain\Assert\Assertion;
use Ivoz\Provider\Domain\Model\ResidentialDevice\ResidentialDeviceInterface;
use Ivoz\Provider\Domain\Service\ResidentialDevice\ResidentialDeviceLifecycleEventHandlerInterface;

class AvoidUpdateCompany implements ResidentialDeviceLifecycleEventHandlerInterface
{
    public const PRE_PERSIST_PRIORITY = self::PRIORITY_NORMAL;

    /**
     * @return array<string,int>
     */
    public static function getSubscribedEvents()
    {
        return [
            self::EVENT_PRE_PERSIST => self::PRE_PERSIST_PRIORITY,
        ];
    }

    public function execute(ResidentialDeviceInterface $residentialDevice): void
    {
        if ($residentialDevice->isNew()) {
            return;
        }

        Assertion::false(
            $residentialDevice->hasChanged('companyId')
        );
    }
}
