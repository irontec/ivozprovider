<?php

namespace Ivoz\Provider\Domain\Model\Ivr;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;

/**
 * IvrAbstract
 * @codeCoverageIgnore
 */
abstract class IvrAbstract
{
    /**
     * @var string
     */
    protected $name;

    /**
     * @var integer
     */
    protected $timeout;

    /**
     * @var integer
     */
    protected $maxDigits;

    /**
     * @var boolean
     */
    protected $allowExtensions = '0';

    /**
     * comment: enum:number|extension|voicemail
     * @var string | null
     */
    protected $noInputRouteType;

    /**
     * @var string | null
     */
    protected $noInputNumberValue;

    /**
     * comment: enum:number|extension|voicemail
     * @var string | null
     */
    protected $errorRouteType;

    /**
     * @var string | null
     */
    protected $errorNumberValue;

    /**
     * @var \Ivoz\Provider\Domain\Model\Company\CompanyInterface
     */
    protected $company;

    /**
     * @var \Ivoz\Provider\Domain\Model\Locution\LocutionInterface
     */
    protected $welcomeLocution;

    /**
     * @var \Ivoz\Provider\Domain\Model\Locution\LocutionInterface
     */
    protected $noInputLocution;

    /**
     * @var \Ivoz\Provider\Domain\Model\Locution\LocutionInterface
     */
    protected $errorLocution;

    /**
     * @var \Ivoz\Provider\Domain\Model\Locution\LocutionInterface
     */
    protected $successLocution;

    /**
     * @var \Ivoz\Provider\Domain\Model\Extension\ExtensionInterface
     */
    protected $noInputExtension;

    /**
     * @var \Ivoz\Provider\Domain\Model\Extension\ExtensionInterface
     */
    protected $errorExtension;

    /**
     * @var \Ivoz\Provider\Domain\Model\User\UserInterface
     */
    protected $noInputVoiceMailUser;

    /**
     * @var \Ivoz\Provider\Domain\Model\User\UserInterface
     */
    protected $errorVoiceMailUser;

    /**
     * @var \Ivoz\Provider\Domain\Model\Country\CountryInterface
     */
    protected $noInputNumberCountry;

    /**
     * @var \Ivoz\Provider\Domain\Model\Country\CountryInterface
     */
    protected $errorNumberCountry;


    use ChangelogTrait;

    /**
     * Constructor
     */
    protected function __construct(
        $name,
        $timeout,
        $maxDigits,
        $allowExtensions
    ) {
        $this->setName($name);
        $this->setTimeout($timeout);
        $this->setMaxDigits($maxDigits);
        $this->setAllowExtensions($allowExtensions);
    }

    abstract public function getId();

    public function __toString()
    {
        return sprintf(
            "%s#%s",
            "Ivr",
            $this->getId()
        );
    }

    /**
     * @return void
     * @throws \Exception
     */
    protected function sanitizeValues()
    {
    }

    /**
     * @param null $id
     * @return IvrDto
     */
    public static function createDto($id = null)
    {
        return new IvrDto($id);
    }

