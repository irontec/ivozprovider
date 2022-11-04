<?php

declare(strict_types=1);

namespace Ivoz\Provider\Domain\Model\ConditionalRoutesCondition;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Provider\Domain\Model\ConditionalRoutesConditionsRelMatchlist\ConditionalRoutesConditionsRelMatchlistInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\Selectable;
use Doctrine\Common\Collections\Criteria;
use Ivoz\Provider\Domain\Model\ConditionalRoutesConditionsRelSchedule\ConditionalRoutesConditionsRelScheduleInterface;
use Ivoz\Provider\Domain\Model\ConditionalRoutesConditionsRelCalendar\ConditionalRoutesConditionsRelCalendarInterface;
use Ivoz\Provider\Domain\Model\ConditionalRoutesConditionsRelRouteLock\ConditionalRoutesConditionsRelRouteLockInterface;

/**
* @codeCoverageIgnore
*/
trait ConditionalRoutesConditionTrait
{
    /**
     * @var ?int
     */
    protected $id = null;

    /**
     * @var Collection<array-key, ConditionalRoutesConditionsRelMatchlistInterface> & Selectable<array-key, ConditionalRoutesConditionsRelMatchlistInterface>
     * ConditionalRoutesConditionsRelMatchlistInterface mappedBy condition
     * orphanRemoval
     */
    protected $relMatchlists;

    /**
     * @var Collection<array-key, ConditionalRoutesConditionsRelScheduleInterface> & Selectable<array-key, ConditionalRoutesConditionsRelScheduleInterface>
     * ConditionalRoutesConditionsRelScheduleInterface mappedBy condition
     * orphanRemoval
     */
    protected $relSchedules;

    /**
     * @var Collection<array-key, ConditionalRoutesConditionsRelCalendarInterface> & Selectable<array-key, ConditionalRoutesConditionsRelCalendarInterface>
     * ConditionalRoutesConditionsRelCalendarInterface mappedBy condition
     * orphanRemoval
     */
    protected $relCalendars;

    /**
     * @var Collection<array-key, ConditionalRoutesConditionsRelRouteLockInterface> & Selectable<array-key, ConditionalRoutesConditionsRelRouteLockInterface>
     * ConditionalRoutesConditionsRelRouteLockInterface mappedBy condition
     * orphanRemoval
     */
    protected $relRouteLocks;

    /**
     * Constructor
     */
    protected function __construct()
    {
        parent::__construct(...func_get_args());
        $this->relMatchlists = new ArrayCollection();
        $this->relSchedules = new ArrayCollection();
        $this->relCalendars = new ArrayCollection();
        $this->relRouteLocks = new ArrayCollection();
    }

    abstract protected function sanitizeValues(): void;

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param ConditionalRoutesConditionDto $dto
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
        /** @var static $self */
        $self = parent::fromDto($dto, $fkTransformer);
        $relMatchlists = $dto->getRelMatchlists();
        if (!is_null($relMatchlists)) {

            /** @var Collection<array-key, ConditionalRoutesConditionsRelMatchlistInterface> $replacement */
            $replacement = $fkTransformer->transformCollection(
                $relMatchlists
            );
            $self->replaceRelMatchlists($replacement);
        }

        $relSchedules = $dto->getRelSchedules();
        if (!is_null($relSchedules)) {

            /** @var Collection<array-key, ConditionalRoutesConditionsRelScheduleInterface> $replacement */
            $replacement = $fkTransformer->transformCollection(
                $relSchedules
            );
            $self->replaceRelSchedules($replacement);
        }

        $relCalendars = $dto->getRelCalendars();
        if (!is_null($relCalendars)) {

            /** @var Collection<array-key, ConditionalRoutesConditionsRelCalendarInterface> $replacement */
            $replacement = $fkTransformer->transformCollection(
                $relCalendars
            );
            $self->replaceRelCalendars($replacement);
        }

