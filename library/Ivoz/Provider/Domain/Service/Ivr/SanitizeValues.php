<?php

namespace Ivoz\Provider\Domain\Service\Ivr;

use Ivoz\Core\Domain\Service\LifecycleEventHandlerInterface;
use Ivoz\Provider\Domain\Model\Ivr\IvrInterface;

/**
 * Class SanitizeValues
 * @package Ivoz\Provider\Domain\Service\Ivr
 * @lifecycle pre_persist
 */
class SanitizeValues implements IvrLifecycleEventHandlerInterface
{
    public function __construct() {}

    public function execute(IvrInterface $entity, $isNew)
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