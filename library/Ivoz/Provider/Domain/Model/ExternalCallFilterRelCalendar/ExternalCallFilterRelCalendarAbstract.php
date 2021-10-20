<?php

declare(strict_types=1);

namespace Ivoz\Provider\Domain\Model\ExternalCallFilterRelCalendar;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Provider\Domain\Model\ExternalCallFilter\ExternalCallFilterInterface;
use Ivoz\Provider\Domain\Model\Calendar\CalendarInterface;
use Ivoz\Provider\Domain\Model\ExternalCallFilter\ExternalCallFilter;
use Ivoz\Provider\Domain\Model\Calendar\Calendar;

/**
* ExternalCallFilterRelCalendarAbstract
* @codeCoverageIgnore
*/
abstract class ExternalCallFilterRelCalendarAbstract
{
    use ChangelogTrait;

    /**
     * @var ExternalCallFilterInterface | null
     * inversedBy calendars
     */
    protected $filter;

    /**
     * @var CalendarInterface
     */
    protected $calendar;

    /**
     * Constructor
     */
    protected function __construct()
    {
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
     * @param mixed $id
     */
    public static function createDto($id = null): ExternalCallFilterRelCalendarDto
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
        $dto = $entity->toDto($depth - 1);

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

        $self = new static();

        $self
            ->setFilter($fkTransformer->transform($dto->getFilter()))
            ->setCalendar($fkTransformer->transform($dto->getCalendar()));

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
            ->setFilter($fkTransformer->transform($dto->getFilter()))
            ->setCalendar($fkTransformer->transform($dto->getCalendar()));

        return $this;
    }

    /**
     * @internal use EntityTools instead
     * @param int $depth
     */
    public function toDto($depth = 0): ExternalCallFilterRelCalendarDto
    {
        return self::createDto()
            ->setFilter(ExternalCallFilter::entityToDto(self::getFilter(), $depth))
            ->setCalendar(Calendar::entityToDto(self::getCalendar(), $depth));
    }

    /**
     * @return array
     */
    protected function __toArray()
    {
        return [
            'filterId' => self::getFilter() ? self::getFilter()->getId() : null,
            'calendarId' => self::getCalendar()->getId()
        ];
    }

    public function setFilter(?ExternalCallFilterInterface $filter = null): static
    {
        $this->filter = $filter;

        /** @var  $this */
        return $this;
    }

    public function getFilter(): ?ExternalCallFilterInterface
    {
        return $this->filter;
    }

    protected function setCalendar(CalendarInterface $calendar): static
    {
        $this->calendar = $calendar;

        return $this;
    }

    public function getCalendar(): CalendarInterface
    {
        return $this->calendar;
    }
}
