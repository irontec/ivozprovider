<?php

namespace Ivoz\Provider\Domain\Model\Contact;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\Model\DtoNormalizer;
use Ivoz\Provider\Domain\Model\User\UserDto;
use Ivoz\Provider\Domain\Model\Company\CompanyDto;
use Ivoz\Provider\Domain\Model\Country\CountryDto;

/**
* ContactDtoAbstract
* @codeCoverageIgnore
*/
abstract class ContactDtoAbstract implements DataTransferObjectInterface
{
    use DtoNormalizer;

    /**
     * @var string|null
     */
    private $name = null;

    /**
     * @var string|null
     */
    private $lastname = null;

    /**
     * @var string|null
     */
    private $email = null;

    /**
     * @var string|null
     */
    private $workPhone = null;

    /**
     * @var string|null
     */
    private $workPhoneE164 = null;

    /**
     * @var string|null
     */
    private $mobilePhone = null;

    /**
     * @var string|null
     */
    private $mobilePhoneE164 = null;

    /**
     * @var string|null
     */
    private $otherPhone = null;

    /**
     * @var int|null
     */
    private $id = null;

    /**
     * @var UserDto | null
     */
    private $user = null;

    /**
     * @var CompanyDto | null
     */
    private $company = null;

    /**
     * @var CountryDto | null
     */
    private $workPhoneCountry = null;

    /**
     * @var CountryDto | null
     */
    private $mobilePhoneCountry = null;

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
            'name' => 'name',
            'lastname' => 'lastname',
            'email' => 'email',
            'workPhone' => 'workPhone',
            'workPhoneE164' => 'workPhoneE164',
            'mobilePhone' => 'mobilePhone',
            'mobilePhoneE164' => 'mobilePhoneE164',
            'otherPhone' => 'otherPhone',
            'id' => 'id',
            'userId' => 'user',
            'companyId' => 'company',
            'workPhoneCountryId' => 'workPhoneCountry',
            'mobilePhoneCountryId' => 'mobilePhoneCountry'
        ];
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(bool $hideSensitiveData = false): array
    {
        $response = [
            'name' => $this->getName(),
            'lastname' => $this->getLastname(),
            'email' => $this->getEmail(),
            'workPhone' => $this->getWorkPhone(),
            'workPhoneE164' => $this->getWorkPhoneE164(),
            'mobilePhone' => $this->getMobilePhone(),
            'mobilePhoneE164' => $this->getMobilePhoneE164(),
            'otherPhone' => $this->getOtherPhone(),
            'id' => $this->getId(),
            'user' => $this->getUser(),
            'company' => $this->getCompany(),
            'workPhoneCountry' => $this->getWorkPhoneCountry(),
            'mobilePhoneCountry' => $this->getMobilePhoneCountry()
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

    public function setLastname(?string $lastname): static
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setEmail(?string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setWorkPhone(?string $workPhone): static
    {
        $this->workPhone = $workPhone;

        return $this;
    }

    public function getWorkPhone(): ?string
    {
        return $this->workPhone;
    }

    public function setWorkPhoneE164(?string $workPhoneE164): static
    {
        $this->workPhoneE164 = $workPhoneE164;

        return $this;
    }

    public function getWorkPhoneE164(): ?string
    {
        return $this->workPhoneE164;
    }

    public function setMobilePhone(?string $mobilePhone): static
    {
        $this->mobilePhone = $mobilePhone;

        return $this;
    }

    public function getMobilePhone(): ?string
    {
        return $this->mobilePhone;
    }

    public function setMobilePhoneE164(?string $mobilePhoneE164): static
    {
        $this->mobilePhoneE164 = $mobilePhoneE164;

        return $this;
    }

    public function getMobilePhoneE164(): ?string
    {
        return $this->mobilePhoneE164;
    }

    public function setOtherPhone(?string $otherPhone): static
    {
        $this->otherPhone = $otherPhone;

        return $this;
    }

    public function getOtherPhone(): ?string
    {
        return $this->otherPhone;
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

    public function setUser(?UserDto $user): static
    {
        $this->user = $user;

        return $this;
    }

    public function getUser(): ?UserDto
    {
        return $this->user;
    }

    public function setUserId($id): static
    {
        $value = !is_null($id)
            ? new UserDto($id)
            : null;

        return $this->setUser($value);
    }

    public function getUserId()
    {
        if ($dto = $this->getUser()) {
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

    public function setWorkPhoneCountry(?CountryDto $workPhoneCountry): static
    {
        $this->workPhoneCountry = $workPhoneCountry;

        return $this;
    }

    public function getWorkPhoneCountry(): ?CountryDto
    {
        return $this->workPhoneCountry;
    }

    public function setWorkPhoneCountryId($id): static
    {
        $value = !is_null($id)
            ? new CountryDto($id)
            : null;

        return $this->setWorkPhoneCountry($value);
    }

    public function getWorkPhoneCountryId()
    {
        if ($dto = $this->getWorkPhoneCountry()) {
            return $dto->getId();
        }

        return null;
    }

    public function setMobilePhoneCountry(?CountryDto $mobilePhoneCountry): static
    {
        $this->mobilePhoneCountry = $mobilePhoneCountry;

        return $this;
    }

    public function getMobilePhoneCountry(): ?CountryDto
    {
        return $this->mobilePhoneCountry;
    }

    public function setMobilePhoneCountryId($id): static
    {
        $value = !is_null($id)
            ? new CountryDto($id)
            : null;

        return $this->setMobilePhoneCountry($value);
    }

    public function getMobilePhoneCountryId()
    {
        if ($dto = $this->getMobilePhoneCountry()) {
            return $dto->getId();
        }

        return null;
    }
}
