<?php

namespace Ivoz\Provider\Domain\Service\ApplicationServerSet;

use Ivoz\Core\Domain\Service\EntityTools;
use Ivoz\Provider\Domain\Model\ApplicationServerSet\ApplicationServerSetInterface;

class UpdateProtection implements ApplicationServerSetLifecycleEventHandlerInterface
{
    public const PRE_PERSIST_PRIORITY = self::PRIORITY_NORMAL;

    /**
     * @return array<string, int>
     */
    public static function getSubscribedEvents()
    {
        return [
            self::EVENT_PRE_PERSIST => self::PRE_PERSIST_PRIORITY,
        ];
    }

    public function execute(ApplicationServerSetInterface $applicationServerSet): void
    {
        if ($applicationServerSet->isNew()) {
            return;
        }

        $isDefaultSet = $applicationServerSet->getId() === 0;
        if (!$isDefaultSet) {
            return;
        }

        throw new \DomainException(
            'Default application server set shall not be updated',
            403
        );
    }
}
