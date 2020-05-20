<?php

namespace Ivoz\Provider\Domain\Service\User;

use Ivoz\Core\Application\Service\EntityTools;
use Ivoz\Provider\Domain\Model\Extension\ExtensionDto;
use Ivoz\Provider\Domain\Model\Extension\ExtensionInterface;
use Ivoz\Provider\Domain\Model\User\User;
use Ivoz\Provider\Domain\Model\User\UserDto;
use Ivoz\Provider\Domain\Model\User\UserInterface;
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
     * @var EntityTools
     */
    protected $entityTools;

    public function __construct(
        UserRepository $userRepository,
        EntityTools $entityTools
    ) {
        $this->userRepository = $userRepository;
        $this->entityTools = $entityTools;
    }

    public static function getSubscribedEvents()
    {
        return [
            self::EVENT_POST_PERSIST => 10
        ];
    }

    /**
     * @throws \Exception
     *
     * @return void
     */
    public function execute(ExtensionInterface $extension)
    {
        $changedUserId = $extension->hasChanged('userId');

        if (!$changedUserId) {
            return;
        }

        $currentValue = $extension->getUser()
            ? $extension->getUser()->getId()
            : null;

        $originalValue = $extension->getInitialValue('userId');

        // If this extension was pointing to a user and number has changed
        if ($originalValue && ($originalValue != $currentValue)) {
            /**
             * @var UserInterface | null $prevUser
             */
            $prevUser = $this->userRepository->find($originalValue);

            if (!$prevUser) {
                // User has been removed
                return;
            }

            /** @var UserDto $prevUserDto */
            $prevUserDto = $this
                ->entityTools
                ->entityToDto(
                    $prevUser
                );

            $prevUserDto
                ->setExtension(null);

            $this->entityTools
                ->persistDto(
                    $prevUserDto,
                    $prevUser,
                    false
                );
        }

        $routeType = $extension->getRouteType();

        // If there is a new user and new user has no extension
        if ($routeType === 'user') {
            $user = $extension->getUser();
            $userExtension = $user->getExtension();

            if ($user && !$userExtension) {
                // Set this as its screen extension
                /** @var UserDto $userDto */
                $userDto = $this
                    ->entityTools
                    ->entityToDto($user);

                /** @var ExtensionDto  $extensionDto */
                $extensionDto = $this
                    ->entityTools
                    ->entityToDto(
                        $extension
                    );

                $userDto
                    ->setExtension($extensionDto);

                $this
                    ->entityTools
                    ->persistDto(
                        $userDto,
                        $user,
                        false
                    );
            }
        }
    }
}
