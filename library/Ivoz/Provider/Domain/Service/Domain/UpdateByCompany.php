<?php

namespace Ivoz\Provider\Domain\Service\Domain;

use Ivoz\Core\Application\Service\EntityTools;
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
    const PRE_PERSIST_PRIORITY = 10;

    /**
     * @var EntityTools
     */
    protected $entityTools;

    /**
     * @var DomainRepository
     */
    protected $domainRepository;

    public function __construct(
        EntityTools $entityTools,
        DomainRepository $domainRepository
    ) {
        $this->entityTools = $entityTools;
        $this->domainRepository = $domainRepository;
    }

    public static function getSubscribedEvents()
    {
        return [
            self::EVENT_PRE_PERSIST => self::PRE_PERSIST_PRIORITY
        ];
    }

    public function execute(CompanyInterface $company)
    {
        $name = $company->getDomainUsers();

        // Empty domain field, do nothing
        if (empty($name)) {
            return;
        }

        /**
         * @var DomainInterface $domain
         */
        $domain = $company->getDomain();

        // If domain field is filled, look for Domain entity or create a new one
        $domainDto = is_null($domain)
            ? Domain::createDto()
            : $this->entityTools->entityToDto($domain);

        /**
         * @var DomainDTO $domainDto
         */
        $domainDto
            ->setDomain($name)
            ->setDescription($company->getName() . ' proxyusers domain');

        $domain = $this->entityTools
            ->persistDto($domainDto, $domain);

        $company->setDomain($domain);
    }
}
