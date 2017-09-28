<?php

namespace Ivoz\Kam\Domain\Service\UsersDomainAttr;

use Ivoz\Core\Domain\Service\EntityPersisterInterface;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use Ivoz\Provider\Domain\Service\Company\CompanyLifecycleEventHandlerInterface;
use Ivoz\Kam\Domain\Model\UsersDomainAttr\UsersDomainAttr;

/**
 * Class UpdateByBrand
 * @package Ivoz\Kam\Domain\Service\UsersDomainAttr
 * @lifecycle post_persist
 */
class CreateByCompany implements CompanyLifecycleEventHandlerInterface
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

    public function execute(CompanyInterface $entity, $isNew)
    {
        if (!$isNew) {
            // Do nothing if this is not a new entity
            return;
        }

        // Only Create Domain Attributes if company has domain
        if ($entity->getType() !== $entity::VPBX) {
            return;
        }

        $domainAttrDto = UsersDomainAttr::createDTO();
        $brandId = $entity->getBrand()->getId();
        $domainAttrDto
            ->setDid($entity->getDomainUsers())
            ->setName('brandId')
            ->setType('0')
            ->setValue((string) $brandId);

        $this->entityPersister->persistDto($domainAttrDto);
    }
}