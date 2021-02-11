<?php

namespace Ivoz\Provider\Domain\Service\Domain;

use Ivoz\Core\Application\Service\EntityTools;
use Ivoz\Provider\Domain\Model\Company\CompanyDto;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use Ivoz\Provider\Domain\Model\Domain\Domain;
use Ivoz\Provider\Domain\Model\Domain\DomainDto;
use Ivoz\Provider\Domain\Model\Domain\DomainRepository;
use Ivoz\Provider\Domain\Service\Company\CompanyLifecycleEventHandlerInterface;

/**
 * Class UpdateByCompany
 * @package Ivoz\Provider\Domain\Service\Domain
 * @todo this could be partially merged with UpdateByBrand
 */
class UpdateByCompany implements CompanyLifecycleEventHandlerInterface
{
    const POST_PERSIST_PRIORITY = 10;

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
            self::EVENT_POST_PERSIST => self::POST_PERSIST_PRIORITY
        ];
    }

    /**
     * @return void
     */
    public function execute(CompanyInterface $company)
    {
        $notVpbx = $company->getType() !== CompanyInterface::TYPE_VPBX;
        if ($notVpbx) {
            return;
        }

        $name = $company->getDomainUsers();

        // Empty domain field, do nothing
        if (empty($name)) {
            return;
        }

        $domain = $company->getDomain();

        // If domain field is filled, look for Domain entity or create a new one
        /** @var DomainDto $domainDto */
        $domainDto = is_null($domain)
            ? Domain::createDto()
            : $this->entityTools->entityToDto($domain);

        $domainDto
            ->setDomain($name)
            ->setDescription($company->getName() . ' proxyusers domain');

        $domain = $this->entityTools
            ->persistDto(
                $domainDto,
                $domain,
                true
            );

        /** @var CompanyDto $companyDto */
        $companyDto = $this
            ->entityTools
            ->entityToDto($company);

        $companyDto
            ->setDomain($domainDto);

        $this
            ->entityTools
            ->updateEntityByDto(
                $company,
                $companyDto
            );
    }
}
