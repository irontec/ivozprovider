<?php

namespace Ivoz\Provider\Domain\Model\ExternalCallFilter;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;

/**
 * ExternalCallFilterAbstract
 * @codeCoverageIgnore
 */
abstract class ExternalCallFilterAbstract
{
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
     * @var \Ivoz\Provider\Domain\Model\Company\CompanyInterface
     */
    protected $company;

    /**
     * @var \Ivoz\Provider\Domain\Model\Locution\LocutionInterface | null
     */
    protected $welcomeLocution;

    /**
     * @var \Ivoz\Provider\Domain\Model\Locution\LocutionInterface | null
     */
    protected $holidayLocution;

    /**
     * @var \Ivoz\Provider\Domain\Model\Locution\LocutionInterface | null
     */
    protected $outOfScheduleLocution;

    /**
     * @var \Ivoz\Provider\Domain\Model\Extension\ExtensionInterface | null
     */
    protected $holidayExtension;

    /**
     * @var \Ivoz\Provider\Domain\Model\Extension\ExtensionInterface | null
     */
    protected $outOfScheduleExtension;

    /**
     * @var \Ivoz\Provider\Domain\Model\User\UserInterface | null
     */
    protected $holidayVoiceMailUser;

    /**
     * @var \Ivoz\Provider\Domain\Model\User\UserInterface | null
     */
    protected $outOfScheduleVoiceMailUser;

    /**
     * @var \Ivoz\Provider\Domain\Model\Country\CountryInterface | null
     */
    protected $holidayNumberCountry;

    /**
     * @var \Ivoz\Provider\Domain\Model\Country\CountryInterface | null
     */
    protected $outOfScheduleNumberCountry;


    use ChangelogTrait;

