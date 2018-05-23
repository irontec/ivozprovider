<?php

namespace Ivoz\Provider\Domain\Service\User;

use Ivoz\Core\Domain\Service\EntityPersisterInterface;
use Ivoz\Provider\Domain\Model\Extension\ExtensionInterface;
use Ivoz\Provider\Domain\Model\User\User;
use Ivoz\Provider\Domain\Model\User\UserRepository;
use Ivoz\Provider\Domain\Service\Extension\ExtensionLifecycleEventHandlerInterface;

/**
 * Class SanitizeExtension
 * @package Ivoz\Provider\Domain\Service\User
 * @lifecycle pre_persist
 */
class UpdateByExtension implements ExtensionLifecycleEventHandlerInterface
{
    /**
     * @var UserRepository
     */
    protected $userRepository;

    /**
     * @var EntityPersisterInterface
     */
    protected $entityPersister;

    public function __construct(
        UserRepository $userRepository,
        EntityPersisterInterface $entityPersister
    ) {
        $this->userRepository = $userRepository;
        $this->entityPersister = $entityPersister;
    }

    public static function getSubscribedEvents()
    {
        return [
            self::EVENT_POST_PERSIST => 10
        ];
    }

    /**
     * @throws \Exception
     */
    public function execute(ExtensionInterface $entity, $isNew)
    {
        $changedUserId = $entity->hasChanged('userId');

        if (!$changedUserId) {
            return;
        }

        $currentValue = $entity->getUser()
            ? $entity->getUser()->getId()
            : null;

        $originalValue = $entity->getInitialValue('userId');

        // If this extension was pointing to a user and number has changed
        if ($originalValue && ($originalValue != $currentValue)) {
            /**
             * @var User $prevUser
             */
            $prevUser = $this->userRepository->findOneBy([
                'id' => $originalValue
            ]);

            $prevUser->setExtension(null);
        }

        $routeType = $entity->getRouteType();

        // If there is a new user and new user has no extension
        if ($routeType === 'user') {
            /**
             * @var User $user
             */
            $user = $entity->getUser();
            $userExtension = $user->getExtension();

            if ($user && !$userExtension) {
                // Set this as its screen extension
                $user->setExtension($entity);
                $this
                    ->entityPersister
                    ->persist($user);
            }
        }
    }
}
