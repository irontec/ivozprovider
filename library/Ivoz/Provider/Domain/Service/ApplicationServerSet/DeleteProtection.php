<?php

namespace Ivoz\Provider\Domain\Service\ApplicationServerSet;

use Ivoz\Provider\Domain\Model\ApplicationServerSet\ApplicationServerSetInterface;

class DeleteProtection implements ApplicationServerSetLifecycleEventHandlerInterface
{
    public const PRE_REMOVE_PRIORITY = self::PRIORITY_NORMAL;

    /**
     * @return array<string, int>
     */
    public static function getSubscribedEvents()
    {
        return [
            self::EVENT_PRE_REMOVE => self::PRE_REMOVE_PRIORITY
        ];
    }

    public function execute(ApplicationServerSetInterface $applicationServerSet): void
    {
        $isDefaultSet = $applicationServerSet->getId() === 0;

        if (!$isDefaultSet) {
            return;
        }

        throw new \DomainException(
            'Default application server set cannot be deleted',
            403
        );
    }
}
