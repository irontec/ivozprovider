<?php

declare(strict_types=1);

namespace Ivoz\Provider\Domain\Model\ExternalCallFilter;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Provider\Domain\Model\ExternalCallFilterRelCalendar\ExternalCallFilterRelCalendarInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\Selectable;
use Doctrine\Common\Collections\Criteria;
use Ivoz\Provider\Domain\Model\ExternalCallFilterBlackList\ExternalCallFilterBlackListInterface;
use Ivoz\Provider\Domain\Model\ExternalCallFilterWhiteList\ExternalCallFilterWhiteListInterface;
use Ivoz\Provider\Domain\Model\ExternalCallFilterRelSchedule\ExternalCallFilterRelScheduleInterface;

/**
* @codeCoverageIgnore
*/
trait ExternalCallFilterTrait
{
    /**
     * @var ?int
     */
    protected $id = null;

    /**
     * @var Collection<array-key, ExternalCallFilterRelCalendarInterface> & Selectable<array-key, ExternalCallFilterRelCalendarInterface>
     * ExternalCallFilterRelCalendarInterface mappedBy filter
     * orphanRemoval
     */
    protected $calendars;

    /**
     * @var Collection<array-key, ExternalCallFilterBlackListInterface> & Selectable<array-key, ExternalCallFilterBlackListInterface>
     * ExternalCallFilterBlackListInterface mappedBy filter
     * orphanRemoval
     */
    protected $blackLists;

    /**
     * @var Collection<array-key, ExternalCallFilterWhiteListInterface> & Selectable<array-key, ExternalCallFilterWhiteListInterface>
     * ExternalCallFilterWhiteListInterface mappedBy filter
     * orphanRemoval
     */
    protected $whiteLists;

    /**
     * @var Collection<array-key, ExternalCallFilterRelScheduleInterface> & Selectable<array-key, ExternalCallFilterRelScheduleInterface>
     * ExternalCallFilterRelScheduleInterface mappedBy filter
     * orphanRemoval
     */
    protected $schedules;

    /**
     * Constructor
     */
    protected function __construct()
    {
        parent::__construct(...func_get_args());
        $this->calendars = new ArrayCollection();
        $this->blackLists = new ArrayCollection();
        $this->whiteLists = new ArrayCollection();
        $this->schedules = new ArrayCollection();
    }

    abstract protected function sanitizeValues(): void;

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param ExternalCallFilterDto $dto
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
        /** @var static $self */
        $self = parent::fromDto($dto, $fkTransformer);
        $calendars = $dto->getCalendars();
        if (!is_null($calendars)) {

            /** @var Collection<array-key, ExternalCallFilterRelCalendarInterface> $replacement */
            $replacement = $fkTransformer->transformCollection(
                $calendars
            );
            $self->replaceCalendars($replacement);
        }

        $blackLists = $dto->getBlackLists();
        if (!is_null($blackLists)) {

            /** @var Collection<array-key, ExternalCallFilterBlackListInterface> $replacement */
            $replacement = $fkTransformer->transformCollection(
                $blackLists
            );
            $self->replaceBlackLists($replacement);
        }

        $whiteLists = $dto->getWhiteLists();
        if (!is_null($whiteLists)) {

            /** @var Collection<array-key, ExternalCallFilterWhiteListInterface> $replacement */
            $replacement = $fkTransformer->transformCollection(
                $whiteLists
            );
            $self->replaceWhiteLists($replacement);
        }

        $schedules = $dto->getSchedules();
        if (!is_null($schedules)) {

            /** @var Collection<array-key, ExternalCallFilterRelScheduleInterface> $replacement */
            $replacement = $fkTransformer->transformCollection(
                $schedules
            );
            $self->replaceSchedules($replacement);
        }

        $self->sanitizeValues();
        if ($dto->getId()) {
            $self->id = $dto->getId();
            $self->initChangelog();
        }

