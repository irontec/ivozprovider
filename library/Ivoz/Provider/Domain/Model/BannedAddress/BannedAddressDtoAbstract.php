<?php

namespace Ivoz\Provider\Domain\Model\BannedAddress;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\Model\DtoNormalizer;
use Ivoz\Provider\Domain\Model\Brand\BrandDto;
use Ivoz\Provider\Domain\Model\Company\CompanyDto;

/**
* BannedAddressDtoAbstract
* @codeCoverageIgnore
*/
abstract class BannedAddressDtoAbstract implements DataTransferObjectInterface
{
    use DtoNormalizer;

    /**
     * @var string | null
     */
    private $ip;

    /**
     * @var string | null
     */
    private $blocker;

    /**
     * @var string | null
     */
    private $aor;

    /**
     * @var string | null
     */
    private $description;

    /**
     * @var \DateTimeInterface | null
     */
    private $lastTimeBanned;

    /**
     * @var int
     */
    private $id;

    /**
     * @var BrandDto | null
     */
    private $brand;

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
            'ip' => 'ip',
            'blocker' => 'blocker',
            'aor' => 'aor',
            'description' => 'description',
            'lastTimeBanned' => 'lastTimeBanned',
            'id' => 'id',
            'brandId' => 'brand',
            'companyId' => 'company'
        ];
    }

    /**
    * @return array
    */
    public function toArray($hideSensitiveData = false)
    {
        $response = [
            'ip' => $this->getIp(),
            'blocker' => $this->getBlocker(),
            'aor' => $this->getAor(),
            'description' => $this->getDescription(),
            'lastTimeBanned' => $this->getLastTimeBanned(),
            'id' => $this->getId(),
            'brand' => $this->getBrand(),
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
     * @param string $ip | null
     *
     * @return static
     */
    public function setIp(?string $ip = null): self
    {
        $this->ip = $ip;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getIp(): ?string
    {
        return $this->ip;
    }

    /**
     * @param string $blocker | null
     *
     * @return static
     */
    public function setBlocker(?string $blocker = null): self
    {
        $this->blocker = $blocker;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getBlocker(): ?string
    {
        return $this->blocker;
    }

    /**
     * @param string $aor | null
     *
     * @return static
     */
    public function setAor(?string $aor = null): self
    {
        $this->aor = $aor;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getAor(): ?string
    {
        return $this->aor;
    }

    /**
     * @param string $description | null
     *
     * @return static
     */
    public function setDescription(?string $description = null): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @param \DateTimeInterface $lastTimeBanned | null
     *
     * @return static
     */
    public function setLastTimeBanned($lastTimeBanned = null): self
    {
        $this->lastTimeBanned = $lastTimeBanned;

        return $this;
    }

    /**
     * @return \DateTimeInterface | null
     */
    public function getLastTimeBanned()
    {
        return $this->lastTimeBanned;
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
     * @param BrandDto | null
     *
     * @return static
     */
    public function setBrand(?BrandDto $brand = null): self
    {
        $this->brand = $brand;

        return $this;
    }

    /**
     * @return BrandDto | null
     */
    public function getBrand(): ?BrandDto
    {
        return $this->brand;
    }

    /**
     * @return static
     */
    public function setBrandId($id): self
    {
        $value = !is_null($id)
            ? new BrandDto($id)
            : null;

        return $this->setBrand($value);
    }

    /**
     * @return mixed | null
     */
    public function getBrandId()
    {
        if ($dto = $this->getBrand()) {
            return $dto->getId();
        }

        return null;
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
