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
    private $ip = null;

    /**
     * @var string|null
     */
    private $blocker = null;

    /**
     * @var string|null
     */
    private $aor = null;

    /**
     * @var string|null
     */
    private $description = null;

    /**
     * @var \DateTimeInterface|string|null
     */
    private $lastTimeBanned = null;

    /**
     * @var int|null
     */
    private $id = null;

    /**
     * @var BrandDto | null
     */
    private $brand = null;

    /**
     * @var CompanyDto | null
     */
    private $company = null;

    /**
     * @param string|int|null $id
     */
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
     * @return array<string, mixed>
     */
    public function toArray(bool $hideSensitiveData = false): array
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

    public function setLastTimeBanned(null|\DateTimeInterface|string $lastTimeBanned): static
    {
        $this->lastTimeBanned = $lastTimeBanned;

        return $this;
    }

    public function getLastTimeBanned(): \DateTimeInterface|string|null
    {
        return $this->lastTimeBanned;
    }

    public function setId($id): static
    {
        $this->id = $id;

        return $this;
    }

    public function getId(): ?int
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
