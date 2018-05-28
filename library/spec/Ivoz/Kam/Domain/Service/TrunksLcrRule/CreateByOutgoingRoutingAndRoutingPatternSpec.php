<?php

namespace spec\Ivoz\Kam\Domain\Service\TrunksLcrRule;

use Ivoz\Core\Application\Service\CreateEntityFromDTO;
use Ivoz\Core\Domain\Service\EntityPersisterInterface;
use Ivoz\Provider\Domain\Model\Brand\BrandInterface;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use Ivoz\Kam\Domain\Model\TrunksLcrRule\TrunksLcrRule;
use Ivoz\Kam\Domain\Model\TrunksLcrRule\TrunksLcrRuleDto;
use Ivoz\Kam\Domain\Model\TrunksLcrRule\TrunksLcrRuleInterface;
use Ivoz\Provider\Domain\Model\OutgoingRouting\OutgoingRoutingInterface;
use Ivoz\Provider\Domain\Model\RoutingPattern\RoutingPatternInterface;
use Ivoz\Kam\Domain\Service\TrunksLcrRule\CreateByOutgoingRoutingAndRoutingPattern;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class CreateByOutgoingRoutingAndRoutingPatternSpec extends ObjectBehavior
{
    /**
     * @var EntityPersisterInterface
     */
    protected $entityPersister;

    /**
     * @var CreateEntityFromDTO
     */
    protected $createEntityFromDTO;

    public function let(
        EntityPersisterInterface $entityPersister,
        CreateEntityFromDTO $createEntityFromDTO
    ) {
        $this->entityPersister = $entityPersister;
        $this->createEntityFromDTO = $createEntityFromDTO;

        $this->beConstructedWith($entityPersister, $createEntityFromDTO);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(CreateByOutgoingRoutingAndRoutingPattern::class);
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

        $this
            ->createEntityFromDTO
            ->execute(TrunksLcrRule::class, Argument::type(TrunksLcrRuleDto::class))
            ->willReturn($lcrRule);

        $lcrRule
            ->setOutgoingRouting($entity)
            ->shouldBeCalled();

    }

    function it_creates_lcr_rule(
        OutgoingRoutingInterface $entity,
        BrandInterface $brand,
        TrunksLcrRuleInterface $lcrRule
    ) {
        $this->createExampleBase($entity, $brand, $lcrRule);

        $this
            ->entityPersister
            ->persist(Argument::type(TrunksLcrRule::class), true);

        $this->execute($entity, null);
    }

    function it_sets_fax_properties_when_pattern_is_null(
        OutgoingRoutingInterface $entity,
        BrandInterface $brand,
        TrunksLcrRuleInterface $lcrRule
    ) {
        $this->createExampleBase($entity, $brand, $lcrRule);

        $validatorCallback = function (LcrRule $lcrRule) {
            if ($lcrRule->getPrefix() !== 'fax') {
                return false;
            }
        };

        $this
            ->entityPersister
            ->persist(Argument::that($validatorCallback), true);

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

        $validatorCallback = function (TrunksLcrRule $lcrRule) {
            if ($lcrRule->getPrefix() !== 'prefix') {
                return false;
            }

            return $lcrRule->getRoutingPattern()->getId() === 1;
        };

        $this
            ->entityPersister
            ->persist(Argument::that($validatorCallback), true);

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

        $validatorCallback = function (TrunksLcrRule $lcrRule) {
            return $lcrRule->getFromUri() === '^b1c2$';
        };

        $this
            ->entityPersister
            ->persist(Argument::that($validatorCallback), true);

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

        $validatorCallback = function (LcrRule $lcrRule) {
            return $lcrRule->getFromUri() === '^b1c[0-9]+$';
        };

        $this
            ->entityPersister
            ->persist(Argument::that($validatorCallback), true);

        $this->execute($entity, null);
    }
}
