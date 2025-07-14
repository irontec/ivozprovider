<?php

namespace Service\Domain\Dashboard;

use Ivoz\Provider\Domain\Model\User\UserInterface;
use Model\Dashboard\Dashboard;
use Service\Application\Dashboard\ProductNameFactory;
use Symfony\Component\HttpFoundation\Request;

class GetDashboard
{
    public function __construct(
        private ProductNameFactory $productNameFactory
    ) {
    }

    public function execute(UserInterface $user, Request $request): Dashboard
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

        $productName = $this->productNameFactory->execute($request);

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
