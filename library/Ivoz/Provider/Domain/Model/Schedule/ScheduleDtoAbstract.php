<?php

namespace Ivoz\Provider\Domain\Model\Schedule;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\Model\DtoNormalizer;

/**
 * @codeCoverageIgnore
 */
abstract class ScheduleDtoAbstract implements DataTransferObjectInterface
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var \DateTime
     */
    private $timeIn;

    /**
     * @var \DateTime
     */
    private $timeout;

    /**
     * @var boolean
     */
    private $monday = '0';

    /**
     * @var boolean
     */
    private $tuesday = '0';

    /**
     * @var boolean
     */
    private $wednesday = '0';

    /**
     * @var boolean
     */
    private $thursday = '0';

    /**
     * @var boolean
     */
    private $friday = '0';

    /**
     * @var boolean
     */
    private $saturday = '0';

    /**
     * @var boolean
     */
    private $sunday = '0';

    /**
     * @var integer
     */
    private $id;

    /**
     * @var \Ivoz\Provider\Domain\Model\Company\CompanyDto | null
     */
    private $company;


    use DtoNormalizer;

    public function __construct($id = null)
    {
        $this->setId($id);
    }

    /**
     * @inheritdoc
     */
    public static function getPropertyMap(string $context = '')
    {
        if ($context === self::CONTEXT_COLLECTION) {
            return ['id' => 'id'];
        }

        return [
            'name' => 'name',
            'timeIn' => 'timeIn',
            'timeout' => 'timeout',
            'monday' => 'monday',
            'tuesday' => 'tuesday',
            'wednesday' => 'wednesday',
            'thursday' => 'thursday',
            'friday' => 'friday',
            'saturday' => 'saturday',
            'sunday' => 'sunday',
            'id' => 'id',
            'companyId' => 'company'
        ];
    }

    /**
     * @return array
     */
    public function toArray($hideSensitiveData = false)
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
            'id' => $this->getId(),
            'company' => $this->getCompany()
        ];
    }

    /**
     * @param string $name
     *
     * @return static
     */
    public function setName($name = null)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param \DateTime $timeIn
     *
     * @return static
     */
    public function setTimeIn($timeIn = null)
    {
        $this->timeIn = $timeIn;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getTimeIn()
    {
        return $this->timeIn;
    }

    /**
     * @param \DateTime $timeout
     *
     * @return static
     */
    public function setTimeout($timeout = null)
    {
        $this->timeout = $timeout;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getTimeout()
    {
        return $this->timeout;
    }

    /**
     * @param boolean $monday
     *
     * @return static
     */
    public function setMonday($monday = null)
    {
        $this->monday = $monday;

        return $this;
    }

    /**
     * @return boolean
     */
    public function getMonday()
    {
        return $this->monday;
    }

    /**
     * @param boolean $tuesday
     *
     * @return static
     */
    public function setTuesday($tuesday = null)
    {
        $this->tuesday = $tuesday;

        return $this;
    }

    /**
     * @return boolean
     */
    public function getTuesday()
    {
        return $this->tuesday;
    }

    /**
     * @param boolean $wednesday
     *
     * @return static
     */
    public function setWednesday($wednesday = null)
    {
        $this->wednesday = $wednesday;

        return $this;
    }

    /**
     * @return boolean
     */
    public function getWednesday()
    {
        return $this->wednesday;
    }

    /**
     * @param boolean $thursday
     *
     * @return static
     */
    public function setThursday($thursday = null)
    {
        $this->thursday = $thursday;

        return $this;
    }

    /**
     * @return boolean
     */
    public function getThursday()
    {
        return $this->thursday;
    }

    /**
     * @param boolean $friday
     *
     * @return static
     */
    public function setFriday($friday = null)
    {
        $this->friday = $friday;

        return $this;
    }

    /**
     * @return boolean
     */
    public function getFriday()
    {
        return $this->friday;
    }

    /**
     * @param boolean $saturday
     *
     * @return static
     */
    public function setSaturday($saturday = null)
    {
        $this->saturday = $saturday;

        return $this;
    }

    /**
     * @return boolean
     */
    public function getSaturday()
    {
        return $this->saturday;
    }

    /**
     * @param boolean $sunday
     *
     * @return static
     */
    public function setSunday($sunday = null)
    {
        $this->sunday = $sunday;

        return $this;
    }

    /**
     * @return boolean
     */
    public function getSunday()
    {
        return $this->sunday;
    }

    /**
     * @param integer $id
     *
     * @return static
     */
    public function setId($id = null)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param \Ivoz\Provider\Domain\Model\Company\CompanyDto $company
     *
     * @return static
     */
    public function setCompany(\Ivoz\Provider\Domain\Model\Company\CompanyDto $company = null)
    {
        $this->company = $company;

        return $this;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\Company\CompanyDto
     */
    public function getCompany()
    {
        return $this->company;
    }

    /**
     * @param integer $id | null
     *
     * @return static
     */
    public function setCompanyId($id)
    {
        $value = !is_null($id)
            ? new \Ivoz\Provider\Domain\Model\Company\CompanyDto($id)
            : null;

        return $this->setCompany($value);
    }

    /**
     * @return integer | null
     */
    public function getCompanyId()
    {
        if ($dto = $this->getCompany()) {
            return $dto->getId();
        }

        return null;
    }
}
