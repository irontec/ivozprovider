<?php

declare(strict_types=1);

namespace Ivoz\Provider\Domain\Model\ExternalCallFilter;

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
* ExternalCallFilterAbstract
* @codeCoverageIgnore
*/
abstract class ExternalCallFilterAbstract
{
    use ChangelogTrait;

    protected $name;

    /**
     * comment: enum:number|extension|voicemail
     */
    protected $holidayTargetType;

    protected $holidayNumberValue;

    /**
     * comment: enum:number|extension|voicemail
     */
    protected $outOfScheduleTargetType;

    protected $outOfScheduleNumberValue;

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
    protected $holidayLocution;

    /**
     * @var LocutionInterface | null
     */
    protected $outOfScheduleLocution;

    /**
     * @var ExtensionInterface | null
     */
    protected $holidayExtension;

    /**
     * @var ExtensionInterface | null
     */
    protected $outOfScheduleExtension;

    /**
     * @var UserInterface | null
     */
    protected $holidayVoiceMailUser;

    /**
     * @var UserInterface | null
     */
    protected $outOfScheduleVoiceMailUser;

    /**
     * @var CountryInterface | null
     */
    protected $holidayNumberCountry;

    /**
     * @var CountryInterface | null
     */
    protected $outOfScheduleNumberCountry;

    /**
     * Constructor
     */
    protected function __construct(
        string $name
    ) {
        $this->setName($name);
    }

    abstract public function getId(): null|string|int;

    public function __toString(): string
    {
        return sprintf(
            "%s#%s",
            "ExternalCallFilter",
            (string) $this->getId()
        );
    }

    /**
     * @throws \Exception
     */
    protected function sanitizeValues(): void
    {
    }

    public static function createDto(string|int|null $id = null): ExternalCallFilterDto
    {
        return new ExternalCallFilterDto($id);
    }

    /**
     * @internal use EntityTools instead
     * @param null|ExternalCallFilterInterface $entity
     */
    public static function entityToDto(?EntityInterface $entity, int $depth = 0): ?ExternalCallFilterDto
    {
        if (!$entity) {
            return null;
        }

        Assertion::isInstanceOf($entity, ExternalCallFilterInterface::class);

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
     * @param ExternalCallFilterDto $dto
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
        Assertion::isInstanceOf($dto, ExternalCallFilterDto::class);

        $self = new static(
            $dto->getName()
        );

        $self
            ->setHolidayTargetType($dto->getHolidayTargetType())
            ->setHolidayNumberValue($dto->getHolidayNumberValue())
            ->setOutOfScheduleTargetType($dto->getOutOfScheduleTargetType())
            ->setOutOfScheduleNumberValue($dto->getOutOfScheduleNumberValue())
            ->setCompany($fkTransformer->transform($dto->getCompany()))
            ->setWelcomeLocution($fkTransformer->transform($dto->getWelcomeLocution()))
            ->setHolidayLocution($fkTransformer->transform($dto->getHolidayLocution()))
            ->setOutOfScheduleLocution($fkTransformer->transform($dto->getOutOfScheduleLocution()))
            ->setHolidayExtension($fkTransformer->transform($dto->getHolidayExtension()))
            ->setOutOfScheduleExtension($fkTransformer->transform($dto->getOutOfScheduleExtension()))
            ->setHolidayVoiceMailUser($fkTransformer->transform($dto->getHolidayVoiceMailUser()))
            ->setOutOfScheduleVoiceMailUser($fkTransformer->transform($dto->getOutOfScheduleVoiceMailUser()))
            ->setHolidayNumberCountry($fkTransformer->transform($dto->getHolidayNumberCountry()))
            ->setOutOfScheduleNumberCountry($fkTransformer->transform($dto->getOutOfScheduleNumberCountry()));

        $self->initChangelog();

        return $self;
    }

