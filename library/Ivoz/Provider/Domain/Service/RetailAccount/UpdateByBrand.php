<?php
namespace Ivoz\Provider\Domain\Service\RetailAccount;

use Ivoz\Core\Domain\Service\EntityPersisterInterface;
use Doctrine\ORM\EntityManagerInterface;
use Ivoz\Provider\Domain\Model\Brand\BrandInterface;
use Ivoz\Provider\Domain\Model\RetailAccount\RetailAccountDTO;
use Ivoz\Provider\Domain\Service\Brand\BrandLifecycleEventHandlerInterface;

class UpdateByBrand implements BrandLifecycleEventHandlerInterface
{
    /**
     * @var EntityPersisterInterface
     */
    protected $entityPersister;

    /**
     * @var UpdateEntityFromDTO
     */
    protected $entityUpdater;

    public function __construct(
        EntityManagerInterface $em,
        EntityPersisterInterface $entityPersister
    ) {
        $this->entityPersister = $entityPersister;
    }

    public function execute(BrandInterface $entity, $isNew)
    {
        if (!$entity->hasChanged('domainUsers')) {
            return;
        }

        $retails = $entity->getRetailAccounts();
        foreach ($retails as $retail) {

            /**
             * @var RetailAccountDTO
             */
            $retailDto = $retail->toDto();

            $retailDto->setDomain(
                $entity->getDomainUsers()
            );

            $this->entityPersister->persistDto($retailDto, $retail);
        }
    }
}