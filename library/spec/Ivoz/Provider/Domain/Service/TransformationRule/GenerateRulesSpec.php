<?php

namespace spec\Ivoz\Provider\Domain\Service\TransformationRule;

use Ivoz\Core\Domain\Service\EntityPersisterInterface;
use Ivoz\Provider\Domain\Model\TransformationRule\TransformationRuleInterface;
use Ivoz\Provider\Domain\Model\TransformationRuleSet\TransformationRuleSetInterface;
use Ivoz\Provider\Domain\Service\TransformationRule\GenerateInRules;
use Ivoz\Provider\Domain\Service\TransformationRule\GenerateOutRules;
use Ivoz\Provider\Domain\Service\TransformationRule\GenerateRules;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class GenerateRulesSpec extends ObjectBehavior
{
    /**
     * @var EntityPersisterInterface
     */
    protected $entityPersister;

    /**
     * @var GenerateInRules
     */
    protected $generateInRules;

    /**
     * @var GenerateOutRules
     */
    protected $generateOutRules;

    function let(
        EntityPersisterInterface $entityPersister,
        GenerateInRules $generateInRules,
        GenerateOutRules $generateOutRules
    ) {
        $this->entityPersister = $entityPersister;
        $this->generateInRules = $generateInRules;
        $this->generateOutRules = $generateOutRules;

        $this->beConstructedWith(...func_get_args());
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(GenerateRules::class);
    }

    function it_does_nothing_when_generateRules_is_false(
        TransformationRuleSetInterface $entity
    ) {
        $entity
            ->getGenerateRules()
            ->willReturn(false)
            ->shouldBeCalled();

        $this->execute($entity, true);
    }

    private function prepareExample(
        TransformationRuleSetInterface $entity
    ) {
        $entity
            ->getGenerateRules()
            ->willReturn(true)
            ->shouldBeCalled();

        $entity
            ->getRules()
            ->willReturn([])
            ->shouldBeCalled();

        $this
            ->generateInRules
            ->execute(
                Argument::any(),
                Argument::any()
            )
            ->shouldBeCalled();

        $this
            ->generateOutRules
            ->execute(
                Argument::any(),
                Argument::any()
            )
            ->shouldBeCalled();

        $entity
            ->setGenerateRules(false)
            ->shouldBeCalled();

        $this
            ->entityPersister
            ->persist($entity)
            ->shouldBeCalled();
    }

    function it_removes_already_existing_rules(
        TransformationRuleSetInterface $entity,
        TransformationRuleInterface $transformationRule
    ) {
        $this->prepareExample($entity);

        $entity
            ->getRules()
            ->willReturn([$transformationRule])
            ->shouldBeCalled();

        $entity
            ->removeRule($transformationRule)
            ->shouldBeCalled();

        $this
            ->entityPersister
            ->remove($transformationRule)
            ->shouldBeCalled();

        $this->execute($entity, true);
    }

    function it_calls_generate_callerin_rules(
        TransformationRuleSetInterface $entity
    ) {
        $this->prepareExample($entity);

        $this
            ->generateInRules
            ->execute($entity, 'callerin')
        ->shouldBeCalled();

        $this->execute($entity, true);
    }

    function it_calls_generate_calleein_rules(
        TransformationRuleSetInterface $entity
    ) {
        $this->prepareExample($entity);

        $this
            ->generateInRules
            ->execute($entity, 'calleein')
            ->shouldBeCalled();

        $this->execute($entity, true);
    }

    function it_calls_generate_callerout_rules(
        TransformationRuleSetInterface $entity
    ) {
        $this->prepareExample($entity);

        $this
            ->generateOutRules
            ->execute($entity, 'callerout')
            ->shouldBeCalled();

        $this->execute($entity, true);
    }

    function it_calls_generate_calleeout_rules(
        TransformationRuleSetInterface $entity
    ) {
        $this->prepareExample($entity);

        $this
            ->generateOutRules
            ->execute($entity, 'calleeout')
            ->shouldBeCalled();

        $this->execute($entity, true);
    }
}
