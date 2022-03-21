<?php

declare(strict_types=1);

namespace Ivoz\Provider\Domain\Model\CallForwardSetting;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Provider\Domain\Model\User\UserInterface;
use Ivoz\Provider\Domain\Model\Friend\FriendInterface;
use Ivoz\Provider\Domain\Model\Extension\ExtensionInterface;
use Ivoz\Provider\Domain\Model\Voicemail\VoicemailInterface;
use Ivoz\Provider\Domain\Model\Country\CountryInterface;
use Ivoz\Provider\Domain\Model\ResidentialDevice\ResidentialDeviceInterface;
use Ivoz\Provider\Domain\Model\RetailAccount\RetailAccountInterface;
use Ivoz\Provider\Domain\Model\Ddi\DdiInterface;
use Ivoz\Provider\Domain\Model\User\User;
use Ivoz\Provider\Domain\Model\Friend\Friend;
use Ivoz\Provider\Domain\Model\Extension\Extension;
use Ivoz\Provider\Domain\Model\Voicemail\Voicemail;
use Ivoz\Provider\Domain\Model\Country\Country;
use Ivoz\Provider\Domain\Model\ResidentialDevice\ResidentialDevice;
use Ivoz\Provider\Domain\Model\RetailAccount\RetailAccount;
use Ivoz\Provider\Domain\Model\Ddi\Ddi;

/**
* CallForwardSettingAbstract
* @codeCoverageIgnore
*/
abstract class CallForwardSettingAbstract
{
    use ChangelogTrait;

    /**
     * @var string
     * comment: enum:internal|external|both
     */
    protected $callTypeFilter;

    /**
     * @var string
     * comment: enum:inconditional|noAnswer|busy|userNotRegistered
     */
    protected $callForwardType;

    /**
     * @var ?string
     * comment: enum:number|extension|voicemail|retail
     */
    protected $targetType = null;

    /**
     * @var ?string
     */
    protected $numberValue = null;

    /**
     * @var int
     */
    protected $noAnswerTimeout = 10;

    /**
     * @var bool
     */
    protected $enabled = true;

    /**
     * @var ?UserInterface
     * inversedBy callForwardSettings
     */
    protected $user = null;

    /**
     * @var ?FriendInterface
     * inversedBy callForwardSettings
     */
    protected $friend = null;

    /**
     * @var ?ExtensionInterface
     */
    protected $extension = null;

    /**
     * @var ?VoicemailInterface
     */
    protected $voicemail = null;

    /**
     * @var ?CountryInterface
     */
    protected $numberCountry = null;

    /**
     * @var ?ResidentialDeviceInterface
     * inversedBy callForwardSettings
     */
    protected $residentialDevice = null;

    /**
     * @var ?RetailAccountInterface
     * inversedBy callForwardSettings
     */
    protected $retailAccount = null;

    /**
     * @var ?RetailAccountInterface
     */
    protected $cfwToRetailAccount = null;

    /**
     * @var ?DdiInterface
     */
    protected $ddi = null;

    /**
     * Constructor
     */
    protected function __construct(
        string $callTypeFilter,
        string $callForwardType,
        int $noAnswerTimeout,
        bool $enabled
    ) {
        $this->setCallTypeFilter($callTypeFilter);
        $this->setCallForwardType($callForwardType);
        $this->setNoAnswerTimeout($noAnswerTimeout);
        $this->setEnabled($enabled);
    }

    abstract public function getId(): null|string|int;

    public function __toString(): string
    {
        return sprintf(
            "%s#%s",
            "CallForwardSetting",
            (string) $this->getId()
        );
    }

    /**
     * @throws \Exception
     */
    protected function sanitizeValues(): void
    {
    }

    public static function createDto(string|int|null $id = null): CallForwardSettingDto
    {
        return new CallForwardSettingDto($id);
    }

    /**
     * @internal use EntityTools instead
     * @param null|CallForwardSettingInterface $entity
     */
    public static function entityToDto(?EntityInterface $entity, int $depth = 0): ?CallForwardSettingDto
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

        $dto = $entity->toDto($depth - 1);

