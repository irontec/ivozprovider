<?php
declare(strict_types = 1);

namespace Ivoz\Provider\Domain\Model\ExternalCallFilterRelCalendar;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;
use \Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Provider\Domain\Model\Calendar\CalendarInterface;
use Ivoz\Provider\Domain\Model\ExternalCallFilter\ExternalCallFilterInterface;
use Ivoz\Provider\Domain\Model\Calendar\Calendar;
use Ivoz\Provider\Domain\Model\ExternalCallFilter\ExternalCallFilter;

/**
* ExternalCallFilterRelCalendarAbstract
* @codeCoverageIgnore
*/
abstract class ExternalCallFilterRelCalendarAbstract
{
    use ChangelogTrait;

    /**
     * @var CalendarInterface
     */
    protected $calendar;

    /**
     * @var ExternalCallFilterInterface
     * inversedBy calendars
     */
    protected $filter;

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
            "ExternalCallFilterRelCalendar",
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
     * @return ExternalCallFilterRelCalendarDto
     */
    public static function createDto($id = null)
    {
        return new ExternalCallFilterRelCalendarDto($id);
    }

    /**
     * @internal use EntityTools instead
     * @param ExternalCallFilterRelCalendarInterface|null $entity
     * @param int $depth
     * @return ExternalCallFilterRelCalendarDto|null
     */
    public static function entityToDto(EntityInterface $entity = null, $depth = 0)
    {
        if (!$entity) {
            return null;
        }

        Assertion::isInstanceOf($entity, ExternalCallFilterRelCalendarInterface::class);

        if ($depth < 1) {
            return static::createDto($entity->getId());
        }

        if ($entity instanceof \Doctrine\ORM\Proxy\Proxy && !$entity->__isInitialized()) {
            return static::createDto($entity->getId());
        }

        /** @var ExternalCallFilterRelCalendarDto $dto */
        $dto = $entity->toDto($depth-1);

        return $dto;
    }

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param ExternalCallFilterRelCalendarDto $dto
     * @return self
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ) {
        Assertion::isInstanceOf($dto, ExternalCallFilterRelCalendarDto::class);

        $self = new static(

        );

        $self
            ->setCalendar($fkTransformer->transform($dto->getCalendar()))
            ->setFilter($fkTransformer->transform($dto->getFilter()));

        $self->initChangelog();

        return $self;
    }

    /**
     * @internal use EntityTools instead
     * @param ExternalCallFilterRelCalendarDto $dto
     * @return self
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ) {
        Assertion::isInstanceOf($dto, ExternalCallFilterRelCalendarDto::class);

        $this
            ->setCalendar($fkTransformer->transform($dto->getCalendar()))
            ->setFilter($fkTransformer->transform($dto->getFilter()));

        return $this;
    }

    /**
     * @internal use EntityTools instead
     * @param int $depth
     * @return ExternalCallFilterRelCalendarDto
     */
    public function toDto($depth = 0)
    {
        return self::createDto()
            ->setCalendar(Calendar::entityToDto(self::getCalendar(), $depth))
            ->setFilter(ExternalCallFilter::entityToDto(self::getFilter(), $depth));
    }

    /**
     * @return array
     */
    protected function __toArray()
    {
        return [
            'calendarId' => self::getCalendar()->getId(),
            'filterId' => self::getFilter() ? self::getFilter()->getId() : null
        ];
    }

    /**
     * Set calendar
     *
     * @param CalendarInterface
     *
     * @return static
     */
    protected function setCalendar(CalendarInterface $calendar): ExternalCallFilterRelCalendarInterface
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

    /**
     * Set filter
     *
     * @param ExternalCallFilterInterface | null
     *
     * @return static
     */
    public function setFilter(?ExternalCallFilterInterface $filter = null): ExternalCallFilterRelCalendarInterface
    {
        $this->filter = $filter;

        return $this;
    }

    /**
     * Get filter
     *
     * @return ExternalCallFilterInterface | null
     */
    public function getFilter(): ?ExternalCallFilterInterface
    {
        return $this->filter;
    }

}
