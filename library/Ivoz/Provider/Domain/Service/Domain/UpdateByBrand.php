<?php

namespace Ivoz\Provider\Domain\Service\Domain;

use Ivoz\Core\Domain\Service\EntityPersisterInterface;
use Doctrine\ORM\EntityManagerInterface;
use Ivoz\Provider\Domain\Model\Brand\BrandInterface;
use Ivoz\Provider\Domain\Model\Domain\Domain;
use Ivoz\Provider\Domain\Model\Domain\DomainDto;
use Ivoz\Provider\Domain\Model\Domain\DomainInterface;
use Ivoz\Provider\Domain\Service\Brand\BrandLifecycleEventHandlerInterface;

/**
 * Class UpdateByBrand
 * @package Ivoz\Provider\Domain\Service\Domain
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

    public function __construct(
        EntityManagerInterface $em,
        EntityPersisterInterface $entityPersister
    ) {
        $this->em = $em;
        $this->entityPersister = $entityPersister;
    }

    public static function getSubscribedEvents()
    {
        return [
            self::EVENT_POST_PERSIST => 10
        ];
    }

    public function execute(BrandInterface $entity, $isNew)
    {
        if (!$entity->hasChanged('domain_users')) {

            return;
        }

        $domainUsers = $entity->getDomainUsers();

        /**
         * @var DomainInterface $domain
         */
        $domain = $entity->getDomain();

        // Empty domain field, delete any related domain
        if (!$domainUsers && $domain) {
            $this->em->remove($domain);

            return;
        }

        // If domain field is filled, look for brand domains or create a new one
        if (is_null($domain)) {
            $domainDto = Domain::createDto();
        } else {
            $domainDto = $domain->toDto();
        }

        /**
         * @var DomainDTO $domainDto
         */
        $domainDto
            ->setDomain($domainUsers)
            ->setDescription($entity->getName() . " proxyusers domain");

        $domain = $this
            ->entityPersister
            ->persistDto($domainDto, $domain);

        $entity->setDomain($domain);
    }
}
