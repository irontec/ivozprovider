<?php

namespace Ivoz\Kam\Domain\Service\TrunksDialplan;

use Ivoz\Core\Domain\Service\EntityPersisterInterface;
use Ivoz\Core\Domain\Service\LifecycleEventHandlerInterface;
use Ivoz\Provider\Domain\Model\TransformationRulesetGroupsTrunk\TransformationRulesetGroupsTrunkInterface;
use Ivoz\Provider\Domain\Service\TransformationRulesetGroupsTrunk\TransformationRulesetGroupsTrunkLifecycleEventHandlerInterface;

/**
 * Class CreateCallerOutRules
 * @package Ivoz\Kam\Domain\Service\TrunksDialplan
 * @lifecycle pre_persist
 */
class CreateCallerOutRules implements TransformationRulesetGroupsTrunkLifecycleEventHandlerInterface
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
            "^$cc([0-9]+)$",
            '\1',
            1,
            'E.164 to national',
            $entity->getCallerOut()
        );
        $this->entityPersister->persistDto($dto);

        $dto = $this->createDialplanRuleDtoByTransformationRulesetGroupsTrunk(
            $entity,
            '^([0-9]+)$',
            $intcode . '\1',
            2,
            'E.164 to international',
            $entity->getCallerOut()
        );
        $this->entityPersister->persistDto($dto);
    }
}