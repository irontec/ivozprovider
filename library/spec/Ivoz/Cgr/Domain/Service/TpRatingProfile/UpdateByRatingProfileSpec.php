<?php

namespace spec\Ivoz\Cgr\Domain\Service\TpRatingProfile;

use Doctrine\Common\Collections\ArrayCollection;
use Ivoz\Cgr\Domain\Model\TpRatingProfile\TpRatingProfileDto;
use Ivoz\Cgr\Domain\Model\TpRatingProfile\TpRatingProfileInterface;
use Ivoz\Cgr\Domain\Service\TpRatingProfile\UpdateByRatingProfile;
use Ivoz\Core\Domain\Service\EntityTools;
use Ivoz\Provider\Domain\Model\Brand\BrandInterface;
use Ivoz\Provider\Domain\Model\Carrier\CarrierInterface;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use Ivoz\Provider\Domain\Model\RatingPlanGroup\RatingPlanGroupInterface;
use Ivoz\Provider\Domain\Model\RatingProfile\RatingProfileInterface;
use Ivoz\Provider\Domain\Model\RoutingTag\RoutingTagInterface;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use spec\HelperTrait;

class UpdateByRatingProfileSpec extends ObjectBehavior
{
    use HelperTrait;

    protected $entityTools;
    protected $ratingProfile;
    protected $tpRatingProfile;
    protected $tpRatingProfileDto;
    protected $company;
    protected $carrier;
    protected $brand;
    protected $ratingPlanGroup;
    protected $routingTag;

    public function let()
    {
        $this->entityTools = $this->getTestDouble(
            EntityTools::class
        );

        $this->beConstructedWith(
            $this->entityTools
        );
    }

    protected function prepareExecution()
    {
        $this->ratingProfile = $this->getTestDouble(
            RatingProfileInterface::class,
            false
        );

        $this->tpRatingProfile = $this->getTestDouble(
            TpRatingProfileInterface::class,
            false
        );

        $this->tpRatingProfileDto = $this->getTestDouble(
            TpRatingProfileDto::class,
            false
        );

        $this->company = $this->getTestDouble(
            CompanyInterface::class,
            false
        );

        $this->carrier = $this->getTestDouble(
            CarrierInterface::class
        );

        $this->brand = $this->getTestDouble(
            BrandInterface::class,
            false
        );

        $this->ratingPlanGroup = $this->getTestDouble(
            RatingPlanGroupInterface::class,
            false
        );

        $this->routingTag = $this->getTestDouble(
            RoutingTagInterface::class,
            false
        );

        $activationTime = new \DateTime(
            '2019-01-02 23:00:00',
            new \DateTimeZone('UTC')
        );

        $this->getterProphecy(
            $this->ratingProfile,
            [
                'getCgrRatingProfile' => $this->tpRatingProfile,
                'getCompany' => $this->company,
                'getCarrier' => $this->carrier,
                'getRatingPlanGroup' => $this->ratingPlanGroup,
                'getRoutingTag' => $this->routingTag,
                'getActivationTime' => $activationTime,
                'getId' => 1
            ],
            false
        );

        $this->setterProphecy(
            $this->ratingProfile,
            [
                'replaceTpRatingProfiles' => function () {
                    return [
                        [Argument::type(ArrayCollection::class)],
                        $this->ratingProfile
                    ];
                }
            ],
            false
        );

        $this->getterProphecy(
            $this->company,
            [
                'getBrand' => $this->brand,
                'getCgrSubject' => 'c1'
            ],
            false
        );

        $this->getterProphecy(
            $this->carrier,
            [
                'getBrand' => $this->brand,
                'getCgrSubject' => 'cr1'
            ],
            false
        );

        $this->getterProphecy(
            $this->brand,
            [
                'getCgrTenant' => 'b1'
            ],
            false
        );

        $this->getterProphecy(
            $this->ratingPlanGroup,
            [
                'getCgrTag' => 'b1rp1'
            ],
            false
        );

        $this->getterProphecy(
            $this->routingTag,
            [
                'getCgrSubject' => 'rt1'
            ],
            false
        );

        $this->getterProphecy(
            $this->tpRatingProfileDto,
            [
                'getSubject' => ''
            ],
            false
        );

        $this->fluentSetterProphecy(
            $this->tpRatingProfileDto,
            [
                'setTpid' => Argument::any(),
                'setActivationTime' => Argument::any(),
                'setTenant' => Argument::any(),
                'setRatingPlanTag' => Argument::any(),
                'setRatingProfileId' => Argument::any(),
                'setSubject' => Argument::any(),
                'setCdrStatQueueIds' => Argument::any(),
                'setSubject' => Argument::any()
            ],
            false
        );

        $this
            ->entityTools
            ->entityToDto(
                $this->tpRatingProfile
            )
            ->willReturn(
                $this->tpRatingProfileDto
            );

        $this
            ->entityTools
            ->persistDto(
                $this->tpRatingProfileDto,
                $this->tpRatingProfile,
                true
            )
            ->willReturn(
                $this->tpRatingProfile
            );
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(UpdateByRatingProfile::class);
    }

    function it_persists_tp_rating_profile()
    {
        $this->prepareExecution();

        $this
            ->entityTools
            ->persistDto(
                $this->tpRatingProfileDto,
                $this->tpRatingProfile,
                true
            )
            ->willReturn(
                $this->tpRatingProfile
            )
            ->shouldBeCalled();

        $this->execute($this->ratingProfile);
    }

    function it_updates_TpRatingProfile()
    {
        $this->prepareExecution();

        $this
            ->ratingProfile
            ->replaceTpRatingProfiles(
                new ArrayCollection([$this->tpRatingProfile])
            )
            ->shouldbeCalled();

        $this
            ->execute($this->ratingProfile);
    }

    function it_updates_rating_profile()
    {
        $this->prepareExecution();

        $this
            ->entityTools
            ->persist($this->ratingProfile)
            ->shouldBeCalled();

        $this
            ->execute($this->ratingProfile);
    }

    function it_uses_carier_on_empty_company()
    {
        $this->prepareExecution();

        $this->ratingProfile
            ->getCompany()
            ->willReturn(null)
            ->shouldBeCalled();

        $this->getterProphecy(
            $this->carrier,
            [
                'getBrand' => $this->brand,
                'getCgrSubject' => 'something',
                'getCgrSubject' => 'something',
            ],
            true
        );

        $this
            ->execute($this->ratingProfile);
    }
}
