<?php

namespace Ivoz\Provider\Domain\Service\IvrCustomEntry;

use Ivoz\Provider\Domain\Model\IvrCustomEntry\IvrCustomEntryInterface;

/**
 * Class SanitizeValues
 * @package Ivoz\Provider\Domain\Service\IvrCustomEntry
 * @lifecycle pre_persist
 */
class SanitizeValues implements IvrCustomEntryLifecycleEventHandlerInterface
{
    public function __construct() {}

    public function execute(IvrCustomEntryInterface $entity, $isNew)
    {
        /**
         * @todo move this into the entity
         */
        if ($entity->hasChanged("targetType")) {
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