        return $self;
    }

    /**
     * @internal use EntityTools instead
     * @param ExternalCallFilterDto $dto
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
        parent::updateFromDto($dto, $fkTransformer);
        $calendars = $dto->getCalendars();
        if (!is_null($calendars)) {

            /** @var Collection<array-key, ExternalCallFilterRelCalendarInterface> $replacement */
            $replacement = $fkTransformer->transformCollection(
                $calendars
            );
            $this->replaceCalendars($replacement);
        }

        $blackLists = $dto->getBlackLists();
        if (!is_null($blackLists)) {

            /** @var Collection<array-key, ExternalCallFilterBlackListInterface> $replacement */
            $replacement = $fkTransformer->transformCollection(
                $blackLists
            );
            $this->replaceBlackLists($replacement);
        }

        $whiteLists = $dto->getWhiteLists();
        if (!is_null($whiteLists)) {

            /** @var Collection<array-key, ExternalCallFilterWhiteListInterface> $replacement */
            $replacement = $fkTransformer->transformCollection(
                $whiteLists
            );
            $this->replaceWhiteLists($replacement);
        }

        $schedules = $dto->getSchedules();
        if (!is_null($schedules)) {

            /** @var Collection<array-key, ExternalCallFilterRelScheduleInterface> $replacement */
            $replacement = $fkTransformer->transformCollection(
                $schedules
            );
            $this->replaceSchedules($replacement);
        }
        $this->sanitizeValues();

        return $this;
    }

    /**
     * @internal use EntityTools instead
     */
    public function toDto(int $depth = 0): ExternalCallFilterDto
    {
        $dto = parent::toDto($depth);
        return $dto
            ->setId($this->getId());
    }

    /**
     * @return array<string, mixed>
     */
    protected function __toArray(): array
    {
        return parent::__toArray() + [
            'id' => self::getId()
        ];
    }

    public function addCalendar(ExternalCallFilterRelCalendarInterface $calendar): ExternalCallFilterInterface
    {
        $this->calendars->add($calendar);

        return $this;
    }

    public function removeCalendar(ExternalCallFilterRelCalendarInterface $calendar): ExternalCallFilterInterface
    {
        $this->calendars->removeElement($calendar);

        return $this;
    }

    /**
     * @param Collection<array-key, ExternalCallFilterRelCalendarInterface> $calendars
     */
    public function replaceCalendars(Collection $calendars): ExternalCallFilterInterface
    {
        $updatedEntities = [];
        $fallBackId = -1;
        foreach ($calendars as $entity) {
            /** @var string|int $index */
            $index = $entity->getId() ? $entity->getId() : $fallBackId--;
            $updatedEntities[$index] = $entity;
            $entity->setFilter($this);
        }

        foreach ($this->calendars as $key => $entity) {
            $identity = $entity->getId();
            if (!$identity) {
                $this->calendars->remove($key);
                continue;
            }

            if (array_key_exists($identity, $updatedEntities)) {
                $this->calendars->set($key, $updatedEntities[$identity]);
                unset($updatedEntities[$identity]);
            } else {
                $this->calendars->remove($key);
            }
        }

        foreach ($updatedEntities as $entity) {
            $this->addCalendar($entity);
        }

        return $this;
    }

    /**
     * @return array<array-key, ExternalCallFilterRelCalendarInterface>
     */
    public function getCalendars(Criteria $criteria = null): array
    {
        if (!is_null($criteria)) {
            return $this->calendars->matching($criteria)->toArray();
        }

        return $this->calendars->toArray();
    }

    public function addBlackList(ExternalCallFilterBlackListInterface $blackList): ExternalCallFilterInterface
    {
        $this->blackLists->add($blackList);

        return $this;
    }

    public function removeBlackList(ExternalCallFilterBlackListInterface $blackList): ExternalCallFilterInterface
    {
        $this->blackLists->removeElement($blackList);

        return $this;
    }

    /**
     * @param Collection<array-key, ExternalCallFilterBlackListInterface> $blackLists
     */
    public function replaceBlackLists(Collection $blackLists): ExternalCallFilterInterface
    {
        $updatedEntities = [];
        $fallBackId = -1;
        foreach ($blackLists as $entity) {
            /** @var string|int $index */
            $index = $entity->getId() ? $entity->getId() : $fallBackId--;
            $updatedEntities[$index] = $entity;
            $entity->setFilter($this);
        }

        foreach ($this->blackLists as $key => $entity) {
            $identity = $entity->getId();
            if (!$identity) {
                $this->blackLists->remove($key);
                continue;
            }

            if (array_key_exists($identity, $updatedEntities)) {
                $this->blackLists->set($key, $updatedEntities[$identity]);
                unset($updatedEntities[$identity]);
            } else {
                $this->blackLists->remove($key);
            }
        }

        foreach ($updatedEntities as $entity) {
            $this->addBlackList($entity);
        }

        return $this;
    }

    /**
     * @return array<array-key, ExternalCallFilterBlackListInterface>
     */
    public function getBlackLists(Criteria $criteria = null): array
    {
        if (!is_null($criteria)) {
            return $this->blackLists->matching($criteria)->toArray();
        }

        return $this->blackLists->toArray();
    }

    public function addWhiteList(ExternalCallFilterWhiteListInterface $whiteList): ExternalCallFilterInterface
    {
        $this->whiteLists->add($whiteList);

        return $this;
    }

    public function removeWhiteList(ExternalCallFilterWhiteListInterface $whiteList): ExternalCallFilterInterface
    {
        $this->whiteLists->removeElement($whiteList);

        return $this;
    }

    /**
     * @param Collection<array-key, ExternalCallFilterWhiteListInterface> $whiteLists
     */
    public function replaceWhiteLists(Collection $whiteLists): ExternalCallFilterInterface
    {
        $updatedEntities = [];
        $fallBackId = -1;
        foreach ($whiteLists as $entity) {
            /** @var string|int $index */
            $index = $entity->getId() ? $entity->getId() : $fallBackId--;
            $updatedEntities[$index] = $entity;
            $entity->setFilter($this);
        }

        foreach ($this->whiteLists as $key => $entity) {
            $identity = $entity->getId();
            if (!$identity) {
                $this->whiteLists->remove($key);
                continue;
            }

            if (array_key_exists($identity, $updatedEntities)) {
                $this->whiteLists->set($key, $updatedEntities[$identity]);
                unset($updatedEntities[$identity]);
            } else {
                $this->whiteLists->remove($key);
            }
        }

        foreach ($updatedEntities as $entity) {
            $this->addWhiteList($entity);
        }

        return $this;
    }

    /**
     * @return array<array-key, ExternalCallFilterWhiteListInterface>
     */
    public function getWhiteLists(Criteria $criteria = null): array
    {
        if (!is_null($criteria)) {
            return $this->whiteLists->matching($criteria)->toArray();
        }

        return $this->whiteLists->toArray();
    }

    public function addSchedule(ExternalCallFilterRelScheduleInterface $schedule): ExternalCallFilterInterface
    {
        $this->schedules->add($schedule);

        return $this;
    }

    public function removeSchedule(ExternalCallFilterRelScheduleInterface $schedule): ExternalCallFilterInterface
    {
        $this->schedules->removeElement($schedule);

        return $this;
    }

    /**
     * @param Collection<array-key, ExternalCallFilterRelScheduleInterface> $schedules
     */
    public function replaceSchedules(Collection $schedules): ExternalCallFilterInterface
    {
        $updatedEntities = [];
        $fallBackId = -1;
        foreach ($schedules as $entity) {
            /** @var string|int $index */
            $index = $entity->getId() ? $entity->getId() : $fallBackId--;
            $updatedEntities[$index] = $entity;
            $entity->setFilter($this);
        }

        foreach ($this->schedules as $key => $entity) {
            $identity = $entity->getId();
            if (!$identity) {
                $this->schedules->remove($key);
                continue;
            }

            if (array_key_exists($identity, $updatedEntities)) {
                $this->schedules->set($key, $updatedEntities[$identity]);
                unset($updatedEntities[$identity]);
            } else {
                $this->schedules->remove($key);
            }
        }

        foreach ($updatedEntities as $entity) {
            $this->addSchedule($entity);
        }

        return $this;
    }

    /**
     * @return array<array-key, ExternalCallFilterRelScheduleInterface>
     */
    public function getSchedules(Criteria $criteria = null): array
    {
        if (!is_null($criteria)) {
            return $this->schedules->matching($criteria)->toArray();
        }

        return $this->schedules->toArray();
    }
}
