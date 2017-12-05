<?php

namespace Ivoz\Provider\Domain\Service\LcrRule;

use Ivoz\Core\Domain\Service\EntityPersisterInterface;
use Ivoz\Provider\Domain\Model\LcrRule\LcrRuleDTO;
use Ivoz\Provider\Domain\Model\LcrRule\LcrRuleInterface;
use Ivoz\Provider\Domain\Model\RoutingPattern\RoutingPatternInterface;
use Ivoz\Provider\Domain\Service\RoutingPattern\RoutingPatternLifecycleEventHandlerInterface;

/**
 * Class UpdateByRoutingPattern
 * @package Ivoz\Provider\Domain\Service\LcrRule
 * @lifecycle
 */
class UpdateByRoutingPattern implements RoutingPatternLifecycleEventHandlerInterface
{
    /**
     * @var EntityPersisterInterface
     */
    protected $entityPersister;

    public function __construct(
        EntityPersisterInterface $entityPersister
    ) {
        $this->entityPersister = $entityPersister;
    }

    public function execute(RoutingPatternInterface $entity, $isNew)
    {
        // If any LcrRule uses this Pattern, update accordingly
        /**
         * @var LcrRuleInterface[] $lcrRules
         */
        $lcrRules = $entity->getLcrRules();

        if (empty($lcrRules)) {
            return;
        }

        foreach ($lcrRules as $lcrRule) {

            $lcrRule->setCondition($entity->getRegExp());

            /**
             * @var LcrRuleDTO $lcrRuleDTO
             */
            $lcrRuleDTO = $lcrRule->toDTO();
            $lcrRuleDTO
                ->setTag($entity->getName())
                ->setDescription($entity->getDescription());

            return $this
                ->entityPersister
                ->persistDto($lcrRuleDTO, $lcrRule);
        }
    }
}