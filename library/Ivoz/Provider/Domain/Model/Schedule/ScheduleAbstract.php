<?php

namespace Ivoz\Provider\Domain\Model\Schedule;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;

/**
 * ScheduleAbstract
 * @codeCoverageIgnore
 */
abstract class ScheduleAbstract
{
    /**
     * @var string
     */
    protected $name;

    /**
     * @var \DateTime
     */
    protected $timeIn;

    /**
     * @var \DateTime
     */
    protected $timeout;

    /**
     * @var boolean
     */
    protected $monday = '0';

    /**
     * @var boolean
     */
    protected $tuesday = '0';

    /**
     * @var boolean
     */
    protected $wednesday = '0';

    /**
     * @var boolean
     */
    protected $thursday = '0';

    /**
     * @var boolean
     */
    protected $friday = '0';

    /**
     * @var boolean
     */
    protected $saturday = '0';

    /**
     * @var boolean
     */
    protected $sunday = '0';

    /**
     * @var \Ivoz\Provider\Domain\Model\Company\CompanyInterface
     */
    protected $company;


    /**
     * Changelog tracking purpose
     * @var array
     */
    protected $_initialValues = [];

    /**
     * Constructor
     */
    public function __construct($name, $timeIn, $timeout)
    {
        $this->setName($name);
        $this->setTimeIn($timeIn);
        $this->setTimeout($timeout);
    }

