<?php

namespace Ivoz\Provider\Domain\Service\Domain;

use Ivoz\Core\Domain\Service\EntityPersisterInterface;
use Doctrine\ORM\EntityManagerInterface;
use Ivoz\Provider\Domain\Model\Brand\BrandInterface;
use Ivoz\Provider\Domain\Model\Domain\Domain;
use Ivoz\Provider\Domain\Model\Domain\DomainDTO;
use Ivoz\Provider\Domain\Model\Domain\DomainInterface;
use Ivoz\Provider\Domain\Model\Domain\DomainRepository;
use Ivoz\Provider\Domain\Service\Brand\BrandLifecycleEventHandlerInterface;

/**
 * Class UpdateByBrand
 * @package Ivoz\Provider\Domain\Service\Domain
 * @lifecycle post_persist
 */
class UpdateByBrand implements BrandLifecycleEventHandlerInterface
{
    /**
     * @var EntityManagerInterface
     */
    protected $em;

    /**
     * @var EntityPersisterInterface
     */
    protected $entityPersister;

    /**
     * @var DomainRepository
     */
    protected $domainRepository;

    public function __construct(
        EntityManagerInterface $em,
        EntityPersisterInterface $entityPersister,
        DomainRepository $domainRepository
    ) {
        $this->em = $em;
        $this->entityPersister = $entityPersister;
        $this->domainRepository = $domainRepository;
    }

    public function execute(BrandInterface $entity, $isNew)
    {
        if (!$entity->hasChanged('domainUsers')) {
            return;
        }

        $id = $entity->getId();
        $name = $entity->getDomainUsers();
        $name = trim($name);

        /**
         * @var DomainInterface $domain
         */
        $domain = $this->domainRepository->findOneBy([
            'brand' => $id,
            'pointsTo' => 'proxyusers'
        ]);

        // Empty domain field, delete any related domain
        if (!$name && $domain) {
            $this->em->remove($domain);
            return;
        }

        // If domain field is filled, look for brand domains or create a new one
        if (is_null($domain)) {
            $domainDto = Domain::createDTO();
        } else {
            $domainDto = $domain->toDto();
        }

        /**
         * @var DomainDTO $domainDto
         */
        $domainDto
            ->setDomain($name)
            ->setScope('brand')
            ->setPointsTo('proxyusers')
            ->setBrandId($id)
            ->setDescription($entity->getName() . " proxyusers domain");

        $this->entityPersister->persistDto($domainDto, $domain, true);
    }
}