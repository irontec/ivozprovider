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
     * @var int
     */
    private $id;

    /**
     * @var CalendarPeriodDto | null
     */
    private $calendarPeriod;

    /**
     * @var ScheduleDto | null
     */
    private $schedule;

    public function __construct($id = null)
    {
        $this->setId($id);
    }

    /**
    * @inheritdoc
    */
    public static function getPropertyMap(string $context = '', string $role = null)
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
    * @return array
    */
    public function toArray($hideSensitiveData = false)
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

    /**
     * @param int $id | null
     *
     * @return static
     */
    public function setId(?int $id = null): self
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return int | null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param CalendarPeriodDto | null
     *
     * @return static
     */
    public function setCalendarPeriod(?CalendarPeriodDto $calendarPeriod = null): self
    {
        $this->calendarPeriod = $calendarPeriod;

        return $this;
    }

    /**
     * @return CalendarPeriodDto | null
     */
    public function getCalendarPeriod(): ?CalendarPeriodDto
    {
        return $this->calendarPeriod;
    }

    /**
     * @return static
     */
    public function setCalendarPeriodId($id): self
    {
        $value = !is_null($id)
            ? new CalendarPeriodDto($id)
            : null;

        return $this->setCalendarPeriod($value);
    }

    /**
     * @return mixed | null
     */
    public function getCalendarPeriodId()
    {
        if ($dto = $this->getCalendarPeriod()) {
            return $dto->getId();
        }

        return null;
    }

    /**
     * @param ScheduleDto | null
     *
     * @return static
     */
    public function setSchedule(?ScheduleDto $schedule = null): self
    {
        $this->schedule = $schedule;

        return $this;
    }

    /**
     * @return ScheduleDto | null
     */
    public function getSchedule(): ?ScheduleDto
    {
        return $this->schedule;
    }

    /**
     * @return static
     */
    public function setScheduleId($id): self
    {
        $value = !is_null($id)
            ? new ScheduleDto($id)
            : null;

        return $this->setSchedule($value);
    }

    /**
     * @return mixed | null
     */
    public function getScheduleId()
    {
        if ($dto = $this->getSchedule()) {
            return $dto->getId();
        }

        return null;
    }

}
