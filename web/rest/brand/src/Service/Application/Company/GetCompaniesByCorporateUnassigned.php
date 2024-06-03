<?php

namespace Service\Application\Company;

use ApiPlatform\Core\Exception\ResourceClassNotFoundException;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use Ivoz\Provider\Domain\Model\Company\CompanyRepository;
use Ivoz\Provider\Domain\Model\Friend\FriendRepository;

class GetCompaniesByCorporateUnassigned
{
    public function __construct(
        private CompanyRepository $companyRepository,
        private FriendRepository $friendRepository
    ) {
    }

    /**
     * @return CompanyInterface[]
     */
    function execute(int $companyId, int $includeId): array
    {
        $company = $this->companyRepository->find($companyId);
        if (!$company) {
            throw new ResourceClassNotFoundException('Company not found');
        }

        if (!$company->getCorporation()) {
            throw new \DomainException('Selected company does not belong to a corporation');
        }

        /** @var int $corporationId */
        $corporationId = $company->getCorporation()?->getId();
        $companies = $this->companyRepository->findByCorporationId($corporationId);

        $response = [];

        if (is_null($companies)) {
            return $response;
        }

        foreach ($companies as $interCompany) {
            if ($interCompany->getId() === $includeId) {
                $response[] = $interCompany;
            }

            if ($company->getId() === $interCompany->getId()) {
                continue;
            }

            $friends = $this->friendRepository->findByCompanyAndInterCompany(
                $companyId,
                (int) $interCompany->getId()
            );

            if (count($friends) !== 0) {
                continue;
            }

            $response[] = $interCompany;
        }

        return $response;
    }
}
