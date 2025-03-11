<?php

namespace DataFixtures\Stub\Provider;

use DataFixtures\Stub\StubTrait;
use Ivoz\Provider\Domain\Model\SurvivalDevice\SurvivalDevice;
use Ivoz\Provider\Domain\Model\SurvivalDevice\SurvivalDeviceDto;

class SurvivalDeviceStub
{
    use StubTrait;

    protected function getEntityName(): string
    {
        return SurvivalDevice::class;
    }

    protected function load()
    {
        $dto = (new SurvivalDeviceDto(1))
            ->setName("survival test 1")
            ->setProxy("23123")
            ->setOutboundProxy("43322")
            ->setUdpPort(5060)
            ->setTcpPort(5060)
            ->setTlsPort(5061)
            ->setWssPort(10081)
            ->setDescription("new survival device 1")
            ->setCompanyId(1);

        $this->append($dto);

        $dto = (new SurvivalDeviceDto(2))
            ->setName("Survival Test 2")
            ->setProxy("56789")
            ->setOutboundProxy("67890")
            ->setUdpPort(5070)
            ->setTcpPort(5071)
            ->setTlsPort(5062)
            ->setWssPort(10082)
            ->setDescription("new survival device 2")
            ->setCompanyId(2);
        $this->append($dto);

        $dto = (new SurvivalDeviceDto(3))
            ->setName("Survival Test 3")
            ->setProxy("98765")
            ->setOutboundProxy("54321")
            ->setUdpPort(5080)
            ->setTcpPort(5081)
            ->setTlsPort(5063)
            ->setWssPort(10083)
            ->setDescription("new survival device 3")
            ->setCompanyId(3);
        $this->append($dto);

        $dto = (new SurvivalDeviceDto(4))
            ->setName("Survival Test 4")
            ->setProxy("11223")
            ->setOutboundProxy("44556")
            ->setUdpPort(5090)
            ->setTcpPort(5091)
            ->setTlsPort(5064)
            ->setWssPort(10084)
            ->setDescription("new survival device 4")
            ->setCompanyId(4);
        $this->append($dto);
    }
}
