<?php

namespace spec\Ivoz\Provider\Domain\Service\BillableCall;

use Ivoz\Provider\Domain\Model\RatingPlan\RatingPlanInterface;
use Ivoz\Provider\Domain\Model\RatingPlanGroup\RatingPlanGroupInterface;
use Ivoz\Provider\Domain\Service\BillableCall\UpdateDtoByTpCdr;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Ivoz\Cgr\Domain\Model\TpCdr\TpCdrInterface;
use Ivoz\Cgr\Domain\Model\TpCdr\TpCdrRepository;
use Ivoz\Cgr\Domain\Model\TpDestination\TpDestinationRepository;
use Ivoz\Cgr\Domain\Model\TpRatingPlan\TpRatingPlanInterface;
use Ivoz\Cgr\Domain\Model\TpRatingPlan\TpRatingPlanRepository;
use Ivoz\Provider\Domain\Model\BillableCall\BillableCallDto;
use Ivoz\Provider\Domain\Model\Destination\DestinationInterface;
use Ivoz\Provider\Domain\Model\RatingPlanGroup\Name;
use spec\HelperTrait;

class UpdateDtoByTpCdrSpec extends ObjectBehavior
{
    use HelperTrait;

    /**
     * @var TpCdrRepository
     */
    protected $tpCdrRepository;

    /**
     * @var TpRatingPlanRepository
     */
    protected $tpRatingPlanRepository;

    /**
     * @var TpDestinationRepository
     */
    protected $tpDestinationRepository;

    public function let(
        TpCdrRepository $tpCdrRepository,
        TpRatingPlanRepository $tpRatingPlanRepository,
        TpDestinationRepository $tpDestinationRepository
    ) {
        $this->tpCdrRepository = $tpCdrRepository;
        $this->tpRatingPlanRepository = $tpRatingPlanRepository;
        $this->tpDestinationRepository = $tpDestinationRepository;

        $this->beConstructedWith(
            $this->tpCdrRepository,
            $this->tpRatingPlanRepository,
            $this->tpDestinationRepository
        );
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(UpdateDtoByTpCdr::class);
    }

    function it_returns_on_empty_cgrid(
        BillableCallDto $billableCallDto
    ) {
        $cgrid = null;

        $this
            ->tpCdrRepository
            ->getDefaultRunByCgrid()
            ->shouldNotBeCalled();

        $this->execute(
            $billableCallDto,
            $cgrid,
            ''
        );
    }

    function it_returns_on_empty_defaultRunTpCdr(
        BillableCallDto $billableCallDto
    ) {
        $this
            ->tpCdrRepository
            ->getDefaultRunByCgrid(
                Argument::any()
            )
            ->shouldBeCalled();

        $this
            ->tpRatingPlanRepository
            ->findOneByTag(
                Argument::any()
            )
            ->shouldNotBeCalled();

        $this->execute(
            $billableCallDto,
            'cgrid',
            ''
        );
    }

    function it_updates_billableCallDto(
        BillableCallDto $billableCallDto,
        TpCdrInterface $tpCdr,
        TpRatingPlanInterface $tpRatingPlan,
        RatingPlanInterface $ratingPlan,
        RatingPlanGroupInterface $ratingPlanGroup,
        DestinationInterface $destination
    ) {
        $this->prepareExecution(
            $tpCdr,
            $tpRatingPlan,
            $ratingPlan,
            $ratingPlanGroup,
            $destination
        );

        $this->prepareBillableCallDtoSetters(
            $billableCallDto
        );

        $this->execute($billableCallDto, 'cgrid', 'es');
    }

    protected function prepareExecution(
        TpCdrInterface $defaultRunTpCdr,
        TpRatingPlanInterface $tpRatingPlan,
        RatingPlanInterface $ratingPlan,
        RatingPlanGroupInterface $ratingPlanGroup,
        DestinationInterface $destination
    ) {
        $this
            ->tpCdrRepository
            ->getDefaultRunByCgrid(
                Argument::any()
            )
            ->willReturn($defaultRunTpCdr);

        $this
            ->tpRatingPlanRepository
            ->findOneByTag(
                Argument::any()
            )
            ->willReturn($tpRatingPlan);

        $tpRatingPlan
            ->getRatingPlan()
            ->willReturn($ratingPlan);

        $ratingPlan
            ->getRatingPlanGroup()
            ->willReturn($ratingPlanGroup);

        $ratingPlanGroup
            ->getId()
            ->willReturn(null);

        $ratingPlanGroup
            ->getName()
            ->willReturn(
                new Name('', '')
            );

        $this->prepareDefaultRunTpCdrGetters(
            $defaultRunTpCdr,
            $destination,
            false
        );

        $this
            ->tpCdrRepository
            ->getCarrierRunByCgrid(
                Argument::any()
            )
            ->willReturn($defaultRunTpCdr);
    }

    protected function prepareBillableCallDtoSetters(
        BillableCallDto $billableCallDto
    ) {
        $any = Argument::any();
        $this->fluentSetterProphecy(
            $billableCallDto,
            [
                'setStartTime' => $any,
                'setDuration' => $any,
                'setCallee' => $any,
                'setDestinationId' => $any,
                'setDestinationName' => $any,
                'setRatingPlanGroupId' => $any,
                'setRatingPlanName' => $any,
                'setPrice' => $any
            ]
        );

        // Conditional
        $billableCallDto
            ->setCost($any)
            ->willReturn($billableCallDto);
    }

    /**
     * @param TpCdrInterface $defaultRunTpCdr
     * @param DestinationInterface $destination
     * @param bool $shouldBeCalled
     */
    protected function prepareDefaultRunTpCdrGetters(
        TpCdrInterface $defaultRunTpCdr,
        DestinationInterface $destination,
        $shouldBeCalled = false
    ) {
        $this->getterProphecy(
            $defaultRunTpCdr,
            [
                'getCostDetailsFirstTimespan' => ['something'],
                'getDestination' => $destination,
                'getRatingPlanTag' => 'rpt',
                'getMatchedDestinationTag' => 'destinationtag',
                'getStartTime' => new  \DateTime('2015-01-01 01:01:01'),
                'getDuration' => 120,
                'getCost' => 3
            ],
            $shouldBeCalled
        );
    }
}
