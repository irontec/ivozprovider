<?php

namespace Ivoz\Provider\Domain\Model\Ivr;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\Model\DtoNormalizer;
use Ivoz\Provider\Domain\Model\Company\CompanyDto;
use Ivoz\Provider\Domain\Model\Locution\LocutionDto;
use Ivoz\Provider\Domain\Model\Extension\ExtensionDto;
use Ivoz\Provider\Domain\Model\User\UserDto;
use Ivoz\Provider\Domain\Model\Country\CountryDto;
use Ivoz\Provider\Domain\Model\IvrEntry\IvrEntryDto;
use Ivoz\Provider\Domain\Model\IvrExcludedExtension\IvrExcludedExtensionDto;

/**
* IvrDtoAbstract
* @codeCoverageIgnore
*/
abstract class IvrDtoAbstract implements DataTransferObjectInterface
{
    use DtoNormalizer;

    /**
     * @var string
     */
    private $name;

    /**
     * @var int
     */
    private $timeout;

    /**
     * @var int
     */
    private $maxDigits;

    /**
     * @var bool
     */
    private $allowExtensions = false;

    /**
     * @var string | null
     */
    private $noInputRouteType;

    /**
     * @var string | null
     */
    private $noInputNumberValue;

    /**
     * @var string | null
     */
    private $errorRouteType;

    /**
     * @var string | null
     */
    private $errorNumberValue;

    /**
     * @var int
     */
    private $id;

    /**
     * @var CompanyDto | null
     */
    private $company;

    /**
     * @var LocutionDto | null
     */
    private $welcomeLocution;

    /**
     * @var LocutionDto | null
     */
    private $noInputLocution;

    /**
     * @var LocutionDto | null
     */
    private $errorLocution;

    /**
     * @var LocutionDto | null
     */
    private $successLocution;

    /**
     * @var ExtensionDto | null
     */
    private $noInputExtension;

    /**
     * @var ExtensionDto | null
     */
    private $errorExtension;

    /**
     * @var UserDto | null
     */
    private $noInputVoiceMailUser;

    /**
     * @var UserDto | null
     */
    private $errorVoiceMailUser;

    /**
     * @var CountryDto | null
     */
    private $noInputNumberCountry;

    /**
     * @var CountryDto | null
     */
    private $errorNumberCountry;

    /**
     * @var IvrEntryDto[] | null
     */
    private $entries;

