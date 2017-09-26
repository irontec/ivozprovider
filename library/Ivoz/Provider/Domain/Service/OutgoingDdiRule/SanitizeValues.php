<?php

namespace Ivoz\Provider\Domain\Service\OutgoingDdiRule;

use Ivoz\Provider\Domain\Model\OutgoingDdiRule\OutgoingDdiRuleInterface;

/**
 * Class SanitizeValues
 * @package Ivoz\Provider\Domain\Service\OutgoingDdiRule
 * @lifecycle pre_persist
 */
class SanitizeValues implements OutgoingDdiRuleLifecycleEventHandlerInterface
{
    public function __construct() {}

    public function execute(OutgoingDdiRuleInterface $entity)
    {
        $nullableFields = [
            'force' => 'forcedDdi',
        ];
        $defaultAction = $entity->getDefaultAction();

        foreach ($nullableFields as $type => $fieldName) {
            if ($defaultAction == $type) {
                continue;
            }

            $setter = 'set' . ucfirst($fieldName);
            $entity->{$setter}(null);
        }
    }
}