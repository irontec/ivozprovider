<?php

namespace Ivoz\Provider\Domain\Model\Schedule;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\Model\DtoNormalizer;
use Ivoz\Provider\Domain\Model\Company\CompanyDto;

/**
* ScheduleDtoAbstract
* @codeCoverageIgnore
*/
abstract class ScheduleDtoAbstract implements DataTransferObjectInterface
{
    use DtoNormalizer;

    /**
     * @var string
     */
    private $name;

    /**
     * @var \DateTimeInterface
     */
    private $timeIn;

    /**
     * @var \DateTimeInterface
     */
    private $timeout;

    /**
     * @var bool | null
     */
    private $monday = false;

    /**
     * @var bool | null
     */
    private $tuesday = false;

    /**
     * @var bool | null
     */
    private $wednesday = false;

    /**
     * @var bool | null
     */
    private $thursday = false;

    /**
     * @var bool | null
     */
    private $friday = false;

    /**
     * @var bool | null
     */
    private $saturday = false;

    /**
     * @var bool | null
     */
    private $sunday = false;

    /**
     * @var int
     */
    private $id;

    /**
     * @var CompanyDto | null
     */
    private $company;

    public function __construct($id = null)
    {
        $this->setId($id);
    }

    /**
    * @inheritdoc
    */
    public static function getPropertyMap(string $context = '', string $role = null)
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
        $response = [
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

        if (!$hideSensitiveData) {
            return $response;
        }

        foreach ($this->sensitiveFields as $sensitiveField) {
            if (!array_key_exists($sensitiveField, $response)) {
                throw new \Exception($sensitiveField . ' field was not found');
            }
            $response[$sensitiveField] = '*****';
        }

        return $response;
    }

    /**
     * @param string $name | null
     *
     * @return static
     */
    public function setName(?string $name = null): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param \DateTimeInterface $timeIn | null
     *
     * @return static
     */
    public function setTimeIn($timeIn = null): self
    {
        $this->timeIn = $timeIn;

        return $this;
    }

    /**
     * @return \DateTimeInterface | null
     */
    public function getTimeIn()
    {
        return $this->timeIn;
    }

    /**
     * @param \DateTimeInterface $timeout | null
     *
     * @return static
     */
    public function setTimeout($timeout = null): self
    {
        $this->timeout = $timeout;

        return $this;
    }

    /**
     * @return \DateTimeInterface | null
     */
    public function getTimeout()
    {
        return $this->timeout;
    }

    /**
     * @param bool $monday | null
     *
     * @return static
     */
    public function setMonday(?bool $monday = null): self
    {
        $this->monday = $monday;

        return $this;
    }

    /**
     * @return bool | null
     */
    public function getMonday(): ?bool
    {
        return $this->monday;
    }

    /**
     * @param bool $tuesday | null
     *
     * @return static
     */
    public function setTuesday(?bool $tuesday = null): self
    {
        $this->tuesday = $tuesday;

        return $this;
    }

    /**
     * @return bool | null
     */
    public function getTuesday(): ?bool
    {
        return $this->tuesday;
    }

    /**
     * @param bool $wednesday | null
     *
     * @return static
     */
    public function setWednesday(?bool $wednesday = null): self
    {
        $this->wednesday = $wednesday;

        return $this;
    }

    /**
     * @return bool | null
     */
    public function getWednesday(): ?bool
    {
        return $this->wednesday;
    }

    /**
     * @param bool $thursday | null
     *
     * @return static
     */
    public function setThursday(?bool $thursday = null): self
    {
        $this->thursday = $thursday;

        return $this;
    }

    /**
     * @return bool | null
     */
    public function getThursday(): ?bool
    {
        return $this->thursday;
    }

    /**
     * @param bool $friday | null
     *
     * @return static
     */
    public function setFriday(?bool $friday = null): self
    {
        $this->friday = $friday;

        return $this;
    }

    /**
     * @return bool | null
     */
    public function getFriday(): ?bool
    {
        return $this->friday;
    }

    /**
     * @param bool $saturday | null
     *
     * @return static
     */
    public function setSaturday(?bool $saturday = null): self
    {
        $this->saturday = $saturday;

        return $this;
    }

    /**
     * @return bool | null
     */
    public function getSaturday(): ?bool
    {
        return $this->saturday;
    }

    /**
     * @param bool $sunday | null
     *
     * @return static
     */
    public function setSunday(?bool $sunday = null): self
    {
        $this->sunday = $sunday;

        return $this;
    }

    /**
     * @return bool | null
     */
    public function getSunday(): ?bool
    {
        return $this->sunday;
    }

    /**
     * @param int $id | null
     *
     * @return static
     */
    public function setId(?int $id = null): self
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return int | null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param CompanyDto | null
     *
     * @return static
     */
    public function setCompany(?CompanyDto $company = null): self
    {
        $this->company = $company;

        return $this;
    }

    /**
     * @return CompanyDto | null
     */
    public function getCompany(): ?CompanyDto
    {
        return $this->company;
    }

    /**
     * @return static
     */
    public function setCompanyId($id): self
    {
        $value = !is_null($id)
            ? new CompanyDto($id)
            : null;

        return $this->setCompany($value);
    }

    /**
     * @return mixed | null
     */
    public function getCompanyId()
    {
        if ($dto = $this->getCompany()) {
            return $dto->getId();
        }

        return null;
    }

}
