<?php
declare(strict_types = 1);

namespace Ivoz\Provider\Domain\Model\ExternalCallFilter;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Provider\Domain\Model\ExternalCallFilterRelCalendar\ExternalCallFilterRelCalendarInterface;
use Doctrine\Common\Collections\ArrayCollection;
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
     * @var int
     */
    protected $id;

    /**
     * @var ArrayCollection
     * ExternalCallFilterRelCalendarInterface mappedBy filter
     * orphanRemoval
     */
    protected $calendars;

    /**
     * @var ArrayCollection
     * ExternalCallFilterBlackListInterface mappedBy filter
     * orphanRemoval
     */
    protected $blackLists;

    /**
     * @var ArrayCollection
     * ExternalCallFilterWhiteListInterface mappedBy filter
     * orphanRemoval
     */
    protected $whiteLists;

    /**
     * @var ArrayCollection
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

    abstract protected function sanitizeValues();

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param ExternalCallFilterDto $dto
     * @param ForeignKeyTransformerInterface  $fkTransformer
     * @return static
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ) {
        /** @var static $self */
        $self = parent::fromDto($dto, $fkTransformer);
        if (!is_null($dto->getCalendars())) {
            $self->replaceCalendars(
                $fkTransformer->transformCollection(
                    $dto->getCalendars()
                )
            );
        }

        if (!is_null($dto->getBlackLists())) {
            $self->replaceBlackLists(
                $fkTransformer->transformCollection(
                    $dto->getBlackLists()
                )
            );
        }

        if (!is_null($dto->getWhiteLists())) {
            $self->replaceWhiteLists(
                $fkTransformer->transformCollection(
                    $dto->getWhiteLists()
                )
            );
        }

        if (!is_null($dto->getSchedules())) {
            $self->replaceSchedules(
                $fkTransformer->transformCollection(
                    $dto->getSchedules()
                )
            );
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
     * @param ForeignKeyTransformerInterface  $fkTransformer
     * @return static
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ) {
        parent::updateFromDto($dto, $fkTransformer);
        if (!is_null($dto->getCalendars())) {
            $this->replaceCalendars(
                $fkTransformer->transformCollection(
                    $dto->getCalendars()
                )
            );
        }

        if (!is_null($dto->getBlackLists())) {
            $this->replaceBlackLists(
                $fkTransformer->transformCollection(
                    $dto->getBlackLists()
                )
            );
        }

        if (!is_null($dto->getWhiteLists())) {
            $this->replaceWhiteLists(
                $fkTransformer->transformCollection(
                    $dto->getWhiteLists()
                )
            );
        }

        if (!is_null($dto->getSchedules())) {
            $this->replaceSchedules(
                $fkTransformer->transformCollection(
                    $dto->getSchedules()
                )
            );
        }
        $this->sanitizeValues();

        return $this;
    }

    /**
     * @internal use EntityTools instead
     * @param int $depth
     * @return ExternalCallFilterDto
     */
    public function toDto($depth = 0)
    {
        $dto = parent::toDto($depth);
        return $dto
            ->setId($this->getId());
    }

    /**
     * @return array
     */
    protected function __toArray()
    {
        return parent::__toArray() + [
            'id' => self::getId()
        ];
    }

    /**
     * Add calendar
     *
     * @param ExternalCallFilterRelCalendarInterface $calendar
     *
     * @return static
     */
    public function addCalendar(ExternalCallFilterRelCalendarInterface $calendar): ExternalCallFilterInterface
    {
        $this->calendars->add($calendar);

        return $this;
    }

    /**
     * Remove calendar
     *
     * @param ExternalCallFilterRelCalendarInterface $calendar
     *
     * @return static
     */
    public function removeCalendar(ExternalCallFilterRelCalendarInterface $calendar): ExternalCallFilterInterface
    {
        $this->calendars->removeElement($calendar);

        return $this;
    }

    /**
     * Replace calendars
     *
     * @param ArrayCollection $calendars of ExternalCallFilterRelCalendarInterface
     *
     * @return static
     */
    public function replaceCalendars(ArrayCollection $calendars): ExternalCallFilterInterface
    {
        $updatedEntities = [];
        $fallBackId = -1;
        foreach ($calendars as $entity) {
            $index = $entity->getId() ? $entity->getId() : $fallBackId--;
            $updatedEntities[$index] = $entity;
            $entity->setFilter($this);
        }
        $updatedEntityKeys = array_keys($updatedEntities);

        foreach ($this->calendars as $key => $entity) {
            $identity = $entity->getId();
            if (in_array($identity, $updatedEntityKeys)) {
                $this->calendars->set($key, $updatedEntities[$identity]);
            } else {
                $this->calendars->remove($key);
            }
            unset($updatedEntities[$identity]);
        }

        foreach ($updatedEntities as $entity) {
            $this->addCalendar($entity);
        }

        return $this;
    }

    /**
     * Get calendars
     * @param Criteria | null $criteria
     * @return ExternalCallFilterRelCalendarInterface[]
     */
    public function getCalendars(Criteria $criteria = null): array
    {
        if (!is_null($criteria)) {
            return $this->calendars->matching($criteria)->toArray();
        }

        return $this->calendars->toArray();
    }

    /**
     * Add blackList
     *
     * @param ExternalCallFilterBlackListInterface $blackList
     *
     * @return static
     */
    public function addBlackList(ExternalCallFilterBlackListInterface $blackList): ExternalCallFilterInterface
    {
        $this->blackLists->add($blackList);

        return $this;
    }

    /**
     * Remove blackList
     *
     * @param ExternalCallFilterBlackListInterface $blackList
     *
     * @return static
     */
    public function removeBlackList(ExternalCallFilterBlackListInterface $blackList): ExternalCallFilterInterface
    {
        $this->blackLists->removeElement($blackList);

        return $this;
    }

    /**
     * Replace blackLists
     *
     * @param ArrayCollection $blackLists of ExternalCallFilterBlackListInterface
     *
     * @return static
     */
    public function replaceBlackLists(ArrayCollection $blackLists): ExternalCallFilterInterface
    {
        $updatedEntities = [];
        $fallBackId = -1;
        foreach ($blackLists as $entity) {
            $index = $entity->getId() ? $entity->getId() : $fallBackId--;
            $updatedEntities[$index] = $entity;
            $entity->setFilter($this);
        }
        $updatedEntityKeys = array_keys($updatedEntities);

        foreach ($this->blackLists as $key => $entity) {
            $identity = $entity->getId();
            if (in_array($identity, $updatedEntityKeys)) {
                $this->blackLists->set($key, $updatedEntities[$identity]);
            } else {
                $this->blackLists->remove($key);
            }
            unset($updatedEntities[$identity]);
        }

        foreach ($updatedEntities as $entity) {
            $this->addBlackList($entity);
        }

        return $this;
    }

    /**
     * Get blackLists
     * @param Criteria | null $criteria
     * @return ExternalCallFilterBlackListInterface[]
     */
    public function getBlackLists(Criteria $criteria = null): array
    {
        if (!is_null($criteria)) {
            return $this->blackLists->matching($criteria)->toArray();
        }

        return $this->blackLists->toArray();
    }

    /**
     * Add whiteList
     *
     * @param ExternalCallFilterWhiteListInterface $whiteList
     *
     * @return static
     */
    public function addWhiteList(ExternalCallFilterWhiteListInterface $whiteList): ExternalCallFilterInterface
    {
        $this->whiteLists->add($whiteList);

        return $this;
    }

    /**
     * Remove whiteList
     *
     * @param ExternalCallFilterWhiteListInterface $whiteList
     *
     * @return static
     */
    public function removeWhiteList(ExternalCallFilterWhiteListInterface $whiteList): ExternalCallFilterInterface
    {
        $this->whiteLists->removeElement($whiteList);

        return $this;
    }

    /**
     * Replace whiteLists
     *
     * @param ArrayCollection $whiteLists of ExternalCallFilterWhiteListInterface
     *
     * @return static
     */
    public function replaceWhiteLists(ArrayCollection $whiteLists): ExternalCallFilterInterface
    {
        $updatedEntities = [];
        $fallBackId = -1;
        foreach ($whiteLists as $entity) {
            $index = $entity->getId() ? $entity->getId() : $fallBackId--;
            $updatedEntities[$index] = $entity;
            $entity->setFilter($this);
        }
        $updatedEntityKeys = array_keys($updatedEntities);

        foreach ($this->whiteLists as $key => $entity) {
            $identity = $entity->getId();
            if (in_array($identity, $updatedEntityKeys)) {
                $this->whiteLists->set($key, $updatedEntities[$identity]);
            } else {
                $this->whiteLists->remove($key);
            }
            unset($updatedEntities[$identity]);
        }

        foreach ($updatedEntities as $entity) {
            $this->addWhiteList($entity);
        }

        return $this;
    }

    /**
     * Get whiteLists
     * @param Criteria | null $criteria
     * @return ExternalCallFilterWhiteListInterface[]
     */
    public function getWhiteLists(Criteria $criteria = null): array
    {
        if (!is_null($criteria)) {
            return $this->whiteLists->matching($criteria)->toArray();
        }

        return $this->whiteLists->toArray();
    }

    /**
     * Add schedule
     *
     * @param ExternalCallFilterRelScheduleInterface $schedule
     *
     * @return static
     */
    public function addSchedule(ExternalCallFilterRelScheduleInterface $schedule): ExternalCallFilterInterface
    {
        $this->schedules->add($schedule);

        return $this;
    }

    /**
     * Remove schedule
     *
     * @param ExternalCallFilterRelScheduleInterface $schedule
     *
     * @return static
     */
    public function removeSchedule(ExternalCallFilterRelScheduleInterface $schedule): ExternalCallFilterInterface
    {
        $this->schedules->removeElement($schedule);

        return $this;
    }

    /**
     * Replace schedules
     *
     * @param ArrayCollection $schedules of ExternalCallFilterRelScheduleInterface
     *
     * @return static
     */
    public function replaceSchedules(ArrayCollection $schedules): ExternalCallFilterInterface
    {
        $updatedEntities = [];
        $fallBackId = -1;
        foreach ($schedules as $entity) {
            $index = $entity->getId() ? $entity->getId() : $fallBackId--;
            $updatedEntities[$index] = $entity;
            $entity->setFilter($this);
        }
        $updatedEntityKeys = array_keys($updatedEntities);

        foreach ($this->schedules as $key => $entity) {
            $identity = $entity->getId();
            if (in_array($identity, $updatedEntityKeys)) {
                $this->schedules->set($key, $updatedEntities[$identity]);
            } else {
                $this->schedules->remove($key);
            }
            unset($updatedEntities[$identity]);
        }

        foreach ($updatedEntities as $entity) {
            $this->addSchedule($entity);
        }

        return $this;
    }

    /**
     * Get schedules
     * @param Criteria | null $criteria
     * @return ExternalCallFilterRelScheduleInterface[]
     */
    public function getSchedules(Criteria $criteria = null): array
    {
        if (!is_null($criteria)) {
            return $this->schedules->matching($criteria)->toArray();
        }

        return $this->schedules->toArray();
    }

}
