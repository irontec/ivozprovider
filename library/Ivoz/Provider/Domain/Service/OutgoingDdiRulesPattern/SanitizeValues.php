<?php

namespace Ivoz\Provider\Domain\Service\OutgoingDdiRulesPattern;

use Ivoz\Provider\Domain\Model\OutgoingDdiRulesPattern\OutgoingDdiRulesPatternInterface;

/**
 * Class SanitizeValues
 * @package Ivoz\Provider\Domain\Service\OutgoingDdiRulesPattern
 * @lifecycle pre_persist
 */
class SanitizeValues implements OutgoingDdiRulesPatternLifecycleEventHandlerInterface
{
    public function __construct() {}

    public function execute(OutgoingDdiRulesPatternInterface $entity)
    {
        $nullableFields = [
            'force' => 'forcedDdi',
        ];
        $defaultAction = $entity->getAction();

        foreach ($nullableFields as $type => $fieldName) {
            if ($defaultAction == $type) {
                continue;
            }

            $setter = 'set' . ucfirst($fieldName);
            $entity->{$setter}(null);
        }
    }
}