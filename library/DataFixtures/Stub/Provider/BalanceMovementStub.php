<?php

namespace DataFixtures\Stub\Provider;

use DataFixtures\Stub\StubTrait;
use Ivoz\Provider\Domain\Model\BalanceMovement\BalanceMovement;
use Ivoz\Provider\Domain\Model\BalanceMovement\BalanceMovementDto;

class BalanceMovementStub
{
    use StubTrait;

    protected function getEntityName(): string
    {
        return BalanceMovement::class;
    }

    protected function load()
    {
        $dto = (new BalanceMovementDto(1))
            ->setAmount(10)
            ->setBalance(10)
            ->setCreatedOn('2022-09-02 10:17:10')
            ->setCompanyId(1);

        $this->append($dto);

        $dto = (new BalanceMovementDto(2))
            ->setAmount(25)
            ->setBalance(27)
            ->setCreatedOn('2022-09-02 10:17:11')
            ->setCompanyId(1);

        $this->append($dto);

        $dto = (new BalanceMovementDto(3))
            ->setAmount(500)
            ->setBalance(567.23)
            ->setCreatedOn('2022-09-02 10:17:12')
            ->setCarrierId(1);

        $this->append($dto);
    }
}
