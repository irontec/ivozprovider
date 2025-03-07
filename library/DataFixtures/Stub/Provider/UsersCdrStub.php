<?php

namespace DataFixtures\Stub\Provider;

use DataFixtures\Stub\StubTrait;
use Ivoz\Provider\Domain\Model\UsersCdr\UsersCdr;
use Ivoz\Provider\Domain\Model\UsersCdr\UsersCdrDto;

class UsersCdrStub
{
    use StubTrait;

    protected function getEntityName(): string
    {
        return UsersCdr::class;
    }

    protected function load()
    {
        $dto = (new UsersCdrDto(1))
            ->setStartTime(new \DateTime('2018-11-22 16:54:49'))
            ->setDuration(3600)
            ->setDirection('outbound')
            ->setCaller('102')
            ->setCallee('+34676896561')
            ->setCallid('9297bdde-309cd48f@10.10.1.123')
            ->setBrandId(1)
            ->setCompanyId(1)
            ->setExtensionId(1)
            ->setUserId(1);

        $this->append($dto);

        $dto = (new UsersCdrDto(2))
            ->setStartTime(new \DateTime('2018-11-22 16:54:49'))
            ->setDuration(3600)
            ->setDirection('outbound')
            ->setCaller('102')
            ->setCallee('+34676896561')
            ->setCallid('9297bdde-309cd48f@10.10.1.124')
            ->setBrandId(1)
            ->setCompanyId(1)
            ->setUserId(1)
            ->setKamUsersCdrId(2)
            ->setNumRecordings(1);

        $this->append($dto);

        $dto = new UsersCdrDto(3);
        $prevMonth = strtotime('-1 week');
        $dateTime = date('Y-m-d H:i:s', $prevMonth);

        $dto
            ->setStartTime($dateTime)
            ->setDuration(3600)
            ->setDirection('outbound')
            ->setCaller('103')
            ->setCallee('+34676896564')
            ->setCallid('8297bdde-309cd49f@10.10.1.125')
            ->setBrandId(1)
            ->setCompanyId(1)
            ->setUserId(1)
            ->setKamUsersCdrId(3);

        $this->append($dto);
    }
}
