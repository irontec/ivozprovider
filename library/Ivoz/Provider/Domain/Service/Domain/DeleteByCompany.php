<?php

namespace Ivoz\Provider\Domain\Service\Domain;

use Ivoz\Core\Application\Service\EntityTools;
use Ivoz\Provider\Domain\Model\Company\CompanyDto;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use Ivoz\Provider\Domain\Service\Company\CompanyLifecycleEventHandlerInterface;

/**
 * Class DeleteByCompany
 * @package Ivoz\Provider\Domain\Service\Domain
 */
class DeleteByCompany implements CompanyLifecycleEventHandlerInterface
{
    const POST_REMOVE_PRIORITY = 10;

    public function __construct(
        private EntityTools $entityTools
    ) {
    }

    public static function getSubscribedEvents()
    {
        return [
            self::EVENT_POST_REMOVE => self::POST_REMOVE_PRIORITY
        ];
    }

    /**
     * @return void
     */
    public function execute(CompanyInterface $company)
    {
        if ($company->getType() !== CompanyInterface::TYPE_VPBX) {
            return;
        }

        $domain = $company->getDomain();
        if (!$domain) {
            return;
        }

        /** @var CompanyDto $companyDto */
        $companyDto = $this
            ->entityTools
            ->entityToDto($company);

        $companyDto->setDomain(null);

        $this
            ->entityTools
            ->updateEntityByDto(
                $company,
                $companyDto
            );

        $this->entityTools->remove($domain);
    }
}
