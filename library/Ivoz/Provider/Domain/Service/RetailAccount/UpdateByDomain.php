<?php
namespace Ivoz\Provider\Domain\Service\RetailAccount;

use Ivoz\Core\Domain\Service\EntityPersisterInterface;
use Ivoz\Provider\Domain\Model\Domain\DomainInterface;
use Ivoz\Provider\Domain\Model\RetailAccount\RetailAccountInterface;
use Ivoz\Provider\Domain\Service\Domain\DomainLifecycleEventHandlerInterface;

class UpdateByDomain implements DomainLifecycleEventHandlerInterface
{
    /**
     * @var EntityPersisterInterface
     */
    protected $entityPersister;

    public function __construct(
        EntityPersisterInterface $entityPersister
    ) {
        $this->entityPersister = $entityPersister;
    }

    public function execute(DomainInterface $entity)
    {
        // Only do this for Brand Domains
        $brand = $entity->getBrand();
        if (!$brand) {
            return;
        }

        /** @var RetailAccountInterface[] $retails */
        $retails = $brand->getRetailAccounts();
        foreach ($retails as $retail) {
            $retail->setDomain($entity->getDomain());
            $this->entityPersister->persist($retail);
        }

    }
}
