<?php

namespace Ivoz\Provider\Domain\Service\AdministratorRelPublicEntity;

use Ivoz\Core\Domain\Service\EntityTools;
use Ivoz\Provider\Domain\Model\Administrator\AdministratorInterface;
use Ivoz\Provider\Domain\Model\AdministratorRelPublicEntity\AdministratorRelPublicEntityDto;
use Ivoz\Provider\Domain\Model\PublicEntity\PublicEntityRepository;
use Ivoz\Provider\Domain\Service\Administrator\AdministratorLifecycleEventHandlerInterface;

final class CreateAcls implements AdministratorLifecycleEventHandlerInterface
{
    public const POST_PERSIST_PRIORITY = self::PRIORITY_NORMAL;

    public function __construct(
        private PublicEntityRepository $publicEntityRepository,
        private EntityTools $entityTools
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
        $mustCreateAcls =
            $admin->getRestricted()
            && $admin->hasChanged('restricted');

        $nothingToDo = !$mustCreateAcls;
        if ($nothingToDo) {
            return;
        }

        $isClientAdmin = !is_null($admin->getCompany());
        $isBrandAdmin = !$isClientAdmin && !is_null($admin->getBrand());
        $isPlatformAdmin = !$isClientAdmin && !$isBrandAdmin;

        switch (true) {
            case $isClientAdmin:
                $publicEntities = $this
                    ->publicEntityRepository
                    ->findClientEntities();

                break;
            case $isBrandAdmin:
                $publicEntities = $this
                    ->publicEntityRepository
                    ->findBrandEntities();

                break;
            case $isPlatformAdmin:
                $publicEntities = $this
                    ->publicEntityRepository
                    ->findPlatformEntities();

                break;
            default:
                throw new \Exception('Unkown admin type');
        }

        $readPermissions = true;
        $writePermissions = false;

        foreach ($publicEntities as $publicEntity) {
            $dto = new AdministratorRelPublicEntityDto();
            $dto
                ->setAdministratorId(
                    $admin->getId()
                )
                ->setPublicEntityId(
                    $publicEntity->getId()
                )
                ->setCreate(
                    $writePermissions
                )
                ->setRead(
                    $readPermissions
                )
                ->setUpdate(
                    $writePermissions
                )
                ->setDelete(
                    $writePermissions
                );

            $this->entityTools->persistDto(
                $dto
            );
        }
    }
}
