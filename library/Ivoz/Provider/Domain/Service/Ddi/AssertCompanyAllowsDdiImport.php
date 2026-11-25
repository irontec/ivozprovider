<?php

namespace Ivoz\Provider\Domain\Service\Ddi;

use Ivoz\Provider\Domain\Model\Administrator\AdministratorInterface;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use Ivoz\Provider\Domain\Model\Company\CompanyRepository;

class AssertCompanyAllowsDdiImport
{
    public function __construct(
        private CompanyRepository $companyRepository
    ) {
    }

    /**
     * @throws \DomainException
     */
    public function execute(
        AdministratorInterface $admin,
        CompanyInterface $company
    ): void {
        $supervisedCompanyIds = $this
            ->companyRepository
            ->getSupervisedCompanyIdsByAdmin($admin);

        $isSupervised = in_array((int) $company->getId(), $supervisedCompanyIds, true);
        if (!$isSupervised) {
            throw new \DomainException(
                'Forbidden company',
                403
            );
        }

        if ($company->isWholesale()) {
            throw new \DomainException(
                'DDIs cannot be imported into wholesale clients',
                400
            );
        }
    }
}
