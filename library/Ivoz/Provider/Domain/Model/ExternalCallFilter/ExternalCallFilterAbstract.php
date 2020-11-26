<?php
declare(strict_types = 1);

namespace Ivoz\Provider\Domain\Model\ExternalCallFilter;

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
* ExternalCallFilterAbstract
* @codeCoverageIgnore
*/
abstract class ExternalCallFilterAbstract
{
    use ChangelogTrait;

    /**
     * @var string
     */
    protected $name;

    /**
     * comment: enum:number|extension|voicemail
     * @var string | null
     */
    protected $holidayTargetType;

    /**
     * @var string | null
     */
    protected $holidayNumberValue;

    /**
     * comment: enum:number|extension|voicemail
     * @var string | null
     */
    protected $outOfScheduleTargetType;

    /**
     * @var string | null
     */
    protected $outOfScheduleNumberValue;

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
    protected $holidayLocution;

    /**
     * @var LocutionInterface
     */
    protected $outOfScheduleLocution;

    /**
     * @var ExtensionInterface
     */
    protected $holidayExtension;

    /**
     * @var ExtensionInterface
     */
    protected $outOfScheduleExtension;

    /**
     * @var UserInterface
     */
    protected $holidayVoiceMailUser;

    /**
     * @var UserInterface
     */
    protected $outOfScheduleVoiceMailUser;

    /**
     * @var CountryInterface
     */
    protected $holidayNumberCountry;

    /**
     * @var CountryInterface
     */
    protected $outOfScheduleNumberCountry;

    /**
     * Constructor
     */
    protected function __construct(
        $name
    ) {
        $this->setName($name);
    }

    abstract public function getId();

