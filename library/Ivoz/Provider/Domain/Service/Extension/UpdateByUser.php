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
    public function __construct() {}

    public static function getSubscribedEvents()
    {
        return [
            self::EVENT_POST_PERSIST => 20
        ];
    }

    public function execute(UserInterface $entity, $isNew)
    {
        $hasChangedExtension = $entity->hasChanged("extensionId");
        if (!$hasChangedExtension) {
            return;
        }

        // If extension has changed, update extension user

        $extension = $entity->getExtension();
        if ($extension) {
            $extension
                ->setRouteType('user')
                ->setUser($entity);
        }
    }
}