        $relRouteLocks = $dto->getRelRouteLocks();
        if (!is_null($relRouteLocks)) {

            /** @var Collection<array-key, ConditionalRoutesConditionsRelRouteLockInterface> $replacement */
            $replacement = $fkTransformer->transformCollection(
                $relRouteLocks
            );
            $self->replaceRelRouteLocks($replacement);
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
     * @param ConditionalRoutesConditionDto $dto
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
        parent::updateFromDto($dto, $fkTransformer);
        $relMatchlists = $dto->getRelMatchlists();
        if (!is_null($relMatchlists)) {

            /** @var Collection<array-key, ConditionalRoutesConditionsRelMatchlistInterface> $replacement */
            $replacement = $fkTransformer->transformCollection(
                $relMatchlists
            );
            $this->replaceRelMatchlists($replacement);
        }

        $relSchedules = $dto->getRelSchedules();
        if (!is_null($relSchedules)) {

            /** @var Collection<array-key, ConditionalRoutesConditionsRelScheduleInterface> $replacement */
            $replacement = $fkTransformer->transformCollection(
                $relSchedules
            );
            $this->replaceRelSchedules($replacement);
        }

        $relCalendars = $dto->getRelCalendars();
        if (!is_null($relCalendars)) {

            /** @var Collection<array-key, ConditionalRoutesConditionsRelCalendarInterface> $replacement */
            $replacement = $fkTransformer->transformCollection(
                $relCalendars
            );
            $this->replaceRelCalendars($replacement);
        }

        $relRouteLocks = $dto->getRelRouteLocks();
        if (!is_null($relRouteLocks)) {

            /** @var Collection<array-key, ConditionalRoutesConditionsRelRouteLockInterface> $replacement */
            $replacement = $fkTransformer->transformCollection(
                $relRouteLocks
            );
            $this->replaceRelRouteLocks($replacement);
        }
        $this->sanitizeValues();

        return $this;
    }

    /**
     * @internal use EntityTools instead
     */
    public function toDto(int $depth = 0): ConditionalRoutesConditionDto
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

    public function addRelMatchlist(ConditionalRoutesConditionsRelMatchlistInterface $relMatchlist): ConditionalRoutesConditionInterface
    {
        $this->relMatchlists->add($relMatchlist);

        return $this;
    }

    public function removeRelMatchlist(ConditionalRoutesConditionsRelMatchlistInterface $relMatchlist): ConditionalRoutesConditionInterface
    {
        $this->relMatchlists->removeElement($relMatchlist);

        return $this;
    }

    /**
     * @param Collection<array-key, ConditionalRoutesConditionsRelMatchlistInterface> $relMatchlists
     */
    public function replaceRelMatchlists(Collection $relMatchlists): ConditionalRoutesConditionInterface
    {
        foreach ($relMatchlists as $entity) {
            $entity->setCondition($this);
        }

        $toStringCallable = fn(mixed $val): \Stringable|string => $val instanceof \Stringable ? $val : serialize($val);
        foreach ($this->relMatchlists as $key => $entity) {
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
            foreach ($relMatchlists as $newKey => $newEntity) {
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
                    unset($relMatchlists[$newKey]);
                    $match = true;
                    break;
                }
            }

            if (!$match) {
                $this->relMatchlists->remove($key);
            }
        }

        foreach ($relMatchlists as $entity) {
            $this->addRelMatchlist($entity);
        }

