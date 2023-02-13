<?php

declare(strict_types=1);

namespace Ivoz\Provider\Domain\Model\ExternalCallFilter;

use Ivoz\Core\Domain\DataTransferObjectInterface;
use Ivoz\Core\Domain\ForeignKeyTransformerInterface;
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
        foreach ($calendars as $entity) {
            $entity->setFilter($this);
        }

        $toStringCallable = fn(mixed $val): \Stringable|string => $val instanceof \Stringable ? $val : serialize($val);
        foreach ($this->calendars as $key => $entity) {
            /**
             * @psalm-suppress MixedArgument
             */
            $currentValue = array_map(
                $toStringCallable,
                (function (): array {
                    return $this->__toArray(); /** @phpstan-ignore-line */
                })->call($entity)
            );

            $match = false;
            foreach ($calendars as $newKey => $newEntity) {
                /**
                 * @psalm-suppress MixedArgument
                 */
                $newValue = array_map(
                    $toStringCallable,
                    (function (): array {
                        return $this->__toArray(); /** @phpstan-ignore-line */
                    })->call($newEntity)
                );

                $diff = array_diff_assoc(
                    $currentValue,
                    $newValue
                );
                unset($diff['id']);

                if (empty($diff)) {
                    unset($calendars[$newKey]);
                    $match = true;
                    break;
                }
            }

            if (!$match) {
                $this->calendars->remove($key);
            }
        }

        foreach ($calendars as $entity) {
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
        foreach ($blackLists as $entity) {
            $entity->setFilter($this);
        }

        $toStringCallable = fn(mixed $val): \Stringable|string => $val instanceof \Stringable ? $val : serialize($val);
        foreach ($this->blackLists as $key => $entity) {
            /**
             * @psalm-suppress MixedArgument
             */
            $currentValue = array_map(
                $toStringCallable,
                (function (): array {
                    return $this->__toArray(); /** @phpstan-ignore-line */
                })->call($entity)
            );

            $match = false;
            foreach ($blackLists as $newKey => $newEntity) {
                /**
                 * @psalm-suppress MixedArgument
                 */
                $newValue = array_map(
                    $toStringCallable,
                    (function (): array {
                        return $this->__toArray(); /** @phpstan-ignore-line */
                    })->call($newEntity)
                );

                $diff = array_diff_assoc(
                    $currentValue,
                    $newValue
                );
                unset($diff['id']);

                if (empty($diff)) {
                    unset($blackLists[$newKey]);
                    $match = true;
                    break;
                }
            }

            if (!$match) {
                $this->blackLists->remove($key);
            }
        }

        foreach ($blackLists as $entity) {
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
        foreach ($whiteLists as $entity) {
            $entity->setFilter($this);
        }

        $toStringCallable = fn(mixed $val): \Stringable|string => $val instanceof \Stringable ? $val : serialize($val);
        foreach ($this->whiteLists as $key => $entity) {
            /**
             * @psalm-suppress MixedArgument
             */
            $currentValue = array_map(
                $toStringCallable,
                (function (): array {
                    return $this->__toArray(); /** @phpstan-ignore-line */
                })->call($entity)
            );

            $match = false;
            foreach ($whiteLists as $newKey => $newEntity) {
                /**
                 * @psalm-suppress MixedArgument
                 */
                $newValue = array_map(
                    $toStringCallable,
                    (function (): array {
                        return $this->__toArray(); /** @phpstan-ignore-line */
                    })->call($newEntity)
                );

                $diff = array_diff_assoc(
                    $currentValue,
                    $newValue
                );
                unset($diff['id']);

                if (empty($diff)) {
                    unset($whiteLists[$newKey]);
                    $match = true;
                    break;
                }
            }

            if (!$match) {
                $this->whiteLists->remove($key);
            }
        }

        foreach ($whiteLists as $entity) {
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
        foreach ($schedules as $entity) {
            $entity->setFilter($this);
        }

        $toStringCallable = fn(mixed $val): \Stringable|string => $val instanceof \Stringable ? $val : serialize($val);
        foreach ($this->schedules as $key => $entity) {
            /**
             * @psalm-suppress MixedArgument
             */
            $currentValue = array_map(
                $toStringCallable,
                (function (): array {
                    return $this->__toArray(); /** @phpstan-ignore-line */
                })->call($entity)
            );

            $match = false;
            foreach ($schedules as $newKey => $newEntity) {
                /**
                 * @psalm-suppress MixedArgument
                 */
                $newValue = array_map(
                    $toStringCallable,
                    (function (): array {
                        return $this->__toArray(); /** @phpstan-ignore-line */
                    })->call($newEntity)
                );

                $diff = array_diff_assoc(
                    $currentValue,
                    $newValue
                );
                unset($diff['id']);

                if (empty($diff)) {
                    unset($schedules[$newKey]);
                    $match = true;
                    break;
                }
            }

            if (!$match) {
                $this->schedules->remove($key);
            }
        }

        foreach ($schedules as $entity) {
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
