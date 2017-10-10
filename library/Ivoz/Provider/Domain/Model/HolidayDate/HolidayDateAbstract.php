<?php

namespace Ivoz\Provider\Domain\Model\HolidayDate;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;

/**
 * HolidayDateAbstract
 * @codeCoverageIgnore
 */
abstract class HolidayDateAbstract
{
    /**
     * @var string
     */
    protected $name;

    /**
     * @var \DateTime
     */
    protected $eventDate;

    /**
     * @var \Ivoz\Provider\Domain\Model\Calendar\CalendarInterface
     */
    protected $calendar;

    /**
     * @var \Ivoz\Provider\Domain\Model\Locution\LocutionInterface
     */
    protected $locution;


    /**
     * Changelog tracking purpose
     * @var array
     */
    protected $_initialValues = [];

    /**
     * Constructor
     */
    public function __construct($name, $eventDate)
    {
        $this->setName($name);
        $this->setEventDate($eventDate);

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
     * @return HolidayDateDTO
     */
    public static function createDTO()
    {
        return new HolidayDateDTO();
    }

    /**
     * Factory method
     * @param DataTransferObjectInterface $dto
     * @return self
     */
    public static function fromDTO(DataTransferObjectInterface $dto)
    {
        /**
         * @var $dto HolidayDateDTO
         */
        Assertion::isInstanceOf($dto, HolidayDateDTO::class);

        $self = new static(
            $dto->getName(),
            $dto->getEventDate());

        return $self
            ->setCalendar($dto->getCalendar())
            ->setLocution($dto->getLocution())
        ;
    }

    /**
     * @param DataTransferObjectInterface $dto
     * @return self
     */
    public function updateFromDTO(DataTransferObjectInterface $dto)
    {
        /**
         * @var $dto HolidayDateDTO
         */
        Assertion::isInstanceOf($dto, HolidayDateDTO::class);

        $this
            ->setName($dto->getName())
            ->setEventDate($dto->getEventDate())
            ->setCalendar($dto->getCalendar())
            ->setLocution($dto->getLocution());


        return $this;
    }

    /**
     * @return HolidayDateDTO
     */
    public function toDTO()
    {
        return self::createDTO()
            ->setName($this->getName())
            ->setEventDate($this->getEventDate())
            ->setCalendarId($this->getCalendar() ? $this->getCalendar()->getId() : null)
            ->setLocutionId($this->getLocution() ? $this->getLocution()->getId() : null);
    }

    /**
     * @return array
     */
    protected function __toArray()
    {
        return [
            'name' => self::getName(),
            'eventDate' => self::getEventDate(),
            'calendarId' => self::getCalendar() ? self::getCalendar()->getId() : null,
            'locutionId' => self::getLocution() ? self::getLocution()->getId() : null
        ];
    }


    // @codeCoverageIgnoreStart

    /**
     * Set name
     *
     * @param string $name
     *
     * @return self
     */
    public function setName($name)
    {
        Assertion::notNull($name);
        Assertion::maxLength($name, 50);

        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set eventDate
     *
     * @param \DateTime $eventDate
     *
     * @return self
     */
    public function setEventDate($eventDate)
    {
        Assertion::notNull($eventDate);

        $this->eventDate = $eventDate;

        return $this;
    }

    /**
     * Get eventDate
     *
     * @return \DateTime
     */
    public function getEventDate()
    {
        return $this->eventDate;
    }

    /**
     * Set calendar
     *
     * @param \Ivoz\Provider\Domain\Model\Calendar\CalendarInterface $calendar
     *
     * @return self
     */
    public function setCalendar(\Ivoz\Provider\Domain\Model\Calendar\CalendarInterface $calendar = null)
    {
        $this->calendar = $calendar;

        return $this;
    }

    /**
     * Get calendar
     *
     * @return \Ivoz\Provider\Domain\Model\Calendar\CalendarInterface
     */
    public function getCalendar()
    {
        return $this->calendar;
    }

    /**
     * Set locution
     *
     * @param \Ivoz\Provider\Domain\Model\Locution\LocutionInterface $locution
     *
     * @return self
     */
    public function setLocution(\Ivoz\Provider\Domain\Model\Locution\LocutionInterface $locution = null)
    {
        $this->locution = $locution;

        return $this;
    }

    /**
     * Get locution
     *
     * @return \Ivoz\Provider\Domain\Model\Locution\LocutionInterface
     */
    public function getLocution()
    {
        return $this->locution;
    }



    // @codeCoverageIgnoreEnd
}

