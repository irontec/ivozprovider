<?php

namespace spec\Ivoz\Provider\Domain\Service\BillableCall;

use Ivoz\Kam\Domain\Model\TrunksCdr\Event\TrunksCdrWasMigrated;
use Ivoz\Kam\Domain\Model\TrunksCdr\TrunksCdrInterface;
use Ivoz\Provider\Domain\Model\BillableCall\BillableCallInterface;
use Ivoz\Provider\Domain\Model\Brand\BrandInterface;
use Ivoz\Provider\Domain\Model\RatingPlan\RatingPlanInterface;
use Ivoz\Provider\Domain\Model\RatingPlanGroup\RatingPlanGroupInterface;
use Ivoz\Provider\Domain\Service\BillableCall\UpdateByTpCdr;
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
use Ivoz\Core\Application\Service\EntityTools;
use spec\HelperTrait;

class UpdateByTpCdrSpec extends ObjectBehavior
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

    /**
     * @var EntityTools
     */
    protected $entityTools;

    public function let(
        TpCdrRepository $tpCdrRepository,
        TpRatingPlanRepository $tpRatingPlanRepository,
        TpDestinationRepository $tpDestinationRepository,
        EntityTools $entityTools
    ) {
        $this->tpCdrRepository = $tpCdrRepository;
        $this->tpRatingPlanRepository = $tpRatingPlanRepository;
        $this->tpDestinationRepository = $tpDestinationRepository;
        $this->entityTools = $entityTools;

        $this->beConstructedWith(
            $this->tpCdrRepository,
            $this->tpRatingPlanRepository,
            $this->tpDestinationRepository,
            $this->entityTools
        );
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(UpdateByTpCdr::class);
    }

    function it_returns_on_empty_cgrid(
        TrunksCdrInterface $trunksCdr,
        BillableCallInterface $billableCall
    ) {
        $cgrid = null;

        $this
            ->tpCdrRepository
            ->getDefaultRunByCgrid()
            ->shouldNotBeCalled();

        $this->handle(
            new TrunksCdrWasMigrated(
                $trunksCdr->getWrappedObject(),
                $billableCall->getWrappedObject()
            )
        );
    }

    function it_returns_on_empty_defaultRunTpCdr(
        TrunksCdrInterface $trunksCdr,
        BillableCallInterface $billableCall
    ) {
        $trunksCdr
            ->getCgrid()
            ->willReturn(1);

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

        $this->handle(
            new TrunksCdrWasMigrated(
                $trunksCdr->getWrappedObject(),
                $billableCall->getWrappedObject()
            )
        );
    }

    function it_updates_billableCallDto(
        TrunksCdrInterface $trunksCdr,
        BillableCallInterface $billableCall,
        BillableCallDto $billableCallDto,
        TpCdrInterface $tpCdr,
        TpRatingPlanInterface $tpRatingPlan,
        RatingPlanInterface $ratingPlan,
        RatingPlanGroupInterface $ratingPlanGroup,
        BrandInterface $brand,
        DestinationInterface $destination
    ) {
        $this->prepareExecution(
            $trunksCdr,
            $billableCall,
            $billableCallDto,
            $tpCdr,
            $tpRatingPlan,
            $ratingPlan,
            $ratingPlanGroup,
            $brand,
            $destination
        );

        $this->prepareBillableCallDtoSetters(
            $billableCallDto
        );

        $this->handle(
            new TrunksCdrWasMigrated(
                $trunksCdr->getWrappedObject(),
                $billableCall->getWrappedObject()
            )
        );
    }

    protected function prepareExecution(
        TrunksCdrInterface $trunksCdr,
        BillableCallInterface $billableCall,
        BillableCallDto $billableCallDto,
        TpCdrInterface $defaultRunTpCdr,
        TpRatingPlanInterface $tpRatingPlan,
        RatingPlanInterface $ratingPlan,
        RatingPlanGroupInterface $ratingPlanGroup,
        BrandInterface $brand,
        DestinationInterface $destination
    ) {
        $trunksCdr
            ->getCgrid()
            ->willReturn(1);

        $trunksCdr
            ->getBrand()
            ->willReturn($brand);

        $this
            ->entityTools
            ->entityToDto($billableCall)
            ->willReturn($billableCallDto);

        $this
            ->entityTools
            ->persistDto(
                $billableCallDto,
                $billableCall,
                false
            )
            ->willReturn($billableCall);

        $brand
            ->getLanguageCode()
            ->willReturn('es');

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
