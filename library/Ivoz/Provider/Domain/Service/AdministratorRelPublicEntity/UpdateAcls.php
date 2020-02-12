<?php

namespace Ivoz\Provider\Domain\Service\AdministratorRelPublicEntity;

use Ivoz\Core\Application\Service\EntityTools;
use Ivoz\Provider\Domain\Model\Administrator\AdministratorInterface;
use Ivoz\Provider\Domain\Model\AdministratorRelPublicEntity\AdministratorRelPublicEntityRepository;
use Ivoz\Provider\Domain\Service\Administrator\AdministratorLifecycleEventHandlerInterface;

final class UpdateAcls implements AdministratorLifecycleEventHandlerInterface
{
    const POST_PERSIST_PRIORITY = self::PRIORITY_NORMAL;

    private $administratorRelPublicEntityRepository;
    private $entityTools;

    public function __construct(
        AdministratorRelPublicEntityRepository $administratorRelPublicEntityRepository,
        EntityTools $entityTools
    ) {
        $this->administratorRelPublicEntityRepository = $administratorRelPublicEntityRepository;
        $this->entityTools = $entityTools;
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
        $isNew = $admin->isNew();
        if ($isNew) {
            return;
        }

        $restrictedHasNotChanged = !$admin->hasChanged(
            'restricted'
        );

        if ($restrictedHasNotChanged) {
            return;
        }

        $isRestricted = $admin->getRestricted();

        if ($isRestricted) {
            $this
                ->administratorRelPublicEntityRepository
                ->setReadOnlyPermissions(
                    $admin
                );

            return;
        }

        $this
            ->administratorRelPublicEntityRepository
            ->setWritePermissions(
                $admin
            );
    }
}
