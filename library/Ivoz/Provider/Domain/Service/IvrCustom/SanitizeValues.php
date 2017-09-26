<?php

namespace Ivoz\Provider\Domain\Service\IvrCustom;

use Ivoz\Core\Domain\Service\LifecycleEventHandlerInterface;
use Ivoz\Provider\Domain\Model\IvrCustom\IvrCustomInterface;

/**
 * Class SanitizeValues
 * @package Ivoz\Provider\Domain\Service\IvrCustom
 * @lifecycle pre_persist
 */
class SanitizeValues implements IvrCustomLifecycleEventHandlerInterface
{
    public function __construct() {}

    public function execute(IvrCustomInterface $entity, $isNew)
    {
        $nullableFields =[
            'number' => 'timeoutNumberValue',
            'extension' => 'timeoutExtension',
            'voicemail' => 'timeoutVoiceMailUser'
        ];

        $routeType = $entity->getTimeoutTargetType();
        foreach ($nullableFields as $type => $fieldName) {
            if ($routeType == $type) {
                continue;
            }
            $setter = 'set' . ucfirst($fieldName);
            $entity->{$setter}(null);
        }

        $nullableErrorFields = [
            'number' => 'errorNumberValue',
            'extension' => 'errorExtension',
            'voicemail' => 'errorVoiceMailUser'
        ];

        $routeErrorType = $entity->getErrorTargetType();
        foreach ($nullableErrorFields as $type => $fieldName) {
            if ($routeErrorType == $type) {
                continue;
            }
            $setter = 'set' . ucfirst($fieldName);
            $entity->{$setter}(null);
        }
    }
}