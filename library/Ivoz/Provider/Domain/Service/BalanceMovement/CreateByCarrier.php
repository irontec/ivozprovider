<?php

namespace Ivoz\Provider\Domain\Service\BalanceMovement;

use Ivoz\Core\Domain\Service\EntityTools;
use Ivoz\Provider\Domain\Model\BalanceMovement\BalanceMovement;
use Ivoz\Provider\Domain\Model\Carrier\CarrierInterface;

class CreateByCarrier
{
    public function __construct(
        private EntityTools $entityTools
    ) {
    }

    public function execute(
        CarrierInterface $carrier,
        ?float $amount,
        ?float $balance
    ): void {
        // Store this transaction in a BalanceMovement
        $balanceMovementDto = BalanceMovement::createDto();
        $balanceMovementDto
            ->setCarrierId($carrier->getId())
            ->setAmount($amount)
            ->setBalance($balance);

        $this->entityTools->persistDto(
            $balanceMovementDto,
            null,
            true
        );
    }
}
