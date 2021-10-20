<?php

declare(strict_types=1);

namespace Ivoz\Provider\Domain\Model\Ivr;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
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

    protected $name;

    protected $timeout;

    protected $maxDigits;

    protected $allowExtensions = false;

    /**
     * comment: enum:number|extension|voicemail
     */
    protected $noInputRouteType;

    protected $noInputNumberValue;

    /**
     * comment: enum:number|extension|voicemail
     */
    protected $errorRouteType;

    protected $errorNumberValue;

    /**
     * @var CompanyInterface
     */
    protected $company;

    /**
     * @var LocutionInterface | null
     */
    protected $welcomeLocution;

    /**
     * @var LocutionInterface | null
     */
    protected $noInputLocution;

    /**
     * @var LocutionInterface | null
     */
    protected $errorLocution;

    /**
     * @var LocutionInterface | null
     */
    protected $successLocution;

    /**
     * @var ExtensionInterface | null
     */
    protected $noInputExtension;

    /**
     * @var ExtensionInterface | null
     */
    protected $errorExtension;

    /**
     * @var UserInterface | null
     */
    protected $noInputVoiceMailUser;

    /**
     * @var UserInterface | null
     */
    protected $errorVoiceMailUser;

    /**
     * @var CountryInterface | null
     */
    protected $noInputNumberCountry;

    /**
     * @var CountryInterface | null
     */
    protected $errorNumberCountry;

    /**
     * Constructor
     */
    protected function __construct(
        string $name,
        int $timeout,
        int $maxDigits,
        bool $allowExtensions
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
     * @param mixed $id
     */
    public static function createDto($id = null): IvrDto
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
        $dto = $entity->toDto($depth - 1);

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
     */
    public function toDto($depth = 0): IvrDto
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

    protected function setName(string $name): static
    {
        Assertion::maxLength($name, 50, 'name value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->name = $name;

        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    protected function setTimeout(int $timeout): static
    {
        Assertion::greaterOrEqualThan($timeout, 0, 'timeout provided "%s" is not greater or equal than "%s".');

        $this->timeout = $timeout;

        return $this;
    }

    public function getTimeout(): int
    {
        return $this->timeout;
    }

    protected function setMaxDigits(int $maxDigits): static
    {
        Assertion::greaterOrEqualThan($maxDigits, 0, 'maxDigits provided "%s" is not greater or equal than "%s".');

        $this->maxDigits = $maxDigits;

        return $this;
    }

    public function getMaxDigits(): int
    {
        return $this->maxDigits;
    }

    protected function setAllowExtensions(bool $allowExtensions): static
    {
        Assertion::between((int) $allowExtensions, 0, 1, 'allowExtensions provided "%s" is not a valid boolean value.');
        $allowExtensions = (bool) $allowExtensions;

        $this->allowExtensions = $allowExtensions;

        return $this;
    }

    public function getAllowExtensions(): bool
    {
        return $this->allowExtensions;
    }

    protected function setNoInputRouteType(?string $noInputRouteType = null): static
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

    public function getNoInputRouteType(): ?string
    {
        return $this->noInputRouteType;
    }

    protected function setNoInputNumberValue(?string $noInputNumberValue = null): static
    {
        if (!is_null($noInputNumberValue)) {
            Assertion::maxLength($noInputNumberValue, 25, 'noInputNumberValue value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->noInputNumberValue = $noInputNumberValue;

        return $this;
    }

    public function getNoInputNumberValue(): ?string
    {
        return $this->noInputNumberValue;
    }

    protected function setErrorRouteType(?string $errorRouteType = null): static
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

    public function getErrorRouteType(): ?string
    {
        return $this->errorRouteType;
    }

    protected function setErrorNumberValue(?string $errorNumberValue = null): static
    {
        if (!is_null($errorNumberValue)) {
            Assertion::maxLength($errorNumberValue, 25, 'errorNumberValue value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->errorNumberValue = $errorNumberValue;

        return $this;
    }

    public function getErrorNumberValue(): ?string
    {
        return $this->errorNumberValue;
    }

    protected function setCompany(CompanyInterface $company): static
    {
        $this->company = $company;

        return $this;
    }

    public function getCompany(): CompanyInterface
    {
        return $this->company;
    }

    protected function setWelcomeLocution(?LocutionInterface $welcomeLocution = null): static
    {
        $this->welcomeLocution = $welcomeLocution;

        return $this;
    }

    public function getWelcomeLocution(): ?LocutionInterface
    {
        return $this->welcomeLocution;
    }

    protected function setNoInputLocution(?LocutionInterface $noInputLocution = null): static
    {
        $this->noInputLocution = $noInputLocution;

        return $this;
    }

    public function getNoInputLocution(): ?LocutionInterface
    {
        return $this->noInputLocution;
    }

    protected function setErrorLocution(?LocutionInterface $errorLocution = null): static
    {
        $this->errorLocution = $errorLocution;

        return $this;
    }

    public function getErrorLocution(): ?LocutionInterface
    {
        return $this->errorLocution;
    }

    protected function setSuccessLocution(?LocutionInterface $successLocution = null): static
    {
        $this->successLocution = $successLocution;

        return $this;
    }

    public function getSuccessLocution(): ?LocutionInterface
    {
        return $this->successLocution;
    }

    protected function setNoInputExtension(?ExtensionInterface $noInputExtension = null): static
    {
        $this->noInputExtension = $noInputExtension;

        return $this;
    }

    public function getNoInputExtension(): ?ExtensionInterface
    {
        return $this->noInputExtension;
    }

    protected function setErrorExtension(?ExtensionInterface $errorExtension = null): static
    {
        $this->errorExtension = $errorExtension;

        return $this;
    }

    public function getErrorExtension(): ?ExtensionInterface
    {
        return $this->errorExtension;
    }

    protected function setNoInputVoiceMailUser(?UserInterface $noInputVoiceMailUser = null): static
    {
        $this->noInputVoiceMailUser = $noInputVoiceMailUser;

        return $this;
    }

    public function getNoInputVoiceMailUser(): ?UserInterface
    {
        return $this->noInputVoiceMailUser;
    }

    protected function setErrorVoiceMailUser(?UserInterface $errorVoiceMailUser = null): static
    {
        $this->errorVoiceMailUser = $errorVoiceMailUser;

        return $this;
    }

    public function getErrorVoiceMailUser(): ?UserInterface
    {
        return $this->errorVoiceMailUser;
    }

    protected function setNoInputNumberCountry(?CountryInterface $noInputNumberCountry = null): static
    {
        $this->noInputNumberCountry = $noInputNumberCountry;

        return $this;
    }

    public function getNoInputNumberCountry(): ?CountryInterface
    {
        return $this->noInputNumberCountry;
    }

    protected function setErrorNumberCountry(?CountryInterface $errorNumberCountry = null): static
    {
        $this->errorNumberCountry = $errorNumberCountry;

        return $this;
    }

    public function getErrorNumberCountry(): ?CountryInterface
    {
        return $this->errorNumberCountry;
    }
}
