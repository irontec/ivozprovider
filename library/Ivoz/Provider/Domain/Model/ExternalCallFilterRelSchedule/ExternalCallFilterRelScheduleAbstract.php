<?php

declare(strict_types=1);

namespace Ivoz\Provider\Domain\Model\ExternalCallFilterRelSchedule;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Provider\Domain\Model\ExternalCallFilter\ExternalCallFilterInterface;
use Ivoz\Provider\Domain\Model\Schedule\ScheduleInterface;
use Ivoz\Provider\Domain\Model\ExternalCallFilter\ExternalCallFilter;
use Ivoz\Provider\Domain\Model\Schedule\Schedule;

/**
* ExternalCallFilterRelScheduleAbstract
* @codeCoverageIgnore
*/
abstract class ExternalCallFilterRelScheduleAbstract
{
    use ChangelogTrait;

    /**
     * @var ?ExternalCallFilterInterface
     * inversedBy schedules
     */
    protected $filter = null;

    /**
     * @var ScheduleInterface
     */
    protected $schedule;

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
            "ExternalCallFilterRelSchedule",
            (string) $this->getId()
        );
    }

    /**
     * @throws \Exception
     */
    protected function sanitizeValues(): void
    {
    }

    public static function createDto(string|int|null $id = null): ExternalCallFilterRelScheduleDto
    {
        return new ExternalCallFilterRelScheduleDto($id);
    }

    /**
     * @internal use EntityTools instead
     * @param null|ExternalCallFilterRelScheduleInterface $entity
     */
    public static function entityToDto(?EntityInterface $entity, int $depth = 0): ?ExternalCallFilterRelScheduleDto
    {
        if (!$entity) {
            return null;
        }

        Assertion::isInstanceOf($entity, ExternalCallFilterRelScheduleInterface::class);

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
     * @param ExternalCallFilterRelScheduleDto $dto
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
        Assertion::isInstanceOf($dto, ExternalCallFilterRelScheduleDto::class);
        $schedule = $dto->getSchedule();
        Assertion::notNull($schedule, 'getSchedule value is null, but non null value was expected.');

        $self = new static();

        $self
            ->setFilter($fkTransformer->transform($dto->getFilter()))
            ->setSchedule($fkTransformer->transform($schedule));

        $self->initChangelog();

        return $self;
    }

    /**
     * @internal use EntityTools instead
     * @param ExternalCallFilterRelScheduleDto $dto
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
        Assertion::isInstanceOf($dto, ExternalCallFilterRelScheduleDto::class);

        $schedule = $dto->getSchedule();
        Assertion::notNull($schedule, 'getSchedule value is null, but non null value was expected.');

        $this
            ->setFilter($fkTransformer->transform($dto->getFilter()))
            ->setSchedule($fkTransformer->transform($schedule));

        return $this;
    }

    /**
     * @internal use EntityTools instead
     */
    public function toDto(int $depth = 0): ExternalCallFilterRelScheduleDto
    {
        return self::createDto()
            ->setFilter(ExternalCallFilter::entityToDto(self::getFilter(), $depth))
            ->setSchedule(Schedule::entityToDto(self::getSchedule(), $depth));
    }

    protected function __toArray(): array
    {
        return [
            'filterId' => self::getFilter()?->getId(),
            'scheduleId' => self::getSchedule()->getId()
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

    protected function setSchedule(ScheduleInterface $schedule): static
    {
        $this->schedule = $schedule;

        return $this;
    }

    public function getSchedule(): ScheduleInterface
    {
        return $this->schedule;
    }
}
