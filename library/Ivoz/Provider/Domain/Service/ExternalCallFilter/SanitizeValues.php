<?php

namespace Ivoz\Provider\Domain\Service\ExternalCallFilter;

use Ivoz\Provider\Domain\Model\ExternalCallFilter\ExternalCallFilterInterface;

/**
 * Class SanitizeValues
 * @package Ivoz\Provider\Domain\Service\Extension
 * @lifecycle pre_persist
 */
class SanitizeValues implements ExternalCallFilterLifecycleEventHandlerInterface
{
    public function __construct() {}

    /**
     * @throws \Exception
     */
    public function execute(ExternalCallFilterInterface $entity)
    {
        $holidayNullableFields = array(
            "number" => "holidayNumberValue",
            "extension" => "holidayExtension",
            "voicemail" => "holidayVoiceMailUser",
        );

        $routeTypeHoliday = $entity->getHolidayTargetType();

        foreach ($holidayNullableFields as $type => $fieldName) {
            if ($routeTypeHoliday == $type) {
                continue;
            }

            $setter = "set".ucfirst($fieldName);
            $entity->{$setter}(null);
        }

        $scheduleNullableFields = array(
            "number" => "outOfScheduleNumberValue",
            "extension" => "outOfScheduleExtension",
            "voicemail" => "outOfScheduleVoiceMailUser",
        );

        $schedulerouteType = $entity->getOutOfScheduleTargetType();

        foreach ($scheduleNullableFields as $type => $fieldName) {
            if ($schedulerouteType == $type) {
                continue;
            }
            $setter = "set".ucfirst($fieldName);
            $entity->{$setter}(null);
        }
    }
}
