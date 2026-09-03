<?php

namespace Ivoz\Provider\Domain\Model\ChannelUsage;

use Ivoz\Core\Domain\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\DtoNormalizer;
use Ivoz\Provider\Domain\Model\Brand\BrandDto;
use Ivoz\Provider\Domain\Model\Company\CompanyDto;

/**
* ChannelUsageDtoAbstract
* @codeCoverageIgnore
*/
abstract class ChannelUsageDtoAbstract implements DataTransferObjectInterface
{
    use DtoNormalizer;

    /**
     * @var \DateTimeInterface|string|null
     */
    private $timestamp = null;

    /**
     * @var int|null
     */
    private $peak = null;

    /**
     * @var float|null
     */
    private $avgUsage = null;

    /**
     * @var int|null
     */
    private $closingUsage = null;

    /**
     * @var int|null
     */
    private $maxCallsCompany = null;

    /**
     * @var int|null
     */
    private $maxCallsBrand = null;

    /**
     * @var int|null
     */
    private $blockedByCompanyLimit = 0;

    /**
     * @var int|null
     */
    private $blockedByBrandLimit = 0;

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

    public function __construct(?int $id = null)
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
            'timestamp' => 'timestamp',
            'peak' => 'peak',
            'avgUsage' => 'avgUsage',
            'closingUsage' => 'closingUsage',
            'maxCallsCompany' => 'maxCallsCompany',
            'maxCallsBrand' => 'maxCallsBrand',
            'blockedByCompanyLimit' => 'blockedByCompanyLimit',
            'blockedByBrandLimit' => 'blockedByBrandLimit',
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
            'timestamp' => $this->getTimestamp(),
            'peak' => $this->getPeak(),
            'avgUsage' => $this->getAvgUsage(),
            'closingUsage' => $this->getClosingUsage(),
            'maxCallsCompany' => $this->getMaxCallsCompany(),
            'maxCallsBrand' => $this->getMaxCallsBrand(),
            'blockedByCompanyLimit' => $this->getBlockedByCompanyLimit(),
            'blockedByBrandLimit' => $this->getBlockedByBrandLimit(),
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

    public function setTimestamp(\DateTimeInterface|string $timestamp): static
    {
        $this->timestamp = $timestamp;

        return $this;
    }

    public function getTimestamp(): \DateTimeInterface|string|null
    {
        return $this->timestamp;
    }

    public function setPeak(int $peak): static
    {
        $this->peak = $peak;

        return $this;
    }

    public function getPeak(): ?int
    {
        return $this->peak;
    }

    public function setAvgUsage(float $avgUsage): static
    {
        $this->avgUsage = $avgUsage;

        return $this;
    }

    public function getAvgUsage(): ?float
    {
        return $this->avgUsage;
    }

    public function setClosingUsage(int $closingUsage): static
    {
        $this->closingUsage = $closingUsage;

        return $this;
    }

    public function getClosingUsage(): ?int
    {
        return $this->closingUsage;
    }

    public function setMaxCallsCompany(int $maxCallsCompany): static
    {
        $this->maxCallsCompany = $maxCallsCompany;

        return $this;
    }

    public function getMaxCallsCompany(): ?int
    {
        return $this->maxCallsCompany;
    }

    public function setMaxCallsBrand(int $maxCallsBrand): static
    {
        $this->maxCallsBrand = $maxCallsBrand;

        return $this;
    }

    public function getMaxCallsBrand(): ?int
    {
        return $this->maxCallsBrand;
    }

    public function setBlockedByCompanyLimit(int $blockedByCompanyLimit): static
    {
        $this->blockedByCompanyLimit = $blockedByCompanyLimit;

        return $this;
    }

    public function getBlockedByCompanyLimit(): ?int
    {
        return $this->blockedByCompanyLimit;
    }

    public function setBlockedByBrandLimit(int $blockedByBrandLimit): static
    {
        $this->blockedByBrandLimit = $blockedByBrandLimit;

        return $this;
    }

    public function getBlockedByBrandLimit(): ?int
    {
        return $this->blockedByBrandLimit;
    }

    /**
     * @param int|null $id
     */
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

    public function setBrandId(?int $id): static
    {
        $value = !is_null($id)
            ? new BrandDto($id)
            : null;

        return $this->setBrand($value);
    }

    public function getBrandId(): ?int
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

    public function setCompanyId(?int $id): static
    {
        $value = !is_null($id)
            ? new CompanyDto($id)
            : null;

        return $this->setCompany($value);
    }

    public function getCompanyId(): ?int
    {
        if ($dto = $this->getCompany()) {
            return $dto->getId();
        }

        return null;
    }
}
