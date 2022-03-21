<?php

namespace Ivoz\Provider\Domain\Model\Queue;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\Model\DtoNormalizer;
use Ivoz\Provider\Domain\Model\Company\CompanyDto;
use Ivoz\Provider\Domain\Model\Locution\LocutionDto;
use Ivoz\Provider\Domain\Model\Extension\ExtensionDto;
use Ivoz\Provider\Domain\Model\Voicemail\VoicemailDto;
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
    private $name = null;

    /**
     * @var int|null
     */
    private $maxWaitTime = null;

    /**
     * @var string|null
     */
    private $timeoutTargetType = null;

    /**
     * @var string|null
     */
    private $timeoutNumberValue = null;

    /**
     * @var int|null
     */
    private $maxlen = null;

    /**
     * @var string|null
     */
    private $fullTargetType = null;

    /**
     * @var string|null
     */
    private $fullNumberValue = null;

    /**
     * @var int|null
     */
    private $periodicAnnounceFrequency = null;

    /**
     * @var int|null
     */
    private $memberCallRest = null;

    /**
     * @var int|null
     */
    private $memberCallTimeout = null;

    /**
     * @var string|null
     */
    private $strategy = null;

    /**
     * @var int|null
     */
    private $weight = null;

    /**
     * @var int|null
     */
    private $preventMissedCalls = 1;

    /**
     * @var int|null
     */
    private $id = null;

    /**
     * @var CompanyDto | null
     */
    private $company = null;

    /**
     * @var LocutionDto | null
     */
    private $periodicAnnounceLocution = null;

    /**
     * @var LocutionDto | null
     */
    private $timeoutLocution = null;

    /**
     * @var ExtensionDto | null
     */
    private $timeoutExtension = null;

    /**
     * @var VoicemailDto | null
     */
    private $timeoutVoicemail = null;

    /**
     * @var LocutionDto | null
     */
    private $fullLocution = null;

    /**
     * @var ExtensionDto | null
     */
    private $fullExtension = null;

    /**
     * @var VoicemailDto | null
     */
    private $fullVoicemail = null;

    /**
     * @var CountryDto | null
     */
    private $timeoutNumberCountry = null;

    /**
     * @var CountryDto | null
     */
    private $fullNumberCountry = null;

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
            'timeoutVoicemailId' => 'timeoutVoicemail',
            'fullLocutionId' => 'fullLocution',
            'fullExtensionId' => 'fullExtension',
            'fullVoicemailId' => 'fullVoicemail',
            'timeoutNumberCountryId' => 'timeoutNumberCountry',
            'fullNumberCountryId' => 'fullNumberCountry'
        ];
    }

    /**
     * @return array<string, mixed>
     */
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
            'timeoutVoicemail' => $this->getTimeoutVoicemail(),
            'fullLocution' => $this->getFullLocution(),
            'fullExtension' => $this->getFullExtension(),
            'fullVoicemail' => $this->getFullVoicemail(),
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

    public function getId(): ?int
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

    public function setTimeoutVoicemail(?VoicemailDto $timeoutVoicemail): static
    {
        $this->timeoutVoicemail = $timeoutVoicemail;

        return $this;
    }

    public function getTimeoutVoicemail(): ?VoicemailDto
    {
        return $this->timeoutVoicemail;
    }

    public function setTimeoutVoicemailId($id): static
    {
        $value = !is_null($id)
            ? new VoicemailDto($id)
            : null;

        return $this->setTimeoutVoicemail($value);
    }

    public function getTimeoutVoicemailId()
    {
        if ($dto = $this->getTimeoutVoicemail()) {
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

    public function setFullVoicemail(?VoicemailDto $fullVoicemail): static
    {
        $this->fullVoicemail = $fullVoicemail;

        return $this;
    }

    public function getFullVoicemail(): ?VoicemailDto
    {
        return $this->fullVoicemail;
    }

    public function setFullVoicemailId($id): static
    {
        $value = !is_null($id)
            ? new VoicemailDto($id)
            : null;

        return $this->setFullVoicemail($value);
    }

    public function getFullVoicemailId()
    {
        if ($dto = $this->getFullVoicemail()) {
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
