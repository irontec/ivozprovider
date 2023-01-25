<?php

namespace DataFixtures\Stub\Cgr;

use DataFixtures\Stub\StubTrait;
use Ivoz\Cgr\Domain\Model\TpDestination\TpDestination;
use Ivoz\Cgr\Domain\Model\TpDestination\TpDestinationDto;

class TpDestinationStub
{
    use StubTrait;

    protected function getEntityName(): string
    {
        return TpDestination::class;
    }

    protected function load()
    {
        $dto = (new TpDestinationDto(1))
            ->setTpid('b2')
            ->setTag('b2dst140')
            ->setPrefix('+34')
            ->setCreatedAt('2022-12-09 13:56:08')
            ->setDestinationId(3);
        $this->append($dto);
    }
}
