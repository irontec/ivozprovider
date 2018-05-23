<?php

namespace Ivoz\Provider\Domain\Service\Domain;

use Ivoz\Core\Domain\Service\EntityPersisterInterface;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use Ivoz\Provider\Domain\Model\Domain\Domain;
use Ivoz\Provider\Domain\Model\Domain\DomainDto;
use Ivoz\Provider\Domain\Model\Domain\DomainInterface;
use Ivoz\Provider\Domain\Model\Domain\DomainRepository;
use Ivoz\Provider\Domain\Service\Company\CompanyLifecycleEventHandlerInterface;

/**
 * Class UpdateByCompany
 * @package Ivoz\Provider\Domain\Service\Domain
 * @todo this could be partially merged with UpdateByBrand
 */
class UpdateByCompany implements CompanyLifecycleEventHandlerInterface
{
    /**
     * @var EntityPersisterInterface
     */
    protected $entityPersister;

    /**
     * @var DomainRepository
     */
    protected $domainRepository;

    public function __construct(
        EntityPersisterInterface $entityPersister,
        DomainRepository $domainRepository
    ) {
        $this->entityPersister = $entityPersister;
        $this->domainRepository = $domainRepository;
    }

    public static function getSubscribedEvents()
    {
        return [
            self::EVENT_POST_PERSIST => 10
        ];
    }

    public function execute(CompanyInterface $entity, $isNew)
    {
        $name = $entity->getDomainUsers();

        // Empty domain field, do nothing
        if (empty($name)) {
            return;
        }
        /**
         * @var DomainInterface $domain
         */
        $domain = $entity->getDomain();

        // If domain field is filled, look for Domain entity or create a new one
        $domainDto = is_null($domain)
            ? Domain::createDto()
            : $domain->toDto();

        /**
         * @var DomainDTO $domainDto
         */
        $domainDto
            ->setDomain($name)
            ->setDescription($entity->getName() . ' proxyusers domain');

        $domain = $this->entityPersister->persistDto($domainDto, $domain);

        $entity->setDomain($domain);
    }
}
