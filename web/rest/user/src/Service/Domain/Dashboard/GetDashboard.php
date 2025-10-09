<?php

namespace Service\Domain\Dashboard;

use Ivoz\Provider\Domain\Model\User\UserInterface;
use Model\Dashboard\Dashboard;
use Ivoz\Provider\Application\Service\WebPortal\ProductNameResolver;
use Ivoz\Provider\Domain\Model\WebPortal\WebPortalInterface;
use Symfony\Component\HttpFoundation\Request;

class GetDashboard
{
    public function __construct(
        private ProductNameResolver $productNameResolver
    ) {
    }

    public function execute(UserInterface $user, string $hostName): Dashboard
    {
        $extension = $user->getExtension();

        $extensionNumber = is_null($extension)
            ? ''
            : $extension->getNumber();

        $terminal = $user->getTerminal();
        $terminalName = is_null($terminal)
            ? ''
            : $terminal->getName();

        $name = $user->getName();
        $lastName = $user->getLastname();
        $email = $user->getEmail();
        $outgoingDdi = $user->getOutgoingDdi();
        $outgoingDdiToStr = is_null($outgoingDdi)
            ? ''
            : $outgoingDdi->getDdi();

        $productName = $this->productNameResolver->execute(
            $hostName,
            WebPortalInterface::URLTYPE_USER
        );

        return new Dashboard(
            $name,
            $lastName,
            $extensionNumber,
            $terminalName,
            $email ?? '',
            $outgoingDdiToStr,
            $productName
        );
    }
}
