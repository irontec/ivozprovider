<?php

namespace spec\Ivoz\Cgr\Domain\Model\TpRatingProfile;

use Ivoz\Cgr\Domain\Model\TpRatingPlan\TpRatingPlan;
use Ivoz\Cgr\Domain\Model\TpRatingPlan\TpRatingPlanRepository;
use Ivoz\Cgr\Domain\Model\TpRatingProfile\SimulatedCall;
use Ivoz\Core\Domain\Service\EntityTools;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use spec\HelperTrait;

class SimulatedCallSpec extends ObjectBehavior
{
    use HelperTrait;

    protected $entityTools;
    protected $tpRatingPlansRepository;

    public function __construct()
    {
        $this->entityTools = $this->getTestDouble(
            EntityTools::class,
            true
        );

        $this->tpRatingPlansRepository = $this->getTestDouble(
            TpRatingPlanRepository::class,
            true
        );

        $this
            ->entityTools
            ->getRepository(
                TpRatingPlan::class
            )
            ->willReturn(
                $this->tpRatingPlansRepository
            );
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(
            SimulatedCall::class
        );
    }

    function it_throws_exception_if_error_code_is_found()
    {
        $this->beConstructedThrough(
            'fromCgRatesResponse',
            [
                '{"error": "Somathing"}',
                0,
                $this->entityTools
            ]
        );

        $this
            ->shouldThrow('\Exception')
            ->duringInstantiation();
    }

    function it_throws_domain_exception_if_rating_plan_is_not_found()
    {
        $this->beConstructedThrough(
            'fromCgRatesResponse',
            [
                '{"error": "Somathing"}',
                0,
                $this->entityTools
            ]
        );

        $this
            ->shouldThrow('\Exception')
            ->duringInstantiation();
    }

    function it_can_be_instantiated_from_unauthorized_error_response()
    {
        $this->beConstructedThrough(
            'fromErrorResponse',
            [
                SimulatedCall::ERROR_UNAUTHORIZED_DESTINATION_MSG,
                'b1rp1',
                $this->entityTools
            ]
        );

        $this
            ->getErrorMessage()
            ->shouldReturn(
                SimulatedCall::ERROR_UNAUTHORIZED_DESTINATION_MSG
            );

        $this
            ->getErrorCode()
            ->shouldReturn(
                SimulatedCall::ERROR_UNAUTHORIZED_DESTINATION
            );
    }

    function it_can_be_instantiated_from_rating_plan_not_found_error_response()
    {
        $this->beConstructedThrough(
            'fromErrorResponse',
            [
                SimulatedCall::ERROR_NO_RATING_PLAN_MSG . '1',
                'b1rp1',
                $this->entityTools
            ]
        );

        $this
            ->getErrorMessage()
            ->shouldReturn(
                SimulatedCall::ERROR_NO_RATING_PLAN_MSG . '1'
            );

        $this
            ->getErrorCode()
            ->shouldReturn(
                SimulatedCall::ERROR_NO_RATING_PLAN
            );
    }

    function it_throws_exception_on_unknown_error_response()
    {
        $this->beConstructedThrough(
            'fromErrorResponse',
            [
                'Random error msg',
                '',
                $this->entityTools
            ]
        );

        $this
            ->shouldThrow('\Exception')
            ->duringInstantiation();
    }
}
