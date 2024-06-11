<?php

namespace Ivoz\Provider\Domain\Service\RetailAccount;

use Ivoz\Core\Domain\Assert\Assertion;
use Ivoz\Provider\Domain\Model\RetailAccount\RetailAccountInterface;
use Ivoz\Provider\Domain\Service\RetailAccount\RetailAccountLifecycleEventHandlerInterface;

class AvoidUpdateCompany implements RetailAccountLifecycleEventHandlerInterface
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

    public function execute(RetailAccountInterface $retailAccount): void
    {
        if ($retailAccount->isNew()) {
            return;
        }

        Assertion::false(
            $retailAccount->hasChanged('companyId')
        );
    }
}
