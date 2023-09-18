<?php

namespace Ivoz\Provider\Domain\Model\HolidayDate;

use Ivoz\Api\Core\Annotation\AttributeDefinition;

class HolidayDateRange
{
    /**
     * @var string
     * @AttributeDefinition(type="string", required=true)
     */
    private $name = '';

    /**
     * @var ?int
     * @AttributeDefinition(type="int")
     */
    private $locution;

    /**
     * @var int
     * @AttributeDefinition(type="int", required=true)
     */
    private $wholeDayEvent;

    /**
     * @var ?string
     * @AttributeDefinition(type="string")
     */
    private $timeIn;

    /**
     * @var ?string
     * @AttributeDefinition(type="string")
     */
    private $timeOut;

    /**
     * @var ?string
     * @AttributeDefinition(type="string")
     */
    private $routeType;

    /**
     * @var ?int
     * @AttributeDefinition(type="int")
     */
    private $extension;

    /**
     * @var ?int
     * @AttributeDefinition(type="int")
     */
    private $voicemail;

    /**
     * @var ?int
     * @AttributeDefinition(type="int")
     */
    private $numberCountry;

    /**
     * @var ?string
     * @AttributeDefinition(type="string")
     */
    private $numberValue;

    /**
     * @var string
     * @AttributeDefinition(type="string", required=true)
     */
    private $startDate;

    /**
     * @var string
     * @AttributeDefinition(type="string", required=true)
     */
    private $endDate;

    /**
     * @var int
     * @AttributeDefinition(type="int", required=true)
     */
    private $calendar;

    public function __construct(
        int $calendar,
        string $name,
        string $startDate,
        string $endDate,
        int $wholeDayEvent,
        ?int $locution,
        ?string $timeIn,
        ?string $timeOut,
        ?string $routeType,
        ?int $extension,
        ?int $voicemail,
        ?int $numberCountry,
        ?string $numberValue,
    ) {
        $this->name = $name;
        $this->wholeDayEvent = $wholeDayEvent;
        $this->startDate = $startDate;
        $this->endDate = $endDate;
        $this->calendar = $calendar;
        $this->timeIn = $timeIn;
        $this->timeOut = $timeOut;
        $this->routeType = $routeType;
        $this->locution = $locution;
        $this->extension = $extension;
        $this->voicemail = $voicemail;
        $this->numberCountry = $numberCountry;
        $this->numberValue = $numberValue;
    }

    /**
     * @return array{
     *     'name': string,
     *     'wholeDayEvent': int,
     *     'startDate': string,
     *     'endDate': string,
     *     'calendar': int,
     *     'timeIn': string | null,
     *     'timeOut': string | null,
     *     'routeType': string | null,
     *     'locution': int | null,
     *     'extension': int | null,
     *     'voicemail': int | null,
     *     'numberCountry': int | null,
     *     'numberValue': string | null,
     *   }
     */
    public function toArray(): array
    {
        return [
            'name' => $this->getName(),
            'wholeDayEvent' => $this->getWholeDayEvent(),
            'startDate' => $this->getStartDate(),
            'endDate' => $this->getEndDate(),
            'calendar' => $this->getCalendar(),
            'timeIn' => $this->getTimeIn(),
            'timeOut' => $this->getTimeOut(),
            'routeType' => $this->getRouteType(),
            'locution' => $this->getLocution(),
            'extension' => $this->getExtension(),
            'voicemail' => $this->getVoicemail(),
            'numberCountry' => $this->getNumberCountry(),
            'numberValue' => $this->getNumberValue(),
        ];
    }

    public function getName(): string
    {
        return $this->name;
    }


    public function getLocution(): int|null
    {
        return $this->locution;
    }

    public function getWholeDayEvent(): int
    {
        return $this->wholeDayEvent;
    }

    public function getTimeIn(): ?string
    {
        return $this->timeIn;
    }

    public function getTimeOut(): ?string
    {
        return $this->timeOut;
    }

    public function getRouteType(): ?string
    {
        return $this->routeType;
    }

    public function getStartDate(): string
    {
        return $this->startDate;
    }

    public function getEndDate(): string
    {
        return $this->endDate;
    }

    public function getCalendar(): int
    {
        return $this->calendar;
    }

    public function getExtension(): ?int
    {
        return $this->extension;
    }

    public function getVoicemail(): ?int
    {
        return $this->voicemail;
    }

    public function getNumberCountry(): ?int
    {
        return $this->numberCountry;
    }

    public function getNumberValue(): ?string
    {
        return $this->numberValue;
    }
}
