<?php

namespace Ivoz\Provider\Domain\Model\CalendarPeriodsRelSchedule;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\Model\DtoNormalizer;
use Ivoz\Provider\Domain\Model\CalendarPeriod\CalendarPeriodDto;
use Ivoz\Provider\Domain\Model\Schedule\ScheduleDto;

/**
* CalendarPeriodsRelScheduleDtoAbstract
* @codeCoverageIgnore
*/
abstract class CalendarPeriodsRelScheduleDtoAbstract implements DataTransferObjectInterface
{
    use DtoNormalizer;

    /**
     * @var int|null
     */
    private $id = null;

    /**
     * @var CalendarPeriodDto | null
     */
    private $calendarPeriod = null;

    /**
     * @var ScheduleDto | null
     */
    private $schedule = null;

    public function __construct($id = null)
    {
        $this->setId($id);
    }

    /**
    * @inheritdoc
    */
    public static function getPropertyMap(string $context = '', string $role = null): array
    {
        if ($context === self::CONTEXT_COLLECTION) {
            return ['id' => 'id'];
        }

        return [
            'id' => 'id',
            'calendarPeriodId' => 'calendarPeriod',
            'scheduleId' => 'schedule'
        ];
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(bool $hideSensitiveData = false): array
    {
        $response = [
            'id' => $this->getId(),
            'calendarPeriod' => $this->getCalendarPeriod(),
            'schedule' => $this->getSchedule()
        ];

        if (!$hideSensitiveData) {
            return $response;
        }

        foreach ($this->sensitiveFields as $sensitiveField) {
            if (!array_key_exists($sensitiveField, $response)) {
                throw new \Exception($sensitiveField . ' field was not found');
            }
            $response[$sensitiveField] = '*****';
        }

        return $response;
    }

    public function setId($id): static
    {
        $this->id = $id;

        return $this;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setCalendarPeriod(?CalendarPeriodDto $calendarPeriod): static
    {
        $this->calendarPeriod = $calendarPeriod;

        return $this;
    }

    public function getCalendarPeriod(): ?CalendarPeriodDto
    {
        return $this->calendarPeriod;
    }

    public function setCalendarPeriodId($id): static
    {
        $value = !is_null($id)
            ? new CalendarPeriodDto($id)
            : null;

        return $this->setCalendarPeriod($value);
    }

    public function getCalendarPeriodId()
    {
        if ($dto = $this->getCalendarPeriod()) {
            return $dto->getId();
        }

        return null;
    }

    public function setSchedule(?ScheduleDto $schedule): static
    {
        $this->schedule = $schedule;

        return $this;
    }

    public function getSchedule(): ?ScheduleDto
    {
        return $this->schedule;
    }

    public function setScheduleId($id): static
    {
        $value = !is_null($id)
            ? new ScheduleDto($id)
            : null;

        return $this->setSchedule($value);
    }

    public function getScheduleId()
    {
        if ($dto = $this->getSchedule()) {
            return $dto->getId();
        }

        return null;
    }
}
