<?php

namespace Ivoz\Provider\Domain\Service\Extension;

use Ivoz\Provider\Domain\Model\User\UserInterface;
use Ivoz\Provider\Domain\Service\User\UserLifecycleEventHandlerInterface;

/**
 * Class UpdateByUser
 * @package Ivoz\Provider\Domain\Service\Extension
 */
class UpdateByUser implements UserLifecycleEventHandlerInterface
{
    const POST_PERSIST_PRIORITY = 20;
    const POST_REMOVE_PRIORITY = 10;

    public function __construct() {}

    public static function getSubscribedEvents()
    {
        return [
            self::EVENT_POST_PERSIST => self::POST_PERSIST_PRIORITY,
            self::EVENT_POST_REMOVE => self::POST_REMOVE_PRIORITY,
        ];
    }

    public function execute(UserInterface $user, $isNew)
    {
        $removed = ($user->hasChanged('id') && !$user->getId());
        if ($removed) {
            $this->cleanUpExtension($user);
            return;
        }

        $hasChangedExtension = $user->hasChanged("extensionId");
        if (!$hasChangedExtension) {
            return;
        }

        // If extension has changed, update extension user

        $extension = $user->getExtension();
        if ($extension) {
            $extension
                ->setRouteType('user')
                ->setUser($user);
        }
    }

    private function cleanUpExtension(UserInterface $entity)
    {
        $extension = $entity->getExtension();
        if ($extension) {
            $extension
                ->setRouteType(null)
                ->setUser(null);
        }
    }
}