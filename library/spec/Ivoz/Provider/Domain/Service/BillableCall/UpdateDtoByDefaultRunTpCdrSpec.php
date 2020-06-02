<?php

namespace spec\Ivoz\Provider\Domain\Service\BillableCall;

use Ivoz\Cgr\Domain\Model\TpCdr\TpCdrInterface;
use Ivoz\Cgr\Domain\Model\TpDestination\TpDestination;
use Ivoz\Cgr\Domain\Model\TpDestination\TpDestinationRepository;
use Ivoz\Cgr\Domain\Model\TpRatingPlan\TpRatingPlan;
use Ivoz\Cgr\Domain\Model\TpRatingPlan\TpRatingPlanRepository;
use Ivoz\Kam\Domain\Model\TrunksCdr\TrunksCdrInterface;
use Ivoz\Provider\Domain\Model\BillableCall\BillableCallDto;
use Ivoz\Provider\Domain\Model\Brand\BrandInterface;
use Ivoz\Provider\Domain\Model\Destination\Destination;
use Ivoz\Provider\Domain\Model\RatingPlan\RatingPlan;
use Ivoz\Provider\Domain\Model\RatingPlanGroup\RatingPlanGroup;
use Ivoz\Provider\Domain\Service\BillableCall\UpdateDtoByDefaultRunTpCdr;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Psr\Log\LoggerInterface;
use spec\HelperTrait;

class UpdateDtoByDefaultRunTpCdrSpec extends ObjectBehavior
{
    use HelperTrait;


    protected $tpRatingPlanRepository;
    protected $tpDestinationRepository;
    protected $logger;

    /////////////////////////////////////////
    ///
    /////////////////////////////////////////

    protected $billableCallDto;
    protected $trunksCdr;
    protected $brand;
    protected $defaultRunTpCdr;
    protected $tpRatingPlan;
    protected $ratingPlan;
    protected $ratingPlanGroup;
    protected $tpDestination;
    protected $destination;

    public function let(
        TpRatingPlanRepository $tpRatingPlanRepository,
        TpDestinationRepository $tpDestinationRepository,
        LoggerInterface $logger
    ) {
        $this->tpRatingPlanRepository = $tpRatingPlanRepository;
        $this->tpDestinationRepository = $tpDestinationRepository;
        $this->logger = $logger;

        $this->beConstructedWith(
            ...func_get_args()
        );
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(UpdateDtoByDefaultRunTpCdr::class);
    }

    function it_returns_on_empty_cost_details()
    {
        $this->prepareExecution();

        $this
            ->defaultRunTpCdr
            ->getCostDetailsFirstTimespan()
            ->willReturn(null)
            ->shouldBeCalled();

        $this
            ->logger
            ->error('Empty cost details. Skipping')
            ->shouldBeCalled();

        $this->execute(
            $this->billableCallDto,
            $this->trunksCdr,
            $this->defaultRunTpCdr
        );
    }

    function it_sets_safe_values_on_negative_cost()
    {
        $this->prepareExecution();

        $this
            ->defaultRunTpCdr
            ->getCost()
            ->willReturn(-1)
            ->shouldBeCalled();

        $this
            ->logger
            ->error(Argument::type('string'))
            ->shouldbeCalled();

        $this->fluentSetterProphecy(
            $this->billableCallDto,
            [
                'setPrice' => -1,
                'setDestinationId' => null,
                'setDestinationName' => null,
                'setRatingPlanGroupId' => null,
                'setRatingPlanName' => null,
            ],
            true
        );

        $this->execute(
            $this->billableCallDto,
            $this->trunksCdr,
            $this->defaultRunTpCdr
        );
    }

    function it_sets_destination_id_and_name()
    {
        $this->prepareExecution();

        $this->fluentSetterProphecy(
            $this->billableCallDto,
            [
                'setDestinationId' => 1,
                'setDestinationName' => 'DestinationEn',
                'setRatingPlanGroupId' => 1,
                'setRatingPlanName' => 'RatingPlanGroupEn',
            ],
            true
        );

        $this->execute(
            $this->billableCallDto,
            $this->trunksCdr,
            $this->defaultRunTpCdr
        );
    }

    private function prepareExecution()
    {

        $this->billableCallDto = $this->getTestDouble(
            BillableCallDto::class
        );

        $this->brand = $this->getTestDouble(
            BrandInterface::class
        );

        $this
            ->brand
            ->getLanguageCode()
            ->willReturn('en');

        $this->trunksCdr = $this->getTestDouble(
            TrunksCdrInterface::class
        );

        $this
            ->trunksCdr
            ->getBrand()
            ->willReturn($this->brand);

        $this->defaultRunTpCdr = $this->getTestDouble(
            TpCdrInterface::class
        );

        $this->getterProphecy(
            $this->defaultRunTpCdr,
            [
                'getCostDetailsFirstTimespan' => ['SomeValue'],
                'getCost' => 1,
                'getRatingPlanTag' => 'tag',
                'getMatchedDestinationTag' => 'destTag'
            ],
            false
        );

        $this->ratingPlanGroup = $this->getInstance(
            RatingPlanGroup::class,
            [
                'id' => 1,
                'name' => new \Ivoz\Provider\Domain\Model\RatingPlanGroup\Name(
                    'RatingPlanGroupEn',
                    'RatingPlanGroupEs',
                    'RatingPlanGroupCa',
                    'RatingPlanGroupIt'
                ),
            ]
        );

        $this->ratingPlan = $this->getInstance(
            RatingPlan::class,
            [
                'ratingPlanGroup' => $this->ratingPlanGroup
            ]
        );

        $this->tpRatingPlan = $this->getInstance(
            TpRatingPlan::class,
            [
                'ratingPlan' => $this->ratingPlan
            ]
        );

        $this->destination = $this->getInstance(
            Destination::class,
            [
                'id' => '1',
                'name' => new \Ivoz\Provider\Domain\Model\Destination\Name(
                    'DestinationEn',
                    'DestinationEs',
                    'DestinationCa',
                    'DestinationIt'
                ),
            ]
        );

        $this->tpDestination = $this->getInstance(
            TpDestination::class,
            [
                'destination' => $this->destination
            ]
        );

        $this
            ->tpRatingPlanRepository
            ->findOneByTag(Argument::type('string'))
            ->willReturn($this->tpRatingPlan);

        $this
            ->tpDestinationRepository
            ->findOneByTag(
                Argument::type('string')
            )
            ->willReturn(
                $this->tpDestination
            );
    }
}
