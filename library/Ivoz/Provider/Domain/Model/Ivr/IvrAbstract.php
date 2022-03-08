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
use Ivoz\Provider\Domain\Model\Voicemail\VoicemailInterface;
use Ivoz\Provider\Domain\Model\Country\CountryInterface;
use Ivoz\Provider\Domain\Model\Company\Company;
use Ivoz\Provider\Domain\Model\Locution\Locution;
use Ivoz\Provider\Domain\Model\Extension\Extension;
use Ivoz\Provider\Domain\Model\Voicemail\Voicemail;
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
     * @var ?string
     * comment: enum:number|extension|voicemail
     */
    protected $noInputRouteType = null;

    /**
     * @var ?string
     */
    protected $noInputNumberValue = null;

    /**
     * @var ?string
     * comment: enum:number|extension|voicemail
     */
    protected $errorRouteType = null;

    /**
     * @var ?string
     */
    protected $errorNumberValue = null;

    /**
     * @var CompanyInterface
     */
    protected $company;

    /**
     * @var ?LocutionInterface
     */
    protected $welcomeLocution = null;

    /**
     * @var ?LocutionInterface
     */
    protected $noInputLocution = null;

    /**
     * @var ?LocutionInterface
     */
    protected $errorLocution = null;

    /**
     * @var ?LocutionInterface
     */
    protected $successLocution = null;

    /**
     * @var ?ExtensionInterface
     */
    protected $noInputExtension = null;

    /**
     * @var ?ExtensionInterface
     */
    protected $errorExtension = null;

    /**
     * @var ?VoicemailInterface
     */
    protected $noInputVoicemail = null;

    /**
     * @var ?VoicemailInterface
     */
    protected $errorVoicemail = null;

    /**
     * @var ?CountryInterface
     */
    protected $noInputNumberCountry = null;

    /**
     * @var ?CountryInterface
     */
    protected $errorNumberCountry = null;

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

    abstract public function getId(): null|string|int;

    public function __toString(): string
    {
        return sprintf(
            "%s#%s",
            "Ivr",
            (string) $this->getId()
        );
    }

    /**
     * @throws \Exception
     */
    protected function sanitizeValues(): void
    {
    }

    public static function createDto(string|int|null $id = null): IvrDto
    {
        return new IvrDto($id);
    }

    /**
     * @internal use EntityTools instead
     * @param null|IvrInterface $entity
     */
    public static function entityToDto(?EntityInterface $entity, int $depth = 0): ?IvrDto
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

        $dto = $entity->toDto($depth - 1);

        return $dto;
    }

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param IvrDto $dto
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
        Assertion::isInstanceOf($dto, IvrDto::class);
        $name = $dto->getName();
        Assertion::notNull($name, 'getName value is null, but non null value was expected.');
        $timeout = $dto->getTimeout();
        Assertion::notNull($timeout, 'getTimeout value is null, but non null value was expected.');
        $maxDigits = $dto->getMaxDigits();
        Assertion::notNull($maxDigits, 'getMaxDigits value is null, but non null value was expected.');
        $allowExtensions = $dto->getAllowExtensions();
        Assertion::notNull($allowExtensions, 'getAllowExtensions value is null, but non null value was expected.');
        $company = $dto->getCompany();
        Assertion::notNull($company, 'getCompany value is null, but non null value was expected.');

        $self = new static(
            $name,
            $timeout,
            $maxDigits,
            $allowExtensions
        );

        $self
            ->setNoInputRouteType($dto->getNoInputRouteType())
            ->setNoInputNumberValue($dto->getNoInputNumberValue())
            ->setErrorRouteType($dto->getErrorRouteType())
            ->setErrorNumberValue($dto->getErrorNumberValue())
            ->setCompany($fkTransformer->transform($company))
            ->setWelcomeLocution($fkTransformer->transform($dto->getWelcomeLocution()))
            ->setNoInputLocution($fkTransformer->transform($dto->getNoInputLocution()))
            ->setErrorLocution($fkTransformer->transform($dto->getErrorLocution()))
            ->setSuccessLocution($fkTransformer->transform($dto->getSuccessLocution()))
            ->setNoInputExtension($fkTransformer->transform($dto->getNoInputExtension()))
            ->setErrorExtension($fkTransformer->transform($dto->getErrorExtension()))
            ->setNoInputVoicemail($fkTransformer->transform($dto->getNoInputVoicemail()))
            ->setErrorVoicemail($fkTransformer->transform($dto->getErrorVoicemail()))
            ->setNoInputNumberCountry($fkTransformer->transform($dto->getNoInputNumberCountry()))
            ->setErrorNumberCountry($fkTransformer->transform($dto->getErrorNumberCountry()));

        $self->initChangelog();

        return $self;
    }

    /**
     * @internal use EntityTools instead
     * @param IvrDto $dto
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
        Assertion::isInstanceOf($dto, IvrDto::class);

        $name = $dto->getName();
        Assertion::notNull($name, 'getName value is null, but non null value was expected.');
        $timeout = $dto->getTimeout();
        Assertion::notNull($timeout, 'getTimeout value is null, but non null value was expected.');
        $maxDigits = $dto->getMaxDigits();
        Assertion::notNull($maxDigits, 'getMaxDigits value is null, but non null value was expected.');
        $allowExtensions = $dto->getAllowExtensions();
        Assertion::notNull($allowExtensions, 'getAllowExtensions value is null, but non null value was expected.');
        $company = $dto->getCompany();
        Assertion::notNull($company, 'getCompany value is null, but non null value was expected.');

        $this
            ->setName($name)
            ->setTimeout($timeout)
            ->setMaxDigits($maxDigits)
            ->setAllowExtensions($allowExtensions)
            ->setNoInputRouteType($dto->getNoInputRouteType())
            ->setNoInputNumberValue($dto->getNoInputNumberValue())
            ->setErrorRouteType($dto->getErrorRouteType())
            ->setErrorNumberValue($dto->getErrorNumberValue())
            ->setCompany($fkTransformer->transform($company))
            ->setWelcomeLocution($fkTransformer->transform($dto->getWelcomeLocution()))
            ->setNoInputLocution($fkTransformer->transform($dto->getNoInputLocution()))
            ->setErrorLocution($fkTransformer->transform($dto->getErrorLocution()))
            ->setSuccessLocution($fkTransformer->transform($dto->getSuccessLocution()))
            ->setNoInputExtension($fkTransformer->transform($dto->getNoInputExtension()))
            ->setErrorExtension($fkTransformer->transform($dto->getErrorExtension()))
            ->setNoInputVoicemail($fkTransformer->transform($dto->getNoInputVoicemail()))
            ->setErrorVoicemail($fkTransformer->transform($dto->getErrorVoicemail()))
            ->setNoInputNumberCountry($fkTransformer->transform($dto->getNoInputNumberCountry()))
            ->setErrorNumberCountry($fkTransformer->transform($dto->getErrorNumberCountry()));

        return $this;
    }

    /**
     * @internal use EntityTools instead
     */
    public function toDto(int $depth = 0): IvrDto
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
            ->setNoInputVoicemail(Voicemail::entityToDto(self::getNoInputVoicemail(), $depth))
            ->setErrorVoicemail(Voicemail::entityToDto(self::getErrorVoicemail(), $depth))
            ->setNoInputNumberCountry(Country::entityToDto(self::getNoInputNumberCountry(), $depth))
            ->setErrorNumberCountry(Country::entityToDto(self::getErrorNumberCountry(), $depth));
    }

    protected function __toArray(): array
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
            'welcomeLocutionId' => self::getWelcomeLocution()?->getId(),
            'noInputLocutionId' => self::getNoInputLocution()?->getId(),
            'errorLocutionId' => self::getErrorLocution()?->getId(),
            'successLocutionId' => self::getSuccessLocution()?->getId(),
            'noInputExtensionId' => self::getNoInputExtension()?->getId(),
            'errorExtensionId' => self::getErrorExtension()?->getId(),
            'noInputVoicemailId' => self::getNoInputVoicemail()?->getId(),
            'errorVoicemailId' => self::getErrorVoicemail()?->getId(),
            'noInputNumberCountryId' => self::getNoInputNumberCountry()?->getId(),
            'errorNumberCountryId' => self::getErrorNumberCountry()?->getId()
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

    protected function setNoInputVoicemail(?VoicemailInterface $noInputVoicemail = null): static
    {
        $this->noInputVoicemail = $noInputVoicemail;

        return $this;
    }

    public function getNoInputVoicemail(): ?VoicemailInterface
    {
        return $this->noInputVoicemail;
    }

    protected function setErrorVoicemail(?VoicemailInterface $errorVoicemail = null): static
    {
        $this->errorVoicemail = $errorVoicemail;

        return $this;
    }

    public function getErrorVoicemail(): ?VoicemailInterface
    {
        return $this->errorVoicemail;
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
