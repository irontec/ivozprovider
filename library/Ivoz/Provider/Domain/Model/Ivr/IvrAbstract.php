<?php
declare(strict_types = 1);

namespace Ivoz\Provider\Domain\Model\Ivr;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;
use \Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use Ivoz\Provider\Domain\Model\Locution\LocutionInterface;
use Ivoz\Provider\Domain\Model\Extension\ExtensionInterface;
use Ivoz\Provider\Domain\Model\User\UserInterface;
use Ivoz\Provider\Domain\Model\Country\CountryInterface;
use Ivoz\Provider\Domain\Model\Company\Company;
use Ivoz\Provider\Domain\Model\Locution\Locution;
use Ivoz\Provider\Domain\Model\Extension\Extension;
use Ivoz\Provider\Domain\Model\User\User;
use Ivoz\Provider\Domain\Model\Country\Country;

/**
* IvrAbstract
* @codeCoverageIgnore
*/
abstract class IvrAbstract
{
    use ChangelogTrait;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var int
     */
    protected $timeout;

    /**
     * @var int
     */
    protected $maxDigits;

    /**
     * @var bool
     */
    protected $allowExtensions = false;

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
     * @var CompanyInterface
     */
    protected $company;

    /**
     * @var LocutionInterface
     */
    protected $welcomeLocution;

    /**
     * @var LocutionInterface
     */
    protected $noInputLocution;

    /**
     * @var LocutionInterface
     */
    protected $errorLocution;

    /**
     * @var LocutionInterface
     */
    protected $successLocution;

    /**
     * @var ExtensionInterface
     */
    protected $noInputExtension;

    /**
     * @var ExtensionInterface
     */
    protected $errorExtension;

    /**
     * @var UserInterface
     */
    protected $noInputVoiceMailUser;

    /**
     * @var UserInterface
     */
    protected $errorVoiceMailUser;

    /**
     * @var CountryInterface
     */
    protected $noInputNumberCountry;

    /**
     * @var CountryInterface
     */
    protected $errorNumberCountry;

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
     * @param IvrInterface|null $entity
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

        /** @var IvrDto $dto */
        $dto = $entity->toDto($depth-1);