    /**
     * @param string $fieldName
     * @return mixed
     * @throws \Exception
     */
    public function initChangelog()
    {
        $this->_initialValues = $this->__toArray();
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
     * @return ScheduleDTO
     */
    public static function createDTO()
    {
        return new ScheduleDTO();
    }

    /**
     * Factory method
     * @param DataTransferObjectInterface $dto
     * @return self
     */
    public static function fromDTO(DataTransferObjectInterface $dto)
    {
        /**
         * @var $dto ScheduleDTO
         */
        Assertion::isInstanceOf($dto, ScheduleDTO::class);

        $self = new static(
            $dto->getName(),
            $dto->getTimeIn(),
            $dto->getTimeout());

        return $self
            ->setMonday($dto->getMonday())
            ->setTuesday($dto->getTuesday())
            ->setWednesday($dto->getWednesday())
            ->setThursday($dto->getThursday())
            ->setFriday($dto->getFriday())
            ->setSaturday($dto->getSaturday())
            ->setSunday($dto->getSunday())
            ->setCompany($dto->getCompany())
        ;
    }

    /**
     * @param DataTransferObjectInterface $dto
     * @return self
     */
    public function updateFromDTO(DataTransferObjectInterface $dto)
    {
        /**
         * @var $dto ScheduleDTO
         */
        Assertion::isInstanceOf($dto, ScheduleDTO::class);

        $this
            ->setName($dto->getName())
            ->setTimeIn($dto->getTimeIn())
            ->setTimeout($dto->getTimeout())
            ->setMonday($dto->getMonday())
            ->setTuesday($dto->getTuesday())
            ->setWednesday($dto->getWednesday())
            ->setThursday($dto->getThursday())
            ->setFriday($dto->getFriday())
            ->setSaturday($dto->getSaturday())
            ->setSunday($dto->getSunday())
            ->setCompany($dto->getCompany());


        return $this;
    }

    /**
     * @return ScheduleDTO
     */
    public function toDTO()
    {
        return self::createDTO()
            ->setName($this->getName())
            ->setTimeIn($this->getTimeIn())
            ->setTimeout($this->getTimeout())
            ->setMonday($this->getMonday())
            ->setTuesday($this->getTuesday())
            ->setWednesday($this->getWednesday())
            ->setThursday($this->getThursday())
            ->setFriday($this->getFriday())
            ->setSaturday($this->getSaturday())
            ->setSunday($this->getSunday())
            ->setCompanyId($this->getCompany() ? $this->getCompany()->getId() : null);
    }

    /**
     * @return array
     */
    protected function __toArray()
    {
        return [
            'name' => $this->getName(),
            'timeIn' => $this->getTimeIn(),
            'timeout' => $this->getTimeout(),
            'monday' => $this->getMonday(),
            'tuesday' => $this->getTuesday(),
            'wednesday' => $this->getWednesday(),
            'thursday' => $this->getThursday(),
            'friday' => $this->getFriday(),
            'saturday' => $this->getSaturday(),
            'sunday' => $this->getSunday(),
            'companyId' => $this->getCompany() ? $this->getCompany()->getId() : null
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
     * Set timeIn
     *
     * @param \DateTime $timeIn
     *
     * @return self
     */
    public function setTimeIn($timeIn)
    {
        Assertion::notNull($timeIn);

        $this->timeIn = $timeIn;

        return $this;
    }

    /**
     * Get timeIn
     *
     * @return \DateTime
     */
    public function getTimeIn()
    {
        return $this->timeIn;
    }

    /**
     * Set timeout
     *
     * @param \DateTime $timeout
     *
     * @return self
     */
    public function setTimeout($timeout)
    {
        Assertion::notNull($timeout);

        $this->timeout = $timeout;

        return $this;
    }

    /**
     * Get timeout
     *
     * @return \DateTime
     */
    public function getTimeout()
    {
        return $this->timeout;
    }

    /**
     * Set monday
     *
     * @param boolean $monday
     *
     * @return self
     */
    public function setMonday($monday = null)
    {
        if (!is_null($monday)) {
            Assertion::between(intval($monday), 0, 1);
        }

        $this->monday = $monday;

        return $this;
    }

    /**
     * Get monday
     *
     * @return boolean
     */
    public function getMonday()
    {
        return $this->monday;
    }

    /**
     * Set tuesday
     *
     * @param boolean $tuesday
     *
     * @return self
     */
    public function setTuesday($tuesday = null)
    {
        if (!is_null($tuesday)) {
            Assertion::between(intval($tuesday), 0, 1);
        }

        $this->tuesday = $tuesday;

        return $this;
    }

    /**
     * Get tuesday
     *
     * @return boolean
     */
    public function getTuesday()
    {
        return $this->tuesday;
    }

    /**
     * Set wednesday
     *
     * @param boolean $wednesday
     *
     * @return self
     */
    public function setWednesday($wednesday = null)
    {
        if (!is_null($wednesday)) {
            Assertion::between(intval($wednesday), 0, 1);
        }

        $this->wednesday = $wednesday;

        return $this;
    }

    /**
     * Get wednesday
     *
     * @return boolean
     */
    public function getWednesday()
    {
        return $this->wednesday;
    }

    /**
     * Set thursday
     *
     * @param boolean $thursday
     *
     * @return self
     */
    public function setThursday($thursday = null)
    {
        if (!is_null($thursday)) {
            Assertion::between(intval($thursday), 0, 1);
        }

        $this->thursday = $thursday;

        return $this;
    }

    /**
     * Get thursday
     *
     * @return boolean
     */
    public function getThursday()
    {
        return $this->thursday;
    }

    /**
     * Set friday
     *
     * @param boolean $friday
     *
     * @return self
     */
    public function setFriday($friday = null)
    {
        if (!is_null($friday)) {
            Assertion::between(intval($friday), 0, 1);
        }

        $this->friday = $friday;

        return $this;
    }

    /**
     * Get friday
     *
     * @return boolean
     */
    public function getFriday()
    {
        return $this->friday;
    }

    /**
     * Set saturday
     *
     * @param boolean $saturday
     *
     * @return self
     */
    public function setSaturday($saturday = null)
    {
        if (!is_null($saturday)) {
            Assertion::between(intval($saturday), 0, 1);
        }

        $this->saturday = $saturday;

        return $this;
    }

    /**
     * Get saturday
     *
     * @return boolean
     */
    public function getSaturday()
    {
        return $this->saturday;
    }

    /**
     * Set sunday
     *
     * @param boolean $sunday
     *
     * @return self
     */
    public function setSunday($sunday = null)
    {
        if (!is_null($sunday)) {
            Assertion::between(intval($sunday), 0, 1);
        }

        $this->sunday = $sunday;

        return $this;
    }

    /**
     * Get sunday
     *
     * @return boolean
     */
    public function getSunday()
    {
        return $this->sunday;
    }

    /**
     * Set company
     *
     * @param \Ivoz\Provider\Domain\Model\Company\CompanyInterface $company
     *
     * @return self
     */
    public function setCompany(\Ivoz\Provider\Domain\Model\Company\CompanyInterface $company)
    {
        $this->company = $company;

        return $this;
    }

    /**
     * Get company
     *
     * @return \Ivoz\Provider\Domain\Model\Company\CompanyInterface
     */
    public function getCompany()
    {
        return $this->company;
    }



    // @codeCoverageIgnoreEnd
}

