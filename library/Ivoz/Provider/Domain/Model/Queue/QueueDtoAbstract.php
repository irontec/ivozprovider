<?php

namespace Ivoz\Provider\Domain\Model\Queue;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\Model\DtoNormalizer;
use Ivoz\Provider\Domain\Model\Company\CompanyDto;
use Ivoz\Provider\Domain\Model\Locution\LocutionDto;
use Ivoz\Provider\Domain\Model\Extension\ExtensionDto;
use Ivoz\Provider\Domain\Model\User\UserDto;
use Ivoz\Provider\Domain\Model\Country\CountryDto;

/**
* QueueDtoAbstract
* @codeCoverageIgnore
*/
abstract class QueueDtoAbstract implements DataTransferObjectInterface
{
    use DtoNormalizer;

    /**
     * @var string|null
     */
    private $name;

    /**
     * @var int|null
     */
    private $maxWaitTime;

    /**
     * @var string|null
     */
    private $timeoutTargetType;

    /**
     * @var string|null
     */
    private $timeoutNumberValue;

    /**
     * @var int|null
     */
    private $maxlen;

    /**
     * @var string|null
     */
    private $fullTargetType;

    /**
     * @var string|null
     */
    private $fullNumberValue;

    /**
     * @var int|null
     */
    private $periodicAnnounceFrequency;

    /**
     * @var int|null
     */
    private $memberCallRest;

    /**
     * @var int|null
     */
    private $memberCallTimeout;

    /**
     * @var string|null
     */
    private $strategy;

    /**
     * @var int|null
     */
    private $weight;

    /**
     * @var int
     */
    private $preventMissedCalls = 1;

    /**
     * @var int
     */
    private $id;

    /**
     * @var CompanyDto | null
     */
    private $company;

    /**
     * @var LocutionDto | null
     */
    private $periodicAnnounceLocution;

    /**
     * @var LocutionDto | null
     */
    private $timeoutLocution;

    /**
     * @var ExtensionDto | null
     */
    private $timeoutExtension;

    /**
     * @var UserDto | null
     */
    private $timeoutVoiceMailUser;

    /**
     * @var LocutionDto | null
     */
    private $fullLocution;

    /**
     * @var ExtensionDto | null
     */
    private $fullExtension;

    /**
     * @var UserDto | null
     */
    private $fullVoiceMailUser;

    /**
     * @var CountryDto | null
     */
    private $timeoutNumberCountry;