    public function __toString()
    {
        return sprintf(
            "%s#%s",
            "ExternalCallFilter",
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
     * @return ExternalCallFilterDto
     */
    public static function createDto($id = null)
    {
        return new ExternalCallFilterDto($id);
    }

    /**
     * @internal use EntityTools instead
     * @param ExternalCallFilterInterface|null $entity
     * @param int $depth
     * @return ExternalCallFilterDto|null
     */
    public static function entityToDto(EntityInterface $entity = null, $depth = 0)
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

        /** @var ExternalCallFilterDto $dto */
        $dto = $entity->toDto($depth-1);

        return $dto;
    }

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param ExternalCallFilterDto $dto
     * @return self
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ) {
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
     * @return self
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ) {
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
     * @param int $depth
     * @return ExternalCallFilterDto
     */
    public function toDto($depth = 0)
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

    /**
     * @return array
     */
    protected function __toArray()
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

    /**
     * Set name
     *
     * @param string $name
     *
     * @return static
     */
    protected function setName(string $name): ExternalCallFilterInterface
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
     * Set holidayTargetType
     *
     * @param string $holidayTargetType | null
     *
     * @return static
     */
    protected function setHolidayTargetType(?string $holidayTargetType = null): ExternalCallFilterInterface
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

    /**
     * Get holidayTargetType
     *
     * @return string | null
     */
    public function getHolidayTargetType(): ?string
    {
        return $this->holidayTargetType;
    }

    /**
     * Set holidayNumberValue
     *
     * @param string $holidayNumberValue | null
     *
     * @return static
     */
    protected function setHolidayNumberValue(?string $holidayNumberValue = null): ExternalCallFilterInterface
    {
        if (!is_null($holidayNumberValue)) {
            Assertion::maxLength($holidayNumberValue, 25, 'holidayNumberValue value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->holidayNumberValue = $holidayNumberValue;

        return $this;
    }

    /**
     * Get holidayNumberValue
     *
     * @return string | null
     */
    public function getHolidayNumberValue(): ?string
    {
        return $this->holidayNumberValue;
    }

    /**
     * Set outOfScheduleTargetType
     *
     * @param string $outOfScheduleTargetType | null
     *
     * @return static
     */
    protected function setOutOfScheduleTargetType(?string $outOfScheduleTargetType = null): ExternalCallFilterInterface
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

    /**
     * Get outOfScheduleTargetType
     *
     * @return string | null
     */
    public function getOutOfScheduleTargetType(): ?string
    {
        return $this->outOfScheduleTargetType;
    }

    /**
     * Set outOfScheduleNumberValue
     *
     * @param string $outOfScheduleNumberValue | null
     *
     * @return static
     */
    protected function setOutOfScheduleNumberValue(?string $outOfScheduleNumberValue = null): ExternalCallFilterInterface
    {
        if (!is_null($outOfScheduleNumberValue)) {
            Assertion::maxLength($outOfScheduleNumberValue, 25, 'outOfScheduleNumberValue value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->outOfScheduleNumberValue = $outOfScheduleNumberValue;

        return $this;
    }

    /**
     * Get outOfScheduleNumberValue
     *
     * @return string | null
     */
    public function getOutOfScheduleNumberValue(): ?string
    {
        return $this->outOfScheduleNumberValue;
    }

    /**
     * Set company
     *
     * @param CompanyInterface
     *
     * @return static
     */
    protected function setCompany(CompanyInterface $company): ExternalCallFilterInterface
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
    protected function setWelcomeLocution(?LocutionInterface $welcomeLocution = null): ExternalCallFilterInterface
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
     * Set holidayLocution
     *
     * @param LocutionInterface | null
     *
     * @return static
     */
    protected function setHolidayLocution(?LocutionInterface $holidayLocution = null): ExternalCallFilterInterface
    {
        $this->holidayLocution = $holidayLocution;

        return $this;
    }

    /**
     * Get holidayLocution
     *
     * @return LocutionInterface | null
     */
    public function getHolidayLocution(): ?LocutionInterface
    {
        return $this->holidayLocution;
    }

    /**
     * Set outOfScheduleLocution
     *
     * @param LocutionInterface | null
     *
     * @return static
     */
    protected function setOutOfScheduleLocution(?LocutionInterface $outOfScheduleLocution = null): ExternalCallFilterInterface
    {
        $this->outOfScheduleLocution = $outOfScheduleLocution;

        return $this;
    }

    /**
     * Get outOfScheduleLocution
     *
     * @return LocutionInterface | null
     */
    public function getOutOfScheduleLocution(): ?LocutionInterface
    {
        return $this->outOfScheduleLocution;
    }

    /**
     * Set holidayExtension
     *
     * @param ExtensionInterface | null
     *
     * @return static
     */
    protected function setHolidayExtension(?ExtensionInterface $holidayExtension = null): ExternalCallFilterInterface
    {
        $this->holidayExtension = $holidayExtension;

        return $this;
    }

    /**
     * Get holidayExtension
     *
     * @return ExtensionInterface | null
     */
    public function getHolidayExtension(): ?ExtensionInterface
    {
        return $this->holidayExtension;
    }

    /**
     * Set outOfScheduleExtension
     *
     * @param ExtensionInterface | null
     *
     * @return static
     */
    protected function setOutOfScheduleExtension(?ExtensionInterface $outOfScheduleExtension = null): ExternalCallFilterInterface
    {
        $this->outOfScheduleExtension = $outOfScheduleExtension;

        return $this;
    }

    /**
     * Get outOfScheduleExtension
     *
     * @return ExtensionInterface | null
     */
    public function getOutOfScheduleExtension(): ?ExtensionInterface
    {
        return $this->outOfScheduleExtension;
    }

    /**
     * Set holidayVoiceMailUser
     *
     * @param UserInterface | null
     *
     * @return static
     */
    protected function setHolidayVoiceMailUser(?UserInterface $holidayVoiceMailUser = null): ExternalCallFilterInterface
    {
        $this->holidayVoiceMailUser = $holidayVoiceMailUser;

        return $this;
    }

    /**
     * Get holidayVoiceMailUser
     *
     * @return UserInterface | null
     */
    public function getHolidayVoiceMailUser(): ?UserInterface
    {
        return $this->holidayVoiceMailUser;
    }

    /**
     * Set outOfScheduleVoiceMailUser
     *
     * @param UserInterface | null
     *
     * @return static
     */
    protected function setOutOfScheduleVoiceMailUser(?UserInterface $outOfScheduleVoiceMailUser = null): ExternalCallFilterInterface
    {
        $this->outOfScheduleVoiceMailUser = $outOfScheduleVoiceMailUser;

        return $this;
    }

    /**
     * Get outOfScheduleVoiceMailUser
     *
     * @return UserInterface | null
     */
    public function getOutOfScheduleVoiceMailUser(): ?UserInterface
    {
        return $this->outOfScheduleVoiceMailUser;
    }

    /**
     * Set holidayNumberCountry
     *
     * @param CountryInterface | null
     *
     * @return static
     */
    protected function setHolidayNumberCountry(?CountryInterface $holidayNumberCountry = null): ExternalCallFilterInterface
    {
        $this->holidayNumberCountry = $holidayNumberCountry;

        return $this;
    }

    /**
     * Get holidayNumberCountry
     *
     * @return CountryInterface | null
     */
    public function getHolidayNumberCountry(): ?CountryInterface
    {
        return $this->holidayNumberCountry;
    }

    /**
     * Set outOfScheduleNumberCountry
     *
     * @param CountryInterface | null
     *
     * @return static
     */
    protected function setOutOfScheduleNumberCountry(?CountryInterface $outOfScheduleNumberCountry = null): ExternalCallFilterInterface
    {
        $this->outOfScheduleNumberCountry = $outOfScheduleNumberCountry;

        return $this;
    }

    /**
     * Get outOfScheduleNumberCountry
     *
     * @return CountryInterface | null
     */
    public function getOutOfScheduleNumberCountry(): ?CountryInterface
    {
        return $this->outOfScheduleNumberCountry;
    }

}
