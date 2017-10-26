<?php

namespace Ivoz\Provider\Domain\Service\Domain;

use Ivoz\Ast\Domain\Model\PsAor\PsAor;
use Ivoz\Ast\Domain\Model\PsEndpoint\PsEndpoint;
use Ivoz\Core\Domain\Service\EntityPersisterInterface;
use Doctrine\ORM\EntityManagerInterface;
use Ivoz\Provider\Domain\Model\Company\Company;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use Ivoz\Provider\Domain\Model\Domain\Domain;
use Ivoz\Provider\Domain\Model\Domain\DomainDTO;
use Ivoz\Provider\Domain\Model\Domain\DomainInterface;
use Ivoz\Provider\Domain\Model\Domain\DomainRepository;
use Ivoz\Provider\Domain\Model\Friend\Friend;
use Ivoz\Provider\Domain\Model\Terminal\Terminal;
use Ivoz\Provider\Domain\Service\Company\CompanyLifecycleEventHandlerInterface;

/**
 * Class UpdateByCompany
 * @package Ivoz\Provider\Domain\Service\Domain
 * @lifecycle post_persist
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

    public function execute(CompanyInterface $entity, $isNew)
    {
        $id = $entity->getId();
        $name = $entity->getDomainUsers();

        /**
         * @todo trim value on setter
         */
        $name = trim($name);

        // Empty domain field, do nothing
        if (empty($name)) {
            return;
        }

        /**
         * @var DomainInterface $domain
         */
        $domain = $this->domainRepository->findOneBy([
            'company' => $id,
            'pointsTo' => 'proxyusers'
        ]);

        // If domain field is filled, look for Domain entity or create a new one
        $domainDto = is_null($domain)
            ? Domain::createDTO()
            : $domain->toDto();

        $name = $entity->getDomainUsers();

        /**
         * @var DomainDTO $domainDto
         */
        $domainDto
            ->setDomain($name)
            ->setScope('company')
            ->setPointsTo('proxyusers')
            ->setCompanyId($id)
            ->setDescription($entity->getName() . " proxyusers domain");

        $this->entityPersister->persistDto($domainDto, $domain);
    }
}
