<?php

declare(strict_types=1);

namespace Ivoz\Provider\Domain\Model\CalendarPeriod;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Provider\Domain\Model\CalendarPeriodsRelSchedule\CalendarPeriodsRelScheduleInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\Selectable;
use Doctrine\Common\Collections\Criteria;

/**
* @codeCoverageIgnore
*/
trait CalendarPeriodTrait
{
    /**
     * @var ?int
     */
    protected $id = null;

    /**
     * @var Collection<array-key, CalendarPeriodsRelScheduleInterface> & Selectable<array-key, CalendarPeriodsRelScheduleInterface>
     * CalendarPeriodsRelScheduleInterface mappedBy calendarPeriod
     * orphanRemoval
     */
    protected $relSchedules;

    /**
     * Constructor
     */
    protected function __construct()
    {
        parent::__construct(...func_get_args());
        $this->relSchedules = new ArrayCollection();
    }

    abstract protected function sanitizeValues(): void;

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param CalendarPeriodDto $dto
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
        /** @var static $self */
        $self = parent::fromDto($dto, $fkTransformer);
        $relSchedules = $dto->getRelSchedules();
        if (!is_null($relSchedules)) {

            /** @var Collection<array-key, CalendarPeriodsRelScheduleInterface> $replacement */
            $replacement = $fkTransformer->transformCollection(
                $relSchedules
            );
            $self->replaceRelSchedules($replacement);
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
     * @param CalendarPeriodDto $dto
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
        parent::updateFromDto($dto, $fkTransformer);
        $relSchedules = $dto->getRelSchedules();
        if (!is_null($relSchedules)) {

            /** @var Collection<array-key, CalendarPeriodsRelScheduleInterface> $replacement */
            $replacement = $fkTransformer->transformCollection(
                $relSchedules
            );
            $this->replaceRelSchedules($replacement);
        }
        $this->sanitizeValues();

        return $this;
    }

    /**
     * @internal use EntityTools instead
     */
    public function toDto(int $depth = 0): CalendarPeriodDto
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

    public function addRelSchedule(CalendarPeriodsRelScheduleInterface $relSchedule): CalendarPeriodInterface
    {
        $this->relSchedules->add($relSchedule);

        return $this;
    }

    public function removeRelSchedule(CalendarPeriodsRelScheduleInterface $relSchedule): CalendarPeriodInterface
    {
        $this->relSchedules->removeElement($relSchedule);

        return $this;
    }

    /**
     * @param Collection<array-key, CalendarPeriodsRelScheduleInterface> $relSchedules
     */
    public function replaceRelSchedules(Collection $relSchedules): CalendarPeriodInterface
    {
        $updatedEntities = [];
        $fallBackId = -1;
        foreach ($relSchedules as $entity) {
            /** @var string|int $index */
            $index = $entity->getId() ? $entity->getId() : $fallBackId--;
            $updatedEntities[$index] = $entity;
            $entity->setCalendarPeriod($this);
        }

        foreach ($this->relSchedules as $key => $entity) {
            $identity = $entity->getId();
            if (!$identity) {
                $this->relSchedules->remove($key);
                continue;
            }

            if (array_key_exists($identity, $updatedEntities)) {
                $this->relSchedules->set($key, $updatedEntities[$identity]);
                unset($updatedEntities[$identity]);
            } else {
                $this->relSchedules->remove($key);
            }
        }

        foreach ($updatedEntities as $entity) {
            $this->addRelSchedule($entity);
        }

        return $this;
    }

    /**
     * @return array<array-key, CalendarPeriodsRelScheduleInterface>
     */
    public function getRelSchedules(Criteria $criteria = null): array
    {
        if (!is_null($criteria)) {
            return $this->relSchedules->matching($criteria)->toArray();
        }

        return $this->relSchedules->toArray();
    }
}
