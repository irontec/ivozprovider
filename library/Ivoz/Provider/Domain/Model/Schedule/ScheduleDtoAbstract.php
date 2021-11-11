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
     * @var \DateTimeInterface|string
     */
    private $timeIn;

    /**
     * @var \DateTimeInterface|string
     */
    private $timeout;

    /**
     * @var bool|null
     */
    private $monday = false;

    /**
     * @var bool|null
     */
    private $tuesday = false;

    /**
     * @var bool|null
     */
    private $wednesday = false;

    /**
     * @var bool|null
     */
    private $thursday = false;

    /**
     * @var bool|null
     */
    private $friday = false;

    /**
     * @var bool|null
     */
    private $saturday = false;

    /**
     * @var bool|null
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
    public static function getPropertyMap(string $context = '', string $role = null): array
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
     * @return array<string, mixed>
     */
    public function toArray(bool $hideSensitiveData = false): array
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

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setTimeIn(\DateTimeInterface|string $timeIn): static
    {
        $this->timeIn = $timeIn;

        return $this;
    }

    public function getTimeIn(): \DateTimeInterface|string|null
    {
        return $this->timeIn;
    }

    public function setTimeout(\DateTimeInterface|string $timeout): static
    {
        $this->timeout = $timeout;

        return $this;
    }

    public function getTimeout(): \DateTimeInterface|string|null
    {
        return $this->timeout;
    }

    public function setMonday(?bool $monday): static
    {
        $this->monday = $monday;

        return $this;
    }

    public function getMonday(): ?bool
    {
        return $this->monday;
    }

    public function setTuesday(?bool $tuesday): static
    {
        $this->tuesday = $tuesday;

        return $this;
    }

    public function getTuesday(): ?bool
    {
        return $this->tuesday;
    }

    public function setWednesday(?bool $wednesday): static
    {
        $this->wednesday = $wednesday;

        return $this;
    }

    public function getWednesday(): ?bool
    {
        return $this->wednesday;
    }

    public function setThursday(?bool $thursday): static
    {
        $this->thursday = $thursday;

        return $this;
    }

    public function getThursday(): ?bool
    {
        return $this->thursday;
    }

    public function setFriday(?bool $friday): static
    {
        $this->friday = $friday;

        return $this;
    }

    public function getFriday(): ?bool
    {
        return $this->friday;
    }

    public function setSaturday(?bool $saturday): static
    {
        $this->saturday = $saturday;

        return $this;
    }

    public function getSaturday(): ?bool
    {
        return $this->saturday;
    }

    public function setSunday(?bool $sunday): static
    {
        $this->sunday = $sunday;

        return $this;
    }

    public function getSunday(): ?bool
    {
        return $this->sunday;
    }

    public function setId($id): static
    {
        $this->id = $id;

        return $this;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setCompany(?CompanyDto $company): static
    {
        $this->company = $company;

        return $this;
    }

    public function getCompany(): ?CompanyDto
    {
        return $this->company;
    }

    public function setCompanyId($id): static
    {
        $value = !is_null($id)
            ? new CompanyDto($id)
            : null;

        return $this->setCompany($value);
    }

    public function getCompanyId()
    {
        if ($dto = $this->getCompany()) {
            return $dto->getId();
        }

        return null;
    }
}
