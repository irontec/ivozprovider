<?php

namespace Ivoz\Provider\Domain\Model\CallForwardSetting;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\Model\DtoNormalizer;
use Ivoz\Provider\Domain\Model\User\UserDto;
use Ivoz\Provider\Domain\Model\Friend\FriendDto;
use Ivoz\Provider\Domain\Model\Extension\ExtensionDto;
use Ivoz\Provider\Domain\Model\Voicemail\VoicemailDto;
use Ivoz\Provider\Domain\Model\Country\CountryDto;
use Ivoz\Provider\Domain\Model\ResidentialDevice\ResidentialDeviceDto;
use Ivoz\Provider\Domain\Model\RetailAccount\RetailAccountDto;
use Ivoz\Provider\Domain\Model\Ddi\DdiDto;

/**
* CallForwardSettingDtoAbstract
* @codeCoverageIgnore
*/
abstract class CallForwardSettingDtoAbstract implements DataTransferObjectInterface
{
    use DtoNormalizer;

    /**
     * @var string|null
     */
    private $callTypeFilter = null;

    /**
     * @var string|null
     */
    private $callForwardType = null;

    /**
     * @var string|null
     */
    private $targetType = null;

    /**
     * @var string|null
     */
    private $numberValue = null;

    /**
     * @var int|null
     */
    private $noAnswerTimeout = 10;

    /**
     * @var bool|null
     */
    private $enabled = true;

    /**
     * @var int|null
     */
    private $id = null;

    /**
     * @var UserDto | null
     */
    private $user = null;

    /**
     * @var FriendDto | null
     */
    private $friend = null;

    /**
     * @var ExtensionDto | null
     */
    private $extension = null;

    /**
     * @var VoicemailDto | null
     */
    private $voicemail = null;

    /**
     * @var CountryDto | null
     */
    private $numberCountry = null;

    /**
     * @var ResidentialDeviceDto | null
     */
    private $residentialDevice = null;

    /**
     * @var RetailAccountDto | null
     */
    private $retailAccount = null;

    /**
     * @var RetailAccountDto | null
     */
    private $cfwToRetailAccount = null;

    /**
     * @var DdiDto | null
     */
    private $ddi = null;

    public function __construct($id = null)
    {
        $this->setId($id);
    }

