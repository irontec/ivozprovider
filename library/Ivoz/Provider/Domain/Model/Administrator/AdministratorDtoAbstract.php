<?php

namespace Ivoz\Provider\Domain\Model\Administrator;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\Model\DtoNormalizer;
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
     * @var string
     */
    private $username;

    /**
     * @var string
     */
    private $pass;

    /**
     * @var string
     */
    private $email = '';

    /**
     * @var bool
     */
    private $active = true;

    /**
     * @var bool
     */
    private $restricted = false;

    /**
     * @var string | null
     */
    private $name;

    /**
     * @var string | null
     */
    private $lastname;

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

    /**
     * @var TimezoneDto | null
     */
    private $timezone;

    /**
     * @var AdministratorRelPublicEntityDto[] | null
     */
    private $relPublicEntities;

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
            'username' => 'username',
            'pass' => 'pass',
            'email' => 'email',
            'active' => 'active',
            'restricted' => 'restricted',
            'name' => 'name',
            'lastname' => 'lastname',
            'id' => 'id',
            'brandId' => 'brand',
            'companyId' => 'company',
            'timezoneId' => 'timezone'
        ];
    }

    /**
    * @return array
    */
    public function toArray($hideSensitiveData = false)
    {
        $response = [
            'username' => $this->getUsername(),
            'pass' => $this->getPass(),
            'email' => $this->getEmail(),
            'active' => $this->getActive(),
            'restricted' => $this->getRestricted(),
            'name' => $this->getName(),
            'lastname' => $this->getLastname(),
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

    /**
     * @param string $username | null
     *
     * @return static
     */
    public function setUsername(?string $username = null): self
    {
        $this->username = $username;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getUsername(): ?string
    {
        return $this->username;
    }

    /**
     * @param string $pass | null
     *
     * @return static
     */
    public function setPass(?string $pass = null): self
    {
        $this->pass = $pass;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getPass(): ?string
    {
        return $this->pass;
    }

    /**
     * @param string $email | null
     *
     * @return static
     */
    public function setEmail(?string $email = null): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * @param bool $active | null
     *
     * @return static
     */
    public function setActive(?bool $active = null): self
    {
        $this->active = $active;

        return $this;
    }

    /**
     * @return bool | null
     */
    public function getActive(): ?bool
    {
        return $this->active;
    }

    /**
     * @param bool $restricted | null
     *
     * @return static
     */
    public function setRestricted(?bool $restricted = null): self
    {
        $this->restricted = $restricted;

        return $this;
    }

    /**
     * @return bool | null
     */
    public function getRestricted(): ?bool
    {
        return $this->restricted;
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
     * @param string $lastname | null
     *
     * @return static
     */
    public function setLastname(?string $lastname = null): self
    {
        $this->lastname = $lastname;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getLastname(): ?string
    {
        return $this->lastname;
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

    /**
     * @param TimezoneDto | null
     *
     * @return static
     */
    public function setTimezone(?TimezoneDto $timezone = null): self
    {
        $this->timezone = $timezone;

        return $this;
    }

    /**
     * @return TimezoneDto | null
     */
    public function getTimezone(): ?TimezoneDto
    {
        return $this->timezone;
    }

    /**
     * @return static
     */
    public function setTimezoneId($id): self
    {
        $value = !is_null($id)
            ? new TimezoneDto($id)
            : null;

        return $this->setTimezone($value);
    }

    /**
     * @return mixed | null
     */
    public function getTimezoneId()
    {
        if ($dto = $this->getTimezone()) {
            return $dto->getId();
        }

        return null;
    }

    /**
     * @param AdministratorRelPublicEntityDto[] | null
     *
     * @return static
     */
    public function setRelPublicEntities(?array $relPublicEntities = null): self
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
