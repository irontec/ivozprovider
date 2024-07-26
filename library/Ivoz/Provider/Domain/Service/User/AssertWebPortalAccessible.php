<?php

namespace Ivoz\Provider\Domain\Service\User;

use Ivoz\Provider\Domain\Model\Administrator\Administrator;
use Ivoz\Provider\Domain\Model\User\UserInterface;
use Ivoz\Provider\Domain\Model\WebPortal\WebPortalInterface;
use Ivoz\Provider\Domain\Model\WebPortal\WebPortalRepository;

class AssertWebPortalAccessible
{
    public function __construct(
        private WebPortalRepository $webPortalRepository
    ) {
    }

    public function execute(UserInterface $user, string $domain): void
    {
        $webPortal = $this->webPortalRepository->findByServerName($domain);

        if (is_null($webPortal)) {
            return;
        }

        if ($webPortal->getUrlType() === WebPortalInterface::URLTYPE_GOD) {
            return;
        }

        $webPortalCompanyId = $webPortal->getCompany()?->getId();
        $userCompanyId = $user->getCompany()->getId();
        if ($userCompanyId === $webPortalCompanyId) {
            return;
        }

        $webPortalBrandId = $webPortal->getBrand()?->getId();
        $userBrandId = $user->getCompany()->getBrand()->getId();
        if (is_null($webPortalCompanyId) && $userBrandId === $webPortalBrandId) {
            return;
        }

        throw new \DomainException(
            "Access denied",
            401
        );
    }
}
