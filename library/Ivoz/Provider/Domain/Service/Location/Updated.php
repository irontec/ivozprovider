<?php

namespace Ivoz\Provider\Domain\Service\Location;

use Ivoz\Core\Domain\Service\EntityTools;
use Ivoz\Provider\Domain\Model\User\UserInterface;
use Ivoz\Provider\Domain\Service\User\UserLifecycleEventHandlerInterface;

class Updated implements UserLifecycleEventHandlerInterface
{
    public const POST_PERSIST_PRIORITY = self::PRIORITY_NORMAL;

    public function __construct(
        private EntityTools $entityTools
    ) {
    }

    public static function getSubscribedEvents()
    {
        return [
            self::EVENT_PRE_PERSIST => self::POST_PERSIST_PRIORITY,
        ];
    }

    /**
     * @return void
     */
    public function execute(UserInterface $user)
    {
        $location = $user->getLocation();

        
        if ($location === null) {
            $user->setUseDefaultLocation(true);
        }

    }
}
