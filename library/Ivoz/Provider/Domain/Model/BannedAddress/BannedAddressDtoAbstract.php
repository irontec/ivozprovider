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
     * @var string|null
     */
    private $ip;

    /**
     * @var string|null
     */
    private $blocker;

    /**
     * @var string|null
     */
    private $aor;

    /**
     * @var string|null
     */
    private $description;

    /**
     * @var \DateTime|string|null
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

    public function setIp(?string $ip): static
    {
        $this->ip = $ip;

        return $this;
    }

    public function getIp(): ?string
    {
        return $this->ip;
    }

    public function setBlocker(?string $blocker): static
    {
        $this->blocker = $blocker;

        return $this;
    }

    public function getBlocker(): ?string
    {
        return $this->blocker;
    }

    public function setAor(?string $aor): static
    {
        $this->aor = $aor;

        return $this;
    }

    public function getAor(): ?string
    {
        return $this->aor;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setLastTimeBanned(null|\DateTime|string $lastTimeBanned): static
    {
        $this->lastTimeBanned = $lastTimeBanned;

        return $this;
    }

    public function getLastTimeBanned(): \DateTime|string|null
    {
        return $this->lastTimeBanned;
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

    public function setBrand(?BrandDto $brand): static
    {
        $this->brand = $brand;

        return $this;
    }

    public function getBrand(): ?BrandDto
    {
        return $this->brand;
    }

    public function setBrandId($id): static
    {
        $value = !is_null($id)
            ? new BrandDto($id)
            : null;

        return $this->setBrand($value);
    }

    public function getBrandId()
    {
        if ($dto = $this->getBrand()) {
            return $dto->getId();
        }

        return null;
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
