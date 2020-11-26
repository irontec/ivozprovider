<?php
declare(strict_types = 1);

namespace Ivoz\Provider\Domain\Model\CallForwardSetting;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;
use \Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Provider\Domain\Model\User\UserInterface;
use Ivoz\Provider\Domain\Model\Extension\ExtensionInterface;
use Ivoz\Provider\Domain\Model\Country\CountryInterface;
use Ivoz\Provider\Domain\Model\ResidentialDevice\ResidentialDeviceInterface;
use Ivoz\Provider\Domain\Model\RetailAccount\RetailAccountInterface;
use Ivoz\Provider\Domain\Model\User\User;
use Ivoz\Provider\Domain\Model\Extension\Extension;
use Ivoz\Provider\Domain\Model\Country\Country;
use Ivoz\Provider\Domain\Model\ResidentialDevice\ResidentialDevice;
use Ivoz\Provider\Domain\Model\RetailAccount\RetailAccount;

/**
* CallForwardSettingAbstract
* @codeCoverageIgnore
*/
abstract class CallForwardSettingAbstract
{
    use ChangelogTrait;

    /**
     * comment: enum:internal|external|both
     * @var string
     */
    protected $callTypeFilter;

    /**
     * comment: enum:inconditional|noAnswer|busy|userNotRegistered
     * @var string
     */
    protected $callForwardType;

    /**
     * comment: enum:number|extension|voicemail
     * @var string | null
     */
    protected $targetType;

    /**
     * @var string | null
     */
    protected $numberValue;

    /**
     * @var int
     */
    protected $noAnswerTimeout = 10;

    /**
     * @var bool
     */
    protected $enabled = true;

    /**
     * @var UserInterface
     * inversedBy callForwardSettings
     */
    protected $user;

    /**
     * @var ExtensionInterface
     */
    protected $extension;

    /**
     * @var UserInterface
     */
    protected $voiceMailUser;

    /**
     * @var CountryInterface
     */
    protected $numberCountry;

    /**
     * @var ResidentialDeviceInterface
     * inversedBy callForwardSettings
     */
    protected $residentialDevice;

    /**
     * @var RetailAccountInterface
     * inversedBy callForwardSettings
     */
    protected $retailAccount;

    /**
     * Constructor
     */
    protected function __construct(
        $callTypeFilter,
        $callForwardType,
        $noAnswerTimeout,
        $enabled
    ) {
        $this->setCallTypeFilter($callTypeFilter);
        $this->setCallForwardType($callForwardType);
        $this->setNoAnswerTimeout($noAnswerTimeout);
        $this->setEnabled($enabled);
    }

    abstract public function getId();

