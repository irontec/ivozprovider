<?php

namespace Ivoz\Provider\Domain\Service\TransformationRule;

use Ivoz\Core\Domain\Service\EntityPersisterInterface;
use Ivoz\Provider\Domain\Model\TransformationRule\TransformationRuleInterface;
use Ivoz\Provider\Domain\Model\TransformationRuleSet\TransformationRuleSetInterface;
use Ivoz\Provider\Domain\Service\TransformationRuleSet\TransformationRuleSetLifecycleEventHandlerInterface;

/**
 * Class GenerateRules
 * @package Ivoz\Provider\Domain\Service\TransformationRule
 */
class GenerateRules implements TransformationRuleSetLifecycleEventHandlerInterface
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

    public function __construct(
        EntityPersisterInterface $entityPersister,
        GenerateInRules $generateInRules,
        GenerateOutRules $generateOutRules
    ) {
        $this->entityPersister = $entityPersister;
        $this->generateInRules = $generateInRules;
        $this->generateOutRules = $generateOutRules;
    }

    public static function getSubscribedEvents()
    {
        return [
            self::EVENT_POST_PERSIST => 10
        ];
    }

    public function execute(TransformationRuleSetInterface $entity, $isNew)
    {
        // Only if requested to autogenerate rules
        if (!$entity->getGenerateRules()) {
            return;
        }

        // Delete existing Rules for given ruleset
        /** @var TransformationRuleInterface[] $rules */
        $rules = $entity->getRules();
        foreach ($rules as $rule) {

            $entity
                ->removeRule($rule);

            $this->entityPersister
                ->remove($rule);
        }

        // Generate rules
        $this->generateInRules->execute($entity, 'callerin');
        $this->generateInRules->execute($entity, 'calleein');
        $this->generateOutRules->execute($entity, 'callerout');
        $this->generateOutRules->execute($entity, 'calleeout');

        // Mark rules as generated
        $entity->setGenerateRules(false);
        $this->entityPersister->persist($entity);
    }
}