    /**
     * Constructor
     */
    protected function __construct($name)
    {
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
        \Ivoz\Core\Application\ForeignKeyTransformerInterface $fkTransformer
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
            ->setOutOfScheduleNumberCountry($fkTransformer->transform($dto->getOutOfScheduleNumberCountry()))
        ;

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
        \Ivoz\Core\Application\ForeignKeyTransformerInterface $fkTransformer
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
            ->setCompany(\Ivoz\Provider\Domain\Model\Company\Company::entityToDto(self::getCompany(), $depth))
            ->setWelcomeLocution(\Ivoz\Provider\Domain\Model\Locution\Locution::entityToDto(self::getWelcomeLocution(), $depth))
            ->setHolidayLocution(\Ivoz\Provider\Domain\Model\Locution\Locution::entityToDto(self::getHolidayLocution(), $depth))
            ->setOutOfScheduleLocution(\Ivoz\Provider\Domain\Model\Locution\Locution::entityToDto(self::getOutOfScheduleLocution(), $depth))
            ->setHolidayExtension(\Ivoz\Provider\Domain\Model\Extension\Extension::entityToDto(self::getHolidayExtension(), $depth))
            ->setOutOfScheduleExtension(\Ivoz\Provider\Domain\Model\Extension\Extension::entityToDto(self::getOutOfScheduleExtension(), $depth))
            ->setHolidayVoiceMailUser(\Ivoz\Provider\Domain\Model\User\User::entityToDto(self::getHolidayVoiceMailUser(), $depth))
            ->setOutOfScheduleVoiceMailUser(\Ivoz\Provider\Domain\Model\User\User::entityToDto(self::getOutOfScheduleVoiceMailUser(), $depth))
            ->setHolidayNumberCountry(\Ivoz\Provider\Domain\Model\Country\Country::entityToDto(self::getHolidayNumberCountry(), $depth))
            ->setOutOfScheduleNumberCountry(\Ivoz\Provider\Domain\Model\Country\Country::entityToDto(self::getOutOfScheduleNumberCountry(), $depth));
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
    // @codeCoverageIgnoreStart

    /**
     * Set name
     *
     * @param string $name
     *
     * @return static
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
    protected function setHolidayTargetType($holidayTargetType = null)
    {
        if (!is_null($holidayTargetType)) {
            Assertion::maxLength($holidayTargetType, 25, 'holidayTargetType value "%s" is too long, it should have no more than %d characters, but has %d characters.');
            Assertion::choice($holidayTargetType, [
                ExternalCallFilterInterface::HOLIDAYTARGETTYPE_NUMBER,
                ExternalCallFilterInterface::HOLIDAYTARGETTYPE_EXTENSION,
                ExternalCallFilterInterface::HOLIDAYTARGETTYPE_VOICEMAIL
            ], 'holidayTargetTypevalue "%s" is not an element of the valid values: %s');
        }

        $this->holidayTargetType = $holidayTargetType;

        return $this;
    }

    /**
     * Get holidayTargetType
     *
     * @return string | null
     */
    public function getHolidayTargetType()
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
    protected function setHolidayNumberValue($holidayNumberValue = null)
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
    public function getHolidayNumberValue()
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
    protected function setOutOfScheduleTargetType($outOfScheduleTargetType = null)
    {
        if (!is_null($outOfScheduleTargetType)) {
            Assertion::maxLength($outOfScheduleTargetType, 25, 'outOfScheduleTargetType value "%s" is too long, it should have no more than %d characters, but has %d characters.');
            Assertion::choice($outOfScheduleTargetType, [
                ExternalCallFilterInterface::OUTOFSCHEDULETARGETTYPE_NUMBER,
                ExternalCallFilterInterface::OUTOFSCHEDULETARGETTYPE_EXTENSION,
                ExternalCallFilterInterface::OUTOFSCHEDULETARGETTYPE_VOICEMAIL
            ], 'outOfScheduleTargetTypevalue "%s" is not an element of the valid values: %s');
        }

        $this->outOfScheduleTargetType = $outOfScheduleTargetType;

        return $this;
    }

    /**
     * Get outOfScheduleTargetType
     *
     * @return string | null
     */
    public function getOutOfScheduleTargetType()
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
    protected function setOutOfScheduleNumberValue($outOfScheduleNumberValue = null)
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
    public function getOutOfScheduleNumberValue()
    {
        return $this->outOfScheduleNumberValue;
    }

    /**
     * Set company
     *
     * @param \Ivoz\Provider\Domain\Model\Company\CompanyInterface $company
     *
     * @return static
     */
    protected function setCompany(\Ivoz\Provider\Domain\Model\Company\CompanyInterface $company)
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
     * @param \Ivoz\Provider\Domain\Model\Locution\LocutionInterface $welcomeLocution | null
     *
     * @return static
     */
    protected function setWelcomeLocution(\Ivoz\Provider\Domain\Model\Locution\LocutionInterface $welcomeLocution = null)
    {
        $this->welcomeLocution = $welcomeLocution;

        return $this;
    }

    /**
     * Get welcomeLocution
     *
     * @return \Ivoz\Provider\Domain\Model\Locution\LocutionInterface | null
     */
    public function getWelcomeLocution()
    {
        return $this->welcomeLocution;
    }

    /**
     * Set holidayLocution
     *
     * @param \Ivoz\Provider\Domain\Model\Locution\LocutionInterface $holidayLocution | null
     *
     * @return static
     */
    protected function setHolidayLocution(\Ivoz\Provider\Domain\Model\Locution\LocutionInterface $holidayLocution = null)
    {
        $this->holidayLocution = $holidayLocution;

        return $this;
    }

    /**
     * Get holidayLocution
     *
     * @return \Ivoz\Provider\Domain\Model\Locution\LocutionInterface | null
     */
    public function getHolidayLocution()
    {
        return $this->holidayLocution;
    }

    /**
     * Set outOfScheduleLocution
     *
     * @param \Ivoz\Provider\Domain\Model\Locution\LocutionInterface $outOfScheduleLocution | null
     *
     * @return static
     */
    protected function setOutOfScheduleLocution(\Ivoz\Provider\Domain\Model\Locution\LocutionInterface $outOfScheduleLocution = null)
    {
        $this->outOfScheduleLocution = $outOfScheduleLocution;

        return $this;
    }

    /**
     * Get outOfScheduleLocution
     *
     * @return \Ivoz\Provider\Domain\Model\Locution\LocutionInterface | null
     */
    public function getOutOfScheduleLocution()
    {
        return $this->outOfScheduleLocution;
    }

    /**
     * Set holidayExtension
     *
     * @param \Ivoz\Provider\Domain\Model\Extension\ExtensionInterface $holidayExtension | null
     *
     * @return static
     */
    protected function setHolidayExtension(\Ivoz\Provider\Domain\Model\Extension\ExtensionInterface $holidayExtension = null)
    {
        $this->holidayExtension = $holidayExtension;

        return $this;
    }

    /**
     * Get holidayExtension
     *
     * @return \Ivoz\Provider\Domain\Model\Extension\ExtensionInterface | null
     */
    public function getHolidayExtension()
    {
        return $this->holidayExtension;
    }

    /**
     * Set outOfScheduleExtension
     *
     * @param \Ivoz\Provider\Domain\Model\Extension\ExtensionInterface $outOfScheduleExtension | null
     *
     * @return static
     */
    protected function setOutOfScheduleExtension(\Ivoz\Provider\Domain\Model\Extension\ExtensionInterface $outOfScheduleExtension = null)
    {
        $this->outOfScheduleExtension = $outOfScheduleExtension;

        return $this;
    }

    /**
     * Get outOfScheduleExtension
     *
     * @return \Ivoz\Provider\Domain\Model\Extension\ExtensionInterface | null
     */
    public function getOutOfScheduleExtension()
    {
        return $this->outOfScheduleExtension;
    }

    /**
     * Set holidayVoiceMailUser
     *
     * @param \Ivoz\Provider\Domain\Model\User\UserInterface $holidayVoiceMailUser | null
     *
     * @return static
     */
    protected function setHolidayVoiceMailUser(\Ivoz\Provider\Domain\Model\User\UserInterface $holidayVoiceMailUser = null)
    {
        $this->holidayVoiceMailUser = $holidayVoiceMailUser;

        return $this;
    }

    /**
     * Get holidayVoiceMailUser
     *
     * @return \Ivoz\Provider\Domain\Model\User\UserInterface | null
     */
    public function getHolidayVoiceMailUser()
    {
        return $this->holidayVoiceMailUser;
    }

    /**
     * Set outOfScheduleVoiceMailUser
     *
     * @param \Ivoz\Provider\Domain\Model\User\UserInterface $outOfScheduleVoiceMailUser | null
     *
     * @return static
     */
    protected function setOutOfScheduleVoiceMailUser(\Ivoz\Provider\Domain\Model\User\UserInterface $outOfScheduleVoiceMailUser = null)
    {
        $this->outOfScheduleVoiceMailUser = $outOfScheduleVoiceMailUser;

        return $this;
    }

    /**
     * Get outOfScheduleVoiceMailUser
     *
     * @return \Ivoz\Provider\Domain\Model\User\UserInterface | null
     */
    public function getOutOfScheduleVoiceMailUser()
    {
        return $this->outOfScheduleVoiceMailUser;
    }

    /**
     * Set holidayNumberCountry
     *
     * @param \Ivoz\Provider\Domain\Model\Country\CountryInterface $holidayNumberCountry | null
     *
     * @return static
     */
    protected function setHolidayNumberCountry(\Ivoz\Provider\Domain\Model\Country\CountryInterface $holidayNumberCountry = null)
    {
        $this->holidayNumberCountry = $holidayNumberCountry;

        return $this;
    }

    /**
     * Get holidayNumberCountry
     *
     * @return \Ivoz\Provider\Domain\Model\Country\CountryInterface | null
     */
    public function getHolidayNumberCountry()
    {
        return $this->holidayNumberCountry;
    }

    /**
     * Set outOfScheduleNumberCountry
     *
     * @param \Ivoz\Provider\Domain\Model\Country\CountryInterface $outOfScheduleNumberCountry | null
     *
     * @return static
     */
    protected function setOutOfScheduleNumberCountry(\Ivoz\Provider\Domain\Model\Country\CountryInterface $outOfScheduleNumberCountry = null)
    {
        $this->outOfScheduleNumberCountry = $outOfScheduleNumberCountry;

        return $this;
    }

    /**
     * Get outOfScheduleNumberCountry
     *
     * @return \Ivoz\Provider\Domain\Model\Country\CountryInterface | null
     */
    public function getOutOfScheduleNumberCountry()
    {
        return $this->outOfScheduleNumberCountry;
    }

    // @codeCoverageIgnoreEnd
}
