<?php

namespace Ivoz\Provider\Domain\Model\ExternalCallFilter;

use Ivoz\Api\Core\Annotation\AttributeDefinition;
use Ivoz\Provider\Domain\Model\ExternalCallFilterBlackList\ExternalCallFilterBlackListDto;
use Ivoz\Provider\Domain\Model\ExternalCallFilterRelCalendar\ExternalCallFilterRelCalendarDto;
use Ivoz\Provider\Domain\Model\ExternalCallFilterRelSchedule\ExternalCallFilterRelScheduleDto;
use Ivoz\Provider\Domain\Model\ExternalCallFilterWhiteList\ExternalCallFilterWhiteListDto;

class ExternalCallFilterDto extends ExternalCallFilterDtoAbstract
{
    public const CONTEXT_WITH_INVERSE_RELATIONSHIPS = 'withInverseRelationships';

    public const CONTEXTS_WITH_INVERSE_RELATIONSHIPS = [
        self::CONTEXT_WITH_INVERSE_RELATIONSHIPS,
        self::CONTEXT_DETAILED
    ];

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
     * @var int[]
     * @AttributeDefinition(
     *     type="array",
     *     collectionValueType="int",
     *     description="Calendar ids"
     * )
     */
    private $calendarIds = [];

    /**
     * @var int[]
     * @AttributeDefinition(
     *     type="array",
     *     collectionValueType="int",
     *     description="Whitelisted matchlists"
     * )
     */
    private $whiteListIds = [];

    /**
     * @var int[]
     * @AttributeDefinition(
     *     type="array",
     *     collectionValueType="int",
     *     description="Blacklisted matchlists"
     * )
     */
    private $blackListIds = [];

    /**
     * @inheritdoc
     * @codeCoverageIgnore
     */
    public static function getPropertyMap(string $context = '', string $role = null): array
    {
        if ($context === self::CONTEXT_COLLECTION) {
            return [
                'id' => 'id',
                'name' => 'name',

                'holidayTargetType' => 'holidayTargetType',
                'holidayNumberValue' => 'holidayNumberValue',
                'holidayLocutionId' => 'holidayLocution',
                'holidayExtensionId' => 'holidayExtension',
                'holidayVoicemailId' => 'holidayVoicemail',
                'holidayNumberCountryId' => 'holidayNumberCountry',

                'outOfScheduleTargetType' => 'outOfScheduleTargetType',
                'outOfScheduleNumberValue' => 'outOfScheduleNumberValue',
                'outOfScheduleLocutionId' => 'outOfScheduleLocution',
                'outOfScheduleExtensionId' => 'outOfScheduleExtension',
                'outOfScheduleVoicemailId' => 'outOfScheduleVoicemail',
                'outOfScheduleNumberCountryId' => 'outOfScheduleNumberCountry'


            ];
        }

        $response = parent::getPropertyMap(...func_get_args());

        if (in_array($context, self::CONTEXTS_WITH_INVERSE_RELATIONSHIPS, true)) {
            $response['scheduleIds'] = 'scheduleIds';
            $response['calendarIds'] = 'calendarIds';
            $response['whiteListIds'] = 'whiteListIds';
            $response['blackListIds'] = 'blackListIds';
        }

        if ($role === 'ROLE_COMPANY_ADMIN') {
            unset($response['companyId']);
        }

        return $response;
    }

    public function normalize(string $context, string $role = ''): array
    {
        $response = parent::normalize(
            $context,
            $role
        );

        if (in_array($context, self::CONTEXTS_WITH_INVERSE_RELATIONSHIPS, true)) {
            $response['scheduleIds'] = $this->scheduleIds;
            $response['calendarIds'] = $this->calendarIds;
            $response['whiteListIds'] = $this->whiteListIds;
            $response['blackListIds'] = $this->blackListIds;
        }

        return $response;
    }

    public function denormalize(array $data, string $context, string $role = ''): void
    {
        $contextProperties = self::getPropertyMap($context, $role);
        if ($role === 'ROLE_COMPANY_ADMIN') {
            $contextProperties['companyId'] = 'company';
        }

        $this->setByContext(
            $contextProperties,
            $data
        );
    }

    public function setCalendarIds(array $calendarIds): static
    {
        $this->calendarIds = $calendarIds;

        $relCalendars = [];
        foreach ($calendarIds as $id) {
            $dto = new ExternalCallFilterRelCalendarDto();
            $dto->setCalendarId($id);
            $relCalendars[] = $dto;
        }

        $this->setCalendars($relCalendars);

        return $this;
    }

    public function setScheduleIds(array $scheduleIds): static
    {
        $this->scheduleIds = $scheduleIds;

        $relScheduless = [];
        foreach ($scheduleIds as $id) {
            $dto = new ExternalCallFilterRelScheduleDto();
            $dto->setScheduleId($id);
            $relScheduless[] = $dto;
        }

        $this->setSchedules($relScheduless);

        return $this;
    }

    public function setWhiteListIds(array $whiteListIds): static
    {
        $this->whiteListIds = $whiteListIds;

        $relWhiteLists = [];
        foreach ($whiteListIds as $id) {
            $dto = new ExternalCallFilterWhiteListDto();
            $dto->setMatchlistId($id);
            $relWhiteLists[] = $dto;
        }

        $this->setWhiteLists($relWhiteLists);

        return $this;
    }

    public function setBlackListIds(array $blackListIds): static
    {
        $this->blackListIds = $blackListIds;

        $relBlackLists = [];
        foreach ($blackListIds as $id) {
            $dto = new ExternalCallFilterBlackListDto();
            $dto->setMatchlistId($id);
            $relBlackLists[] = $dto;
        }

        $this->setBlackLists($relBlackLists);

        return $this;
    }
}