    /**
     * @var IvrExcludedExtensionDto[] | null
     */
    private $excludedExtensions;

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
            'timeout' => 'timeout',
            'maxDigits' => 'maxDigits',
            'allowExtensions' => 'allowExtensions',
            'noInputRouteType' => 'noInputRouteType',
            'noInputNumberValue' => 'noInputNumberValue',
            'errorRouteType' => 'errorRouteType',
            'errorNumberValue' => 'errorNumberValue',
            'id' => 'id',
            'companyId' => 'company',
            'welcomeLocutionId' => 'welcomeLocution',
            'noInputLocutionId' => 'noInputLocution',
            'errorLocutionId' => 'errorLocution',
            'successLocutionId' => 'successLocution',
            'noInputExtensionId' => 'noInputExtension',
            'errorExtensionId' => 'errorExtension',
            'noInputVoiceMailUserId' => 'noInputVoiceMailUser',
            'errorVoiceMailUserId' => 'errorVoiceMailUser',
            'noInputNumberCountryId' => 'noInputNumberCountry',
            'errorNumberCountryId' => 'errorNumberCountry'
        ];
    }

    /**
    * @return array
    */
    public function toArray($hideSensitiveData = false)
    {
        $response = [
            'name' => $this->getName(),
            'timeout' => $this->getTimeout(),
            'maxDigits' => $this->getMaxDigits(),
            'allowExtensions' => $this->getAllowExtensions(),
            'noInputRouteType' => $this->getNoInputRouteType(),
            'noInputNumberValue' => $this->getNoInputNumberValue(),
            'errorRouteType' => $this->getErrorRouteType(),
            'errorNumberValue' => $this->getErrorNumberValue(),
            'id' => $this->getId(),
            'company' => $this->getCompany(),
            'welcomeLocution' => $this->getWelcomeLocution(),
            'noInputLocution' => $this->getNoInputLocution(),
            'errorLocution' => $this->getErrorLocution(),
            'successLocution' => $this->getSuccessLocution(),
            'noInputExtension' => $this->getNoInputExtension(),
            'errorExtension' => $this->getErrorExtension(),
            'noInputVoiceMailUser' => $this->getNoInputVoiceMailUser(),
            'errorVoiceMailUser' => $this->getErrorVoiceMailUser(),
            'noInputNumberCountry' => $this->getNoInputNumberCountry(),
            'errorNumberCountry' => $this->getErrorNumberCountry(),
            'entries' => $this->getEntries(),
            'excludedExtensions' => $this->getExcludedExtensions()
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
     * @param int $timeout | null
     *
     * @return static
     */
    public function setTimeout(?int $timeout = null): self
    {
        $this->timeout = $timeout;

        return $this;
    }

    /**
     * @return int | null
     */
    public function getTimeout(): ?int
    {
        return $this->timeout;
    }

    /**
     * @param int $maxDigits | null
     *
     * @return static
     */
    public function setMaxDigits(?int $maxDigits = null): self
    {
        $this->maxDigits = $maxDigits;

        return $this;
    }

    /**
     * @return int | null
     */
    public function getMaxDigits(): ?int
    {
        return $this->maxDigits;
    }

    /**
     * @param bool $allowExtensions | null
     *
     * @return static
     */
    public function setAllowExtensions(?bool $allowExtensions = null): self
    {
        $this->allowExtensions = $allowExtensions;

        return $this;
    }

    /**
     * @return bool | null
     */
    public function getAllowExtensions(): ?bool
    {
        return $this->allowExtensions;
    }

    /**
     * @param string $noInputRouteType | null
     *
     * @return static
     */
    public function setNoInputRouteType(?string $noInputRouteType = null): self
    {
        $this->noInputRouteType = $noInputRouteType;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getNoInputRouteType(): ?string
    {
        return $this->noInputRouteType;
    }

    /**
     * @param string $noInputNumberValue | null
     *
     * @return static
     */
    public function setNoInputNumberValue(?string $noInputNumberValue = null): self
    {
        $this->noInputNumberValue = $noInputNumberValue;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getNoInputNumberValue(): ?string
    {
        return $this->noInputNumberValue;
    }

    /**
     * @param string $errorRouteType | null
     *
     * @return static
     */
    public function setErrorRouteType(?string $errorRouteType = null): self
    {
        $this->errorRouteType = $errorRouteType;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getErrorRouteType(): ?string
    {
        return $this->errorRouteType;
    }

    /**
     * @param string $errorNumberValue | null
     *
     * @return static
     */
    public function setErrorNumberValue(?string $errorNumberValue = null): self
    {
        $this->errorNumberValue = $errorNumberValue;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getErrorNumberValue(): ?string
    {
        return $this->errorNumberValue;
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

    /**
     * @param LocutionDto | null
     *
     * @return static
     */
    public function setWelcomeLocution(?LocutionDto $welcomeLocution = null): self
    {
        $this->welcomeLocution = $welcomeLocution;

        return $this;
    }

    /**
     * @return LocutionDto | null
     */
    public function getWelcomeLocution(): ?LocutionDto
    {
        return $this->welcomeLocution;
    }

    /**
     * @return static
     */
    public function setWelcomeLocutionId($id): self
    {
        $value = !is_null($id)
            ? new LocutionDto($id)
            : null;

        return $this->setWelcomeLocution($value);
    }

    /**
     * @return mixed | null
     */
    public function getWelcomeLocutionId()
    {
        if ($dto = $this->getWelcomeLocution()) {
            return $dto->getId();
        }

        return null;
    }

    /**
     * @param LocutionDto | null
     *
     * @return static
     */
    public function setNoInputLocution(?LocutionDto $noInputLocution = null): self
    {
        $this->noInputLocution = $noInputLocution;

        return $this;
    }

    /**
     * @return LocutionDto | null
     */
    public function getNoInputLocution(): ?LocutionDto
    {
        return $this->noInputLocution;
    }

    /**
     * @return static
     */
    public function setNoInputLocutionId($id): self
    {
        $value = !is_null($id)
            ? new LocutionDto($id)
            : null;

        return $this->setNoInputLocution($value);
    }

    /**
     * @return mixed | null
     */
    public function getNoInputLocutionId()
    {
        if ($dto = $this->getNoInputLocution()) {
            return $dto->getId();
        }

        return null;
    }

    /**
     * @param LocutionDto | null
     *
     * @return static
     */
    public function setErrorLocution(?LocutionDto $errorLocution = null): self
    {
        $this->errorLocution = $errorLocution;

        return $this;
    }

    /**
     * @return LocutionDto | null
     */
    public function getErrorLocution(): ?LocutionDto
    {
        return $this->errorLocution;
    }

    /**
     * @return static
     */
    public function setErrorLocutionId($id): self
    {
        $value = !is_null($id)
            ? new LocutionDto($id)
            : null;

        return $this->setErrorLocution($value);
    }

    /**
     * @return mixed | null
     */
    public function getErrorLocutionId()
    {
        if ($dto = $this->getErrorLocution()) {
            return $dto->getId();
        }

        return null;
    }

    /**
     * @param LocutionDto | null
     *
     * @return static
     */
    public function setSuccessLocution(?LocutionDto $successLocution = null): self
    {
        $this->successLocution = $successLocution;

        return $this;
    }

    /**
     * @return LocutionDto | null
     */
    public function getSuccessLocution(): ?LocutionDto
    {
        return $this->successLocution;
    }

    /**
     * @return static
     */
    public function setSuccessLocutionId($id): self
    {
        $value = !is_null($id)
            ? new LocutionDto($id)
            : null;

        return $this->setSuccessLocution($value);
    }

    /**
     * @return mixed | null
     */
    public function getSuccessLocutionId()
    {
        if ($dto = $this->getSuccessLocution()) {
            return $dto->getId();
        }

        return null;
    }

    /**
     * @param ExtensionDto | null
     *
     * @return static
     */
    public function setNoInputExtension(?ExtensionDto $noInputExtension = null): self
    {
        $this->noInputExtension = $noInputExtension;

        return $this;
    }

    /**
     * @return ExtensionDto | null
     */
    public function getNoInputExtension(): ?ExtensionDto
    {
        return $this->noInputExtension;
    }

    /**
     * @return static
     */
    public function setNoInputExtensionId($id): self
    {
        $value = !is_null($id)
            ? new ExtensionDto($id)
            : null;

        return $this->setNoInputExtension($value);
    }

    /**
     * @return mixed | null
     */
    public function getNoInputExtensionId()
    {
        if ($dto = $this->getNoInputExtension()) {
            return $dto->getId();
        }

        return null;
    }

    /**
     * @param ExtensionDto | null
     *
     * @return static
     */
    public function setErrorExtension(?ExtensionDto $errorExtension = null): self
    {
        $this->errorExtension = $errorExtension;

        return $this;
    }

    /**
     * @return ExtensionDto | null
     */
    public function getErrorExtension(): ?ExtensionDto
    {
        return $this->errorExtension;
    }

    /**
     * @return static
     */
    public function setErrorExtensionId($id): self
    {
        $value = !is_null($id)
            ? new ExtensionDto($id)
            : null;

        return $this->setErrorExtension($value);
    }

    /**
     * @return mixed | null
     */
    public function getErrorExtensionId()
    {
        if ($dto = $this->getErrorExtension()) {
            return $dto->getId();
        }

        return null;
    }

    /**
     * @param UserDto | null
     *
     * @return static
     */
    public function setNoInputVoiceMailUser(?UserDto $noInputVoiceMailUser = null): self
    {
        $this->noInputVoiceMailUser = $noInputVoiceMailUser;

        return $this;
    }

    /**
     * @return UserDto | null
     */
    public function getNoInputVoiceMailUser(): ?UserDto
    {
        return $this->noInputVoiceMailUser;
    }

    /**
     * @return static
     */
    public function setNoInputVoiceMailUserId($id): self
    {
        $value = !is_null($id)
            ? new UserDto($id)
            : null;

        return $this->setNoInputVoiceMailUser($value);
    }

    /**
     * @return mixed | null
     */
    public function getNoInputVoiceMailUserId()
    {
        if ($dto = $this->getNoInputVoiceMailUser()) {
            return $dto->getId();
        }

        return null;
    }

    /**
     * @param UserDto | null
     *
     * @return static
     */
    public function setErrorVoiceMailUser(?UserDto $errorVoiceMailUser = null): self
    {
        $this->errorVoiceMailUser = $errorVoiceMailUser;

        return $this;
    }

    /**
     * @return UserDto | null
     */
    public function getErrorVoiceMailUser(): ?UserDto
    {
        return $this->errorVoiceMailUser;
    }

    /**
     * @return static
     */
    public function setErrorVoiceMailUserId($id): self
    {
        $value = !is_null($id)
            ? new UserDto($id)
            : null;

        return $this->setErrorVoiceMailUser($value);
    }

    /**
     * @return mixed | null
     */
    public function getErrorVoiceMailUserId()
    {
        if ($dto = $this->getErrorVoiceMailUser()) {
            return $dto->getId();
        }

        return null;
    }

    /**
     * @param CountryDto | null
     *
     * @return static
     */
    public function setNoInputNumberCountry(?CountryDto $noInputNumberCountry = null): self
    {
        $this->noInputNumberCountry = $noInputNumberCountry;

        return $this;
    }

    /**
     * @return CountryDto | null
     */
    public function getNoInputNumberCountry(): ?CountryDto
    {
        return $this->noInputNumberCountry;
    }

    /**
     * @return static
     */
    public function setNoInputNumberCountryId($id): self
    {
        $value = !is_null($id)
            ? new CountryDto($id)
            : null;

        return $this->setNoInputNumberCountry($value);
    }

    /**
     * @return mixed | null
     */
    public function getNoInputNumberCountryId()
    {
        if ($dto = $this->getNoInputNumberCountry()) {
            return $dto->getId();
        }

        return null;
    }

    /**
     * @param CountryDto | null
     *
     * @return static
     */
    public function setErrorNumberCountry(?CountryDto $errorNumberCountry = null): self
    {
        $this->errorNumberCountry = $errorNumberCountry;

        return $this;
    }

    /**
     * @return CountryDto | null
     */
    public function getErrorNumberCountry(): ?CountryDto
    {
        return $this->errorNumberCountry;
    }

    /**
     * @return static
     */
    public function setErrorNumberCountryId($id): self
    {
        $value = !is_null($id)
            ? new CountryDto($id)
            : null;

        return $this->setErrorNumberCountry($value);
    }

    /**
     * @return mixed | null
     */
    public function getErrorNumberCountryId()
    {
        if ($dto = $this->getErrorNumberCountry()) {
            return $dto->getId();
        }

        return null;
    }

    /**
     * @param IvrEntryDto[] | null
     *
     * @return static
     */
    public function setEntries(?array $entries = null): self
    {
        $this->entries = $entries;

        return $this;
    }

    /**
     * @return IvrEntryDto[] | null
     */
    public function getEntries(): ?array
    {
        return $this->entries;
    }

    /**
     * @param IvrExcludedExtensionDto[] | null
     *
     * @return static
     */
    public function setExcludedExtensions(?array $excludedExtensions = null): self
    {
        $this->excludedExtensions = $excludedExtensions;

        return $this;
    }

    /**
     * @return IvrExcludedExtensionDto[] | null
     */
    public function getExcludedExtensions(): ?array
    {
        return $this->excludedExtensions;
    }

}