    /**
     * @internal use EntityTools instead
     * @param ExternalCallFilterDto $dto
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
        Assertion::isInstanceOf($dto, ExternalCallFilterDto::class);

        $this
            ->setName($dto->getName())
            ->setHolidayTargetType($dto->getHolidayTargetType())
            ->setHolidayNumberValue($dto->getHolidayNumberValue())
            ->setOutOfScheduleTargetType($dto->getOutOfScheduleTargetType())
            ->setOutOfScheduleNumberValue($dto->getOutOfScheduleNumberValue())
            ->setCompany($fkTransformer->transform($dto->getCompany()))
            ->setWelcomeLocution($fkTransformer->transform($dto->getWelcomeLocution()))
            ->setHolidayLocution($fkTransformer->transform($dto->getHolidayLocution()))
            ->setOutOfScheduleLocution($fkTransformer->transform($dto->getOutOfScheduleLocution()))
            ->setHolidayExtension($fkTransformer->transform($dto->getHolidayExtension()))
            ->setOutOfScheduleExtension($fkTransformer->transform($dto->getOutOfScheduleExtension()))
            ->setHolidayVoiceMailUser($fkTransformer->transform($dto->getHolidayVoiceMailUser()))
            ->setOutOfScheduleVoiceMailUser($fkTransformer->transform($dto->getOutOfScheduleVoiceMailUser()))
            ->setHolidayNumberCountry($fkTransformer->transform($dto->getHolidayNumberCountry()))
            ->setOutOfScheduleNumberCountry($fkTransformer->transform($dto->getOutOfScheduleNumberCountry()));

        return $this;
    }

    /**
     * @internal use EntityTools instead
     */
    public function toDto(int $depth = 0): ExternalCallFilterDto
    {
        return self::createDto()
            ->setName(self::getName())
            ->setHolidayTargetType(self::getHolidayTargetType())
            ->setHolidayNumberValue(self::getHolidayNumberValue())
            ->setOutOfScheduleTargetType(self::getOutOfScheduleTargetType())
            ->setOutOfScheduleNumberValue(self::getOutOfScheduleNumberValue())
            ->setCompany(Company::entityToDto(self::getCompany(), $depth))
            ->setWelcomeLocution(Locution::entityToDto(self::getWelcomeLocution(), $depth))
            ->setHolidayLocution(Locution::entityToDto(self::getHolidayLocution(), $depth))
            ->setOutOfScheduleLocution(Locution::entityToDto(self::getOutOfScheduleLocution(), $depth))
            ->setHolidayExtension(Extension::entityToDto(self::getHolidayExtension(), $depth))
            ->setOutOfScheduleExtension(Extension::entityToDto(self::getOutOfScheduleExtension(), $depth))
            ->setHolidayVoiceMailUser(User::entityToDto(self::getHolidayVoiceMailUser(), $depth))
            ->setOutOfScheduleVoiceMailUser(User::entityToDto(self::getOutOfScheduleVoiceMailUser(), $depth))
            ->setHolidayNumberCountry(Country::entityToDto(self::getHolidayNumberCountry(), $depth))
            ->setOutOfScheduleNumberCountry(Country::entityToDto(self::getOutOfScheduleNumberCountry(), $depth));
    }

