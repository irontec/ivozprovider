<?php

namespace DataFixtures\Stub\Provider;

use DataFixtures\Stub\StubTrait;
use Ivoz\Provider\Domain\Model\Corporation\Corporation;
use Ivoz\Provider\Domain\Model\Corporation\CorporationDto;

class CorporationStub
{
    use StubTrait;

    protected function getEntityName(): string
    {
        return Corporation::class;
    }

    protected function load()
    {
        $dto = (new CorporationDto(1))
            ->setName('Irontec Test Corporation')
            ->setDescription('Irontec Test Desc Corporation')
            ->setBrandId(1);

        $this->append($dto);

        $dto = (new CorporationDto(2))
            ->setName('Irontec Test Corporation2')
            ->setDescription('Irontec Test Desc Corporation')
            ->setBrandId(1);

        $this->append($dto);
    }
}
