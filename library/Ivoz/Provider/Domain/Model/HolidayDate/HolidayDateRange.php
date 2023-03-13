<?php

namespace Ivoz\Provider\Domain\Model\HolidayDate;

use Ivoz\Api\Core\Annotation\AttributeDefinition;

class HolidayDateRange
{
    /**
     * @var string
     * @AttributeDefinition(type="string")
     */
    private $name = '';

    /**
     * @var ?int
     * @AttributeDefinition(type="int")
     */
    private $locution;


    /**
     * @var int
     * @AttributeDefinition(type="int")
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
     * @var string
     * @AttributeDefinition(type="string")
     */
    private $startDate;

    /**
     * @var string
     * @AttributeDefinition(type="string")
     */
    private $endDate;

    /**
     * @var int
     * @AttributeDefinition(type="int")
     */
    private $calendar;


    public function __construct(
        string $name,
        int $wholeDayEvent,
        string $startDate,
        string $endDate,
        int $calendar,
        ?string $timeIn,
        ?string $timeOut,
        ?string $routeType,
        ?int $locution
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
}
