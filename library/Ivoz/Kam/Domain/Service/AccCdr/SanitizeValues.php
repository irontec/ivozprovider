<?php

namespace Ivoz\Kam\Domain\Service\AccCdr;

use Ivoz\Core\Domain\Service\LifecycleEventHandlerInterface;
use Ivoz\Kam\Domain\Model\AccCdr\AccCdrInterface;

/**
 * Class SanitizeValues
 * @package Ivoz\Kam\Domain\Service\AccCdr
 * @lifecycle pre_persist
 */
class SanitizeValues implements AccCdrLifecycleEventHandlerInterface
{
    public function __construct() {}

    public function execute(AccCdrInterface $entity)
    {
        $pricingPlan = $entity->getPricingPlan();
        if ($pricingPlan) {
            $entity->setPricingPlanName(
                $pricingPlan->getName()
            );
        }

        $targetPattern = $entity->getTargetPattern();
        if ($targetPattern) {
            $entity->setTargetPatternName(
                $targetPattern->getName()
            );
        }
    }
}