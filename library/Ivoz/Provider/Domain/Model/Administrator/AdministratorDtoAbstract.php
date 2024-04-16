<?php

namespace Ivoz\Provider\Domain\Model\Administrator;

use Ivoz\Core\Domain\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\DtoNormalizer;
use Ivoz\Provider\Domain\Model\Brand\BrandDto;
use Ivoz\Provider\Domain\Model\Company\CompanyDto;
use Ivoz\Provider\Domain\Model\Timezone\TimezoneDto;
use Ivoz\Provider\Domain\Model\AdministratorRelPublicEntity\AdministratorRelPublicEntityDto;

/**
* AdministratorDtoAbstract
* @codeCoverageIgnore
*/
abstract class AdministratorDtoAbstract implements DataTransferObjectInterface
{
    use DtoNormalizer;

    /**
     * @var string|null
     */
    private $username = null;

    /**
     * @var string|null
     */
    private $pass = null;

    /**
     * @var string|null
     */
    private $email = '';

    /**
     * @var bool|null
     */
    private $active = true;

    /**
     * @var bool|null
     */
    private $internal = false;

    /**
     * @var bool|null
     */
    private $restricted = false;

    /**
     * @var string|null
     */
    private $name = null;

    /**
     * @var string|null
     */
    private $lastname = null;

    /**
     * @var bool|null
     */
    private $canImpersonate = false;

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
     * @var TimezoneDto | null
     */
    private $timezone = null;

    /**
     * @var AdministratorRelPublicEntityDto[] | null
     */
    private $relPublicEntities = null;

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
            'username' => 'username',
            'pass' => 'pass',
            'email' => 'email',
            'active' => 'active',
            'internal' => 'internal',
            'restricted' => 'restricted',
            'name' => 'name',
            'lastname' => 'lastname',
            'canImpersonate' => 'canImpersonate',
            'id' => 'id',
            'brandId' => 'brand',
            'companyId' => 'company',
            'timezoneId' => 'timezone'
        ];
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(bool $hideSensitiveData = false): array
    {
        $response = [
            'username' => $this->getUsername(),
            'pass' => $this->getPass(),
            'email' => $this->getEmail(),
            'active' => $this->getActive(),
            'internal' => $this->getInternal(),
            'restricted' => $this->getRestricted(),
            'name' => $this->getName(),
            'lastname' => $this->getLastname(),
            'canImpersonate' => $this->getCanImpersonate(),
            'id' => $this->getId(),
            'brand' => $this->getBrand(),
            'company' => $this->getCompany(),
            'timezone' => $this->getTimezone(),
            'relPublicEntities' => $this->getRelPublicEntities()
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

    public function setUsername(string $username): static
    {
        $this->username = $username;

        return $this;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setPass(string $pass): static
    {
        $this->pass = $pass;

        return $this;
    }

    public function getPass(): ?string
    {
        return $this->pass;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setActive(bool $active): static
    {
        $this->active = $active;

        return $this;
    }

    public function getActive(): ?bool
    {
        return $this->active;
    }

    public function setInternal(bool $internal): static
    {
        $this->internal = $internal;

        return $this;
    }

    public function getInternal(): ?bool
    {
        return $this->internal;
    }

    public function setRestricted(bool $restricted): static
    {
        $this->restricted = $restricted;

        return $this;
    }

    public function getRestricted(): ?bool
    {
        return $this->restricted;
    }

    public function setName(?string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setLastname(?string $lastname): static
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setCanImpersonate(bool $canImpersonate): static
    {
        $this->canImpersonate = $canImpersonate;

        return $this;
    }

    public function getCanImpersonate(): ?bool
    {
        return $this->canImpersonate;
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

    public function setTimezone(?TimezoneDto $timezone): static
    {
        $this->timezone = $timezone;

        return $this;
    }

    public function getTimezone(): ?TimezoneDto
    {
        return $this->timezone;
    }

    public function setTimezoneId(?int $id): static
    {
        $value = !is_null($id)
            ? new TimezoneDto($id)
            : null;

        return $this->setTimezone($value);
    }

    public function getTimezoneId(): ?int
    {
        if ($dto = $this->getTimezone()) {
            return $dto->getId();
        }

        return null;
    }

    /**
     * @param AdministratorRelPublicEntityDto[] | null $relPublicEntities
     */
    public function setRelPublicEntities(?array $relPublicEntities): static
    {
        $this->relPublicEntities = $relPublicEntities;

        return $this;
    }

    /**
    * @return AdministratorRelPublicEntityDto[] | null
    */
    public function getRelPublicEntities(): ?array
    {
        return $this->relPublicEntities;
    }
}
