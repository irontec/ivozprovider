<?php

namespace Ivoz\Provider\Domain\Model\Schedule;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Core\Application\CollectionTransformerInterface;

/**
 * @codeCoverageIgnore
 */
class ScheduleDTO implements DataTransferObjectInterface
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
     * @var mixed
     */
    private $companyId;

    /**
     * @var mixed
     */
    private $company;

    /**
     * @return array
     */
    public function __toArray()
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
            'companyId' => $this->getCompanyId()
        ];
    }

    /**
     * {@inheritDoc}
     */
    public function transformForeignKeys(ForeignKeyTransformerInterface $transformer)
    {
        $this->company = $transformer->transform('Ivoz\\Provider\\Domain\\Model\\Company\\Company', $this->getCompanyId());
    }

    /**
     * {@inheritDoc}
     */
    public function transformCollections(CollectionTransformerInterface $transformer)
    {

    }

    /**
     * @param string $name
     *
     * @return ScheduleDTO
     */
    public function setName($name)
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
     * @return ScheduleDTO
     */
    public function setTimeIn($timeIn)
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
     * @return ScheduleDTO
     */
    public function setTimeout($timeout)
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
     * @return ScheduleDTO
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
     * @return ScheduleDTO
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
     * @return ScheduleDTO
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
     * @return ScheduleDTO
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
     * @return ScheduleDTO
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
     * @return ScheduleDTO
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
     * @return ScheduleDTO
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
     * @return ScheduleDTO
     */
    public function setId($id)
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
     * @param integer $companyId
     *
     * @return ScheduleDTO
     */
    public function setCompanyId($companyId)
    {
        $this->companyId = $companyId;

        return $this;
    }

    /**
     * @return integer
     */
    public function getCompanyId()
    {
        return $this->companyId;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\Company\Company
     */
    public function getCompany()
    {
        return $this->company;
    }
}


