<?php

namespace spec\Ivoz\Provider\Domain\Service\TransformationRule;

use Ivoz\Core\Domain\Service\EntityTools;
use Ivoz\Core\Domain\Service\EntityPersisterInterface;
use Ivoz\Provider\Domain\Model\TransformationRule\TransformationRuleInterface;
use Ivoz\Provider\Domain\Model\TransformationRuleSet\TransformationRuleSetDto;
use Ivoz\Provider\Domain\Model\TransformationRuleSet\TransformationRuleSetInterface;
use Ivoz\Provider\Domain\Service\TransformationRule\GenerateInRules;
use Ivoz\Provider\Domain\Service\TransformationRule\GenerateOutRules;
use Ivoz\Provider\Domain\Service\TransformationRule\GenerateRules;
use Ivoz\Provider\Domain\Service\TransformationRuleSet\DisableGenerateRules;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class GenerateRulesSpec extends ObjectBehavior
{
    protected $entityTools;
    protected $generateInRules;
    protected $generateOutRules;
    protected $disableGenerateRules;

    function let(
        EntityTools $entityTools,
        GenerateInRules $generateInRules,
        GenerateOutRules $generateOutRules,
        DisableGenerateRules $disableGenerateRules
    ) {
        $this->entityTools = $entityTools;
        $this->generateInRules = $generateInRules;
        $this->generateOutRules = $generateOutRules;
        $this->disableGenerateRules = $disableGenerateRules;

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

        $this->execute($entity);
    }

    private function prepareExample(
        TransformationRuleSetInterface $transformationRuleSet,
        TransformationRuleSetDto $transformationRuleSetDto
    ) {
        $transformationRuleSet
            ->getGenerateRules()
            ->willReturn(true)
            ->shouldBeCalled();

        $transformationRuleSet
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

        $this
            ->entityTools
            ->dispatchQueuedOperations()
            ->shouldBeCalled();
    }

    function it_removes_already_existing_rules(
        TransformationRuleSetInterface $transformationRuleSet,
        TransformationRuleSetDto $transformationRuleSetDto,
        TransformationRuleInterface $transformationRule
    ) {
        $this->prepareExample($transformationRuleSet, $transformationRuleSetDto);

        $transformationRuleSet
            ->getRules()
            ->willReturn([$transformationRule])
            ->shouldBeCalled();

        $transformationRuleSet
            ->removeRule($transformationRule)
            ->shouldBeCalled();

        $this
            ->entityTools
            ->remove($transformationRule)
            ->shouldBeCalled();

        $this->execute($transformationRuleSet);
    }

    function it_calls_generate_callerin_rules(
        TransformationRuleSetInterface $transformationRuleSet,
        TransformationRuleSetDto $transformationRuleSetDto
    ) {
        $this->prepareExample($transformationRuleSet, $transformationRuleSetDto);

        $this
            ->generateInRules
            ->execute($transformationRuleSet, 'callerin')
            ->shouldBeCalled();

        $this->execute($transformationRuleSet);
    }

    function it_calls_generate_calleein_rules(
        TransformationRuleSetInterface $transformationRuleSet,
        TransformationRuleSetDto $transformationRuleSetDto
    ) {
        $this->prepareExample($transformationRuleSet, $transformationRuleSetDto);

        $this
            ->generateInRules
            ->execute($transformationRuleSet, 'calleein')
            ->shouldBeCalled();

        $this->execute($transformationRuleSet);
    }

    function it_calls_generate_callerout_rules(
        TransformationRuleSetInterface $transformationRuleSet,
        TransformationRuleSetDto $transformationRuleSetDto
    ) {
        $this->prepareExample($transformationRuleSet, $transformationRuleSetDto);

        $this
            ->generateOutRules
            ->execute($transformationRuleSet, 'callerout')
            ->shouldBeCalled();

        $this->execute($transformationRuleSet);
    }

    function it_calls_generate_calleeout_rules(
        TransformationRuleSetInterface $transformationRuleSet,
        TransformationRuleSetDto $transformationRuleSetDto
    ) {
        $this->prepareExample($transformationRuleSet, $transformationRuleSetDto);

        $this
            ->generateOutRules
            ->execute($transformationRuleSet, 'calleeout')
            ->shouldBeCalled();

        $this->execute($transformationRuleSet);
    }
}
