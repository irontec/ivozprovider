<?php

namespace Ivoz\Provider\Domain\Service\TransformationRule;

use Ivoz\Core\Application\Service\EntityTools;
use Ivoz\Provider\Domain\Model\TransformationRule\TransformationRuleInterface;
use Ivoz\Provider\Domain\Model\TransformationRuleSet\TransformationRuleSetDto;
use Ivoz\Provider\Domain\Model\TransformationRuleSet\TransformationRuleSetInterface;
use Ivoz\Provider\Domain\Service\TransformationRuleSet\TransformationRuleSetLifecycleEventHandlerInterface;

/**
 * Class GenerateRules
 * @package Ivoz\Provider\Domain\Service\TransformationRule
 */
class GenerateRules implements TransformationRuleSetLifecycleEventHandlerInterface
{
    /**
     * @var EntityTools
     */
    protected $entityTools;

    /**
     * @var GenerateInRules
     */
    protected $generateInRules;

    /**
     * @var GenerateOutRules
     */
    protected $generateOutRules;

    public function __construct(
        EntityTools $entityTools,
        GenerateInRules $generateInRules,
        GenerateOutRules $generateOutRules
    ) {
        $this->entityTools = $entityTools;
        $this->generateInRules = $generateInRules;
        $this->generateOutRules = $generateOutRules;
    }

    public static function getSubscribedEvents()
    {
        return [
            self::EVENT_POST_PERSIST => 10
        ];
    }

    public function execute(TransformationRuleSetInterface $transformationRuleSet)
    {
        // Only if requested to autogenerate rules
        if (!$transformationRuleSet->getGenerateRules()) {
            return;
        }

        // Delete existing Rules for given ruleset
        /** @var TransformationRuleInterface[] $rules */
        $rules = $transformationRuleSet->getRules();
        foreach ($rules as $rule) {
            $transformationRuleSet
                ->removeRule($rule);

            $this->entityTools
                ->remove($rule);
        }

        // Generate rules
        $this->generateInRules->execute($transformationRuleSet, 'callerin');
        $this->generateInRules->execute($transformationRuleSet, 'calleein');
        $this->generateOutRules->execute($transformationRuleSet, 'callerout');
        $this->generateOutRules->execute($transformationRuleSet, 'calleeout');

        // Mark rules as generated
        /** @var TransformationRuleSetDto $transformationRuleSetDto */
        $transformationRuleSetDto = $this->entityTools->entityToDto($transformationRuleSet);
        $transformationRuleSetDto->setGenerateRules(false);
        $this->entityTools->persistDto(
            $transformationRuleSetDto,
            $transformationRuleSet,
            false
        );

        $this->entityTools->dispatchQueuedOperations();
    }
}
