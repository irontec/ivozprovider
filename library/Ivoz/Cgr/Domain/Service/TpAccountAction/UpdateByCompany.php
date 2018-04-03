<?php

namespace Ivoz\Cgr\Domain\Service\TpAccountAction;

use Ivoz\Cgr\Domain\Model\TpAccountAction\TpAccountAction;
use Ivoz\Cgr\Infrastructure\Persistence\Doctrine\TpAccountActionDoctrineRepository;
use Ivoz\Core\Domain\Service\EntityPersisterInterface;
use Ivoz\Provider\Domain\Model\Company\CompanyDTO;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use Ivoz\Provider\Domain\Service\Company\CompanyLifecycleEventHandlerInterface;

class UpdateByCompany implements CompanyLifecycleEventHandlerInterface
{
    /**
     * @var EntityPersisterInterface
     */
    protected $entityPersister;

    /**
     * @var TpAccountActionDoctrineRepository
     */
    protected $tpAccountActionRepository;

    /**
     * UpdateByDestinationTpAccountAction constructor.
     * @param EntityPersisterInterface $entityPersister
     * @param TpAccountActionDoctrineRepository $tpAccountActionRepository
     */
    public function __construct(
        EntityPersisterInterface $entityPersister,
        TpAccountActionDoctrineRepository $tpAccountActionRepository
    ) {
        $this->entityPersister = $entityPersister;
        $this->tpAccountActionRepository = $tpAccountActionRepository;
    }

    public function execute(CompanyInterface $entity, $isNew)
    {
        if (!$isNew) {
            return;
        }

        /** @var CompanyDTO $entityDto */
        $entityDto = $entity->toDTO();

        // Find associated account for company
        $accountAction = $this->tpAccountActionRepository->findOneBy([
            'company' => $entity->getId()
        ]);

        $accountActionDto = is_null($accountAction)
            ? TpAccountAction::createDTO()
            : $accountAction->toDTO();

        // Fill all rating plan fields
        $accountActionDto
            ->setCompanyId($entityDto->getId())
            ->setTenant(sprintf("b%d", $entityDto->getBrandId()))
            ->setAccount(sprintf("c%d", $entityDto->getId()));

        $this->entityPersister->persistDto($accountActionDto, $accountAction);
    }
}
