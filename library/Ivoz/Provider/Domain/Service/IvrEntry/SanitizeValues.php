<?php

namespace Ivoz\Provider\Domain\Service\IvrEntry;

use Ivoz\Provider\Domain\Model\IvrEntry\IvrExcludedExtensionInterface;

/**
 * Class SanitizeValues
 * @package Ivoz\Provider\Domain\Service\IvrEntry
 * @lifecycle pre_persist
 */
class SanitizeValues implements IvrEntryLifecycleEventHandlerInterface
{
    public function __construct() {}

    public function execute(IvrExcludedExtensionInterface $entity, $isNew)
    {
        /**
         * @todo move this into the entity
         */
        if ($entity->hasChanged('targetType')) {
            switch($entity->getTargetType())
            {
                case 'number':
                    $entity->setTargetExtension(null);
                    $entity->setTargetVoiceMailUser(null);
                    break;
                case 'extension':
                    $entity->setTargetNumberValue(null);
                    $entity->setTargetVoiceMailUser(null);
                    break;
                case 'voicemail':
                    $entity->setTargetNumberValue(null);
                    $entity->setTargetExtension(null);
                    break;
            }
        }
    }
}