        return $dto;
    }

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param CallForwardSettingDto $dto
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
        Assertion::isInstanceOf($dto, CallForwardSettingDto::class);
        $callTypeFilter = $dto->getCallTypeFilter();
        Assertion::notNull($callTypeFilter, 'getCallTypeFilter value is null, but non null value was expected.');
        $callForwardType = $dto->getCallForwardType();
        Assertion::notNull($callForwardType, 'getCallForwardType value is null, but non null value was expected.');
        $noAnswerTimeout = $dto->getNoAnswerTimeout();
        Assertion::notNull($noAnswerTimeout, 'getNoAnswerTimeout value is null, but non null value was expected.');
        $enabled = $dto->getEnabled();
        Assertion::notNull($enabled, 'getEnabled value is null, but non null value was expected.');

        $self = new static(
            $callTypeFilter,
            $callForwardType,
            $noAnswerTimeout,
            $enabled
        );

        $self
            ->setTargetType($dto->getTargetType())
            ->setNumberValue($dto->getNumberValue())
            ->setUser($fkTransformer->transform($dto->getUser()))
            ->setFriend($fkTransformer->transform($dto->getFriend()))
            ->setExtension($fkTransformer->transform($dto->getExtension()))
            ->setVoicemail($fkTransformer->transform($dto->getVoicemail()))
            ->setNumberCountry($fkTransformer->transform($dto->getNumberCountry()))
            ->setResidentialDevice($fkTransformer->transform($dto->getResidentialDevice()))
            ->setRetailAccount($fkTransformer->transform($dto->getRetailAccount()))
            ->setCfwToRetailAccount($fkTransformer->transform($dto->getCfwToRetailAccount()))
            ->setDdi($fkTransformer->transform($dto->getDdi()));

        $self->initChangelog();

        return $self;
    }

    /**
     * @internal use EntityTools instead
     * @param CallForwardSettingDto $dto
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
        Assertion::isInstanceOf($dto, CallForwardSettingDto::class);

        $callTypeFilter = $dto->getCallTypeFilter();
        Assertion::notNull($callTypeFilter, 'getCallTypeFilter value is null, but non null value was expected.');
        $callForwardType = $dto->getCallForwardType();
        Assertion::notNull($callForwardType, 'getCallForwardType value is null, but non null value was expected.');
        $noAnswerTimeout = $dto->getNoAnswerTimeout();
        Assertion::notNull($noAnswerTimeout, 'getNoAnswerTimeout value is null, but non null value was expected.');
        $enabled = $dto->getEnabled();
        Assertion::notNull($enabled, 'getEnabled value is null, but non null value was expected.');

        $this
            ->setCallTypeFilter($callTypeFilter)
            ->setCallForwardType($callForwardType)
            ->setTargetType($dto->getTargetType())
            ->setNumberValue($dto->getNumberValue())
            ->setNoAnswerTimeout($noAnswerTimeout)
            ->setEnabled($enabled)
            ->setUser($fkTransformer->transform($dto->getUser()))
            ->setFriend($fkTransformer->transform($dto->getFriend()))
            ->setExtension($fkTransformer->transform($dto->getExtension()))
            ->setVoicemail($fkTransformer->transform($dto->getVoicemail()))
            ->setNumberCountry($fkTransformer->transform($dto->getNumberCountry()))
            ->setResidentialDevice($fkTransformer->transform($dto->getResidentialDevice()))
            ->setRetailAccount($fkTransformer->transform($dto->getRetailAccount()))
            ->setCfwToRetailAccount($fkTransformer->transform($dto->getCfwToRetailAccount()))
            ->setDdi($fkTransformer->transform($dto->getDdi()));

        return $this;
    }

    /**
     * @internal use EntityTools instead
     */
    public function toDto(int $depth = 0): CallForwardSettingDto
    {
        return self::createDto()
            ->setCallTypeFilter(self::getCallTypeFilter())
            ->setCallForwardType(self::getCallForwardType())
            ->setTargetType(self::getTargetType())
            ->setNumberValue(self::getNumberValue())
            ->setNoAnswerTimeout(self::getNoAnswerTimeout())
            ->setEnabled(self::getEnabled())
            ->setUser(User::entityToDto(self::getUser(), $depth))
            ->setFriend(Friend::entityToDto(self::getFriend(), $depth))
            ->setExtension(Extension::entityToDto(self::getExtension(), $depth))
            ->setVoicemail(Voicemail::entityToDto(self::getVoicemail(), $depth))
            ->setNumberCountry(Country::entityToDto(self::getNumberCountry(), $depth))
            ->setResidentialDevice(ResidentialDevice::entityToDto(self::getResidentialDevice(), $depth))
            ->setRetailAccount(RetailAccount::entityToDto(self::getRetailAccount(), $depth))
            ->setCfwToRetailAccount(RetailAccount::entityToDto(self::getCfwToRetailAccount(), $depth))
            ->setDdi(Ddi::entityToDto(self::getDdi(), $depth));
    }

    protected function __toArray(): array
    {
        return [
            'callTypeFilter' => self::getCallTypeFilter(),
            'callForwardType' => self::getCallForwardType(),
            'targetType' => self::getTargetType(),
            'numberValue' => self::getNumberValue(),
            'noAnswerTimeout' => self::getNoAnswerTimeout(),
            'enabled' => self::getEnabled(),
            'userId' => self::getUser()?->getId(),
            'friendId' => self::getFriend()?->getId(),
            'extensionId' => self::getExtension()?->getId(),
            'voicemailId' => self::getVoicemail()?->getId(),
            'numberCountryId' => self::getNumberCountry()?->getId(),
            'residentialDeviceId' => self::getResidentialDevice()?->getId(),
            'retailAccountId' => self::getRetailAccount()?->getId(),
            'cfwToRetailAccountId' => self::getCfwToRetailAccount()?->getId(),
            'ddiId' => self::getDdi()?->getId()
        ];
    }

    protected function setCallTypeFilter(string $callTypeFilter): static
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

    public function getCallTypeFilter(): string
    {
        return $this->callTypeFilter;
    }

    protected function setCallForwardType(string $callForwardType): static
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

    public function getCallForwardType(): string
    {
        return $this->callForwardType;
    }

    protected function setTargetType(?string $targetType = null): static
    {
        if (!is_null($targetType)) {
            Assertion::maxLength($targetType, 25, 'targetType value "%s" is too long, it should have no more than %d characters, but has %d characters.');
            Assertion::choice(
                $targetType,
                [
                    CallForwardSettingInterface::TARGETTYPE_NUMBER,
                    CallForwardSettingInterface::TARGETTYPE_EXTENSION,
                    CallForwardSettingInterface::TARGETTYPE_VOICEMAIL,
                    CallForwardSettingInterface::TARGETTYPE_RETAIL,
                ],
                'targetTypevalue "%s" is not an element of the valid values: %s'
            );
        }

        $this->targetType = $targetType;

        return $this;
    }

    public function getTargetType(): ?string
    {
        return $this->targetType;
    }

    protected function setNumberValue(?string $numberValue = null): static
    {
        if (!is_null($numberValue)) {
            Assertion::maxLength($numberValue, 25, 'numberValue value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->numberValue = $numberValue;

        return $this;
    }

    public function getNumberValue(): ?string
    {
        return $this->numberValue;
    }

    protected function setNoAnswerTimeout(int $noAnswerTimeout): static
    {
        $this->noAnswerTimeout = $noAnswerTimeout;

        return $this;
    }

    public function getNoAnswerTimeout(): int
    {
        return $this->noAnswerTimeout;
    }

    protected function setEnabled(bool $enabled): static
    {
        $this->enabled = $enabled;

        return $this;
    }

    public function getEnabled(): bool
    {
        return $this->enabled;
    }

    public function setUser(?UserInterface $user = null): static
    {
        $this->user = $user;

        return $this;
    }

    public function getUser(): ?UserInterface
    {
        return $this->user;
    }

    public function setFriend(?FriendInterface $friend = null): static
    {
        $this->friend = $friend;

        return $this;
    }

    public function getFriend(): ?FriendInterface
    {
        return $this->friend;
    }

    protected function setExtension(?ExtensionInterface $extension = null): static
    {
        $this->extension = $extension;

        return $this;
    }

    public function getExtension(): ?ExtensionInterface
    {
        return $this->extension;
    }

    protected function setVoicemail(?VoicemailInterface $voicemail = null): static
    {
        $this->voicemail = $voicemail;

        return $this;
    }

    public function getVoicemail(): ?VoicemailInterface
    {
        return $this->voicemail;
    }

    protected function setNumberCountry(?CountryInterface $numberCountry = null): static
    {
        $this->numberCountry = $numberCountry;

        return $this;
    }

    public function getNumberCountry(): ?CountryInterface
    {
        return $this->numberCountry;
    }

    public function setResidentialDevice(?ResidentialDeviceInterface $residentialDevice = null): static
    {
        $this->residentialDevice = $residentialDevice;

        return $this;
    }

    public function getResidentialDevice(): ?ResidentialDeviceInterface
    {
        return $this->residentialDevice;
    }

    public function setRetailAccount(?RetailAccountInterface $retailAccount = null): static
    {
        $this->retailAccount = $retailAccount;

        return $this;
    }

    public function getRetailAccount(): ?RetailAccountInterface
    {
        return $this->retailAccount;
    }

    protected function setCfwToRetailAccount(?RetailAccountInterface $cfwToRetailAccount = null): static
    {
        $this->cfwToRetailAccount = $cfwToRetailAccount;

        return $this;
    }

    public function getCfwToRetailAccount(): ?RetailAccountInterface
    {
        return $this->cfwToRetailAccount;
    }

    protected function setDdi(?DdiInterface $ddi = null): static
    {
        $this->ddi = $ddi;

        return $this;
    }

    public function getDdi(): ?DdiInterface
    {
        return $this->ddi;
    }
}
