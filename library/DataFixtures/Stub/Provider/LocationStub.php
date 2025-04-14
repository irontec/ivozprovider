<?php

namespace DataFixtures\Stub\Provider;

use DataFixtures\Stub\StubTrait;
use Ivoz\Provider\Domain\Model\Location\Location;
use Ivoz\Provider\Domain\Model\Location\LocationDto;

class LocationStub
{
    use StubTrait;

    protected function getEntityName(): string
    {
        return Location::class;
    }

    protected function load()
    {
        $dto = (new LocationDto(1))
            ->setName("testLocation")
            ->setDescription("Test Location description")
            ->setSurvivalDeviceId(1)
            ->setCompanyId(1);

        $this->append($dto);

        $dto = (new LocationDto(2))
            ->setName("altLocation")
            ->setDescription("Alternative Location description")
            ->setCompanyId(1);

        $this->append($dto);
    }
}
