<?php

namespace Ivoz\Provider\Domain\Model\ExternalCallFilterRelSchedule;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;

/**
 * ExternalCallFilterRelScheduleAbstract
 * @codeCoverageIgnore
 */
abstract class ExternalCallFilterRelScheduleAbstract
{
    /**
     * @var \Ivoz\Provider\Domain\Model\ExternalCallFilter\ExternalCallFilterInterface
     */
    protected $filter;

    /**
     * @var \Ivoz\Provider\Domain\Model\Schedule\ScheduleInterface
     */
    protected $schedule;


    /**
     * Changelog tracking purpose
     * @var array
     */
    protected $_initialValues = [];

    /**
     * Constructor
     */
    public function __construct()
    {


        $this->initChangelog();
    }

    /**
     * @param string $fieldName
     * @return mixed
     * @throws \Exception
     */
    public function initChangelog()
    {
        $values = $this->__toArray();
        if (!$this->getId()) {
            // Empty values for entities with no Id
            foreach ($values as $key => $val) {
                $values[$key] = null;
            }
        }

        $this->_initialValues = $values;
    }

    /**
     * @param string $fieldName
     * @return mixed
     * @throws \Exception
     */
    public function hasChanged($fieldName)
    {
        if (!array_key_exists($fieldName, $this->_initialValues)) {
            throw new \Exception($fieldName . ' field was not found');
        }
        $currentValues = $this->__toArray();

        return $currentValues[$fieldName] != $this->_initialValues[$fieldName];
    }

    public function getInitialValue($fieldName)
    {
        if (!array_key_exists($fieldName, $this->_initialValues)) {
            throw new \Exception($fieldName . ' field was not found');
        }

        return $this->_initialValues[$fieldName];
    }

    /**
     * @return ExternalCallFilterRelScheduleDTO
     */
    public static function createDTO()
    {
        return new ExternalCallFilterRelScheduleDTO();
    }

    /**
     * Factory method
     * @param DataTransferObjectInterface $dto
     * @return self
     */
    public static function fromDTO(DataTransferObjectInterface $dto)
    {
        /**
         * @var $dto ExternalCallFilterRelScheduleDTO
         */
        Assertion::isInstanceOf($dto, ExternalCallFilterRelScheduleDTO::class);

        $self = new static();

        return $self
            ->setFilter($dto->getFilter())
            ->setSchedule($dto->getSchedule())
        ;
    }

    /**
     * @param DataTransferObjectInterface $dto
     * @return self
     */
    public function updateFromDTO(DataTransferObjectInterface $dto)
    {
        /**
         * @var $dto ExternalCallFilterRelScheduleDTO
         */
        Assertion::isInstanceOf($dto, ExternalCallFilterRelScheduleDTO::class);

        $this
            ->setFilter($dto->getFilter())
            ->setSchedule($dto->getSchedule());


        return $this;
    }

    /**
     * @return ExternalCallFilterRelScheduleDTO
     */
    public function toDTO()
    {
        return self::createDTO()
            ->setFilterId($this->getFilter() ? $this->getFilter()->getId() : null)
            ->setScheduleId($this->getSchedule() ? $this->getSchedule()->getId() : null);
    }

    /**
     * @return array
     */
    protected function __toArray()
    {
        return [
            'filterId' => $this->getFilter() ? $this->getFilter()->getId() : null,
            'scheduleId' => $this->getSchedule() ? $this->getSchedule()->getId() : null
        ];
    }


    // @codeCoverageIgnoreStart

    /**
     * Set filter
     *
     * @param \Ivoz\Provider\Domain\Model\ExternalCallFilter\ExternalCallFilterInterface $filter
     *
     * @return self
     */
    public function setFilter(\Ivoz\Provider\Domain\Model\ExternalCallFilter\ExternalCallFilterInterface $filter = null)
    {
        $this->filter = $filter;

        return $this;
    }

    /**
     * Get filter
     *
     * @return \Ivoz\Provider\Domain\Model\ExternalCallFilter\ExternalCallFilterInterface
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
     * @return self
     */
    public function setSchedule(\Ivoz\Provider\Domain\Model\Schedule\ScheduleInterface $schedule)
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

