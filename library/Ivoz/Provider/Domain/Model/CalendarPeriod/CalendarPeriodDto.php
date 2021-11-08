<?php

namespace Ivoz\Provider\Domain\Model\CalendarPeriod;

use Ivoz\Api\Core\Annotation\AttributeDefinition;
use Ivoz\Provider\Domain\Model\CalendarPeriodsRelSchedule\CalendarPeriodsRelScheduleDto;

class CalendarPeriodDto extends CalendarPeriodDtoAbstract
{
    /**
     * @var int[]
     * @AttributeDefinition(
     *     type="array",
     *     collectionValueType="int",
     *     description="Schedule ids"
     * )
     */
    private $scheduleIds = [];

    /**
     * @return string[]
     */
    public static function getPropertyMap(string $context = '', string $role = null): array
    {
        if ($context === self::CONTEXT_COLLECTION) {
            return [
                'id' => 'id',
                'calendarId' => 'calendar',
                'startDate' => 'startDate',
                'endDate' => 'endDate',
                'routeType' => 'routeType',
                'locutionId' => 'locution',
                'numberCountryId' => 'numberCountry',
                'numberValue' => 'numberValue',
                'extensionId' => 'extension',
                'voicemailId' => 'voicemail',
                'scheduleIds' => 'scheduleIds',
            ];
        }

        $response = parent::getPropertyMap($context, $role);
        $response['scheduleIds'] = 'scheduleIds';

        return $response;
    }

    /**
     * @return array<array-key, mixed>
     */
    public function normalize(string $context, string $role = ''): array
    {
        $response = parent::normalize(
            $context,
            $role
        );

        if ($context !== self::CONTEXT_EMPTY) {
            $response['scheduleIds'] = $this->scheduleIds;
        }

        return $response;
    }

    /**
     * @param array<array-key, mixed> $data
     */
    public function denormalize(array $data, string $context, string $role = ''): void
    {
        $contextProperties = self::getPropertyMap($context, $role);

        if ($context !== self::CONTEXT_EMPTY) {
            $contextProperties['scheduleIds'] = 'scheduleIds';
        }

        $this->setByContext(
            $contextProperties,
            $data
        );
    }

    /**
     * @param int[] $ids
     */
    public function setScheduleIds(array $ids): void
    {
        $this->scheduleIds = $ids;

        $relSchedules = [];
        foreach ($ids as $id) {
            $dto = new CalendarPeriodsRelScheduleDto();
            $dto->setScheduleId($id);
            $relSchedules[] = $dto;
        }

        $this->setRelSchedules($relSchedules);
    }
}
