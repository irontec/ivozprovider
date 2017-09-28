<?php

namespace Ivoz\Kam\Domain\Service\TrunksDialplan;

use Ivoz\Core\Domain\Service\EntityPersisterInterface;
use Ivoz\Core\Domain\Service\LifecycleEventHandlerInterface;
use Ivoz\Provider\Domain\Model\TransformationRulesetGroupsTrunk\TransformationRulesetGroupsTrunkInterface;
use Ivoz\Provider\Domain\Service\TransformationRulesetGroupsTrunk\TransformationRulesetGroupsTrunkLifecycleEventHandlerInterface;

/**
 * Class CreateCallerInRules
 * @package Ivoz\Kam\Domain\Service\TrunksDialplan
 * @lifecycle pre_persist
 */
class CreateCallerInRules implements TransformationRulesetGroupsTrunkLifecycleEventHandlerInterface
{
    use CreateDialplanRuleDtoTrait;

    protected $entityPersister;

    public function __construct(
       EntityPersisterInterface $entityPersister
    ) {
        $this->entityPersister = $entityPersister;
    }

    public function execute(TransformationRulesetGroupsTrunkInterface $entity, $isNew)
    {
        if (!$isNew || !$entity->getAutomatic()) {
            return;
        }

        $cc = $entity
            ->getCountry()
            ->getCallingCode();

        $intcode = $entity->getInternationalCode();

        $dto = $this->createDialplanRuleDtoByTransformationRulesetGroupsTrunk(
            $entity,
            "^($intcode|\+)([0-9]+)$",
            '\2',
            1,
            'International to E.164',
            $entity->getCallerIn()
        );
        $this->entityPersister->persistDto($dto);

        $dto = $this->createDialplanRuleDtoByTransformationRulesetGroupsTrunk(
            $entity,
            '^([0-9]+)$',
            $cc . '\1',
            2,
            'National to E.164',
            $entity->getCallerIn()
        );

        $this->entityPersister->persistDto($dto);
    }
}