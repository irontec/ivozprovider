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
     * @var string | null
     */
    private $name;

    /**
     * @var int | null
     */
    private $maxWaitTime;

    /**
     * @var string | null
     */
    private $timeoutTargetType;

    /**
     * @var string | null
     */
    private $timeoutNumberValue;

    /**
     * @var int | null
     */
    private $maxlen;

    /**
     * @var string | null
     */
    private $fullTargetType;

    /**
     * @var string | null
     */
    private $fullNumberValue;

    /**
     * @var int | null
     */
    private $periodicAnnounceFrequency;

    /**
     * @var int | null
     */
    private $memberCallRest;

    /**
     * @var int | null
     */
    private $memberCallTimeout;

    /**
     * @var string | null
     */
    private $strategy;

    /**
     * @var int | null
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
    public static function getPropertyMap(string $context = '', string $role = null)
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

    /**
    * @return array
    */
    public function toArray($hideSensitiveData = false)
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

    /**
     * @param string $name | null
     *
     * @return static
     */
    public function setName(?string $name = null): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param int $maxWaitTime | null
     *
     * @return static
     */
    public function setMaxWaitTime(?int $maxWaitTime = null): self
    {
        $this->maxWaitTime = $maxWaitTime;

        return $this;
    }

    /**
     * @return int | null
     */
    public function getMaxWaitTime(): ?int
    {
        return $this->maxWaitTime;
    }

    /**
     * @param string $timeoutTargetType | null
     *
     * @return static
     */
    public function setTimeoutTargetType(?string $timeoutTargetType = null): self
    {
        $this->timeoutTargetType = $timeoutTargetType;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getTimeoutTargetType(): ?string
    {
        return $this->timeoutTargetType;
    }

    /**
     * @param string $timeoutNumberValue | null
     *
     * @return static
     */
    public function setTimeoutNumberValue(?string $timeoutNumberValue = null): self
    {
        $this->timeoutNumberValue = $timeoutNumberValue;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getTimeoutNumberValue(): ?string
    {
        return $this->timeoutNumberValue;
    }

    /**
     * @param int $maxlen | null
     *
     * @return static
     */
    public function setMaxlen(?int $maxlen = null): self
    {
        $this->maxlen = $maxlen;

        return $this;
    }

    /**
     * @return int | null
     */
    public function getMaxlen(): ?int
    {
        return $this->maxlen;
    }

    /**
     * @param string $fullTargetType | null
     *
     * @return static
     */
    public function setFullTargetType(?string $fullTargetType = null): self
    {
        $this->fullTargetType = $fullTargetType;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getFullTargetType(): ?string
    {
        return $this->fullTargetType;
    }

    /**
     * @param string $fullNumberValue | null
     *
     * @return static
     */
    public function setFullNumberValue(?string $fullNumberValue = null): self
    {
        $this->fullNumberValue = $fullNumberValue;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getFullNumberValue(): ?string
    {
        return $this->fullNumberValue;
    }

    /**
     * @param int $periodicAnnounceFrequency | null
     *
     * @return static
     */
    public function setPeriodicAnnounceFrequency(?int $periodicAnnounceFrequency = null): self
    {
        $this->periodicAnnounceFrequency = $periodicAnnounceFrequency;

        return $this;
    }

    /**
     * @return int | null
     */
    public function getPeriodicAnnounceFrequency(): ?int
    {
        return $this->periodicAnnounceFrequency;
    }

    /**
     * @param int $memberCallRest | null
     *
     * @return static
     */
    public function setMemberCallRest(?int $memberCallRest = null): self
    {
        $this->memberCallRest = $memberCallRest;

        return $this;
    }

    /**
     * @return int | null
     */
    public function getMemberCallRest(): ?int
    {
        return $this->memberCallRest;
    }

    /**
     * @param int $memberCallTimeout | null
     *
     * @return static
     */
    public function setMemberCallTimeout(?int $memberCallTimeout = null): self
    {
        $this->memberCallTimeout = $memberCallTimeout;

        return $this;
    }

    /**
     * @return int | null
     */
    public function getMemberCallTimeout(): ?int
    {
        return $this->memberCallTimeout;
    }

    /**
     * @param string $strategy | null
     *
     * @return static
     */
    public function setStrategy(?string $strategy = null): self
    {
        $this->strategy = $strategy;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getStrategy(): ?string
    {
        return $this->strategy;
    }

    /**
     * @param int $weight | null
     *
     * @return static
     */
    public function setWeight(?int $weight = null): self
    {
        $this->weight = $weight;

        return $this;
    }

    /**
     * @return int | null
     */
    public function getWeight(): ?int
    {
        return $this->weight;
    }

    /**
     * @param int $preventMissedCalls | null
     *
     * @return static
     */
    public function setPreventMissedCalls(?int $preventMissedCalls = null): self
    {
        $this->preventMissedCalls = $preventMissedCalls;

        return $this;
    }

    /**
     * @return int | null
     */
    public function getPreventMissedCalls(): ?int
    {
        return $this->preventMissedCalls;
    }

    /**
     * @param int $id | null
     *
     * @return static
     */
    public function setId(?int $id = null): self
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return int | null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param CompanyDto | null
     *
     * @return static
     */
    public function setCompany(?CompanyDto $company = null): self
    {
        $this->company = $company;

        return $this;
    }

    /**
     * @return CompanyDto | null
     */
    public function getCompany(): ?CompanyDto
    {
        return $this->company;
    }

    /**
     * @return static
     */
    public function setCompanyId($id): self
    {
        $value = !is_null($id)
            ? new CompanyDto($id)
            : null;

        return $this->setCompany($value);
    }

    /**
     * @return mixed | null
     */
    public function getCompanyId()
    {
        if ($dto = $this->getCompany()) {
            return $dto->getId();
        }

        return null;
    }

    /**
     * @param LocutionDto | null
     *
     * @return static
     */
    public function setPeriodicAnnounceLocution(?LocutionDto $periodicAnnounceLocution = null): self
    {
        $this->periodicAnnounceLocution = $periodicAnnounceLocution;

        return $this;
    }

    /**
     * @return LocutionDto | null
     */
    public function getPeriodicAnnounceLocution(): ?LocutionDto
    {
        return $this->periodicAnnounceLocution;
    }

    /**
     * @return static
     */
    public function setPeriodicAnnounceLocutionId($id): self
    {
        $value = !is_null($id)
            ? new LocutionDto($id)
            : null;

        return $this->setPeriodicAnnounceLocution($value);
    }

    /**
     * @return mixed | null
     */
    public function getPeriodicAnnounceLocutionId()
    {
        if ($dto = $this->getPeriodicAnnounceLocution()) {
            return $dto->getId();
        }

        return null;
    }

    /**
     * @param LocutionDto | null
     *
     * @return static
     */
    public function setTimeoutLocution(?LocutionDto $timeoutLocution = null): self
    {
        $this->timeoutLocution = $timeoutLocution;

        return $this;
    }

    /**
     * @return LocutionDto | null
     */
    public function getTimeoutLocution(): ?LocutionDto
    {
        return $this->timeoutLocution;
    }

    /**
     * @return static
     */
    public function setTimeoutLocutionId($id): self
    {
        $value = !is_null($id)
            ? new LocutionDto($id)
            : null;

        return $this->setTimeoutLocution($value);
    }

    /**
     * @return mixed | null
     */
    public function getTimeoutLocutionId()
    {
        if ($dto = $this->getTimeoutLocution()) {
            return $dto->getId();
        }

        return null;
    }

    /**
     * @param ExtensionDto | null
     *
     * @return static
     */
    public function setTimeoutExtension(?ExtensionDto $timeoutExtension = null): self
    {
        $this->timeoutExtension = $timeoutExtension;

        return $this;
    }

    /**
     * @return ExtensionDto | null
     */
    public function getTimeoutExtension(): ?ExtensionDto
    {
        return $this->timeoutExtension;
    }

    /**
     * @return static
     */
    public function setTimeoutExtensionId($id): self
    {
        $value = !is_null($id)
            ? new ExtensionDto($id)
            : null;

        return $this->setTimeoutExtension($value);
    }

    /**
     * @return mixed | null
     */
    public function getTimeoutExtensionId()
    {
        if ($dto = $this->getTimeoutExtension()) {
            return $dto->getId();
        }

        return null;
    }

    /**
     * @param UserDto | null
     *
     * @return static
     */
    public function setTimeoutVoiceMailUser(?UserDto $timeoutVoiceMailUser = null): self
    {
        $this->timeoutVoiceMailUser = $timeoutVoiceMailUser;

        return $this;
    }

    /**
     * @return UserDto | null
     */
    public function getTimeoutVoiceMailUser(): ?UserDto
    {
        return $this->timeoutVoiceMailUser;
    }

    /**
     * @return static
     */
    public function setTimeoutVoiceMailUserId($id): self
    {
        $value = !is_null($id)
            ? new UserDto($id)
            : null;

        return $this->setTimeoutVoiceMailUser($value);
    }

    /**
     * @return mixed | null
     */
    public function getTimeoutVoiceMailUserId()
    {
        if ($dto = $this->getTimeoutVoiceMailUser()) {
            return $dto->getId();
        }

        return null;
    }

    /**
     * @param LocutionDto | null
     *
     * @return static
     */
    public function setFullLocution(?LocutionDto $fullLocution = null): self
    {
        $this->fullLocution = $fullLocution;

        return $this;
    }

    /**
     * @return LocutionDto | null
     */
    public function getFullLocution(): ?LocutionDto
    {
        return $this->fullLocution;
    }

    /**
     * @return static
     */
    public function setFullLocutionId($id): self
    {
        $value = !is_null($id)
            ? new LocutionDto($id)
            : null;

        return $this->setFullLocution($value);
    }

    /**
     * @return mixed | null
     */
    public function getFullLocutionId()
    {
        if ($dto = $this->getFullLocution()) {
            return $dto->getId();
        }

        return null;
    }

    /**
     * @param ExtensionDto | null
     *
     * @return static
     */
    public function setFullExtension(?ExtensionDto $fullExtension = null): self
    {
        $this->fullExtension = $fullExtension;

        return $this;
    }

    /**
     * @return ExtensionDto | null
     */
    public function getFullExtension(): ?ExtensionDto
    {
        return $this->fullExtension;
    }

    /**
     * @return static
     */
    public function setFullExtensionId($id): self
    {
        $value = !is_null($id)
            ? new ExtensionDto($id)
            : null;

        return $this->setFullExtension($value);
    }

    /**
     * @return mixed | null
     */
    public function getFullExtensionId()
    {
        if ($dto = $this->getFullExtension()) {
            return $dto->getId();
        }

        return null;
    }

    /**
     * @param UserDto | null
     *
     * @return static
     */
    public function setFullVoiceMailUser(?UserDto $fullVoiceMailUser = null): self
    {
        $this->fullVoiceMailUser = $fullVoiceMailUser;

        return $this;
    }

    /**
     * @return UserDto | null
     */
    public function getFullVoiceMailUser(): ?UserDto
    {
        return $this->fullVoiceMailUser;
    }

    /**
     * @return static
     */
    public function setFullVoiceMailUserId($id): self
    {
        $value = !is_null($id)
            ? new UserDto($id)
            : null;

        return $this->setFullVoiceMailUser($value);
    }

    /**
     * @return mixed | null
     */
    public function getFullVoiceMailUserId()
    {
        if ($dto = $this->getFullVoiceMailUser()) {
            return $dto->getId();
        }

        return null;
    }

    /**
     * @param CountryDto | null
     *
     * @return static
     */
    public function setTimeoutNumberCountry(?CountryDto $timeoutNumberCountry = null): self
    {
        $this->timeoutNumberCountry = $timeoutNumberCountry;

        return $this;
    }

    /**
     * @return CountryDto | null
     */
    public function getTimeoutNumberCountry(): ?CountryDto
    {
        return $this->timeoutNumberCountry;
    }

    /**
     * @return static
     */
    public function setTimeoutNumberCountryId($id): self
    {
        $value = !is_null($id)
            ? new CountryDto($id)
            : null;

        return $this->setTimeoutNumberCountry($value);
    }

    /**
     * @return mixed | null
     */
    public function getTimeoutNumberCountryId()
    {
        if ($dto = $this->getTimeoutNumberCountry()) {
            return $dto->getId();
        }

        return null;
    }

    /**
     * @param CountryDto | null
     *
     * @return static
     */
    public function setFullNumberCountry(?CountryDto $fullNumberCountry = null): self
    {
        $this->fullNumberCountry = $fullNumberCountry;

        return $this;
    }

    /**
     * @return CountryDto | null
     */
    public function getFullNumberCountry(): ?CountryDto
    {
        return $this->fullNumberCountry;
    }

    /**
     * @return static
     */
    public function setFullNumberCountryId($id): self
    {
        $value = !is_null($id)
            ? new CountryDto($id)
            : null;

        return $this->setFullNumberCountry($value);
    }

    /**
     * @return mixed | null
     */
    public function getFullNumberCountryId()
    {
        if ($dto = $this->getFullNumberCountry()) {
            return $dto->getId();
        }

        return null;
    }

}
