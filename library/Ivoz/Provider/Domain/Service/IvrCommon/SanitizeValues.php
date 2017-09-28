<?php

namespace Ivoz\Provider\Domain\Service\IvrCommon;

use Ivoz\Provider\Domain\Model\IvrCommon\IvrCommonInterface;

/**
 * Class SanitizeValues
 * @package Ivoz\Provider\Domain\Service\IvrCommon
 * @lifecycle pre_persist
 */
class SanitizeValues implements IvrCommonLifecycleEventHandlerInterface
{
    public function __construct() {}

    public function execute(IvrCommonInterface $entity, $isNew)
    {
        $nullableFields = [
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
            $setter = 'set'.ucfirst($fieldName);
            $entity->{$setter}(null);
        }
    }
}