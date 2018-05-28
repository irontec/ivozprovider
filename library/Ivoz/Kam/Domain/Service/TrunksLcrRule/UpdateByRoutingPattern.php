<?php

namespace Ivoz\Kam\Domain\Service\TrunksLcrRule;

use Ivoz\Core\Domain\Service\EntityPersisterInterface;
use Ivoz\Kam\Domain\Model\TrunksLcrRule\TrunksLcrRuleDto;
use Ivoz\Kam\Domain\Model\TrunksLcrRule\TrunksLcrRuleInterface;
use Ivoz\Provider\Domain\Model\RoutingPattern\RoutingPatternInterface;
use Ivoz\Provider\Domain\Service\RoutingPattern\RoutingPatternLifecycleEventHandlerInterface;

/**
 * Class UpdateByRoutingPattern
 * @package Ivoz\Kam\Domain\Service\TrunksLcrRule
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

    public static function getSubscribedEvents()
    {
        return [
            self::EVENT_POST_PERSIST => 10
        ];
    }

    public function execute(RoutingPatternInterface $entity, $isNew)
    {
        // If any LcrRule uses this Pattern, update accordingly
        /**
         * @var TrunksLcrRuleInterface[] $lcrRules
         */
        $lcrRules = $entity->getLcrRules();

        if (empty($lcrRules)) {
            return;
        }

        foreach ($lcrRules as $lcrRule) {

            /**
             * @var TrunksLcrRuleDTO $lcrRuleDTO
             */
            $lcrRuleDTO = $lcrRule->toDto();

            return $this
                ->entityPersister
                ->persistDto($lcrRuleDTO, $lcrRule);
        }
    }
}