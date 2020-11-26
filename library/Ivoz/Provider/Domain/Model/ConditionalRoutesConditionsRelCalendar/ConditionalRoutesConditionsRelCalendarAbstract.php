<?php
declare(strict_types = 1);

namespace Ivoz\Provider\Domain\Model\ConditionalRoutesConditionsRelCalendar;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;
use \Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Provider\Domain\Model\ConditionalRoutesCondition\ConditionalRoutesConditionInterface;
use Ivoz\Provider\Domain\Model\Calendar\CalendarInterface;
use Ivoz\Provider\Domain\Model\ConditionalRoutesCondition\ConditionalRoutesCondition;
use Ivoz\Provider\Domain\Model\Calendar\Calendar;

/**
* ConditionalRoutesConditionsRelCalendarAbstract
* @codeCoverageIgnore
*/
abstract class ConditionalRoutesConditionsRelCalendarAbstract
{
    use ChangelogTrait;

    /**
     * @var ConditionalRoutesConditionInterface
     * inversedBy relCalendars
     */
    protected $condition;

    /**
     * @var CalendarInterface
     */
    protected $calendar;

    /**
     * Constructor
     */
    protected function __construct(

    ) {

    }

    abstract public function getId();

    public function __toString()
    {
        return sprintf(
            "%s#%s",
            "ConditionalRoutesConditionsRelCalendar",
            $this->getId()
        );
    }

    /**
     * @return void
     * @throws \Exception
     */
    protected function sanitizeValues()
    {
    }

    /**
     * @param null $id
     * @return ConditionalRoutesConditionsRelCalendarDto
     */
    public static function createDto($id = null)
    {
        return new ConditionalRoutesConditionsRelCalendarDto($id);
    }

    /**
     * @internal use EntityTools instead
     * @param ConditionalRoutesConditionsRelCalendarInterface|null $entity
     * @param int $depth
     * @return ConditionalRoutesConditionsRelCalendarDto|null
     */
    public static function entityToDto(EntityInterface $entity = null, $depth = 0)
    {
        if (!$entity) {
            return null;
        }

        Assertion::isInstanceOf($entity, ConditionalRoutesConditionsRelCalendarInterface::class);

        if ($depth < 1) {
            return static::createDto($entity->getId());
        }

        if ($entity instanceof \Doctrine\ORM\Proxy\Proxy && !$entity->__isInitialized()) {
            return static::createDto($entity->getId());
        }

        /** @var ConditionalRoutesConditionsRelCalendarDto $dto */
        $dto = $entity->toDto($depth-1);

        return $dto;
    }

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param ConditionalRoutesConditionsRelCalendarDto $dto
     * @return self
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ) {
        Assertion::isInstanceOf($dto, ConditionalRoutesConditionsRelCalendarDto::class);

        $self = new static(

        );

        $self
            ->setCondition($fkTransformer->transform($dto->getCondition()))
            ->setCalendar($fkTransformer->transform($dto->getCalendar()));

        $self->initChangelog();

        return $self;
    }

    /**
     * @internal use EntityTools instead
     * @param ConditionalRoutesConditionsRelCalendarDto $dto
     * @return self
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ) {
        Assertion::isInstanceOf($dto, ConditionalRoutesConditionsRelCalendarDto::class);

        $this
            ->setCondition($fkTransformer->transform($dto->getCondition()))
            ->setCalendar($fkTransformer->transform($dto->getCalendar()));

        return $this;
    }

    /**
     * @internal use EntityTools instead
     * @param int $depth
     * @return ConditionalRoutesConditionsRelCalendarDto
     */
    public function toDto($depth = 0)
    {
        return self::createDto()
            ->setCondition(ConditionalRoutesCondition::entityToDto(self::getCondition(), $depth))
            ->setCalendar(Calendar::entityToDto(self::getCalendar(), $depth));
    }

    /**
     * @return array
     */
    protected function __toArray()
    {
        return [
            'conditionId' => self::getCondition() ? self::getCondition()->getId() : null,
            'calendarId' => self::getCalendar()->getId()
        ];
    }

    /**
     * Set condition
     *
     * @param ConditionalRoutesConditionInterface | null
     *
     * @return static
     */
    public function setCondition(?ConditionalRoutesConditionInterface $condition = null): ConditionalRoutesConditionsRelCalendarInterface
    {
        $this->condition = $condition;

        return $this;
    }

    /**
     * Get condition
     *
     * @return ConditionalRoutesConditionInterface | null
     */
    public function getCondition(): ?ConditionalRoutesConditionInterface
    {
        return $this->condition;
    }

    /**
     * Set calendar
     *
     * @param CalendarInterface
     *
     * @return static
     */
    protected function setCalendar(CalendarInterface $calendar): ConditionalRoutesConditionsRelCalendarInterface
    {
        $this->calendar = $calendar;

        return $this;
    }

    /**
     * Get calendar
     *
     * @return CalendarInterface
     */
    public function getCalendar(): CalendarInterface
    {
        return $this->calendar;
    }

}
