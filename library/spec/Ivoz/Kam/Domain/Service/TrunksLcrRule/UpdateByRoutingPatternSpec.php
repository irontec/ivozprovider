<?php

namespace spec\Ivoz\Kam\Domain\Service\TrunksLcrRule;

use Ivoz\Core\Domain\Service\EntityPersisterInterface;
use Ivoz\Kam\Domain\Model\TrunksLcrRule\TrunksLcrRuleDto;
use Ivoz\Kam\Domain\Model\TrunksLcrRule\TrunksLcrRuleInterface;
use Ivoz\Provider\Domain\Model\RoutingPattern\RoutingPatternInterface;
use Ivoz\Kam\Domain\Service\TrunksLcrRule\UpdateByRoutingPattern;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use spec\HelperTrait;

class UpdateByRoutingPatternSpec extends ObjectBehavior
{
    use HelperTrait;

    /**
     * @var EntityPersisterInterface
     */
    protected $entityPersister;

    public function let(
        EntityPersisterInterface $entityPersister
    ) {
        $this->entityPersister = $entityPersister;

        $this->beConstructedWith($entityPersister);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(UpdateByRoutingPattern::class);
    }

    function it_does_nothing_on_empty_lcr_rules(
        RoutingPatternInterface $entity
    ) {
        $entity
            ->getLcrRules()
            ->willReturn([]);

        $this->execute($entity, false);

    }

    function it_updates_lcr_rules(
        RoutingPatternInterface $entity,
        TrunksLcrRuleInterface $lcrRule
    ) {
        $this->getterProphecy(
            $entity,
            [
                'getLcrRules' => [$lcrRule],
            ]
        );

        $lcrRuleDto = new TrunksLcrRuleDto();
        $lcrRule
            ->toDto()
            ->willReturn($lcrRuleDto);

        $this
            ->entityPersister
            ->persistDto($lcrRuleDto, $lcrRule)
            ->shouldBeCalled();

        $this->execute($entity, false);
    }
}

