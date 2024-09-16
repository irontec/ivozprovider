<?php

namespace Ivoz\Provider\Domain\Service\Administrator;

use Ivoz\Provider\Domain\Model\Administrator\AdministratorInterface;
use Ivoz\Provider\Domain\Model\WebPortal\WebPortal;
use Ivoz\Provider\Domain\Model\WebPortal\WebPortalInterface;
use Ivoz\Provider\Domain\Model\WebPortal\WebPortalRepository;

final class AssertWebPortalAccessible
{
    public function __construct(
        private WebPortalRepository $webPortalRepository
    ) {
    }

    public function execute(AdministratorInterface $user, string $domain): void
    {
        if ($user->isSuperAdmin()) {
            return;
        }

        $webPortal = $this->webPortalRepository->findByServerName($domain);

        if (is_null($webPortal)) {
            return;
        }

        if ($webPortal->getUrlType() === WebPortalInterface::URLTYPE_GOD) {
            return;
        }

        if (is_null($webPortal->getCompany())) {
            $this->assertBrandsMatch($user, $webPortal);
            return;
        }

        $this->assertCompaniesMatch($user, $webPortal);
    }

    private function assertBrandsMatch(AdministratorInterface $user, WebPortalInterface $webPortal): void
    {
        $userBrandId = $user->getBrand()?->getId();
        $webPortalBrandId = $webPortal->getBrand()?->getId();

        $brandMustMatch = !(is_null($userBrandId) || is_null($webPortalBrandId));
        if ($brandMustMatch && $userBrandId === $webPortalBrandId) {
            return;
        }

        $this->throwAccessDeniedException();
    }

    private function assertCompaniesMatch(AdministratorInterface $user, WebPortalInterface $webPortal): void
    {
        $userCompanyId = $user->getCompany()?->getId();
        $webPortalCompanyId = $webPortal->getCompany()?->getId();

        $companyMustMatch = !(is_null($userCompanyId) || is_null($webPortalCompanyId));
        if ($companyMustMatch && $userCompanyId === $webPortalCompanyId) {
            return;
        }

        $this->throwAccessDeniedException();
    }

    private function throwAccessDeniedException(): void
    {
        throw new \DomainException(
            "Access denied",
            401
        );
    }
}
