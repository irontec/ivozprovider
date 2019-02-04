<?php

namespace Ivoz\Provider\Domain\Model\ConditionalRoutesConditionsRelCalendar;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\Model\DtoNormalizer;

/**
 * @codeCoverageIgnore
 */
abstract class ConditionalRoutesConditionsRelCalendarDtoAbstract implements DataTransferObjectInterface
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var \Ivoz\Provider\Domain\Model\ConditionalRoutesCondition\ConditionalRoutesConditionDto | null
     */
    private $condition;

    /**
     * @var \Ivoz\Provider\Domain\Model\Calendar\CalendarDto | null
     */
    private $calendar;


    use DtoNormalizer;

    public function __construct($id = null)
    {
        $this->setId($id);
    }

    /**
     * @inheritdoc
     */
    public static function getPropertyMap(string $context = '')
    {
        if ($context === self::CONTEXT_COLLECTION) {
            return ['id' => 'id'];
        }

        return [
            'id' => 'id',
            'conditionId' => 'condition',
            'calendarId' => 'calendar'
        ];
    }

    /**
     * @return array
     */
    public function toArray($hideSensitiveData = false)
    {
        return [
            'id' => $this->getId(),
            'condition' => $this->getCondition(),
            'calendar' => $this->getCalendar()
        ];
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
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param \Ivoz\Provider\Domain\Model\ConditionalRoutesCondition\ConditionalRoutesConditionDto $condition
     *
     * @return static
     */
    public function setCondition(\Ivoz\Provider\Domain\Model\ConditionalRoutesCondition\ConditionalRoutesConditionDto $condition = null)
    {
        $this->condition = $condition;

        return $this;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\ConditionalRoutesCondition\ConditionalRoutesConditionDto
     */
    public function getCondition()
    {
        return $this->condition;
    }

    /**
     * @param integer $id | null
     *
     * @return static
     */
    public function setConditionId($id)
    {
        $value = !is_null($id)
            ? new \Ivoz\Provider\Domain\Model\ConditionalRoutesCondition\ConditionalRoutesConditionDto($id)
            : null;

        return $this->setCondition($value);
    }

    /**
     * @return integer | null
     */
    public function getConditionId()
    {
        if ($dto = $this->getCondition()) {
            return $dto->getId();
        }

        return null;
    }

    /**
     * @param \Ivoz\Provider\Domain\Model\Calendar\CalendarDto $calendar
     *
     * @return static
     */
    public function setCalendar(\Ivoz\Provider\Domain\Model\Calendar\CalendarDto $calendar = null)
    {
        $this->calendar = $calendar;

        return $this;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\Calendar\CalendarDto
     */
    public function getCalendar()
    {
        return $this->calendar;
    }

    /**
     * @param integer $id | null
     *
     * @return static
     */
    public function setCalendarId($id)
    {
        $value = !is_null($id)
            ? new \Ivoz\Provider\Domain\Model\Calendar\CalendarDto($id)
            : null;

        return $this->setCalendar($value);
    }

    /**
     * @return integer | null
     */
    public function getCalendarId()
    {
        if ($dto = $this->getCalendar()) {
            return $dto->getId();
        }

        return null;
    }
}
