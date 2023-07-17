<?php

namespace Service\Domain\Dashboard;

use Ivoz\Provider\Domain\Model\User\UserInterface;
use Model\Dashboard\Dashboard;

class GetDashboard
{
    public function __construct()
    {
    }

    public function execute(UserInterface $user): Dashboard
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

        return new Dashboard(
            $name,
            $lastName,
            $extensionNumber,
            $terminalName,
            $email ?? '',
            $outgoingDdiToStr
        );
    }
}
