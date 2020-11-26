<?php

namespace Ivoz\Provider\Domain\Model\ConditionalRoutesConditionsRelCalendar;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\Model\DtoNormalizer;
use Ivoz\Provider\Domain\Model\ConditionalRoutesCondition\ConditionalRoutesConditionDto;
use Ivoz\Provider\Domain\Model\Calendar\CalendarDto;

/**
* ConditionalRoutesConditionsRelCalendarDtoAbstract
* @codeCoverageIgnore
*/
abstract class ConditionalRoutesConditionsRelCalendarDtoAbstract implements DataTransferObjectInterface
{
    use DtoNormalizer;

    /**
     * @var int
     */
    private $id;

    /**
     * @var ConditionalRoutesConditionDto | null
     */
    private $condition;

    /**
     * @var CalendarDto | null
     */
    private $calendar;

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
            'conditionId' => 'condition',
            'calendarId' => 'calendar'
        ];
    }

    /**
    * @return array
    */
    public function toArray($hideSensitiveData = false)
    {
        $response = [
            'id' => $this->getId(),
            'condition' => $this->getCondition(),
            'calendar' => $this->getCalendar()
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
     * @param ConditionalRoutesConditionDto | null
     *
     * @return static
     */
    public function setCondition(?ConditionalRoutesConditionDto $condition = null): self
    {
        $this->condition = $condition;

        return $this;
    }

    /**
     * @return ConditionalRoutesConditionDto | null
     */
    public function getCondition(): ?ConditionalRoutesConditionDto
    {
        return $this->condition;
    }

    /**
     * @return static
     */
    public function setConditionId($id): self
    {
        $value = !is_null($id)
            ? new ConditionalRoutesConditionDto($id)
            : null;

        return $this->setCondition($value);
    }

    /**
     * @return mixed | null
     */
    public function getConditionId()
    {
        if ($dto = $this->getCondition()) {
            return $dto->getId();
        }

        return null;
    }

    /**
     * @param CalendarDto | null
     *
     * @return static
     */
    public function setCalendar(?CalendarDto $calendar = null): self
    {
        $this->calendar = $calendar;

        return $this;
    }

    /**
     * @return CalendarDto | null
     */
    public function getCalendar(): ?CalendarDto
    {
        return $this->calendar;
    }

    /**
     * @return static
     */
    public function setCalendarId($id): self
    {
        $value = !is_null($id)
            ? new CalendarDto($id)
            : null;

        return $this->setCalendar($value);
    }

    /**
     * @return mixed | null
     */
    public function getCalendarId()
    {
        if ($dto = $this->getCalendar()) {
            return $dto->getId();
        }

        return null;
    }

}