    /**
    * @inheritdoc
    */
    public static function getPropertyMap(string $context = '', string $role = null): array
    {
        if ($context === self::CONTEXT_COLLECTION) {
            return ['id' => 'id'];
        }

        return [
            'callTypeFilter' => 'callTypeFilter',
            'callForwardType' => 'callForwardType',
            'targetType' => 'targetType',
            'numberValue' => 'numberValue',
            'noAnswerTimeout' => 'noAnswerTimeout',
            'enabled' => 'enabled',
            'id' => 'id',
            'userId' => 'user',
            'friendId' => 'friend',
            'extensionId' => 'extension',
            'voicemailId' => 'voicemail',
            'numberCountryId' => 'numberCountry',
            'residentialDeviceId' => 'residentialDevice',
            'retailAccountId' => 'retailAccount',
            'cfwToRetailAccountId' => 'cfwToRetailAccount',
            'ddiId' => 'ddi'
        ];
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(bool $hideSensitiveData = false): array
    {
        $response = [
            'callTypeFilter' => $this->getCallTypeFilter(),
            'callForwardType' => $this->getCallForwardType(),
            'targetType' => $this->getTargetType(),
            'numberValue' => $this->getNumberValue(),
            'noAnswerTimeout' => $this->getNoAnswerTimeout(),
            'enabled' => $this->getEnabled(),
            'id' => $this->getId(),
            'user' => $this->getUser(),
            'friend' => $this->getFriend(),
            'extension' => $this->getExtension(),
            'voicemail' => $this->getVoicemail(),
            'numberCountry' => $this->getNumberCountry(),
            'residentialDevice' => $this->getResidentialDevice(),
            'retailAccount' => $this->getRetailAccount(),
            'cfwToRetailAccount' => $this->getCfwToRetailAccount(),
            'ddi' => $this->getDdi()
        ];

        if (!$hideSensitiveData) {
            return $response;
        }

        foreach ($this->sensitiveFields as $sensitiveField) {
            if (!array_key_exists($sensitiveField, $response)) {
                throw new \Exception($sensitiveField . ' field was not found');
            }
            $response[$sensitiveField] = '*****';
        }

        return $response;
    }

    public function setCallTypeFilter(string $callTypeFilter): static
    {
        $this->callTypeFilter = $callTypeFilter;

        return $this;
    }

    public function getCallTypeFilter(): ?string
    {
        return $this->callTypeFilter;
    }

    public function setCallForwardType(string $callForwardType): static
    {
        $this->callForwardType = $callForwardType;

        return $this;
    }

    public function getCallForwardType(): ?string
    {
        return $this->callForwardType;
    }

    public function setTargetType(?string $targetType): static
    {
        $this->targetType = $targetType;

        return $this;
    }

    public function getTargetType(): ?string
    {
        return $this->targetType;
    }

    public function setNumberValue(?string $numberValue): static
    {
        $this->numberValue = $numberValue;

        return $this;
    }

    public function getNumberValue(): ?string
    {
        return $this->numberValue;
    }

    public function setNoAnswerTimeout(int $noAnswerTimeout): static
    {
        $this->noAnswerTimeout = $noAnswerTimeout;

        return $this;
    }

    public function getNoAnswerTimeout(): ?int
    {
        return $this->noAnswerTimeout;
    }

    public function setEnabled(bool $enabled): static
    {
        $this->enabled = $enabled;

        return $this;
    }

    public function getEnabled(): ?bool
    {
        return $this->enabled;
    }

    public function setId($id): static
    {
        $this->id = $id;

        return $this;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setUser(?UserDto $user): static
    {
        $this->user = $user;

        return $this;
    }

    public function getUser(): ?UserDto
    {
        return $this->user;
    }

    public function setUserId($id): static
    {
        $value = !is_null($id)
            ? new UserDto($id)
            : null;

        return $this->setUser($value);
    }

    public function getUserId()
    {
        if ($dto = $this->getUser()) {
            return $dto->getId();
        }

        return null;
    }

    public function setFriend(?FriendDto $friend): static
    {
        $this->friend = $friend;

        return $this;
    }

    public function getFriend(): ?FriendDto
    {
        return $this->friend;
    }

    public function setFriendId($id): static
    {
        $value = !is_null($id)
            ? new FriendDto($id)
            : null;

        return $this->setFriend($value);
    }

    public function getFriendId()
    {
        if ($dto = $this->getFriend()) {
            return $dto->getId();
        }

        return null;
    }

    public function setExtension(?ExtensionDto $extension): static
    {
        $this->extension = $extension;

        return $this;
    }

    public function getExtension(): ?ExtensionDto
    {
        return $this->extension;
    }

    public function setExtensionId($id): static
    {
        $value = !is_null($id)
            ? new ExtensionDto($id)
            : null;

        return $this->setExtension($value);
    }

    public function getExtensionId()
    {
        if ($dto = $this->getExtension()) {
            return $dto->getId();
        }

        return null;
    }

    public function setVoicemail(?VoicemailDto $voicemail): static
    {
        $this->voicemail = $voicemail;

        return $this;
    }

    public function getVoicemail(): ?VoicemailDto
    {
        return $this->voicemail;
    }

    public function setVoicemailId($id): static
    {
        $value = !is_null($id)
            ? new VoicemailDto($id)
            : null;

        return $this->setVoicemail($value);
    }

    public function getVoicemailId()
    {
        if ($dto = $this->getVoicemail()) {
            return $dto->getId();
        }

        return null;
    }

    public function setNumberCountry(?CountryDto $numberCountry): static
    {
        $this->numberCountry = $numberCountry;

        return $this;
    }

    public function getNumberCountry(): ?CountryDto
    {
        return $this->numberCountry;
    }

    public function setNumberCountryId($id): static
    {
        $value = !is_null($id)
            ? new CountryDto($id)
            : null;

        return $this->setNumberCountry($value);
    }

    public function getNumberCountryId()
    {
        if ($dto = $this->getNumberCountry()) {
            return $dto->getId();
        }

        return null;
    }

    public function setResidentialDevice(?ResidentialDeviceDto $residentialDevice): static
    {
        $this->residentialDevice = $residentialDevice;

        return $this;
    }

    public function getResidentialDevice(): ?ResidentialDeviceDto
    {
        return $this->residentialDevice;
    }

    public function setResidentialDeviceId($id): static
    {
        $value = !is_null($id)
            ? new ResidentialDeviceDto($id)
            : null;

        return $this->setResidentialDevice($value);
    }

    public function getResidentialDeviceId()
    {
        if ($dto = $this->getResidentialDevice()) {
            return $dto->getId();
        }

        return null;
    }

    public function setRetailAccount(?RetailAccountDto $retailAccount): static
    {
        $this->retailAccount = $retailAccount;

        return $this;
    }

    public function getRetailAccount(): ?RetailAccountDto
    {
        return $this->retailAccount;
    }

    public function setRetailAccountId($id): static
    {
        $value = !is_null($id)
            ? new RetailAccountDto($id)
            : null;

        return $this->setRetailAccount($value);
    }

    public function getRetailAccountId()
    {
        if ($dto = $this->getRetailAccount()) {
            return $dto->getId();
        }

        return null;
    }

    public function setCfwToRetailAccount(?RetailAccountDto $cfwToRetailAccount): static
    {
        $this->cfwToRetailAccount = $cfwToRetailAccount;

        return $this;
    }

    public function getCfwToRetailAccount(): ?RetailAccountDto
    {
        return $this->cfwToRetailAccount;
    }

    public function setCfwToRetailAccountId($id): static
    {
        $value = !is_null($id)
            ? new RetailAccountDto($id)
            : null;

        return $this->setCfwToRetailAccount($value);
    }

    public function getCfwToRetailAccountId()
    {
        if ($dto = $this->getCfwToRetailAccount()) {
            return $dto->getId();
        }

        return null;
    }

    public function setDdi(?DdiDto $ddi): static
    {
        $this->ddi = $ddi;

        return $this;
    }

    public function getDdi(): ?DdiDto
    {
        return $this->ddi;
    }

    public function setDdiId($id): static
    {
        $value = !is_null($id)
            ? new DdiDto($id)
            : null;

        return $this->setDdi($value);
    }

    public function getDdiId()
    {
        if ($dto = $this->getDdi()) {
            return $dto->getId();
        }

        return null;
    }
}