        return $dto;
    }

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param IvrDto $dto
     * @return self
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ) {
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
            ->setErrorNumberCountry($fkTransformer->transform($dto->getErrorNumberCountry()));

        $self->initChangelog();

        return $self;
    }

    /**
     * @internal use EntityTools instead
     * @param IvrDto $dto
     * @return self
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ) {
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
            ->setCompany(Company::entityToDto(self::getCompany(), $depth))
            ->setWelcomeLocution(Locution::entityToDto(self::getWelcomeLocution(), $depth))
            ->setNoInputLocution(Locution::entityToDto(self::getNoInputLocution(), $depth))
            ->setErrorLocution(Locution::entityToDto(self::getErrorLocution(), $depth))
            ->setSuccessLocution(Locution::entityToDto(self::getSuccessLocution(), $depth))
            ->setNoInputExtension(Extension::entityToDto(self::getNoInputExtension(), $depth))
            ->setErrorExtension(Extension::entityToDto(self::getErrorExtension(), $depth))
            ->setNoInputVoiceMailUser(User::entityToDto(self::getNoInputVoiceMailUser(), $depth))
            ->setErrorVoiceMailUser(User::entityToDto(self::getErrorVoiceMailUser(), $depth))
            ->setNoInputNumberCountry(Country::entityToDto(self::getNoInputNumberCountry(), $depth))
            ->setErrorNumberCountry(Country::entityToDto(self::getErrorNumberCountry(), $depth));
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
            'companyId' => self::getCompany()->getId(),
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

    /**
     * Set name
     *
     * @param string $name
     *
     * @return static
     */
    protected function setName(string $name): IvrInterface
    {
        Assertion::maxLength($name, 50, 'name value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Set timeout
     *
     * @param int $timeout
     *
     * @return static
     */
    protected function setTimeout(int $timeout): IvrInterface
    {
        Assertion::greaterOrEqualThan($timeout, 0, 'timeout provided "%s" is not greater or equal than "%s".');

        $this->timeout = $timeout;

        return $this;
    }

    /**
     * Get timeout
     *
     * @return int
     */
    public function getTimeout(): int
    {
        return $this->timeout;
    }

    /**
     * Set maxDigits
     *
     * @param int $maxDigits
     *
     * @return static
     */
    protected function setMaxDigits(int $maxDigits): IvrInterface
    {
        Assertion::greaterOrEqualThan($maxDigits, 0, 'maxDigits provided "%s" is not greater or equal than "%s".');

        $this->maxDigits = $maxDigits;

        return $this;
    }

    /**
     * Get maxDigits
     *
     * @return int
     */
    public function getMaxDigits(): int
    {
        return $this->maxDigits;
    }

    /**
     * Set allowExtensions
     *
     * @param bool $allowExtensions
     *
     * @return static
     */
    protected function setAllowExtensions(bool $allowExtensions): IvrInterface
    {
        Assertion::between(intval($allowExtensions), 0, 1, 'allowExtensions provided "%s" is not a valid boolean value.');
        $allowExtensions = (bool) $allowExtensions;

        $this->allowExtensions = $allowExtensions;

        return $this;
    }

    /**
     * Get allowExtensions
     *
     * @return bool
     */
    public function getAllowExtensions(): bool
    {
        return $this->allowExtensions;
    }

    /**
     * Set noInputRouteType
     *
     * @param string $noInputRouteType | null
     *
     * @return static
     */
    protected function setNoInputRouteType(?string $noInputRouteType = null): IvrInterface
    {
        if (!is_null($noInputRouteType)) {
            Assertion::maxLength($noInputRouteType, 25, 'noInputRouteType value "%s" is too long, it should have no more than %d characters, but has %d characters.');
            Assertion::choice(
                $noInputRouteType,
                [
                    IvrInterface::NOINPUTROUTETYPE_NUMBER,
                    IvrInterface::NOINPUTROUTETYPE_EXTENSION,
                    IvrInterface::NOINPUTROUTETYPE_VOICEMAIL,
                ],
                'noInputRouteTypevalue "%s" is not an element of the valid values: %s'
            );
        }

        $this->noInputRouteType = $noInputRouteType;

        return $this;
    }

    /**
     * Get noInputRouteType
     *
     * @return string | null
     */
    public function getNoInputRouteType(): ?string
    {
        return $this->noInputRouteType;
    }

    /**
     * Set noInputNumberValue
     *
     * @param string $noInputNumberValue | null
     *
     * @return static
     */
    protected function setNoInputNumberValue(?string $noInputNumberValue = null): IvrInterface
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
    public function getNoInputNumberValue(): ?string
    {
        return $this->noInputNumberValue;
    }

    /**
     * Set errorRouteType
     *
     * @param string $errorRouteType | null
     *
     * @return static
     */
    protected function setErrorRouteType(?string $errorRouteType = null): IvrInterface
    {
        if (!is_null($errorRouteType)) {
            Assertion::maxLength($errorRouteType, 25, 'errorRouteType value "%s" is too long, it should have no more than %d characters, but has %d characters.');
            Assertion::choice(
                $errorRouteType,
                [
                    IvrInterface::ERRORROUTETYPE_NUMBER,
                    IvrInterface::ERRORROUTETYPE_EXTENSION,
                    IvrInterface::ERRORROUTETYPE_VOICEMAIL,
                ],
                'errorRouteTypevalue "%s" is not an element of the valid values: %s'
            );
        }

        $this->errorRouteType = $errorRouteType;

        return $this;
    }

    /**
     * Get errorRouteType
     *
     * @return string | null
     */
    public function getErrorRouteType(): ?string
    {
        return $this->errorRouteType;
    }

    /**
     * Set errorNumberValue
     *
     * @param string $errorNumberValue | null
     *
     * @return static
     */
    protected function setErrorNumberValue(?string $errorNumberValue = null): IvrInterface
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
    public function getErrorNumberValue(): ?string
    {
        return $this->errorNumberValue;
    }

    /**
     * Set company
     *
     * @param CompanyInterface
     *
     * @return static
     */
    protected function setCompany(CompanyInterface $company): IvrInterface
    {
        $this->company = $company;

        return $this;
    }

    /**
     * Get company
     *
     * @return CompanyInterface
     */
    public function getCompany(): CompanyInterface
    {
        return $this->company;
    }

    /**
     * Set welcomeLocution
     *
     * @param LocutionInterface | null
     *
     * @return static
     */
    protected function setWelcomeLocution(?LocutionInterface $welcomeLocution = null): IvrInterface
    {
        $this->welcomeLocution = $welcomeLocution;

        return $this;
    }

    /**
     * Get welcomeLocution
     *
     * @return LocutionInterface | null
     */
    public function getWelcomeLocution(): ?LocutionInterface
    {
        return $this->welcomeLocution;
    }

    /**
     * Set noInputLocution
     *
     * @param LocutionInterface | null
     *
     * @return static
     */
    protected function setNoInputLocution(?LocutionInterface $noInputLocution = null): IvrInterface
    {
        $this->noInputLocution = $noInputLocution;

        return $this;
    }

    /**
     * Get noInputLocution
     *
     * @return LocutionInterface | null
     */
    public function getNoInputLocution(): ?LocutionInterface
    {
        return $this->noInputLocution;
    }

    /**
     * Set errorLocution
     *
     * @param LocutionInterface | null
     *
     * @return static
     */
    protected function setErrorLocution(?LocutionInterface $errorLocution = null): IvrInterface
    {
        $this->errorLocution = $errorLocution;

        return $this;
    }

    /**
     * Get errorLocution
     *
     * @return LocutionInterface | null
     */
    public function getErrorLocution(): ?LocutionInterface
    {
        return $this->errorLocution;
    }

    /**
     * Set successLocution
     *
     * @param LocutionInterface | null
     *
     * @return static
     */
    protected function setSuccessLocution(?LocutionInterface $successLocution = null): IvrInterface
    {
        $this->successLocution = $successLocution;

        return $this;
    }

    /**
     * Get successLocution
     *
     * @return LocutionInterface | null
     */
    public function getSuccessLocution(): ?LocutionInterface
    {
        return $this->successLocution;
    }

    /**
     * Set noInputExtension
     *
     * @param ExtensionInterface | null
     *
     * @return static
     */
    protected function setNoInputExtension(?ExtensionInterface $noInputExtension = null): IvrInterface
    {
        $this->noInputExtension = $noInputExtension;

        return $this;
    }

    /**
     * Get noInputExtension
     *
     * @return ExtensionInterface | null
     */
    public function getNoInputExtension(): ?ExtensionInterface
    {
        return $this->noInputExtension;
    }

    /**
     * Set errorExtension
     *
     * @param ExtensionInterface | null
     *
     * @return static
     */
    protected function setErrorExtension(?ExtensionInterface $errorExtension = null): IvrInterface
    {
        $this->errorExtension = $errorExtension;

        return $this;
    }

    /**
     * Get errorExtension
     *
     * @return ExtensionInterface | null
     */
    public function getErrorExtension(): ?ExtensionInterface
    {
        return $this->errorExtension;
    }

    /**
     * Set noInputVoiceMailUser
     *
     * @param UserInterface | null
     *
     * @return static
     */
    protected function setNoInputVoiceMailUser(?UserInterface $noInputVoiceMailUser = null): IvrInterface
    {
        $this->noInputVoiceMailUser = $noInputVoiceMailUser;

        return $this;
    }

    /**
     * Get noInputVoiceMailUser
     *
     * @return UserInterface | null
     */
    public function getNoInputVoiceMailUser(): ?UserInterface
    {
        return $this->noInputVoiceMailUser;
    }

    /**
     * Set errorVoiceMailUser
     *
     * @param UserInterface | null
     *
     * @return static
     */
    protected function setErrorVoiceMailUser(?UserInterface $errorVoiceMailUser = null): IvrInterface
    {
        $this->errorVoiceMailUser = $errorVoiceMailUser;

        return $this;
    }

    /**
     * Get errorVoiceMailUser
     *
     * @return UserInterface | null
     */
    public function getErrorVoiceMailUser(): ?UserInterface
    {
        return $this->errorVoiceMailUser;
    }

    /**
     * Set noInputNumberCountry
     *
     * @param CountryInterface | null
     *
     * @return static
     */
    protected function setNoInputNumberCountry(?CountryInterface $noInputNumberCountry = null): IvrInterface
    {
        $this->noInputNumberCountry = $noInputNumberCountry;

        return $this;
    }

    /**
     * Get noInputNumberCountry
     *
     * @return CountryInterface | null
     */
    public function getNoInputNumberCountry(): ?CountryInterface
    {
        return $this->noInputNumberCountry;
    }

    /**
     * Set errorNumberCountry
     *
     * @param CountryInterface | null
     *
     * @return static
     */
    protected function setErrorNumberCountry(?CountryInterface $errorNumberCountry = null): IvrInterface
    {
        $this->errorNumberCountry = $errorNumberCountry;

        return $this;
    }

    /**
     * Get errorNumberCountry
     *
     * @return CountryInterface | null
     */
    public function getErrorNumberCountry(): ?CountryInterface
    {
        return $this->errorNumberCountry;
    }

}
