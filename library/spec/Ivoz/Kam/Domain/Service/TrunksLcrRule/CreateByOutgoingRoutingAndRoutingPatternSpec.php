<?php

namespace spec\Ivoz\Kam\Domain\Service\TrunksLcrRule;

use Ivoz\Core\Application\Service\CreateEntityFromDTO;
use Ivoz\Core\Application\Service\EntityTools;
use Ivoz\Kam\Domain\Model\TrunksLcrRule\TrunksLcrRuleRepository;
use Ivoz\Provider\Domain\Model\Brand\BrandInterface;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use Ivoz\Kam\Domain\Model\TrunksLcrRule\TrunksLcrRule;
use Ivoz\Kam\Domain\Model\TrunksLcrRule\TrunksLcrRuleDto;
use Ivoz\Kam\Domain\Model\TrunksLcrRule\TrunksLcrRuleInterface;
use Ivoz\Provider\Domain\Model\OutgoingRouting\OutgoingRoutingInterface;
use Ivoz\Provider\Domain\Model\RoutingPattern\RoutingPatternInterface;
use Ivoz\Kam\Domain\Service\TrunksLcrRule\TrunksLcrRuleFactory;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class CreateByOutgoingRoutingAndRoutingPatternSpec extends ObjectBehavior
{
    /**
     * @var EntityTools
     */
    protected $entityTools;

    /**
     * @var CreateEntityFromDTO
     */
    protected $createEntityFromDTO;

    /**
     * @var TrunksLcrRuleRepository
     */
    protected $trunksLcrRuleRepository;

    public function let(
        EntityTools $entityTools,
        CreateEntityFromDTO $createEntityFromDTO,
        TrunksLcrRuleRepository $trunksLcrRuleRepository
    ) {
        $this->entityTools = $entityTools;
        $this->createEntityFromDTO = $createEntityFromDTO;
        $this->trunksLcrRuleRepository = $trunksLcrRuleRepository;

        $this->beConstructedWith($trunksLcrRuleRepository, $entityTools);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(TrunksLcrRuleFactory::class);
    }

    protected function createExampleBase(
        OutgoingRoutingInterface $entity,
        BrandInterface $brand,
        TrunksLcrRuleInterface $lcrRule
    ) {
        $entity
            ->getBrand()
            ->willReturn($brand)
            ->shouldBeCalled();

        $entity
            ->getId()
            ->willReturn(1)
            ->shouldBeCalled();

        $brand
            ->getId()
            ->willReturn(1);

        $entity
            ->getCompany()
            ->willReturn(null);

        $entity
            ->getRoutingTag()
            ->willReturn(null)
            ->shouldBeCalled();
    }

    function it_creates_lcr_rule(
        OutgoingRoutingInterface $entity,
        BrandInterface $brand,
        TrunksLcrRuleInterface $lcrRule
    ) {
        $this->createExampleBase($entity, $brand, $lcrRule);

        $this
            ->entityTools
            ->persistDto(
                Argument::type(TrunksLcrRuleDto::class),
                Argument::type(TrunksLcrRule::class),
                true
            );

        $this->execute($entity, null);
    }

    function it_sets_outgoingRouting_id(
        OutgoingRoutingInterface $entity,
        BrandInterface $brand,
        TrunksLcrRuleInterface $lcrRule
    ) {
        $this->createExampleBase($entity, $brand, $lcrRule);

        $validatorCallback = function (LcrRuleDto $lcrRuleDto) use ($entity) {
            if ($lcrRuleDto->getOutgoingRoutingId() === $entity->getId()) {
                return false;
            }
        };

        $this
            ->entityTools
            ->persistDto(
                Argument::that($validatorCallback),
                Argument::any(),
                true
            );

        $this->execute($entity, null);
    }

    function it_sets_fax_properties_when_pattern_is_null(
        OutgoingRoutingInterface $entity,
        BrandInterface $brand,
        TrunksLcrRuleInterface $lcrRule
    ) {
        $this->createExampleBase($entity, $brand, $lcrRule);

        $validatorCallback = function (LcrRuleDto $lcrRuleDto) {
            if ($lcrRuleDto->getPrefix() !== 'fax') {
                return false;
            }
        };

        $this
            ->entityTools
            ->persistDto(
                Argument::that($validatorCallback),
                Argument::type(TrunksLcrRule::class),
                true
            );

        $this->execute($entity, null);
    }

    function it_sets_properties_by_pattern(
        OutgoingRoutingInterface $entity,
        BrandInterface $brand,
        TrunksLcrRuleInterface $lcrRule,
        RoutingPatternInterface $pattern
    ) {
        $this->createExampleBase($entity, $brand, $lcrRule);

        $pattern
            ->getPrefix()
            ->willReturn('prefix')
            ->shouldBeCalled();

        $pattern
            ->getId()
            ->willReturn(1)
            ->shouldBeCalled();

        $validatorCallback = function (TrunksLcrRuleDto $lcrRuleDto) {
            if ($lcrRuleDto->getPrefix() !== 'prefix') {
                return false;
            }

            return $lcrRuleDto->getRoutingPatternId() === 1;
        };

        $this
            ->entityTools
            ->persist(
                Argument::that($validatorCallback),
                Argument::type(TrunksLcrRule::class),
                true
            );

        $this->execute($entity, $pattern);
    }

    function it_sets_fromUri_by_company_and_brand_if_not_empty(
        OutgoingRoutingInterface $entity,
        BrandInterface $brand,
        TrunksLcrRuleInterface $lcrRule,
        CompanyInterface $company
    ) {
        $this->createExampleBase($entity, $brand, $lcrRule);

        $entity
            ->getCompany()
            ->willReturn($company)
            ->shouldBeCalled();

        $company
            ->getId()
            ->willReturn(2);

        $validatorCallback = function (TrunksLcrRuleDto $lcrRuleDto) {
            return $lcrRuleDto->getFromUri() === '^b1c2$';
        };

        $this
            ->entityTools
            ->persist(
                Argument::that($validatorCallback),
                Argument::type(TrunksLcrRule::class),
                true
            );

        $this->execute($entity, null);
    }

    function it_sets_fromUri_by_brand_if_company_is_empty(
        OutgoingRoutingInterface $entity,
        BrandInterface $brand,
        TrunksLcrRuleInterface $lcrRule
    ) {
        $this->createExampleBase($entity, $brand, $lcrRule);

        $entity
            ->getCompany()
            ->willReturn(null)
            ->shouldBeCalled();

        $validatorCallback = function (LcrRuleDto $lcrRuleDto) {
            return $lcrRuleDto->getFromUri() === '^b1c[0-9]+$';
        };

        $this
            ->entityTools
            ->persist(
                Argument::that($validatorCallback),
                Argument::type(TrunksLcrRule::class),
                true
            );

        $this->execute($entity, null);
    }
}
