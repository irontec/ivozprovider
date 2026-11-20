<?php

declare(strict_types=1);

namespace Ivoz\Provider\Domain\Service\User;

use Ivoz\Provider\Domain\Model\Ddi\DdiInterface;
use Ivoz\Provider\Domain\Model\User\UserInterface;

class CsvRowFormatter
{
    /**
     * @return list<string> values in CsvStaticValidator::COLUMNS order, with an empty terminal password
     */
    public function execute(UserInterface $user): array
    {
        $terminal = $user->getTerminal();
        $ddi = $this->ownOutgoingDdi($user);
        $ddiCountry = $ddi?->getCountry();

        return [
            $user->getName(),
            $user->getLastname(),
            $user->getEmail() ?? '',
            $terminal?->getName() ?? '',
            '',
            $terminal?->getTerminalModel()?->getIden() ?? '',
            $terminal?->getMac() ?? '',
            $user->getExtension()?->getNumber() ?? '',
            $ddiCountry ? $ddiCountry->getCode() : '',
            $ddi ? $ddi->getDdi() : '',
            $ddi?->getDdiProvider()?->getName() ?? '',
        ];
    }

    private function ownOutgoingDdi(UserInterface $user): ?DdiInterface
    {
        $hasOwnDdi = $user->getInitialValue('outgoingDdiId') !== null;

        return $hasOwnDdi
            ? $user->getOutgoingDdi()
            : null;
    }
}
