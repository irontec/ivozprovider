<?php

namespace Ivoz\Provider\Domain\Service\Extension;

use Ivoz\Core\Application\Service\EntityTools;
use Ivoz\Provider\Domain\Model\Extension\ExtensionDto;
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

    /**
     * @var EntityTools
     */
    protected $entityTools;

    public function __construct(
        EntityTools $entityTools
    ) {
        $this->entityTools = $entityTools;
    }

    public static function getSubscribedEvents()
    {
        return [
            self::EVENT_POST_PERSIST => self::POST_PERSIST_PRIORITY,
            self::EVENT_POST_REMOVE => self::POST_REMOVE_PRIORITY,
        ];
    }

    public function execute(UserInterface $user)
    {
        $extension = $user->getExtension();
        if (!$extension) {
            return;
        }

        /** @var ExtensionDto $extensionDto */
        $extensionDto = $this->entityTools
            ->entityToDto($extension);

        $removed = ($user->hasChanged('id') && !$user->getId());
        if ($removed) {
            $extensionDto
                ->setRouteType(null)
                ->setUserId(null);

            $this->entityTools->persistDto(
                $extensionDto,
                $extension,
                false
            );
            return;
        }

        $hasChangedExtension = $user->hasChanged("extensionId");
        if (!$hasChangedExtension) {
            return;
        }

        $extensionDto
            ->setRouteType('user')
            ->setUserId($user->getId());

        $this->entityTools->persistDto(
            $extensionDto,
            $extension,
            false
        );
    }
}
