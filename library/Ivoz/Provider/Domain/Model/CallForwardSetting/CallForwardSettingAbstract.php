<?php

declare(strict_types=1);

namespace Ivoz\Provider\Domain\Model\CallForwardSetting;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Provider\Domain\Model\User\UserInterface;
use Ivoz\Provider\Domain\Model\Extension\ExtensionInterface;
use Ivoz\Provider\Domain\Model\Country\CountryInterface;
use Ivoz\Provider\Domain\Model\ResidentialDevice\ResidentialDeviceInterface;
use Ivoz\Provider\Domain\Model\RetailAccount\RetailAccountInterface;
use Ivoz\Provider\Domain\Model\Ddi\DdiInterface;
use Ivoz\Provider\Domain\Model\User\User;
use Ivoz\Provider\Domain\Model\Extension\Extension;
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
     * comment: enum:internal|external|both
     */
    protected $callTypeFilter;

    /**
     * comment: enum:inconditional|noAnswer|busy|userNotRegistered
     */
    protected $callForwardType;

    /**
     * comment: enum:number|extension|voicemail|retail
     */
    protected $targetType;

    protected $numberValue;

    protected $noAnswerTimeout = 10;

    protected $enabled = true;

    /**
     * @var UserInterface | null
     * inversedBy callForwardSettings
     */
    protected $user;

    /**
     * @var ExtensionInterface | null
     */
    protected $extension;

    /**
     * @var UserInterface | null
     */
    protected $voiceMailUser;

    /**
     * @var CountryInterface | null
     */
    protected $numberCountry;

    /**
     * @var ResidentialDeviceInterface | null
     * inversedBy callForwardSettings
     */
    protected $residentialDevice;

    /**
     * @var RetailAccountInterface | null
     * inversedBy callForwardSettings
     */
    protected $retailAccount;

    /**
     * @var RetailAccountInterface | null
     */
    protected $cfwToRetailAccount;

    /**
     * @var DdiInterface | null
     */
    protected $ddi;

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
     * @param mixed $id
     */
    public static function createDto($id = null): CallForwardSettingDto
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
        $dto = $entity->toDto($depth - 1);

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
            ->setRetailAccount($fkTransformer->transform($dto->getRetailAccount()))
            ->setCfwToRetailAccount($fkTransformer->transform($dto->getCfwToRetailAccount()))
            ->setDdi($fkTransformer->transform($dto->getDdi()));

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
            ->setRetailAccount($fkTransformer->transform($dto->getRetailAccount()))
            ->setCfwToRetailAccount($fkTransformer->transform($dto->getCfwToRetailAccount()))
            ->setDdi($fkTransformer->transform($dto->getDdi()));

        return $this;
    }

    /**
     * @internal use EntityTools instead
     * @param int $depth
     */
    public function toDto($depth = 0): CallForwardSettingDto
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
            ->setRetailAccount(RetailAccount::entityToDto(self::getRetailAccount(), $depth))
            ->setCfwToRetailAccount(RetailAccount::entityToDto(self::getCfwToRetailAccount(), $depth))
            ->setDdi(Ddi::entityToDto(self::getDdi(), $depth));
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
            'retailAccountId' => self::getRetailAccount() ? self::getRetailAccount()->getId() : null,
            'cfwToRetailAccountId' => self::getCfwToRetailAccount() ? self::getCfwToRetailAccount()->getId() : null,
            'ddiId' => self::getDdi() ? self::getDdi()->getId() : null
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
        Assertion::between((int) $enabled, 0, 1, 'enabled provided "%s" is not a valid boolean value.');
        $enabled = (bool) $enabled;

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

    protected function setExtension(?ExtensionInterface $extension = null): static
    {
        $this->extension = $extension;

        return $this;
    }

    public function getExtension(): ?ExtensionInterface
    {
        return $this->extension;
    }

    protected function setVoiceMailUser(?UserInterface $voiceMailUser = null): static
    {
        $this->voiceMailUser = $voiceMailUser;

        return $this;
    }

    public function getVoiceMailUser(): ?UserInterface
    {
        return $this->voiceMailUser;
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
