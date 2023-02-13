<?php

namespace Ivoz\Provider\Domain\Service\AdministratorRelPublicEntity;

use Ivoz\Core\Domain\Service\EntityTools;
use Ivoz\Provider\Domain\Model\Administrator\AdministratorInterface;
use Ivoz\Provider\Domain\Model\AdministratorRelPublicEntity\AdministratorRelPublicEntityRepository;
use Ivoz\Provider\Domain\Service\Administrator\AdministratorLifecycleEventHandlerInterface;

final class RemoveAcls implements AdministratorLifecycleEventHandlerInterface
{
    public const POST_PERSIST_PRIORITY = self::PRIORITY_NORMAL;

    public function __construct(
        private AdministratorRelPublicEntityRepository $administratorRelPublicEntityRepository,
    ) {
    }

    public static function getSubscribedEvents()
    {
        return [
            self::EVENT_POST_PERSIST => self::POST_PERSIST_PRIORITY
        ];
    }

    /**
     * @return void
     */
    public function execute(AdministratorInterface $admin)
    {
        $mustDeleteAcls =
            !$admin->getRestricted()
            && $admin->hasChanged('restricted');

        $nothingToDo = !$mustDeleteAcls;
        if ($nothingToDo) {
            return;
        }

        $this
            ->administratorRelPublicEntityRepository
            ->removeByAdministratorId(
                (int) $admin->getId()
            );
    }
}
