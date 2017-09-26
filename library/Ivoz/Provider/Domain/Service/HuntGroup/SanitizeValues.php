<?php

namespace Ivoz\Provider\Domain\Service\HuntGroup;

use Ivoz\Provider\Domain\Model\HuntGroup\HuntGroupInterface;

/**
 * Class SanitizeValues
 * @package Ivoz\Provider\Domain\Service\HuntGroup
 * @lifecycle pre_persist
 */
class SanitizeValues implements HuntGroupLifecycleEventHandlerInterface
{
    public function __construct() {}

    public function execute(HuntGroupInterface $entity)
    {
        $nullableFields = array(
            'number' => 'noAnswerNumberValue',
            'extension' => 'noAnswerExtension',
            'voicemail' => 'noAnswerVoiceMailUser'
        );

        $routeType = $entity->getNoAnswerTargetType();
        foreach ($nullableFields as $type => $fieldName) {
            if ($routeType == $type) {
                continue;
            }

            $setter = 'set' . ucfirst($fieldName);
            $entity->{$setter}(null);
        }
    }
}