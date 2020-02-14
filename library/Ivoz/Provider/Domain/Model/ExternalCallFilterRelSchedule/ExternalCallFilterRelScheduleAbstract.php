<?php

namespace Ivoz\Provider\Domain\Model\ExternalCallFilterRelSchedule;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;

/**
 * ExternalCallFilterRelScheduleAbstract
 * @codeCoverageIgnore
 */
abstract class ExternalCallFilterRelScheduleAbstract
{
    /**
     * @var \Ivoz\Provider\Domain\Model\ExternalCallFilter\ExternalCallFilterInterface | null
     */
    protected $filter;

    /**
     * @var \Ivoz\Provider\Domain\Model\Schedule\ScheduleInterface
     */
    protected $schedule;


    use ChangelogTrait;

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
            "ExternalCallFilterRelSchedule",
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
     * @return ExternalCallFilterRelScheduleDto
     */
    public static function createDto($id = null)
    {
        return new ExternalCallFilterRelScheduleDto($id);
    }

    /**
     * @internal use EntityTools instead
     * @param ExternalCallFilterRelScheduleInterface|null $entity
     * @param int $depth
     * @return ExternalCallFilterRelScheduleDto|null
     */
    public static function entityToDto(EntityInterface $entity = null, $depth = 0)
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

        /** @var ExternalCallFilterRelScheduleDto $dto */
        $dto = $entity->toDto($depth-1);

        return $dto;
    }

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param ExternalCallFilterRelScheduleDto $dto
     * @return self
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        \Ivoz\Core\Application\ForeignKeyTransformerInterface $fkTransformer
    ) {
        Assertion::isInstanceOf($dto, ExternalCallFilterRelScheduleDto::class);

        $self = new static();

        $self
            ->setFilter($fkTransformer->transform($dto->getFilter()))
            ->setSchedule($fkTransformer->transform($dto->getSchedule()))
        ;

        $self->initChangelog();

        return $self;
    }

    /**
     * @internal use EntityTools instead
     * @param ExternalCallFilterRelScheduleDto $dto
     * @return self
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        \Ivoz\Core\Application\ForeignKeyTransformerInterface $fkTransformer
    ) {
        Assertion::isInstanceOf($dto, ExternalCallFilterRelScheduleDto::class);

        $this
            ->setFilter($fkTransformer->transform($dto->getFilter()))
            ->setSchedule($fkTransformer->transform($dto->getSchedule()));



        return $this;
    }

    /**
     * @internal use EntityTools instead
     * @param int $depth
     * @return ExternalCallFilterRelScheduleDto
     */
    public function toDto($depth = 0)
    {
        return self::createDto()
            ->setFilter(\Ivoz\Provider\Domain\Model\ExternalCallFilter\ExternalCallFilter::entityToDto(self::getFilter(), $depth))
            ->setSchedule(\Ivoz\Provider\Domain\Model\Schedule\Schedule::entityToDto(self::getSchedule(), $depth));
    }

    /**
     * @return array
     */
    protected function __toArray()
    {
        return [
            'filterId' => self::getFilter() ? self::getFilter()->getId() : null,
            'scheduleId' => self::getSchedule()->getId()
        ];
    }
    // @codeCoverageIgnoreStart

    /**
     * Set filter
     *
     * @param \Ivoz\Provider\Domain\Model\ExternalCallFilter\ExternalCallFilterInterface $filter | null
     *
     * @return static
     */
    public function setFilter(\Ivoz\Provider\Domain\Model\ExternalCallFilter\ExternalCallFilterInterface $filter = null)
    {
        $this->filter = $filter;

        return $this;
    }

    /**
     * Get filter
     *
     * @return \Ivoz\Provider\Domain\Model\ExternalCallFilter\ExternalCallFilterInterface | null
     */
    public function getFilter()
    {
        return $this->filter;
    }

    /**
     * Set schedule
     *
     * @param \Ivoz\Provider\Domain\Model\Schedule\ScheduleInterface $schedule
     *
     * @return static
     */
    protected function setSchedule(\Ivoz\Provider\Domain\Model\Schedule\ScheduleInterface $schedule)
    {
        $this->schedule = $schedule;

        return $this;
    }

    /**
     * Get schedule
     *
     * @return \Ivoz\Provider\Domain\Model\Schedule\ScheduleInterface
     */
    public function getSchedule()
    {
        return $this->schedule;
    }

    // @codeCoverageIgnoreEnd
}