    /**
     * @var CountryDto | null
     */
    private $fullNumberCountry;

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
            'name' => 'name',
            'maxWaitTime' => 'maxWaitTime',
            'timeoutTargetType' => 'timeoutTargetType',
            'timeoutNumberValue' => 'timeoutNumberValue',
            'maxlen' => 'maxlen',
            'fullTargetType' => 'fullTargetType',
            'fullNumberValue' => 'fullNumberValue',
            'periodicAnnounceFrequency' => 'periodicAnnounceFrequency',
            'memberCallRest' => 'memberCallRest',
            'memberCallTimeout' => 'memberCallTimeout',
            'strategy' => 'strategy',
            'weight' => 'weight',
            'preventMissedCalls' => 'preventMissedCalls',
            'id' => 'id',
            'companyId' => 'company',
            'periodicAnnounceLocutionId' => 'periodicAnnounceLocution',
            'timeoutLocutionId' => 'timeoutLocution',
            'timeoutExtensionId' => 'timeoutExtension',
            'timeoutVoiceMailUserId' => 'timeoutVoiceMailUser',
            'fullLocutionId' => 'fullLocution',
            'fullExtensionId' => 'fullExtension',
            'fullVoiceMailUserId' => 'fullVoiceMailUser',
            'timeoutNumberCountryId' => 'timeoutNumberCountry',
            'fullNumberCountryId' => 'fullNumberCountry'
        ];
    }

    public function toArray(bool $hideSensitiveData = false): array
    {
        $response = [
            'name' => $this->getName(),
            'maxWaitTime' => $this->getMaxWaitTime(),
            'timeoutTargetType' => $this->getTimeoutTargetType(),
            'timeoutNumberValue' => $this->getTimeoutNumberValue(),
            'maxlen' => $this->getMaxlen(),
            'fullTargetType' => $this->getFullTargetType(),
            'fullNumberValue' => $this->getFullNumberValue(),
            'periodicAnnounceFrequency' => $this->getPeriodicAnnounceFrequency(),
            'memberCallRest' => $this->getMemberCallRest(),
            'memberCallTimeout' => $this->getMemberCallTimeout(),
            'strategy' => $this->getStrategy(),
            'weight' => $this->getWeight(),
            'preventMissedCalls' => $this->getPreventMissedCalls(),
            'id' => $this->getId(),
            'company' => $this->getCompany(),
            'periodicAnnounceLocution' => $this->getPeriodicAnnounceLocution(),
            'timeoutLocution' => $this->getTimeoutLocution(),
            'timeoutExtension' => $this->getTimeoutExtension(),
            'timeoutVoiceMailUser' => $this->getTimeoutVoiceMailUser(),
            'fullLocution' => $this->getFullLocution(),
            'fullExtension' => $this->getFullExtension(),
            'fullVoiceMailUser' => $this->getFullVoiceMailUser(),
            'timeoutNumberCountry' => $this->getTimeoutNumberCountry(),
            'fullNumberCountry' => $this->getFullNumberCountry()
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

    public function setName(?string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setMaxWaitTime(?int $maxWaitTime): static
    {
        $this->maxWaitTime = $maxWaitTime;

        return $this;
    }

    public function getMaxWaitTime(): ?int
    {
        return $this->maxWaitTime;
    }

    public function setTimeoutTargetType(?string $timeoutTargetType): static
    {
        $this->timeoutTargetType = $timeoutTargetType;

        return $this;
    }

    public function getTimeoutTargetType(): ?string
    {
        return $this->timeoutTargetType;
    }

    public function setTimeoutNumberValue(?string $timeoutNumberValue): static
    {
        $this->timeoutNumberValue = $timeoutNumberValue;

        return $this;
    }

    public function getTimeoutNumberValue(): ?string
    {
        return $this->timeoutNumberValue;
    }

    public function setMaxlen(?int $maxlen): static
    {
        $this->maxlen = $maxlen;

        return $this;
    }

    public function getMaxlen(): ?int
    {
        return $this->maxlen;
    }

    public function setFullTargetType(?string $fullTargetType): static
    {
        $this->fullTargetType = $fullTargetType;

        return $this;
    }

    public function getFullTargetType(): ?string
    {
        return $this->fullTargetType;
    }

    public function setFullNumberValue(?string $fullNumberValue): static
    {
        $this->fullNumberValue = $fullNumberValue;

        return $this;
    }

    public function getFullNumberValue(): ?string
    {
        return $this->fullNumberValue;
    }

    public function setPeriodicAnnounceFrequency(?int $periodicAnnounceFrequency): static
    {
        $this->periodicAnnounceFrequency = $periodicAnnounceFrequency;

        return $this;
    }

    public function getPeriodicAnnounceFrequency(): ?int
    {
        return $this->periodicAnnounceFrequency;
    }

    public function setMemberCallRest(?int $memberCallRest): static
    {
        $this->memberCallRest = $memberCallRest;

        return $this;
    }

    public function getMemberCallRest(): ?int
    {
        return $this->memberCallRest;
    }

    public function setMemberCallTimeout(?int $memberCallTimeout): static
    {
        $this->memberCallTimeout = $memberCallTimeout;

        return $this;
    }

    public function getMemberCallTimeout(): ?int
    {
        return $this->memberCallTimeout;
    }

    public function setStrategy(?string $strategy): static
    {
        $this->strategy = $strategy;

        return $this;
    }

    public function getStrategy(): ?string
    {
        return $this->strategy;
    }

    public function setWeight(?int $weight): static
    {
        $this->weight = $weight;

        return $this;
    }

    public function getWeight(): ?int
    {
        return $this->weight;
    }

    public function setPreventMissedCalls(int $preventMissedCalls): static
    {
        $this->preventMissedCalls = $preventMissedCalls;

        return $this;
    }

    public function getPreventMissedCalls(): ?int
    {
        return $this->preventMissedCalls;
    }

    public function setId($id): static
    {
        $this->id = $id;

        return $this;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setCompany(?CompanyDto $company): static
    {
        $this->company = $company;

        return $this;
    }

    public function getCompany(): ?CompanyDto
    {
        return $this->company;
    }

    public function setCompanyId($id): static
    {
        $value = !is_null($id)
            ? new CompanyDto($id)
            : null;

        return $this->setCompany($value);
    }

    public function getCompanyId()
    {
        if ($dto = $this->getCompany()) {
            return $dto->getId();
        }

        return null;
    }

    public function setPeriodicAnnounceLocution(?LocutionDto $periodicAnnounceLocution): static
    {
        $this->periodicAnnounceLocution = $periodicAnnounceLocution;

        return $this;
    }

    public function getPeriodicAnnounceLocution(): ?LocutionDto
    {
        return $this->periodicAnnounceLocution;
    }

    public function setPeriodicAnnounceLocutionId($id): static
    {
        $value = !is_null($id)
            ? new LocutionDto($id)
            : null;

        return $this->setPeriodicAnnounceLocution($value);
    }

    public function getPeriodicAnnounceLocutionId()
    {
        if ($dto = $this->getPeriodicAnnounceLocution()) {
            return $dto->getId();
        }

        return null;
    }

    public function setTimeoutLocution(?LocutionDto $timeoutLocution): static
    {
        $this->timeoutLocution = $timeoutLocution;

        return $this;
    }

    public function getTimeoutLocution(): ?LocutionDto
    {
        return $this->timeoutLocution;
    }

    public function setTimeoutLocutionId($id): static
    {
        $value = !is_null($id)
            ? new LocutionDto($id)
            : null;

        return $this->setTimeoutLocution($value);
    }

    public function getTimeoutLocutionId()
    {
        if ($dto = $this->getTimeoutLocution()) {
            return $dto->getId();
        }

        return null;
    }

    public function setTimeoutExtension(?ExtensionDto $timeoutExtension): static
    {
        $this->timeoutExtension = $timeoutExtension;

        return $this;
    }

    public function getTimeoutExtension(): ?ExtensionDto
    {
        return $this->timeoutExtension;
    }

    public function setTimeoutExtensionId($id): static
    {
        $value = !is_null($id)
            ? new ExtensionDto($id)
            : null;

        return $this->setTimeoutExtension($value);
    }

    public function getTimeoutExtensionId()
    {
        if ($dto = $this->getTimeoutExtension()) {
            return $dto->getId();
        }

        return null;
    }

    public function setTimeoutVoiceMailUser(?UserDto $timeoutVoiceMailUser): static
    {
        $this->timeoutVoiceMailUser = $timeoutVoiceMailUser;

        return $this;
    }

    public function getTimeoutVoiceMailUser(): ?UserDto
    {
        return $this->timeoutVoiceMailUser;
    }

    public function setTimeoutVoiceMailUserId($id): static
    {
        $value = !is_null($id)
            ? new UserDto($id)
            : null;

        return $this->setTimeoutVoiceMailUser($value);
    }

    public function getTimeoutVoiceMailUserId()
    {
        if ($dto = $this->getTimeoutVoiceMailUser()) {
            return $dto->getId();
        }

        return null;
    }

    public function setFullLocution(?LocutionDto $fullLocution): static
    {
        $this->fullLocution = $fullLocution;

        return $this;
    }

    public function getFullLocution(): ?LocutionDto
    {
        return $this->fullLocution;
    }

    public function setFullLocutionId($id): static
    {
        $value = !is_null($id)
            ? new LocutionDto($id)
            : null;

        return $this->setFullLocution($value);
    }

    public function getFullLocutionId()
    {
        if ($dto = $this->getFullLocution()) {
            return $dto->getId();
        }

        return null;
    }

    public function setFullExtension(?ExtensionDto $fullExtension): static
    {
        $this->fullExtension = $fullExtension;

        return $this;
    }

    public function getFullExtension(): ?ExtensionDto
    {
        return $this->fullExtension;
    }

    public function setFullExtensionId($id): static
    {
        $value = !is_null($id)
            ? new ExtensionDto($id)
            : null;

        return $this->setFullExtension($value);
    }

    public function getFullExtensionId()
    {
        if ($dto = $this->getFullExtension()) {
            return $dto->getId();
        }

        return null;
    }

    public function setFullVoiceMailUser(?UserDto $fullVoiceMailUser): static
    {
        $this->fullVoiceMailUser = $fullVoiceMailUser;

        return $this;
    }

    public function getFullVoiceMailUser(): ?UserDto
    {
        return $this->fullVoiceMailUser;
    }

    public function setFullVoiceMailUserId($id): static
    {
        $value = !is_null($id)
            ? new UserDto($id)
            : null;

        return $this->setFullVoiceMailUser($value);
    }

    public function getFullVoiceMailUserId()
    {
        if ($dto = $this->getFullVoiceMailUser()) {
            return $dto->getId();
        }

        return null;
    }

    public function setTimeoutNumberCountry(?CountryDto $timeoutNumberCountry): static
    {
        $this->timeoutNumberCountry = $timeoutNumberCountry;

        return $this;
    }

    public function getTimeoutNumberCountry(): ?CountryDto
    {
        return $this->timeoutNumberCountry;
    }

    public function setTimeoutNumberCountryId($id): static
    {
        $value = !is_null($id)
            ? new CountryDto($id)
            : null;

        return $this->setTimeoutNumberCountry($value);
    }

    public function getTimeoutNumberCountryId()
    {
        if ($dto = $this->getTimeoutNumberCountry()) {
            return $dto->getId();
        }

        return null;
    }

    public function setFullNumberCountry(?CountryDto $fullNumberCountry): static
    {
        $this->fullNumberCountry = $fullNumberCountry;

        return $this;
    }

    public function getFullNumberCountry(): ?CountryDto
    {
        return $this->fullNumberCountry;
    }

    public function setFullNumberCountryId($id): static
    {
        $value = !is_null($id)
            ? new CountryDto($id)
            : null;

        return $this->setFullNumberCountry($value);
    }

    public function getFullNumberCountryId()
    {
        if ($dto = $this->getFullNumberCountry()) {
            return $dto->getId();
        }

        return null;
    }
}
