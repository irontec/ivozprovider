<?php

namespace Ivoz\Provider\Domain\Model\CalendarPeriodsRelSchedule;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\Model\DtoNormalizer;

/**
 * @codeCoverageIgnore
 */
abstract class CalendarPeriodsRelScheduleDtoAbstract implements DataTransferObjectInterface
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var \Ivoz\Provider\Domain\Model\CalendarPeriod\CalendarPeriodDto | null
     */
    private $calendarPeriod;

    /**
     * @var \Ivoz\Provider\Domain\Model\Schedule\ScheduleDto | null
     */
    private $schedule;


    use DtoNormalizer;

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
     * @param integer $id
     *
     * @return static
     */
    public function setId($id = null)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return integer | null
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param \Ivoz\Provider\Domain\Model\CalendarPeriod\CalendarPeriodDto $calendarPeriod
     *
     * @return static
     */
    public function setCalendarPeriod(\Ivoz\Provider\Domain\Model\CalendarPeriod\CalendarPeriodDto $calendarPeriod = null)
    {
        $this->calendarPeriod = $calendarPeriod;

        return $this;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\CalendarPeriod\CalendarPeriodDto | null
     */
    public function getCalendarPeriod()
    {
        return $this->calendarPeriod;
    }

    /**
     * @param mixed | null $id
     *
     * @return static
     */
    public function setCalendarPeriodId($id)
    {
        $value = !is_null($id)
            ? new \Ivoz\Provider\Domain\Model\CalendarPeriod\CalendarPeriodDto($id)
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
     * @param \Ivoz\Provider\Domain\Model\Schedule\ScheduleDto $schedule
     *
     * @return static
     */
    public function setSchedule(\Ivoz\Provider\Domain\Model\Schedule\ScheduleDto $schedule = null)
    {
        $this->schedule = $schedule;

        return $this;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\Schedule\ScheduleDto | null
     */
    public function getSchedule()
    {
        return $this->schedule;
    }

    /**
     * @param mixed | null $id
     *
     * @return static
     */
    public function setScheduleId($id)
    {
        $value = !is_null($id)
            ? new \Ivoz\Provider\Domain\Model\Schedule\ScheduleDto($id)
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
