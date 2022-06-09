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
     * @var ?ExternalCallFilterInterface
     * inversedBy calendars
     */
    protected $filter = null;

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

    abstract public function getId(): null|string|int;

    public function __toString(): string
    {
        return sprintf(
            "%s#%s",
            "ExternalCallFilterRelCalendar",
            (string) $this->getId()
        );
    }

    /**
     * @throws \Exception
     */
    protected function sanitizeValues(): void
    {
    }

    public static function createDto(string|int|null $id = null): ExternalCallFilterRelCalendarDto
    {
        return new ExternalCallFilterRelCalendarDto($id);
    }

    /**
     * @internal use EntityTools instead
     * @param null|ExternalCallFilterRelCalendarInterface $entity
     */
    public static function entityToDto(?EntityInterface $entity, int $depth = 0): ?ExternalCallFilterRelCalendarDto
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

        $dto = $entity->toDto($depth - 1);

        return $dto;
    }

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param ExternalCallFilterRelCalendarDto $dto
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
        Assertion::isInstanceOf($dto, ExternalCallFilterRelCalendarDto::class);
        $calendar = $dto->getCalendar();
        Assertion::notNull($calendar, 'getCalendar value is null, but non null value was expected.');

        $self = new static();

        $self
            ->setFilter($fkTransformer->transform($dto->getFilter()))
            ->setCalendar($fkTransformer->transform($calendar));

        $self->initChangelog();

        return $self;
    }

    /**
     * @internal use EntityTools instead
     * @param ExternalCallFilterRelCalendarDto $dto
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
        Assertion::isInstanceOf($dto, ExternalCallFilterRelCalendarDto::class);

        $calendar = $dto->getCalendar();
        Assertion::notNull($calendar, 'getCalendar value is null, but non null value was expected.');

        $this
            ->setFilter($fkTransformer->transform($dto->getFilter()))
            ->setCalendar($fkTransformer->transform($calendar));

        return $this;
    }

    /**
     * @internal use EntityTools instead
     */
    public function toDto(int $depth = 0): ExternalCallFilterRelCalendarDto
    {
        return self::createDto()
            ->setFilter(ExternalCallFilter::entityToDto(self::getFilter(), $depth))
            ->setCalendar(Calendar::entityToDto(self::getCalendar(), $depth));
    }

    /**
     * @return array<string, mixed>
     */
    protected function __toArray(): array
    {
        return [
            'filterId' => self::getFilter()?->getId(),
            'calendarId' => self::getCalendar()->getId()
        ];
    }

    public function setFilter(?ExternalCallFilterInterface $filter = null): static
    {
        $this->filter = $filter;

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
