<?php

namespace Ivoz\Provider\Domain\Model\Calendar;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\Criteria;

/**
 * CalendarTrait
 * @codeCoverageIgnore
 */
trait CalendarTrait
{
    /**
     * @var integer
     */
    protected $id;

    /**
     * @var Collection
     */
    protected $holidayDates;


    /**
     * Constructor
     */
    protected function __construct()
    {
        parent::__construct(...func_get_args());
        $this->holidayDates = new ArrayCollection();
    }

    /**
     * @return CalendarDTO
     */
    public static function createDTO()
    {
        return new CalendarDTO();
    }

    /**
     * Factory method
     * @param DataTransferObjectInterface $dto
     * @return self
     */
    public static function fromDTO(DataTransferObjectInterface $dto)
    {
        /**
         * @var $dto CalendarDTO
         */
        $self = parent::fromDTO($dto);
        if ($dto->getHolidayDates()) {
            $self->replaceHolidayDates($dto->getHolidayDates());
        }
        if ($dto->getId()) {
            $self->id = $dto->getId();
            $self->initChangelog();
        }

        return $self;
    }

    /**
     * @param DataTransferObjectInterface $dto
     * @return self
     */
    public function updateFromDTO(DataTransferObjectInterface $dto)
    {
        /**
         * @var $dto CalendarDTO
         */
        parent::updateFromDTO($dto);
        if ($dto->getHolidayDates()) {
            $this->replaceHolidayDates($dto->getHolidayDates());
        }
        return $this;
    }

    /**
     * @return CalendarDTO
     */
    public function toDTO()
    {
        $dto = parent::toDTO();
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
     * Add holidayDate
     *
     * @param \Ivoz\Provider\Domain\Model\HolidayDate\HolidayDateInterface $holidayDate
     *
     * @return CalendarTrait
     */
    public function addHolidayDate(\Ivoz\Provider\Domain\Model\HolidayDate\HolidayDateInterface $holidayDate)
    {
        $this->holidayDates->add($holidayDate);

        return $this;
    }

    /**
     * Remove holidayDate
     *
     * @param \Ivoz\Provider\Domain\Model\HolidayDate\HolidayDateInterface $holidayDate
     */
    public function removeHolidayDate(\Ivoz\Provider\Domain\Model\HolidayDate\HolidayDateInterface $holidayDate)
    {
        $this->holidayDates->removeElement($holidayDate);
    }

    /**
     * Replace holidayDates
     *
     * @param \Ivoz\Provider\Domain\Model\HolidayDate\HolidayDateInterface[] $holidayDates
     * @return self
     */
    public function replaceHolidayDates(Collection $holidayDates)
    {
        $updatedEntities = [];
        $fallBackId = -1;
        foreach ($holidayDates as $entity) {
            $index = $entity->getId() ? $entity->getId() : $fallBackId--;
            $updatedEntities[$index] = $entity;
            $entity->setCalendar($this);
        }
        $updatedEntityKeys = array_keys($updatedEntities);

        foreach ($this->holidayDates as $key => $entity) {
            $identity = $entity->getId();
            if (in_array($identity, $updatedEntityKeys)) {
                $this->holidayDates->set($key, $updatedEntities[$identity]);
            } else {
                $this->holidayDates->remove($key);
            }
            unset($updatedEntities[$identity]);
        }

        foreach ($updatedEntities as $entity) {
            $this->addHolidayDate($entity);
        }

        return $this;
    }

    /**
     * Get holidayDates
     *
     * @return array
     */
    public function getHolidayDates(Criteria $criteria = null)
    {
        if (!is_null($criteria)) {
            return $this->holidayDates->matching($criteria)->toArray();
        }

        return $this->holidayDates->toArray();
    }


}

