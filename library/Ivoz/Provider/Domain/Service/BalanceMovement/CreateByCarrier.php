<?php

namespace Ivoz\Provider\Domain\Service\BalanceMovement;

use Ivoz\Core\Application\Service\EntityTools;
use Ivoz\Provider\Domain\Model\BalanceMovement\BalanceMovement;
use Ivoz\Provider\Domain\Model\Carrier\CarrierInterface;

class CreateByCarrier
{
    protected $entityTools;

    public function __construct(
        EntityTools $entityTools
    ) {
        $this->entityTools = $entityTools;
    }

    public function execute(
        CarrierInterface $carrier,
        $amount,
        $balance
    ) {
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
