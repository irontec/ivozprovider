<?php

namespace spec\Ivoz\Provider\Domain\Service\LcrRule;

use Ivoz\Core\Domain\Service\EntityPersisterInterface;
use Ivoz\Provider\Domain\Model\LcrRule\LcrRuleDto;
use Ivoz\Provider\Domain\Model\LcrRule\LcrRuleInterface;
use Ivoz\Provider\Domain\Model\RoutingPattern\RoutingPatternInterface;
use Ivoz\Provider\Domain\Service\LcrRule\UpdateByRoutingPattern;
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
        LcrRuleInterface $lcrRule
    ) {
        $regExp = 'a-z';
        $this->getterProphecy(
            $entity,
            [
                'getLcrRules' => [$lcrRule],
                'getRegExp' => $regExp,
                'getName' => 'Name',
                'getDescription' => 'Description'
            ]
        );

        $lcrRuleDto = new LcrRuleDto();
        $lcrRule
            ->toDto()
            ->willReturn($lcrRuleDto);

        $lcrRule
            ->setCondition($regExp)
            ->shouldBeCalled();

        $this
            ->entityPersister
            ->persistDto($lcrRuleDto, $lcrRule)
            ->shouldBeCalled();

        $this->execute($entity, false);
    }
}

