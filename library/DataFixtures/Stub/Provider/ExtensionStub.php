<?php

namespace DataFixtures\Stub\Provider;

use DataFixtures\Stub\StubTrait;
use Ivoz\Provider\Domain\Model\Extension\Extension;
use Ivoz\Provider\Domain\Model\Extension\ExtensionDto;
use Ivoz\Provider\Domain\Model\Location\Location;
use Ivoz\Provider\Domain\Model\Location\LocationDto;

class ExtensionStub
{
    use StubTrait;

    protected function getEntityName(): string
    {
        return Extension::class;
    }

    protected function load()
    {
        $dto = (new ExtensionDto(1))
            ->setNumber("101")
            ->setRouteType("user")
            ->setCompanyId(1)
            ->setUserId(1)
            ->setNumberCountryId(70);

        $this->append($dto);

        $dto = (new ExtensionDto(2))
            ->setNumber("102")
            ->setRouteType("user")
            ->setCompanyId(1)
            ->setUserId(2)
            ->setNumberCountryId(70);

        $this->append($dto);

        $dto = (new ExtensionDto(3))
            ->setNumber("12346")
            ->setRouteType("number")
            ->setNumberValue("946006060")
            ->setCompanyId(1)
            ->setNumberCountryId(70);

        $this->append($dto);

        $dto = (new ExtensionDto(4))
            ->setRouteType(null)
            ->setNumber("987")
            ->setCompanyId(1);

        $this->append($dto);

        $dto = (new ExtensionDto(5))
            ->setNumber("988")
            ->setRouteType('user')
            ->setUserId(3)
            ->setCompanyId(1);

        $this->append($dto);

        $dto = (new ExtensionDto(6))
            ->setNumber("989")
            ->setRouteType('user')
            ->setUserId(4)
            ->setCompanyId(1);

        $this->append($dto);
    }
}