    protected function __toArray(): array
    {
        return [
            'name' => self::getName(),
            'holidayTargetType' => self::getHolidayTargetType(),
            'holidayNumberValue' => self::getHolidayNumberValue(),
            'outOfScheduleTargetType' => self::getOutOfScheduleTargetType(),
            'outOfScheduleNumberValue' => self::getOutOfScheduleNumberValue(),
            'companyId' => self::getCompany()->getId(),
            'welcomeLocutionId' => self::getWelcomeLocution() ? self::getWelcomeLocution()->getId() : null,
            'holidayLocutionId' => self::getHolidayLocution() ? self::getHolidayLocution()->getId() : null,
            'outOfScheduleLocutionId' => self::getOutOfScheduleLocution() ? self::getOutOfScheduleLocution()->getId() : null,
            'holidayExtensionId' => self::getHolidayExtension() ? self::getHolidayExtension()->getId() : null,
            'outOfScheduleExtensionId' => self::getOutOfScheduleExtension() ? self::getOutOfScheduleExtension()->getId() : null,
            'holidayVoiceMailUserId' => self::getHolidayVoiceMailUser() ? self::getHolidayVoiceMailUser()->getId() : null,
            'outOfScheduleVoiceMailUserId' => self::getOutOfScheduleVoiceMailUser() ? self::getOutOfScheduleVoiceMailUser()->getId() : null,
            'holidayNumberCountryId' => self::getHolidayNumberCountry() ? self::getHolidayNumberCountry()->getId() : null,
            'outOfScheduleNumberCountryId' => self::getOutOfScheduleNumberCountry() ? self::getOutOfScheduleNumberCountry()->getId() : null
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

    protected function setHolidayTargetType(?string $holidayTargetType = null): static
    {
        if (!is_null($holidayTargetType)) {
            Assertion::maxLength($holidayTargetType, 25, 'holidayTargetType value "%s" is too long, it should have no more than %d characters, but has %d characters.');
            Assertion::choice(
                $holidayTargetType,
                [
                    ExternalCallFilterInterface::HOLIDAYTARGETTYPE_NUMBER,
                    ExternalCallFilterInterface::HOLIDAYTARGETTYPE_EXTENSION,
                    ExternalCallFilterInterface::HOLIDAYTARGETTYPE_VOICEMAIL,
                ],
                'holidayTargetTypevalue "%s" is not an element of the valid values: %s'
            );
        }

        $this->holidayTargetType = $holidayTargetType;

        return $this;
    }

    public function getHolidayTargetType(): ?string
    {
        return $this->holidayTargetType;
    }

    protected function setHolidayNumberValue(?string $holidayNumberValue = null): static
    {
        if (!is_null($holidayNumberValue)) {
            Assertion::maxLength($holidayNumberValue, 25, 'holidayNumberValue value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->holidayNumberValue = $holidayNumberValue;

        return $this;
    }

    public function getHolidayNumberValue(): ?string
    {
        return $this->holidayNumberValue;
    }

    protected function setOutOfScheduleTargetType(?string $outOfScheduleTargetType = null): static
    {
        if (!is_null($outOfScheduleTargetType)) {
            Assertion::maxLength($outOfScheduleTargetType, 25, 'outOfScheduleTargetType value "%s" is too long, it should have no more than %d characters, but has %d characters.');
            Assertion::choice(
                $outOfScheduleTargetType,
                [
                    ExternalCallFilterInterface::OUTOFSCHEDULETARGETTYPE_NUMBER,
                    ExternalCallFilterInterface::OUTOFSCHEDULETARGETTYPE_EXTENSION,
                    ExternalCallFilterInterface::OUTOFSCHEDULETARGETTYPE_VOICEMAIL,
                ],
                'outOfScheduleTargetTypevalue "%s" is not an element of the valid values: %s'
            );
        }

        $this->outOfScheduleTargetType = $outOfScheduleTargetType;

        return $this;
    }

    public function getOutOfScheduleTargetType(): ?string
    {
        return $this->outOfScheduleTargetType;
    }

    protected function setOutOfScheduleNumberValue(?string $outOfScheduleNumberValue = null): static
    {
        if (!is_null($outOfScheduleNumberValue)) {
            Assertion::maxLength($outOfScheduleNumberValue, 25, 'outOfScheduleNumberValue value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->outOfScheduleNumberValue = $outOfScheduleNumberValue;

        return $this;
    }

    public function getOutOfScheduleNumberValue(): ?string
    {
        return $this->outOfScheduleNumberValue;
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

    protected function setHolidayLocution(?LocutionInterface $holidayLocution = null): static
    {
        $this->holidayLocution = $holidayLocution;

        return $this;
    }

    public function getHolidayLocution(): ?LocutionInterface
    {
        return $this->holidayLocution;
    }

    protected function setOutOfScheduleLocution(?LocutionInterface $outOfScheduleLocution = null): static
    {
        $this->outOfScheduleLocution = $outOfScheduleLocution;

        return $this;
    }

    public function getOutOfScheduleLocution(): ?LocutionInterface
    {
        return $this->outOfScheduleLocution;
    }

    protected function setHolidayExtension(?ExtensionInterface $holidayExtension = null): static
    {
        $this->holidayExtension = $holidayExtension;

        return $this;
    }

    public function getHolidayExtension(): ?ExtensionInterface
    {
        return $this->holidayExtension;
    }

    protected function setOutOfScheduleExtension(?ExtensionInterface $outOfScheduleExtension = null): static
    {
        $this->outOfScheduleExtension = $outOfScheduleExtension;

        return $this;
    }

    public function getOutOfScheduleExtension(): ?ExtensionInterface
    {
        return $this->outOfScheduleExtension;
    }

    protected function setHolidayVoiceMailUser(?UserInterface $holidayVoiceMailUser = null): static
    {
        $this->holidayVoiceMailUser = $holidayVoiceMailUser;

        return $this;
    }

    public function getHolidayVoiceMailUser(): ?UserInterface
    {
        return $this->holidayVoiceMailUser;
    }

    protected function setOutOfScheduleVoiceMailUser(?UserInterface $outOfScheduleVoiceMailUser = null): static
    {
        $this->outOfScheduleVoiceMailUser = $outOfScheduleVoiceMailUser;

        return $this;
    }

    public function getOutOfScheduleVoiceMailUser(): ?UserInterface
    {
        return $this->outOfScheduleVoiceMailUser;
    }

    protected function setHolidayNumberCountry(?CountryInterface $holidayNumberCountry = null): static
    {
        $this->holidayNumberCountry = $holidayNumberCountry;

        return $this;
    }

    public function getHolidayNumberCountry(): ?CountryInterface
    {
        return $this->holidayNumberCountry;
    }

    protected function setOutOfScheduleNumberCountry(?CountryInterface $outOfScheduleNumberCountry = null): static
    {
        $this->outOfScheduleNumberCountry = $outOfScheduleNumberCountry;

        return $this;
    }

    public function getOutOfScheduleNumberCountry(): ?CountryInterface
    {
        return $this->outOfScheduleNumberCountry;
    }
}
