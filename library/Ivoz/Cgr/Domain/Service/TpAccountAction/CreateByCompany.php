<?php

namespace Ivoz\Cgr\Domain\Service\TpAccountAction;

use Ivoz\Cgr\Domain\Model\TpAccountAction\TpAccountAction;
use Ivoz\Core\Domain\Service\EntityPersisterInterface;
use Ivoz\Provider\Domain\Model\Company\CompanyDTO;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use Ivoz\Provider\Domain\Service\Company\CompanyLifecycleEventHandlerInterface;

class CreateByCompany implements CompanyLifecycleEventHandlerInterface
{
    /**
     * @var EntityPersisterInterface
     */
    protected $entityPersister;

    /**
     * UpdateByDestinationTpAccountAction constructor.
     * @param EntityPersisterInterface $entityPersister
     */
    public function __construct(
        EntityPersisterInterface $entityPersister
    ) {
        $this->entityPersister = $entityPersister;
    }

    public static function getSubscribedEvents()
    {
        return [
            self::EVENT_POST_PERSIST => 20
        ];
    }

    public function execute(CompanyInterface $entity, $isNew)
    {
        if (!$isNew) {
            return;
        }

        /** @var CompanyDTO $entityDto */
        $entityDto = $entity->toDTO();

        $accountActionDto = TpAccountAction::createDTO();

        // Fill all rating plan fields
        $accountActionDto
            ->setCompanyId($entityDto->getId())
            ->setTenant(sprintf("b%d", $entityDto->getBrandId()))
            ->setAccount(sprintf("c%d", $entityDto->getId()));

        $this->entityPersister->persistDto($accountActionDto, null);
    }
}
