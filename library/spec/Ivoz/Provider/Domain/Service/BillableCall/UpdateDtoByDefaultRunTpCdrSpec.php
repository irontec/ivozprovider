<?php

namespace spec\Ivoz\Provider\Domain\Service\BillableCall;

use Ivoz\Cgr\Domain\Model\TpCdr\TpCdrInterface;
use Ivoz\Cgr\Domain\Model\TpDestination\TpDestinationInterface;
use Ivoz\Cgr\Domain\Model\TpDestination\TpDestinationRepository;
use Ivoz\Cgr\Domain\Model\TpRatingPlan\TpRatingPlanInterface;
use Ivoz\Cgr\Domain\Model\TpRatingPlan\TpRatingPlanRepository;
use Ivoz\Kam\Domain\Model\TrunksCdr\TrunksCdrInterface;
use Ivoz\Provider\Domain\Model\Brand\BrandInterface;
use Ivoz\Provider\Domain\Model\Destination\DestinationInterface;
use Ivoz\Provider\Domain\Model\RatingPlan\RatingPlanInterface;
use Ivoz\Provider\Domain\Model\RatingPlanGroup\RatingPlanGroupInterface;
use Ivoz\Provider\Domain\Model\BillableCall\BillableCallDto;
use Ivoz\Provider\Domain\Service\BillableCall\UpdateDtoByDefaultRunTpCdr;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Psr\Log\LoggerInterface;
use spec\HelperTrait;

class UpdateDtoByDefaultRunTpCdrSpec extends ObjectBehavior
{
    use HelperTrait;

    /**
     * @var TpRatingPlanRepository
     */
    protected $tpRatingPlanRepository;

    /**
     * @var TpDestinationRepository
     */
    protected $tpDestinationRepository;

    /**
     * @var LoggerInterface
     */
    protected $logger;

    /////////////////////////////////////////
    ///
    /////////////////////////////////////////

    /**
     * @var BillableCallDto
     */
    protected $billableCallDto;

    /**
     * @var TrunksCdrInterface
     */
    protected $trunksCdr;

    /**
     * @var BrandInterface
     */
    protected $brand;

    /**
     * @var TpCdrInterface
     */
    protected $defaultRunTpCdr;

    /**
     * @var TpRatingPlanInterface
     */
    protected $tpRatingPlan;

    /**
     * @var RatingPlanInterface
     */
    protected $ratingPlan;

    /**
     * @var RatingPlanGroupInterface
     */
    protected $ratingPlanGroup;

    /**
     * @var TpDestinationInterface
     */
    protected $tpDestination;

    /**
     * @var DestinationInterface
     */
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

        /////////////////////////////////////////
        ///
        /////////////////////////////////////////

        $this->billableCallDto = $this->getTestDouble(
            BillableCallDto::class
        );
        $this->trunksCdr = $this->getTestDouble(
            TrunksCdrInterface::class
        );
        $this->brand = $this->getTestDouble(
            BrandInterface::class
        );
        $this->defaultRunTpCdr = $this->getTestDouble(
            TpCdrInterface::class
        );
        $this->tpRatingPlan = $this->getTestDouble(
            TpRatingPlanInterface::class
        );
        $this->ratingPlan = $this->getTestDouble(
            RatingPlanInterface::class
        );
        $this->ratingPlanGroup = $this->getTestDouble(
            RatingPlanGroupInterface::class
        );
        $this->tpDestination = $this->getTestDouble(
            TpDestinationInterface::class
        );
        $this->destination = $this->getTestDouble(
            DestinationInterface::class
        );
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(UpdateDtoByDefaultRunTpCdr::class);
    }

    function it_returns_on_empty_cost_details()
    {
        $this
            ->defaultRunTpCdr
            ->getCostDetailsFirstTimespan()
            ->willReturn(null)
            ->shouldBeCalled();

        $this
            ->logger
            ->error(Argument::type('string'))
            ->shouldBeCalled();

        $this->execute(
            $this->billableCallDto,
            $this->trunksCdr,
            $this->defaultRunTpCdr
        );
    }

    function it_sets_save_values_on_negative_cost()
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

    function it_sets_save_values_on_null_cost()
    {
        $this->prepareExecution();

        $this
            ->defaultRunTpCdr
            ->getCost()
            ->willReturn(null)
            ->shouldBeCalled();

        $this
            ->logger
            ->error(Argument::type('string'))
            ->shouldbeCalled();

        $this->fluentSetterProphecy(
            $this->billableCallDto,
            [
                'setPrice' => null,
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

        $this
            ->tpRatingPlanRepository
            ->findOneByTag(Argument::type('string'))
            ->willReturn($this->tpRatingPlan);

        $this->tpRatingPlan
            ->getRatingPlan()
            ->willReturn($this->ratingPlan);

        $this
            ->ratingPlan
            ->getRatingPlanGroup()
            ->willReturn($this->ratingPlanGroup);

        $this
            ->trunksCdr
            ->getBrand()
            ->willReturn($this->brand);

        $this
            ->brand
            ->getLanguageCode()
            ->willReturn('en');

        $this->getterProphecy(
            $this->ratingPlanGroup,
            [
                'getId' => 1,
                'getName' => new \Ivoz\Provider\Domain\Model\RatingPlanGroup\Name(
                    'RatingPlanGroupEn',
                    'RatingPlanGroupEs'
                ),
            ],
            false
        );

        $this
            ->tpDestinationRepository
            ->findOneByTag(
                Argument::type('string')
            )
            ->willReturn(
                $this->tpDestination
            );

        $this
            ->tpDestination
            ->getDestination()
            ->willReturn(
                $this->destination
            );

        $this->getterProphecy(
            $this->destination,
            [
                'getId' => '1',
                'getName' => new \Ivoz\Provider\Domain\Model\Destination\Name(
                    'DestinationEn',
                    'DestinationEs'
                ),
            ],
            false
        );
    }
}
