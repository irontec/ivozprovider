<?php

namespace Ivoz\Provider\Domain\Model\Ivr;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\Model\DtoNormalizer;

/**
 * @codeCoverageIgnore
 */
abstract class IvrDtoAbstract implements DataTransferObjectInterface
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var integer
     */
    private $timeout;

    /**
     * @var integer
     */
    private $maxDigits;

    /**
     * @var boolean
     */
    private $allowExtensions = '0';

    /**
     * @var string
     */
    private $noInputRouteType;

    /**
     * @var string
     */
    private $noInputNumberValue;

    /**
     * @var string
     */
    private $errorRouteType;

    /**
     * @var string
     */
    private $errorNumberValue;

    /**
     * @var integer
     */
    private $id;

    /**
     * @var \Ivoz\Provider\Domain\Model\Company\CompanyDto | null
     */
    private $company;

    /**
     * @var \Ivoz\Provider\Domain\Model\Locution\LocutionDto | null
     */
    private $welcomeLocution;

    /**
     * @var \Ivoz\Provider\Domain\Model\Locution\LocutionDto | null
     */
    private $noInputLocution;

    /**
     * @var \Ivoz\Provider\Domain\Model\Locution\LocutionDto | null
     */
    private $errorLocution;

    /**
     * @var \Ivoz\Provider\Domain\Model\Locution\LocutionDto | null
     */
    private $successLocution;

    /**
     * @var \Ivoz\Provider\Domain\Model\Extension\ExtensionDto | null
     */
    private $noInputExtension;

    /**
     * @var \Ivoz\Provider\Domain\Model\Extension\ExtensionDto | null
     */
    private $errorExtension;

    /**
     * @var \Ivoz\Provider\Domain\Model\User\UserDto | null
     */
    private $noInputVoiceMailUser;

    /**
     * @var \Ivoz\Provider\Domain\Model\User\UserDto | null
     */
    private $errorVoiceMailUser;

    /**
     * @var \Ivoz\Provider\Domain\Model\Country\CountryDto | null
     */
    private $noInputNumberCountry;

    /**
     * @var \Ivoz\Provider\Domain\Model\Country\CountryDto | null
     */
    private $errorNumberCountry;

    /**
     * @var \Ivoz\Provider\Domain\Model\IvrEntry\IvrEntryDto[] | null
     */
    private $entries = null;

    /**
     * @var \Ivoz\Provider\Domain\Model\IvrExcludedExtension\IvrExcludedExtensionDto[] | null
     */
    private $excludedExtensions = null;


    use DtoNormalizer;

    public function __construct($id = null)
    {
        $this->setId($id);
    }

    /**
     * @inheritdoc
     */
    public static function getPropertyMap(string $context = '')
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
        return [
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
    }

    /**
     * @param string $name
     *
     * @return static
     */
    public function setName($name = null)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param integer $timeout
     *
     * @return static
     */
    public function setTimeout($timeout = null)
    {
        $this->timeout = $timeout;

        return $this;
    }

    /**
     * @return integer
     */
    public function getTimeout()
    {
        return $this->timeout;
    }

    /**
     * @param integer $maxDigits
     *
     * @return static
     */
    public function setMaxDigits($maxDigits = null)
    {
        $this->maxDigits = $maxDigits;

        return $this;
    }

    /**
     * @return integer
     */
    public function getMaxDigits()
    {
        return $this->maxDigits;
    }

    /**
     * @param boolean $allowExtensions
     *
     * @return static
     */
    public function setAllowExtensions($allowExtensions = null)
    {
        $this->allowExtensions = $allowExtensions;

        return $this;
    }

    /**
     * @return boolean
     */
    public function getAllowExtensions()
    {
        return $this->allowExtensions;
    }

    /**
     * @param string $noInputRouteType
     *
     * @return static
     */
    public function setNoInputRouteType($noInputRouteType = null)
    {
        $this->noInputRouteType = $noInputRouteType;

        return $this;
    }

    /**
     * @return string
     */
    public function getNoInputRouteType()
    {
        return $this->noInputRouteType;
    }

    /**
     * @param string $noInputNumberValue
     *
     * @return static
     */
    public function setNoInputNumberValue($noInputNumberValue = null)
    {
        $this->noInputNumberValue = $noInputNumberValue;

        return $this;
    }

    /**
     * @return string
     */
    public function getNoInputNumberValue()
    {
        return $this->noInputNumberValue;
    }

    /**
     * @param string $errorRouteType
     *
     * @return static
     */
    public function setErrorRouteType($errorRouteType = null)
    {
        $this->errorRouteType = $errorRouteType;

        return $this;
    }

    /**
     * @return string
     */
    public function getErrorRouteType()
    {
        return $this->errorRouteType;
    }

    /**
     * @param string $errorNumberValue
     *
     * @return static
     */
    public function setErrorNumberValue($errorNumberValue = null)
    {
        $this->errorNumberValue = $errorNumberValue;

        return $this;
    }

    /**
     * @return string
     */
    public function getErrorNumberValue()
    {
        return $this->errorNumberValue;
    }

    /**
     * @param integer $id
     *
     * @return static
     */
    public function setId($id = null)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param \Ivoz\Provider\Domain\Model\Company\CompanyDto $company
     *
     * @return static
     */
    public function setCompany(\Ivoz\Provider\Domain\Model\Company\CompanyDto $company = null)
    {
        $this->company = $company;

        return $this;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\Company\CompanyDto
     */
    public function getCompany()
    {
        return $this->company;
    }

    /**
     * @param integer $id | null
     *
     * @return static
     */
    public function setCompanyId($id)
    {
        $value = !is_null($id)
            ? new \Ivoz\Provider\Domain\Model\Company\CompanyDto($id)
            : null;

        return $this->setCompany($value);
    }

    /**
     * @return integer | null
     */
    public function getCompanyId()
    {
        if ($dto = $this->getCompany()) {
            return $dto->getId();
        }

        return null;
    }

    /**
     * @param \Ivoz\Provider\Domain\Model\Locution\LocutionDto $welcomeLocution
     *
     * @return static
     */
    public function setWelcomeLocution(\Ivoz\Provider\Domain\Model\Locution\LocutionDto $welcomeLocution = null)
    {
        $this->welcomeLocution = $welcomeLocution;

        return $this;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\Locution\LocutionDto
     */
    public function getWelcomeLocution()
    {
        return $this->welcomeLocution;
    }

    /**
     * @param integer $id | null
     *
     * @return static
     */
    public function setWelcomeLocutionId($id)
    {
        $value = !is_null($id)
            ? new \Ivoz\Provider\Domain\Model\Locution\LocutionDto($id)
            : null;

        return $this->setWelcomeLocution($value);
    }

    /**
     * @return integer | null
     */
    public function getWelcomeLocutionId()
    {
        if ($dto = $this->getWelcomeLocution()) {
            return $dto->getId();
        }

        return null;
    }

    /**
     * @param \Ivoz\Provider\Domain\Model\Locution\LocutionDto $noInputLocution
     *
     * @return static
     */
    public function setNoInputLocution(\Ivoz\Provider\Domain\Model\Locution\LocutionDto $noInputLocution = null)
    {
        $this->noInputLocution = $noInputLocution;

        return $this;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\Locution\LocutionDto
     */
    public function getNoInputLocution()
    {
        return $this->noInputLocution;
    }

    /**
     * @param integer $id | null
     *
     * @return static
     */
    public function setNoInputLocutionId($id)
    {
        $value = !is_null($id)
            ? new \Ivoz\Provider\Domain\Model\Locution\LocutionDto($id)
            : null;

        return $this->setNoInputLocution($value);
    }

    /**
     * @return integer | null
     */
    public function getNoInputLocutionId()
    {
        if ($dto = $this->getNoInputLocution()) {
            return $dto->getId();
        }

        return null;
    }

    /**
     * @param \Ivoz\Provider\Domain\Model\Locution\LocutionDto $errorLocution
     *
     * @return static
     */
    public function setErrorLocution(\Ivoz\Provider\Domain\Model\Locution\LocutionDto $errorLocution = null)
    {
        $this->errorLocution = $errorLocution;

        return $this;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\Locution\LocutionDto
     */
    public function getErrorLocution()
    {
        return $this->errorLocution;
    }

    /**
     * @param integer $id | null
     *
     * @return static
     */
    public function setErrorLocutionId($id)
    {
        $value = !is_null($id)
            ? new \Ivoz\Provider\Domain\Model\Locution\LocutionDto($id)
            : null;

        return $this->setErrorLocution($value);
    }

    /**
     * @return integer | null
     */
    public function getErrorLocutionId()
    {
        if ($dto = $this->getErrorLocution()) {
            return $dto->getId();
        }

        return null;
    }

    /**
     * @param \Ivoz\Provider\Domain\Model\Locution\LocutionDto $successLocution
     *
     * @return static
     */
    public function setSuccessLocution(\Ivoz\Provider\Domain\Model\Locution\LocutionDto $successLocution = null)
    {
        $this->successLocution = $successLocution;

        return $this;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\Locution\LocutionDto
     */
    public function getSuccessLocution()
    {
        return $this->successLocution;
    }

    /**
     * @param integer $id | null
     *
     * @return static
     */
    public function setSuccessLocutionId($id)
    {
        $value = !is_null($id)
            ? new \Ivoz\Provider\Domain\Model\Locution\LocutionDto($id)
            : null;

        return $this->setSuccessLocution($value);
    }

    /**
     * @return integer | null
     */
    public function getSuccessLocutionId()
    {
        if ($dto = $this->getSuccessLocution()) {
            return $dto->getId();
        }

        return null;
    }

    /**
     * @param \Ivoz\Provider\Domain\Model\Extension\ExtensionDto $noInputExtension
     *
     * @return static
     */
    public function setNoInputExtension(\Ivoz\Provider\Domain\Model\Extension\ExtensionDto $noInputExtension = null)
    {
        $this->noInputExtension = $noInputExtension;

        return $this;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\Extension\ExtensionDto
     */
    public function getNoInputExtension()
    {
        return $this->noInputExtension;
    }

    /**
     * @param integer $id | null
     *
     * @return static
     */
    public function setNoInputExtensionId($id)
    {
        $value = !is_null($id)
            ? new \Ivoz\Provider\Domain\Model\Extension\ExtensionDto($id)
            : null;

        return $this->setNoInputExtension($value);
    }

    /**
     * @return integer | null
     */
    public function getNoInputExtensionId()
    {
        if ($dto = $this->getNoInputExtension()) {
            return $dto->getId();
        }

        return null;
    }

    /**
     * @param \Ivoz\Provider\Domain\Model\Extension\ExtensionDto $errorExtension
     *
     * @return static
     */
    public function setErrorExtension(\Ivoz\Provider\Domain\Model\Extension\ExtensionDto $errorExtension = null)
    {
        $this->errorExtension = $errorExtension;

        return $this;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\Extension\ExtensionDto
     */
    public function getErrorExtension()
    {
        return $this->errorExtension;
    }

    /**
     * @param integer $id | null
     *
     * @return static
     */
    public function setErrorExtensionId($id)
    {
        $value = !is_null($id)
            ? new \Ivoz\Provider\Domain\Model\Extension\ExtensionDto($id)
            : null;

        return $this->setErrorExtension($value);
    }

    /**
     * @return integer | null
     */
    public function getErrorExtensionId()
    {
        if ($dto = $this->getErrorExtension()) {
            return $dto->getId();
        }

        return null;
    }

    /**
     * @param \Ivoz\Provider\Domain\Model\User\UserDto $noInputVoiceMailUser
     *
     * @return static
     */
    public function setNoInputVoiceMailUser(\Ivoz\Provider\Domain\Model\User\UserDto $noInputVoiceMailUser = null)
    {
        $this->noInputVoiceMailUser = $noInputVoiceMailUser;

        return $this;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\User\UserDto
     */
    public function getNoInputVoiceMailUser()
    {
        return $this->noInputVoiceMailUser;
    }

    /**
     * @param integer $id | null
     *
     * @return static
     */
    public function setNoInputVoiceMailUserId($id)
    {
        $value = !is_null($id)
            ? new \Ivoz\Provider\Domain\Model\User\UserDto($id)
            : null;

        return $this->setNoInputVoiceMailUser($value);
    }

    /**
     * @return integer | null
     */
    public function getNoInputVoiceMailUserId()
    {
        if ($dto = $this->getNoInputVoiceMailUser()) {
            return $dto->getId();
        }

        return null;
    }

    /**
     * @param \Ivoz\Provider\Domain\Model\User\UserDto $errorVoiceMailUser
     *
     * @return static
     */
    public function setErrorVoiceMailUser(\Ivoz\Provider\Domain\Model\User\UserDto $errorVoiceMailUser = null)
    {
        $this->errorVoiceMailUser = $errorVoiceMailUser;

        return $this;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\User\UserDto
     */
    public function getErrorVoiceMailUser()
    {
        return $this->errorVoiceMailUser;
    }

    /**
     * @param integer $id | null
     *
     * @return static
     */
    public function setErrorVoiceMailUserId($id)
    {
        $value = !is_null($id)
            ? new \Ivoz\Provider\Domain\Model\User\UserDto($id)
            : null;

        return $this->setErrorVoiceMailUser($value);
    }

    /**
     * @return integer | null
     */
    public function getErrorVoiceMailUserId()
    {
        if ($dto = $this->getErrorVoiceMailUser()) {
            return $dto->getId();
        }

        return null;
    }

    /**
     * @param \Ivoz\Provider\Domain\Model\Country\CountryDto $noInputNumberCountry
     *
     * @return static
     */
    public function setNoInputNumberCountry(\Ivoz\Provider\Domain\Model\Country\CountryDto $noInputNumberCountry = null)
    {
        $this->noInputNumberCountry = $noInputNumberCountry;

        return $this;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\Country\CountryDto
     */
    public function getNoInputNumberCountry()
    {
        return $this->noInputNumberCountry;
    }

    /**
     * @param integer $id | null
     *
     * @return static
     */
    public function setNoInputNumberCountryId($id)
    {
        $value = !is_null($id)
            ? new \Ivoz\Provider\Domain\Model\Country\CountryDto($id)
            : null;

        return $this->setNoInputNumberCountry($value);
    }

    /**
     * @return integer | null
     */
    public function getNoInputNumberCountryId()
    {
        if ($dto = $this->getNoInputNumberCountry()) {
            return $dto->getId();
        }

        return null;
    }

    /**
     * @param \Ivoz\Provider\Domain\Model\Country\CountryDto $errorNumberCountry
     *
     * @return static
     */
    public function setErrorNumberCountry(\Ivoz\Provider\Domain\Model\Country\CountryDto $errorNumberCountry = null)
    {
        $this->errorNumberCountry = $errorNumberCountry;

        return $this;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\Country\CountryDto
     */
    public function getErrorNumberCountry()
    {
        return $this->errorNumberCountry;
    }

    /**
     * @param integer $id | null
     *
     * @return static
     */
    public function setErrorNumberCountryId($id)
    {
        $value = !is_null($id)
            ? new \Ivoz\Provider\Domain\Model\Country\CountryDto($id)
            : null;

        return $this->setErrorNumberCountry($value);
    }

    /**
     * @return integer | null
     */
    public function getErrorNumberCountryId()
    {
        if ($dto = $this->getErrorNumberCountry()) {
            return $dto->getId();
        }

        return null;
    }

    /**
     * @param array $entries
     *
     * @return static
     */
    public function setEntries($entries = null)
    {
        $this->entries = $entries;

        return $this;
    }

    /**
     * @return array
     */
    public function getEntries()
    {
        return $this->entries;
    }

    /**
     * @param array $excludedExtensions
     *
     * @return static
     */
    public function setExcludedExtensions($excludedExtensions = null)
    {
        $this->excludedExtensions = $excludedExtensions;

        return $this;
    }

    /**
     * @return array
     */
    public function getExcludedExtensions()
    {
        return $this->excludedExtensions;
    }
}