    public function __toString()
    {
        return sprintf(
            "%s#%s",
            "CallForwardSetting",
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
     * @return CallForwardSettingDto
     */
    public static function createDto($id = null)
    {
        return new CallForwardSettingDto($id);
    }

    /**
     * @internal use EntityTools instead
     * @param CallForwardSettingInterface|null $entity
     * @param int $depth
     * @return CallForwardSettingDto|null
     */
    public static function entityToDto(EntityInterface $entity = null, $depth = 0)
    {
        if (!$entity) {
            return null;
        }

        Assertion::isInstanceOf($entity, CallForwardSettingInterface::class);

        if ($depth < 1) {
            return static::createDto($entity->getId());
        }

        if ($entity instanceof \Doctrine\ORM\Proxy\Proxy && !$entity->__isInitialized()) {
            return static::createDto($entity->getId());
        }

        /** @var CallForwardSettingDto $dto */
        $dto = $entity->toDto($depth-1);

        return $dto;
    }

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param CallForwardSettingDto $dto
     * @return self
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ) {
        Assertion::isInstanceOf($dto, CallForwardSettingDto::class);

        $self = new static(
            $dto->getCallTypeFilter(),
            $dto->getCallForwardType(),
            $dto->getNoAnswerTimeout(),
            $dto->getEnabled()
        );

        $self
            ->setTargetType($dto->getTargetType())
            ->setNumberValue($dto->getNumberValue())
            ->setUser($fkTransformer->transform($dto->getUser()))
            ->setExtension($fkTransformer->transform($dto->getExtension()))
            ->setVoiceMailUser($fkTransformer->transform($dto->getVoiceMailUser()))
            ->setNumberCountry($fkTransformer->transform($dto->getNumberCountry()))
            ->setResidentialDevice($fkTransformer->transform($dto->getResidentialDevice()))
            ->setRetailAccount($fkTransformer->transform($dto->getRetailAccount()));

        $self->initChangelog();

        return $self;
    }

    /**
     * @internal use EntityTools instead
     * @param CallForwardSettingDto $dto
     * @return self
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ) {
        Assertion::isInstanceOf($dto, CallForwardSettingDto::class);

        $this
            ->setCallTypeFilter($dto->getCallTypeFilter())
            ->setCallForwardType($dto->getCallForwardType())
            ->setTargetType($dto->getTargetType())
            ->setNumberValue($dto->getNumberValue())
            ->setNoAnswerTimeout($dto->getNoAnswerTimeout())
            ->setEnabled($dto->getEnabled())
            ->setUser($fkTransformer->transform($dto->getUser()))
            ->setExtension($fkTransformer->transform($dto->getExtension()))
            ->setVoiceMailUser($fkTransformer->transform($dto->getVoiceMailUser()))
            ->setNumberCountry($fkTransformer->transform($dto->getNumberCountry()))
            ->setResidentialDevice($fkTransformer->transform($dto->getResidentialDevice()))
            ->setRetailAccount($fkTransformer->transform($dto->getRetailAccount()));

        return $this;
    }

    /**
     * @internal use EntityTools instead
     * @param int $depth
     * @return CallForwardSettingDto
     */
    public function toDto($depth = 0)
    {
        return self::createDto()
            ->setCallTypeFilter(self::getCallTypeFilter())
            ->setCallForwardType(self::getCallForwardType())
            ->setTargetType(self::getTargetType())
            ->setNumberValue(self::getNumberValue())
            ->setNoAnswerTimeout(self::getNoAnswerTimeout())
            ->setEnabled(self::getEnabled())
            ->setUser(User::entityToDto(self::getUser(), $depth))
            ->setExtension(Extension::entityToDto(self::getExtension(), $depth))
            ->setVoiceMailUser(User::entityToDto(self::getVoiceMailUser(), $depth))
            ->setNumberCountry(Country::entityToDto(self::getNumberCountry(), $depth))
            ->setResidentialDevice(ResidentialDevice::entityToDto(self::getResidentialDevice(), $depth))
            ->setRetailAccount(RetailAccount::entityToDto(self::getRetailAccount(), $depth));
    }

    /**
     * @return array
     */
    protected function __toArray()
    {
        return [
            'callTypeFilter' => self::getCallTypeFilter(),
            'callForwardType' => self::getCallForwardType(),
            'targetType' => self::getTargetType(),
            'numberValue' => self::getNumberValue(),
            'noAnswerTimeout' => self::getNoAnswerTimeout(),
            'enabled' => self::getEnabled(),
            'userId' => self::getUser() ? self::getUser()->getId() : null,
            'extensionId' => self::getExtension() ? self::getExtension()->getId() : null,
            'voiceMailUserId' => self::getVoiceMailUser() ? self::getVoiceMailUser()->getId() : null,
            'numberCountryId' => self::getNumberCountry() ? self::getNumberCountry()->getId() : null,
            'residentialDeviceId' => self::getResidentialDevice() ? self::getResidentialDevice()->getId() : null,
            'retailAccountId' => self::getRetailAccount() ? self::getRetailAccount()->getId() : null
        ];
    }

    /**
     * Set callTypeFilter
     *
     * @param string $callTypeFilter
     *
     * @return static
     */
    protected function setCallTypeFilter(string $callTypeFilter): CallForwardSettingInterface
    {
        Assertion::maxLength($callTypeFilter, 25, 'callTypeFilter value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        Assertion::choice(
            $callTypeFilter,
            [
                CallForwardSettingInterface::CALLTYPEFILTER_INTERNAL,
                CallForwardSettingInterface::CALLTYPEFILTER_EXTERNAL,
                CallForwardSettingInterface::CALLTYPEFILTER_BOTH,
            ],
            'callTypeFiltervalue "%s" is not an element of the valid values: %s'
        );

        $this->callTypeFilter = $callTypeFilter;

        return $this;
    }

    /**
     * Get callTypeFilter
     *
     * @return string
     */
    public function getCallTypeFilter(): string
    {
        return $this->callTypeFilter;
    }

    /**
     * Set callForwardType
     *
     * @param string $callForwardType
     *
     * @return static
     */
    protected function setCallForwardType(string $callForwardType): CallForwardSettingInterface
    {
        Assertion::maxLength($callForwardType, 25, 'callForwardType value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        Assertion::choice(
            $callForwardType,
            [
                CallForwardSettingInterface::CALLFORWARDTYPE_INCONDITIONAL,
                CallForwardSettingInterface::CALLFORWARDTYPE_NOANSWER,
                CallForwardSettingInterface::CALLFORWARDTYPE_BUSY,
                CallForwardSettingInterface::CALLFORWARDTYPE_USERNOTREGISTERED,
            ],
            'callForwardTypevalue "%s" is not an element of the valid values: %s'
        );

        $this->callForwardType = $callForwardType;

        return $this;
    }

    /**
     * Get callForwardType
     *
     * @return string
     */
    public function getCallForwardType(): string
    {
        return $this->callForwardType;
    }

    /**
     * Set targetType
     *
     * @param string $targetType | null
     *
     * @return static
     */
    protected function setTargetType(?string $targetType = null): CallForwardSettingInterface
    {
        if (!is_null($targetType)) {
            Assertion::maxLength($targetType, 25, 'targetType value "%s" is too long, it should have no more than %d characters, but has %d characters.');
            Assertion::choice(
                $targetType,
                [
                    CallForwardSettingInterface::TARGETTYPE_NUMBER,
                    CallForwardSettingInterface::TARGETTYPE_EXTENSION,
                    CallForwardSettingInterface::TARGETTYPE_VOICEMAIL,
                ],
                'targetTypevalue "%s" is not an element of the valid values: %s'
            );
        }

        $this->targetType = $targetType;

        return $this;
    }

    /**
     * Get targetType
     *
     * @return string | null
     */
    public function getTargetType(): ?string
    {
        return $this->targetType;
    }

    /**
     * Set numberValue
     *
     * @param string $numberValue | null
     *
     * @return static
     */
    protected function setNumberValue(?string $numberValue = null): CallForwardSettingInterface
    {
        if (!is_null($numberValue)) {
            Assertion::maxLength($numberValue, 25, 'numberValue value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->numberValue = $numberValue;

        return $this;
    }

    /**
     * Get numberValue
     *
     * @return string | null
     */
    public function getNumberValue(): ?string
    {
        return $this->numberValue;
    }

    /**
     * Set noAnswerTimeout
     *
     * @param int $noAnswerTimeout
     *
     * @return static
     */
    protected function setNoAnswerTimeout(int $noAnswerTimeout): CallForwardSettingInterface
    {
        $this->noAnswerTimeout = $noAnswerTimeout;

        return $this;
    }

    /**
     * Get noAnswerTimeout
     *
     * @return int
     */
    public function getNoAnswerTimeout(): int
    {
        return $this->noAnswerTimeout;
    }

    /**
     * Set enabled
     *
     * @param bool $enabled
     *
     * @return static
     */
    protected function setEnabled(bool $enabled): CallForwardSettingInterface
    {
        Assertion::between(intval($enabled), 0, 1, 'enabled provided "%s" is not a valid boolean value.');
        $enabled = (bool) $enabled;

        $this->enabled = $enabled;

        return $this;
    }

    /**
     * Get enabled
     *
     * @return bool
     */
    public function getEnabled(): bool
    {
        return $this->enabled;
    }

    /**
     * Set user
     *
     * @param UserInterface | null
     *
     * @return static
     */
    public function setUser(?UserInterface $user = null): CallForwardSettingInterface
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return UserInterface | null
     */
    public function getUser(): ?UserInterface
    {
        return $this->user;
    }

    /**
     * Set extension
     *
     * @param ExtensionInterface | null
     *
     * @return static
     */
    protected function setExtension(?ExtensionInterface $extension = null): CallForwardSettingInterface
    {
        $this->extension = $extension;

        return $this;
    }

    /**
     * Get extension
     *
     * @return ExtensionInterface | null
     */
    public function getExtension(): ?ExtensionInterface
    {
        return $this->extension;
    }

    /**
     * Set voiceMailUser
     *
     * @param UserInterface | null
     *
     * @return static
     */
    protected function setVoiceMailUser(?UserInterface $voiceMailUser = null): CallForwardSettingInterface
    {
        $this->voiceMailUser = $voiceMailUser;

        return $this;
    }

    /**
     * Get voiceMailUser
     *
     * @return UserInterface | null
     */
    public function getVoiceMailUser(): ?UserInterface
    {
        return $this->voiceMailUser;
    }

    /**
     * Set numberCountry
     *
     * @param CountryInterface | null
     *
     * @return static
     */
    protected function setNumberCountry(?CountryInterface $numberCountry = null): CallForwardSettingInterface
    {
        $this->numberCountry = $numberCountry;

        return $this;
    }

    /**
     * Get numberCountry
     *
     * @return CountryInterface | null
     */
    public function getNumberCountry(): ?CountryInterface
    {
        return $this->numberCountry;
    }

    /**
     * Set residentialDevice
     *
     * @param ResidentialDeviceInterface | null
     *
     * @return static
     */
    public function setResidentialDevice(?ResidentialDeviceInterface $residentialDevice = null): CallForwardSettingInterface
    {
        $this->residentialDevice = $residentialDevice;

        return $this;
    }

    /**
     * Get residentialDevice
     *
     * @return ResidentialDeviceInterface | null
     */
    public function getResidentialDevice(): ?ResidentialDeviceInterface
    {
        return $this->residentialDevice;
    }

    /**
     * Set retailAccount
     *
     * @param RetailAccountInterface | null
     *
     * @return static
     */
    public function setRetailAccount(?RetailAccountInterface $retailAccount = null): CallForwardSettingInterface
    {
        $this->retailAccount = $retailAccount;

        return $this;
    }

    /**
     * Get retailAccount
     *
     * @return RetailAccountInterface | null
     */
    public function getRetailAccount(): ?RetailAccountInterface
    {
        return $this->retailAccount;
    }

}