        return $this;
    }

    /**
     * @return array<array-key, ConditionalRoutesConditionsRelMatchlistInterface>
     */
    public function getRelMatchlists(Criteria $criteria = null): array
    {
        if (!is_null($criteria)) {
            return $this->relMatchlists->matching($criteria)->toArray();
        }

        return $this->relMatchlists->toArray();
    }

    public function addRelSchedule(ConditionalRoutesConditionsRelScheduleInterface $relSchedule): ConditionalRoutesConditionInterface
    {
        $this->relSchedules->add($relSchedule);

        return $this;
    }

    public function removeRelSchedule(ConditionalRoutesConditionsRelScheduleInterface $relSchedule): ConditionalRoutesConditionInterface
    {
        $this->relSchedules->removeElement($relSchedule);

        return $this;
    }

    /**
     * @param Collection<array-key, ConditionalRoutesConditionsRelScheduleInterface> $relSchedules
     */
    public function replaceRelSchedules(Collection $relSchedules): ConditionalRoutesConditionInterface
    {
        foreach ($relSchedules as $entity) {
            $entity->setCondition($this);
        }

        $toStringCallable = fn(mixed $val): \Stringable|string => $val instanceof \Stringable ? $val : serialize($val);
        foreach ($this->relSchedules as $key => $entity) {
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
            foreach ($relSchedules as $newKey => $newEntity) {
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
                    unset($relSchedules[$newKey]);
                    $match = true;
                    break;
                }
            }

            if (!$match) {
                $this->relSchedules->remove($key);
            }
        }

        foreach ($relSchedules as $entity) {
            $this->addRelSchedule($entity);
        }

        return $this;
    }

    /**
     * @return array<array-key, ConditionalRoutesConditionsRelScheduleInterface>
     */
    public function getRelSchedules(Criteria $criteria = null): array
    {
        if (!is_null($criteria)) {
            return $this->relSchedules->matching($criteria)->toArray();
        }

        return $this->relSchedules->toArray();
    }

    public function addRelCalendar(ConditionalRoutesConditionsRelCalendarInterface $relCalendar): ConditionalRoutesConditionInterface
    {
        $this->relCalendars->add($relCalendar);

        return $this;
    }

    public function removeRelCalendar(ConditionalRoutesConditionsRelCalendarInterface $relCalendar): ConditionalRoutesConditionInterface
    {
        $this->relCalendars->removeElement($relCalendar);

        return $this;
    }

    /**
     * @param Collection<array-key, ConditionalRoutesConditionsRelCalendarInterface> $relCalendars
     */
    public function replaceRelCalendars(Collection $relCalendars): ConditionalRoutesConditionInterface
    {
        foreach ($relCalendars as $entity) {
            $entity->setCondition($this);
        }

        $toStringCallable = fn(mixed $val): \Stringable|string => $val instanceof \Stringable ? $val : serialize($val);
        foreach ($this->relCalendars as $key => $entity) {
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
            foreach ($relCalendars as $newKey => $newEntity) {
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
                    unset($relCalendars[$newKey]);
                    $match = true;
                    break;
                }
            }

            if (!$match) {
                $this->relCalendars->remove($key);
            }
        }

        foreach ($relCalendars as $entity) {
            $this->addRelCalendar($entity);
        }

        return $this;
    }

    /**
     * @return array<array-key, ConditionalRoutesConditionsRelCalendarInterface>
     */
    public function getRelCalendars(Criteria $criteria = null): array
    {
        if (!is_null($criteria)) {
            return $this->relCalendars->matching($criteria)->toArray();
        }

        return $this->relCalendars->toArray();
    }

    public function addRelRouteLock(ConditionalRoutesConditionsRelRouteLockInterface $relRouteLock): ConditionalRoutesConditionInterface
    {
        $this->relRouteLocks->add($relRouteLock);

        return $this;
    }

    public function removeRelRouteLock(ConditionalRoutesConditionsRelRouteLockInterface $relRouteLock): ConditionalRoutesConditionInterface
    {
        $this->relRouteLocks->removeElement($relRouteLock);

        return $this;
    }

    /**
     * @param Collection<array-key, ConditionalRoutesConditionsRelRouteLockInterface> $relRouteLocks
     */
    public function replaceRelRouteLocks(Collection $relRouteLocks): ConditionalRoutesConditionInterface
    {
        foreach ($relRouteLocks as $entity) {
            $entity->setCondition($this);
        }

        $toStringCallable = fn(mixed $val): \Stringable|string => $val instanceof \Stringable ? $val : serialize($val);
        foreach ($this->relRouteLocks as $key => $entity) {
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
            foreach ($relRouteLocks as $newKey => $newEntity) {
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
                    unset($relRouteLocks[$newKey]);
                    $match = true;
                    break;
                }
            }

            if (!$match) {
                $this->relRouteLocks->remove($key);
            }
        }

        foreach ($relRouteLocks as $entity) {
            $this->addRelRouteLock($entity);
        }

        return $this;
    }

    /**
     * @return array<array-key, ConditionalRoutesConditionsRelRouteLockInterface>
     */
    public function getRelRouteLocks(Criteria $criteria = null): array
    {
        if (!is_null($criteria)) {
            return $this->relRouteLocks->matching($criteria)->toArray();
        }

        return $this->relRouteLocks->toArray();
    }
}
