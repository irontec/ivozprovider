<?php

namespace DataFixtures\Stub\Cgr;

use DataFixtures\Stub\StubTrait;
use Ivoz\Cgr\Domain\Model\TpRatingPlan\TpRatingPlan;
use Ivoz\Cgr\Domain\Model\TpRatingPlan\TpRatingPlanDto;

class TpRatingPlanStub
{
    use StubTrait;

    protected function getEntityName(): string
    {
        return TpRatingPlan::class;
    }

    protected function load()
    {
        $dto = (new TpRatingPlanDto(1))
            ->setTpid('b2')
            ->setTag('b2rp1')
            ->setDestratesTag('b2r3')
            ->setTimingTag('*any')
            ->setWeight(1.00)
            ->setCreatedAt('2023-01-23 13:15:17')
            ->setRatingPlanId(1);
        $this->append($dto);
    }
}
