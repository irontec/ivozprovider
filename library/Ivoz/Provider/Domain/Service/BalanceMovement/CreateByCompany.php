<?php

namespace Ivoz\Provider\Domain\Service\BalanceMovement;

use Ivoz\Core\Domain\Service\EntityTools;
use Ivoz\Provider\Domain\Model\BalanceMovement\BalanceMovement;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;

class CreateByCompany
{
    public function __construct(
        private EntityTools $entityTools
    ) {
    }

    public function execute(
        CompanyInterface $company,
        ?float $amount,
        ?float $balance
    ): void {
        // Store this transaction in a BalanceMovement
        $balanceMovementDto = BalanceMovement::createDto();
        $balanceMovementDto
            ->setCompanyId($company->getId())
            ->setAmount($amount)
            ->setBalance($balance);

        $this->entityTools->persistDto(
            $balanceMovementDto,
            null,
            true
        );
    }
}
