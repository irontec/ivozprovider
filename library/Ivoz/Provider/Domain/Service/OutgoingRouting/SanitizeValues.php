<?php

namespace Ivoz\Provider\Domain\Service\OutgoingRouting;

use Ivoz\Provider\Domain\Model\OutgoingRouting\OutgoingRoutingInterface;

/**
 * Class SanitizeValues
 * @package Ivoz\Provider\Domain\Service\OutgoingRouting
 * @lifecycle pre_persist
 */
class SanitizeValues implements OutgoingRoutingLifecycleEventHandlerInterface
{
    public function __construct() {}

    public function execute(OutgoingRoutingInterface $entity)
    {
        if ($entity->getType() == 'group') {
            $entity->setRoutingPattern(null);
        } else if ($entity->getType() == 'pattern') {
            $entity->setRoutingPatternGroup(null);
        } else if ($entity->getType() == 'fax') {
            $entity->setRoutingPattern(null);
            $entity->setRoutingPatternGroup(null);
        } else {
            throw new \Exception('Incorrect Outgoing Routing Type');
        }

    }
}