<?php

namespace Ivoz\Provider\Domain\Model\Schedule;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;

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


    use ChangelogTrait;

    /**
     * Constructor
     */
    protected function __construct($name, $timeIn, $timeout)
    {
        $this->setName($name);
        $this->setTimeIn($timeIn);
        $this->setTimeout($timeout);
    }

    abstract public function getId();

    public function __toString()
    {
        return sprintf("%s#%s",
            "Schedule",
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
     * @return ScheduleDto
     */
    public static function createDto($id = null)
    {
        return new ScheduleDto($id);
    }

    /**
     * @param EntityInterface|null $entity
     * @param int $depth
     * @return ScheduleDto|null
     */
    public static function entityToDto(EntityInterface $entity = null, $depth = 0)
    {
        if (!$entity) {
            return null;
        }

        Assertion::isInstanceOf($entity, ScheduleInterface::class);

        if ($depth < 1) {
            return static::createDto($entity->getId());
        }

        if ($entity instanceof \Doctrine\ORM\Proxy\Proxy && !$entity->__isInitialized()) {
            return static::createDto($entity->getId());
        }

        return $entity->toDto($depth-1);
    }

    /**
     * Factory method
     * @param DataTransferObjectInterface $dto
     * @return self
     */
    public static function fromDto(DataTransferObjectInterface $dto)
    {
        /**
         * @var $dto ScheduleDto
         */
        Assertion::isInstanceOf($dto, ScheduleDto::class);

        $self = new static(
            $dto->getName(),
            $dto->getTimeIn(),
            $dto->getTimeout());

        $self
            ->setMonday($dto->getMonday())
            ->setTuesday($dto->getTuesday())
            ->setWednesday($dto->getWednesday())
            ->setThursday($dto->getThursday())
            ->setFriday($dto->getFriday())
            ->setSaturday($dto->getSaturday())
            ->setSunday($dto->getSunday())
            ->setCompany($dto->getCompany())
        ;

        $self->sanitizeValues();
        $self->initChangelog();

        return $self;
    }

    /**
     * @param DataTransferObjectInterface $dto
     * @return self
     */
    public function updateFromDto(DataTransferObjectInterface $dto)
    {
        /**
         * @var $dto ScheduleDto
         */
        Assertion::isInstanceOf($dto, ScheduleDto::class);

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



        $this->sanitizeValues();
        return $this;
    }

    /**
     * @param int $depth
     * @return ScheduleDto
     */
    public function toDto($depth = 0)
    {
        return self::createDto()
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
            ->setCompany(\Ivoz\Provider\Domain\Model\Company\Company::entityToDto($this->getCompany(), $depth));
    }

    /**
     * @return array
     */
    protected function __toArray()
    {
        return [
            'name' => self::getName(),
            'timeIn' => self::getTimeIn(),
            'timeout' => self::getTimeout(),
            'monday' => self::getMonday(),
            'tuesday' => self::getTuesday(),
            'wednesday' => self::getWednesday(),
            'thursday' => self::getThursday(),
            'friday' => self::getFriday(),
            'saturday' => self::getSaturday(),
            'sunday' => self::getSunday(),
            'companyId' => self::getCompany() ? self::getCompany()->getId() : null
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
        Assertion::notNull($name, 'name value "%s" is null, but non null value was expected.');
        Assertion::maxLength($name, 50, 'name value "%s" is too long, it should have no more than %d characters, but has %d characters.');

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
        Assertion::notNull($timeIn, 'timeIn value "%s" is null, but non null value was expected.');

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
        Assertion::notNull($timeout, 'timeout value "%s" is null, but non null value was expected.');

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
            Assertion::between(intval($monday), 0, 1, 'monday provided "%s" is not a valid boolean value.');
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
            Assertion::between(intval($tuesday), 0, 1, 'tuesday provided "%s" is not a valid boolean value.');
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
            Assertion::between(intval($wednesday), 0, 1, 'wednesday provided "%s" is not a valid boolean value.');
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
            Assertion::between(intval($thursday), 0, 1, 'thursday provided "%s" is not a valid boolean value.');
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
            Assertion::between(intval($friday), 0, 1, 'friday provided "%s" is not a valid boolean value.');
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
            Assertion::between(intval($saturday), 0, 1, 'saturday provided "%s" is not a valid boolean value.');
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
            Assertion::between(intval($sunday), 0, 1, 'sunday provided "%s" is not a valid boolean value.');
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

