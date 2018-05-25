<?php

namespace spec\Ivoz\Provider\Domain\Service\LcrRule;

use Ivoz\Core\Application\Service\CreateEntityFromDTO;
use Ivoz\Core\Domain\Service\EntityPersisterInterface;
use Ivoz\Provider\Domain\Model\Brand\BrandInterface;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use Ivoz\Provider\Domain\Model\LcrRule\LcrRule;
use Ivoz\Provider\Domain\Model\LcrRule\LcrRuleDto;
use Ivoz\Provider\Domain\Model\LcrRule\LcrRuleInterface;
use Ivoz\Provider\Domain\Model\OutgoingRouting\OutgoingRoutingInterface;
use Ivoz\Provider\Domain\Model\RoutingPattern\Name;
use Ivoz\Provider\Domain\Model\RoutingPattern\Description;
use Ivoz\Provider\Domain\Model\RoutingPattern\RoutingPatternInterface;
use Ivoz\Provider\Domain\Service\LcrRule\CreateByOutgoingRoutingAndRoutingPattern;
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
        LcrRuleInterface $lcrRule
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
            ->execute(LcrRule::class, Argument::type(LcrRuleDto::class))
            ->willReturn($lcrRule);

        $lcrRule
            ->setOutgoingRouting($entity)
            ->shouldBeCalled();

    }

    function it_creates_lcr_rule(
        OutgoingRoutingInterface $entity,
        BrandInterface $brand,
        LcrRuleInterface $lcrRule
    ) {
        $this->createExampleBase($entity, $brand, $lcrRule);

        $this
            ->entityPersister
            ->persist(Argument::type(LcrRule::class), true);

        $this->execute($entity, null);
    }

    function it_sets_fax_properties_when_pattern_is_null(
        OutgoingRoutingInterface $entity,
        BrandInterface $brand,
        LcrRuleInterface $lcrRule
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
        LcrRuleInterface $lcrRule,
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

        $validatorCallback = function (LcrRule $lcrRule) {
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
        LcrRuleInterface $lcrRule,
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

        $validatorCallback = function (LcrRule $lcrRule) {
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
        LcrRuleInterface $lcrRule
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