    /**
     * @internal use EntityTools instead
     * @param EntityInterface|null $entity
     * @param int $depth
     * @return IvrDto|null
     */
    public static function entityToDto(EntityInterface $entity = null, $depth = 0)
    {
        if (!$entity) {
            return null;
        }

        Assertion::isInstanceOf($entity, IvrInterface::class);

        if ($depth < 1) {
            return static::createDto($entity->getId());
        }

        if ($entity instanceof \Doctrine\ORM\Proxy\Proxy && !$entity->__isInitialized()) {
            return static::createDto($entity->getId());
        }

        return $entity->toDto($depth-1);
    }

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param DataTransferObjectInterface $dto
     * @return self
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        \Ivoz\Core\Application\ForeignKeyTransformerInterface $fkTransformer
    ) {
        /**
         * @var $dto IvrDto
         */
        Assertion::isInstanceOf($dto, IvrDto::class);

        $self = new static(
            $dto->getName(),
            $dto->getTimeout(),
            $dto->getMaxDigits(),
            $dto->getAllowExtensions()
        );

        $self
            ->setNoInputRouteType($dto->getNoInputRouteType())
            ->setNoInputNumberValue($dto->getNoInputNumberValue())
            ->setErrorRouteType($dto->getErrorRouteType())
            ->setErrorNumberValue($dto->getErrorNumberValue())
            ->setCompany($fkTransformer->transform($dto->getCompany()))
            ->setWelcomeLocution($fkTransformer->transform($dto->getWelcomeLocution()))
            ->setNoInputLocution($fkTransformer->transform($dto->getNoInputLocution()))
            ->setErrorLocution($fkTransformer->transform($dto->getErrorLocution()))
            ->setSuccessLocution($fkTransformer->transform($dto->getSuccessLocution()))
            ->setNoInputExtension($fkTransformer->transform($dto->getNoInputExtension()))
            ->setErrorExtension($fkTransformer->transform($dto->getErrorExtension()))
            ->setNoInputVoiceMailUser($fkTransformer->transform($dto->getNoInputVoiceMailUser()))
            ->setErrorVoiceMailUser($fkTransformer->transform($dto->getErrorVoiceMailUser()))
            ->setNoInputNumberCountry($fkTransformer->transform($dto->getNoInputNumberCountry()))
            ->setErrorNumberCountry($fkTransformer->transform($dto->getErrorNumberCountry()))
        ;

        $self->sanitizeValues();
        $self->initChangelog();

        return $self;
    }

    /**
     * @internal use EntityTools instead
     * @param DataTransferObjectInterface $dto
     * @return self
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        \Ivoz\Core\Application\ForeignKeyTransformerInterface $fkTransformer
    ) {
        /**
         * @var $dto IvrDto
         */
        Assertion::isInstanceOf($dto, IvrDto::class);

        $this
            ->setName($dto->getName())
            ->setTimeout($dto->getTimeout())
            ->setMaxDigits($dto->getMaxDigits())
            ->setAllowExtensions($dto->getAllowExtensions())
            ->setNoInputRouteType($dto->getNoInputRouteType())
            ->setNoInputNumberValue($dto->getNoInputNumberValue())
            ->setErrorRouteType($dto->getErrorRouteType())
            ->setErrorNumberValue($dto->getErrorNumberValue())
            ->setCompany($fkTransformer->transform($dto->getCompany()))
            ->setWelcomeLocution($fkTransformer->transform($dto->getWelcomeLocution()))
            ->setNoInputLocution($fkTransformer->transform($dto->getNoInputLocution()))
            ->setErrorLocution($fkTransformer->transform($dto->getErrorLocution()))
            ->setSuccessLocution($fkTransformer->transform($dto->getSuccessLocution()))
            ->setNoInputExtension($fkTransformer->transform($dto->getNoInputExtension()))
            ->setErrorExtension($fkTransformer->transform($dto->getErrorExtension()))
            ->setNoInputVoiceMailUser($fkTransformer->transform($dto->getNoInputVoiceMailUser()))
            ->setErrorVoiceMailUser($fkTransformer->transform($dto->getErrorVoiceMailUser()))
            ->setNoInputNumberCountry($fkTransformer->transform($dto->getNoInputNumberCountry()))
            ->setErrorNumberCountry($fkTransformer->transform($dto->getErrorNumberCountry()));



        $this->sanitizeValues();
        return $this;
    }

    /**
     * @internal use EntityTools instead
     * @param int $depth
     * @return IvrDto
     */
    public function toDto($depth = 0)
    {
        return self::createDto()
            ->setName(self::getName())
            ->setTimeout(self::getTimeout())
            ->setMaxDigits(self::getMaxDigits())
            ->setAllowExtensions(self::getAllowExtensions())
            ->setNoInputRouteType(self::getNoInputRouteType())
            ->setNoInputNumberValue(self::getNoInputNumberValue())
            ->setErrorRouteType(self::getErrorRouteType())
            ->setErrorNumberValue(self::getErrorNumberValue())
            ->setCompany(\Ivoz\Provider\Domain\Model\Company\Company::entityToDto(self::getCompany(), $depth))
            ->setWelcomeLocution(\Ivoz\Provider\Domain\Model\Locution\Locution::entityToDto(self::getWelcomeLocution(), $depth))
            ->setNoInputLocution(\Ivoz\Provider\Domain\Model\Locution\Locution::entityToDto(self::getNoInputLocution(), $depth))
            ->setErrorLocution(\Ivoz\Provider\Domain\Model\Locution\Locution::entityToDto(self::getErrorLocution(), $depth))
            ->setSuccessLocution(\Ivoz\Provider\Domain\Model\Locution\Locution::entityToDto(self::getSuccessLocution(), $depth))
            ->setNoInputExtension(\Ivoz\Provider\Domain\Model\Extension\Extension::entityToDto(self::getNoInputExtension(), $depth))
            ->setErrorExtension(\Ivoz\Provider\Domain\Model\Extension\Extension::entityToDto(self::getErrorExtension(), $depth))
            ->setNoInputVoiceMailUser(\Ivoz\Provider\Domain\Model\User\User::entityToDto(self::getNoInputVoiceMailUser(), $depth))
            ->setErrorVoiceMailUser(\Ivoz\Provider\Domain\Model\User\User::entityToDto(self::getErrorVoiceMailUser(), $depth))
            ->setNoInputNumberCountry(\Ivoz\Provider\Domain\Model\Country\Country::entityToDto(self::getNoInputNumberCountry(), $depth))
            ->setErrorNumberCountry(\Ivoz\Provider\Domain\Model\Country\Country::entityToDto(self::getErrorNumberCountry(), $depth));
    }

    /**
     * @return array
     */
    protected function __toArray()
    {
        return [
            'name' => self::getName(),
            'timeout' => self::getTimeout(),
            'maxDigits' => self::getMaxDigits(),
            'allowExtensions' => self::getAllowExtensions(),
            'noInputRouteType' => self::getNoInputRouteType(),
            'noInputNumberValue' => self::getNoInputNumberValue(),
            'errorRouteType' => self::getErrorRouteType(),
            'errorNumberValue' => self::getErrorNumberValue(),
            'companyId' => self::getCompany() ? self::getCompany()->getId() : null,
            'welcomeLocutionId' => self::getWelcomeLocution() ? self::getWelcomeLocution()->getId() : null,
            'noInputLocutionId' => self::getNoInputLocution() ? self::getNoInputLocution()->getId() : null,
            'errorLocutionId' => self::getErrorLocution() ? self::getErrorLocution()->getId() : null,
            'successLocutionId' => self::getSuccessLocution() ? self::getSuccessLocution()->getId() : null,
            'noInputExtensionId' => self::getNoInputExtension() ? self::getNoInputExtension()->getId() : null,
            'errorExtensionId' => self::getErrorExtension() ? self::getErrorExtension()->getId() : null,
            'noInputVoiceMailUserId' => self::getNoInputVoiceMailUser() ? self::getNoInputVoiceMailUser()->getId() : null,
            'errorVoiceMailUserId' => self::getErrorVoiceMailUser() ? self::getErrorVoiceMailUser()->getId() : null,
            'noInputNumberCountryId' => self::getNoInputNumberCountry() ? self::getNoInputNumberCountry()->getId() : null,
            'errorNumberCountryId' => self::getErrorNumberCountry() ? self::getErrorNumberCountry()->getId() : null
        ];
    }
    // @codeCoverageIgnoreStart

    /**
     * Set name
     *
     * @param string $name
     *
     * @return self
     */
    protected function setName($name)
    {
        Assertion::notNull($name, 'name value "%s" is null, but non null value was expected.');
        Assertion::maxLength($name, 50, 'name value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set timeout
     *
     * @param integer $timeout
     *
     * @return self
     */
    protected function setTimeout($timeout)
    {
        Assertion::notNull($timeout, 'timeout value "%s" is null, but non null value was expected.');
        Assertion::integerish($timeout, 'timeout value "%s" is not an integer or a number castable to integer.');
        Assertion::greaterOrEqualThan($timeout, 0, 'timeout provided "%s" is not greater or equal than "%s".');

        $this->timeout = $timeout;

        return $this;
    }

    /**
     * Get timeout
     *
     * @return integer
     */
    public function getTimeout()
    {
        return $this->timeout;
    }

    /**
     * Set maxDigits
     *
     * @param integer $maxDigits
     *
     * @return self
     */
    protected function setMaxDigits($maxDigits)
    {
        Assertion::notNull($maxDigits, 'maxDigits value "%s" is null, but non null value was expected.');
        Assertion::integerish($maxDigits, 'maxDigits value "%s" is not an integer or a number castable to integer.');
        Assertion::greaterOrEqualThan($maxDigits, 0, 'maxDigits provided "%s" is not greater or equal than "%s".');

        $this->maxDigits = $maxDigits;

        return $this;
    }

    /**
     * Get maxDigits
     *
     * @return integer
     */
    public function getMaxDigits()
    {
        return $this->maxDigits;
    }

    /**
     * Set allowExtensions
     *
     * @param boolean $allowExtensions
     *
     * @return self
     */
    protected function setAllowExtensions($allowExtensions)
    {
        Assertion::notNull($allowExtensions, 'allowExtensions value "%s" is null, but non null value was expected.');
        Assertion::between(intval($allowExtensions), 0, 1, 'allowExtensions provided "%s" is not a valid boolean value.');

        $this->allowExtensions = $allowExtensions;

        return $this;
    }

    /**
     * Get allowExtensions
     *
     * @return boolean
     */
    public function getAllowExtensions()
    {
        return $this->allowExtensions;
    }

    /**
     * Set noInputRouteType
     *
     * @param string $noInputRouteType
     *
     * @return self
     */
    protected function setNoInputRouteType($noInputRouteType = null)
    {
        if (!is_null($noInputRouteType)) {
            Assertion::maxLength($noInputRouteType, 25, 'noInputRouteType value "%s" is too long, it should have no more than %d characters, but has %d characters.');
            Assertion::choice($noInputRouteType, array (
              0 => 'number',
              1 => 'extension',
              2 => 'voicemail',
            ), 'noInputRouteTypevalue "%s" is not an element of the valid values: %s');
        }

        $this->noInputRouteType = $noInputRouteType;

        return $this;
    }

    /**
     * Get noInputRouteType
     *
     * @return string | null
     */
    public function getNoInputRouteType()
    {
        return $this->noInputRouteType;
    }

    /**
     * Set noInputNumberValue
     *
     * @param string $noInputNumberValue
     *
     * @return self
     */
    protected function setNoInputNumberValue($noInputNumberValue = null)
    {
        if (!is_null($noInputNumberValue)) {
            Assertion::maxLength($noInputNumberValue, 25, 'noInputNumberValue value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->noInputNumberValue = $noInputNumberValue;

        return $this;
    }

    /**
     * Get noInputNumberValue
     *
     * @return string | null
     */
    public function getNoInputNumberValue()
    {
        return $this->noInputNumberValue;
    }

    /**
     * Set errorRouteType
     *
     * @param string $errorRouteType
     *
     * @return self
     */
    protected function setErrorRouteType($errorRouteType = null)
    {
        if (!is_null($errorRouteType)) {
            Assertion::maxLength($errorRouteType, 25, 'errorRouteType value "%s" is too long, it should have no more than %d characters, but has %d characters.');
            Assertion::choice($errorRouteType, array (
              0 => 'number',
              1 => 'extension',
              2 => 'voicemail',
            ), 'errorRouteTypevalue "%s" is not an element of the valid values: %s');
        }

        $this->errorRouteType = $errorRouteType;

        return $this;
    }

    /**
     * Get errorRouteType
     *
     * @return string | null
     */
    public function getErrorRouteType()
    {
        return $this->errorRouteType;
    }

    /**
     * Set errorNumberValue
     *
     * @param string $errorNumberValue
     *
     * @return self
     */
    protected function setErrorNumberValue($errorNumberValue = null)
    {
        if (!is_null($errorNumberValue)) {
            Assertion::maxLength($errorNumberValue, 25, 'errorNumberValue value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->errorNumberValue = $errorNumberValue;

        return $this;
    }

    /**
     * Get errorNumberValue
     *
     * @return string | null
     */
    public function getErrorNumberValue()
    {
        return $this->errorNumberValue;
    }

    /**
     * Set company
     *
     * @param \Ivoz\Provider\Domain\Model\Company\CompanyInterface $company
     *
     * @return self
     */
    public function setCompany(\Ivoz\Provider\Domain\Model\Company\CompanyInterface $company)
    {
        $this->company = $company;

        return $this;
    }

    /**
     * Get company
     *
     * @return \Ivoz\Provider\Domain\Model\Company\CompanyInterface
     */
    public function getCompany()
    {
        return $this->company;
    }

    /**
     * Set welcomeLocution
     *
     * @param \Ivoz\Provider\Domain\Model\Locution\LocutionInterface $welcomeLocution
     *
     * @return self
     */
    public function setWelcomeLocution(\Ivoz\Provider\Domain\Model\Locution\LocutionInterface $welcomeLocution = null)
    {
        $this->welcomeLocution = $welcomeLocution;

        return $this;
    }

    /**
     * Get welcomeLocution
     *
     * @return \Ivoz\Provider\Domain\Model\Locution\LocutionInterface
     */
    public function getWelcomeLocution()
    {
        return $this->welcomeLocution;
    }

    /**
     * Set noInputLocution
     *
     * @param \Ivoz\Provider\Domain\Model\Locution\LocutionInterface $noInputLocution
     *
     * @return self
     */
    public function setNoInputLocution(\Ivoz\Provider\Domain\Model\Locution\LocutionInterface $noInputLocution = null)
    {
        $this->noInputLocution = $noInputLocution;

        return $this;
    }

    /**
     * Get noInputLocution
     *
     * @return \Ivoz\Provider\Domain\Model\Locution\LocutionInterface
     */
    public function getNoInputLocution()
    {
        return $this->noInputLocution;
    }

    /**
     * Set errorLocution
     *
     * @param \Ivoz\Provider\Domain\Model\Locution\LocutionInterface $errorLocution
     *
     * @return self
     */
    public function setErrorLocution(\Ivoz\Provider\Domain\Model\Locution\LocutionInterface $errorLocution = null)
    {
        $this->errorLocution = $errorLocution;

        return $this;
    }

    /**
     * Get errorLocution
     *
     * @return \Ivoz\Provider\Domain\Model\Locution\LocutionInterface
     */
    public function getErrorLocution()
    {
        return $this->errorLocution;
    }

    /**
     * Set successLocution
     *
     * @param \Ivoz\Provider\Domain\Model\Locution\LocutionInterface $successLocution
     *
     * @return self
     */
    public function setSuccessLocution(\Ivoz\Provider\Domain\Model\Locution\LocutionInterface $successLocution = null)
    {
        $this->successLocution = $successLocution;

        return $this;
    }

    /**
     * Get successLocution
     *
     * @return \Ivoz\Provider\Domain\Model\Locution\LocutionInterface
     */
    public function getSuccessLocution()
    {
        return $this->successLocution;
    }

    /**
     * Set noInputExtension
     *
     * @param \Ivoz\Provider\Domain\Model\Extension\ExtensionInterface $noInputExtension
     *
     * @return self
     */
    public function setNoInputExtension(\Ivoz\Provider\Domain\Model\Extension\ExtensionInterface $noInputExtension = null)
    {
        $this->noInputExtension = $noInputExtension;

        return $this;
    }

    /**
     * Get noInputExtension
     *
     * @return \Ivoz\Provider\Domain\Model\Extension\ExtensionInterface
     */
    public function getNoInputExtension()
    {
        return $this->noInputExtension;
    }

    /**
     * Set errorExtension
     *
     * @param \Ivoz\Provider\Domain\Model\Extension\ExtensionInterface $errorExtension
     *
     * @return self
     */
    public function setErrorExtension(\Ivoz\Provider\Domain\Model\Extension\ExtensionInterface $errorExtension = null)
    {
        $this->errorExtension = $errorExtension;

        return $this;
    }

    /**
     * Get errorExtension
     *
     * @return \Ivoz\Provider\Domain\Model\Extension\ExtensionInterface
     */
    public function getErrorExtension()
    {
        return $this->errorExtension;
    }

    /**
     * Set noInputVoiceMailUser
     *
     * @param \Ivoz\Provider\Domain\Model\User\UserInterface $noInputVoiceMailUser
     *
     * @return self
     */
    public function setNoInputVoiceMailUser(\Ivoz\Provider\Domain\Model\User\UserInterface $noInputVoiceMailUser = null)
    {
        $this->noInputVoiceMailUser = $noInputVoiceMailUser;

        return $this;
    }

    /**
     * Get noInputVoiceMailUser
     *
     * @return \Ivoz\Provider\Domain\Model\User\UserInterface
     */
    public function getNoInputVoiceMailUser()
    {
        return $this->noInputVoiceMailUser;
    }

    /**
     * Set errorVoiceMailUser
     *
     * @param \Ivoz\Provider\Domain\Model\User\UserInterface $errorVoiceMailUser
     *
     * @return self
     */
    public function setErrorVoiceMailUser(\Ivoz\Provider\Domain\Model\User\UserInterface $errorVoiceMailUser = null)
    {
        $this->errorVoiceMailUser = $errorVoiceMailUser;

        return $this;
    }

    /**
     * Get errorVoiceMailUser
     *
     * @return \Ivoz\Provider\Domain\Model\User\UserInterface
     */
    public function getErrorVoiceMailUser()
    {
        return $this->errorVoiceMailUser;
    }

    /**
     * Set noInputNumberCountry
     *
     * @param \Ivoz\Provider\Domain\Model\Country\CountryInterface $noInputNumberCountry
     *
     * @return self
     */
    public function setNoInputNumberCountry(\Ivoz\Provider\Domain\Model\Country\CountryInterface $noInputNumberCountry = null)
    {
        $this->noInputNumberCountry = $noInputNumberCountry;

        return $this;
    }

    /**
     * Get noInputNumberCountry
     *
     * @return \Ivoz\Provider\Domain\Model\Country\CountryInterface
     */
    public function getNoInputNumberCountry()
    {
        return $this->noInputNumberCountry;
    }

    /**
     * Set errorNumberCountry
     *
     * @param \Ivoz\Provider\Domain\Model\Country\CountryInterface $errorNumberCountry
     *
     * @return self
     */
    public function setErrorNumberCountry(\Ivoz\Provider\Domain\Model\Country\CountryInterface $errorNumberCountry = null)
    {
        $this->errorNumberCountry = $errorNumberCountry;

        return $this;
    }

    /**
     * Get errorNumberCountry
     *
     * @return \Ivoz\Provider\Domain\Model\Country\CountryInterface
     */
    public function getErrorNumberCountry()
    {
        return $this->errorNumberCountry;
    }

    // @codeCoverageIgnoreEnd
}
