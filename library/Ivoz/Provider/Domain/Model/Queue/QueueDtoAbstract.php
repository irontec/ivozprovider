<?php

namespace Ivoz\Provider\Domain\Model\Queue;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\Model\DtoNormalizer;

/**
 * @codeCoverageIgnore
 */
abstract class QueueDtoAbstract implements DataTransferObjectInterface
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var integer
     */
    private $maxWaitTime;

    /**
     * @var string
     */
    private $timeoutTargetType;

    /**
     * @var string
     */
    private $timeoutNumberValue;

    /**
     * @var integer
     */
    private $maxlen;

    /**
     * @var string
     */
    private $fullTargetType;

    /**
     * @var string
     */
    private $fullNumberValue;

    /**
     * @var integer
     */
    private $periodicAnnounceFrequency;

    /**
     * @var integer
     */
    private $memberCallRest;

    /**
     * @var integer
     */
    private $memberCallTimeout;

    /**
     * @var string
     */
    private $strategy;

    /**
     * @var integer
     */
    private $weight;

    /**
     * @var integer
     */
    private $id;

    /**
     * @var \Ivoz\Provider\Domain\Model\Company\CompanyDto | null
     */
    private $company;

    /**
     * @var \Ivoz\Provider\Domain\Model\Locution\LocutionDto | null
     */
    private $periodicAnnounceLocution;

    /**
     * @var \Ivoz\Provider\Domain\Model\Locution\LocutionDto | null
     */
    private $timeoutLocution;

    /**
     * @var \Ivoz\Provider\Domain\Model\Extension\ExtensionDto | null
     */
    private $timeoutExtension;

    /**
     * @var \Ivoz\Provider\Domain\Model\User\UserDto | null
     */
    private $timeoutVoiceMailUser;

    /**
     * @var \Ivoz\Provider\Domain\Model\Locution\LocutionDto | null
     */
    private $fullLocution;

    /**
     * @var \Ivoz\Provider\Domain\Model\Extension\ExtensionDto | null
     */
    private $fullExtension;

    /**
     * @var \Ivoz\Provider\Domain\Model\User\UserDto | null
     */
    private $fullVoiceMailUser;

    /**
     * @var \Ivoz\Provider\Domain\Model\Country\CountryDto | null
     */
    private $timeoutNumberCountry;

    /**
     * @var \Ivoz\Provider\Domain\Model\Country\CountryDto | null
     */
    private $fullNumberCountry;


    use DtoNormalizer;

    public function __construct($id = null)
    {
        $this->setId($id);
    }

    /**
     * @inheritdoc
     */
    public static function getPropertyMap(string $context = '')
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
        return [
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
    }

    /**
     * @param string $name
     *
     * @return static
     */
    public function setName($name = null)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param integer $maxWaitTime
     *
     * @return static
     */
    public function setMaxWaitTime($maxWaitTime = null)
    {
        $this->maxWaitTime = $maxWaitTime;

        return $this;
    }

    /**
     * @return integer
     */
    public function getMaxWaitTime()
    {
        return $this->maxWaitTime;
    }

    /**
     * @param string $timeoutTargetType
     *
     * @return static
     */
    public function setTimeoutTargetType($timeoutTargetType = null)
    {
        $this->timeoutTargetType = $timeoutTargetType;

        return $this;
    }

    /**
     * @return string
     */
    public function getTimeoutTargetType()
    {
        return $this->timeoutTargetType;
    }

    /**
     * @param string $timeoutNumberValue
     *
     * @return static
     */
    public function setTimeoutNumberValue($timeoutNumberValue = null)
    {
        $this->timeoutNumberValue = $timeoutNumberValue;

        return $this;
    }

    /**
     * @return string
     */
    public function getTimeoutNumberValue()
    {
        return $this->timeoutNumberValue;
    }

    /**
     * @param integer $maxlen
     *
     * @return static
     */
    public function setMaxlen($maxlen = null)
    {
        $this->maxlen = $maxlen;

        return $this;
    }

    /**
     * @return integer
     */
    public function getMaxlen()
    {
        return $this->maxlen;
    }

    /**
     * @param string $fullTargetType
     *
     * @return static
     */
    public function setFullTargetType($fullTargetType = null)
    {
        $this->fullTargetType = $fullTargetType;

        return $this;
    }

    /**
     * @return string
     */
    public function getFullTargetType()
    {
        return $this->fullTargetType;
    }

    /**
     * @param string $fullNumberValue
     *
     * @return static
     */
    public function setFullNumberValue($fullNumberValue = null)
    {
        $this->fullNumberValue = $fullNumberValue;

        return $this;
    }

    /**
     * @return string
     */
    public function getFullNumberValue()
    {
        return $this->fullNumberValue;
    }

    /**
     * @param integer $periodicAnnounceFrequency
     *
     * @return static
     */
    public function setPeriodicAnnounceFrequency($periodicAnnounceFrequency = null)
    {
        $this->periodicAnnounceFrequency = $periodicAnnounceFrequency;

        return $this;
    }

    /**
     * @return integer
     */
    public function getPeriodicAnnounceFrequency()
    {
        return $this->periodicAnnounceFrequency;
    }

    /**
     * @param integer $memberCallRest
     *
     * @return static
     */
    public function setMemberCallRest($memberCallRest = null)
    {
        $this->memberCallRest = $memberCallRest;

        return $this;
    }

    /**
     * @return integer
     */
    public function getMemberCallRest()
    {
        return $this->memberCallRest;
    }

    /**
     * @param integer $memberCallTimeout
     *
     * @return static
     */
    public function setMemberCallTimeout($memberCallTimeout = null)
    {
        $this->memberCallTimeout = $memberCallTimeout;

        return $this;
    }

    /**
     * @return integer
     */
    public function getMemberCallTimeout()
    {
        return $this->memberCallTimeout;
    }

    /**
     * @param string $strategy
     *
     * @return static
     */
    public function setStrategy($strategy = null)
    {
        $this->strategy = $strategy;

        return $this;
    }

    /**
     * @return string
     */
    public function getStrategy()
    {
        return $this->strategy;
    }

    /**
     * @param integer $weight
     *
     * @return static
     */
    public function setWeight($weight = null)
    {
        $this->weight = $weight;

        return $this;
    }

    /**
     * @return integer
     */
    public function getWeight()
    {
        return $this->weight;
    }

    /**
     * @param integer $id
     *
     * @return static
     */
    public function setId($id = null)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param \Ivoz\Provider\Domain\Model\Company\CompanyDto $company
     *
     * @return static
     */
    public function setCompany(\Ivoz\Provider\Domain\Model\Company\CompanyDto $company = null)
    {
        $this->company = $company;

        return $this;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\Company\CompanyDto
     */
    public function getCompany()
    {
        return $this->company;
    }

    /**
     * @param integer $id | null
     *
     * @return static
     */
    public function setCompanyId($id)
    {
        $value = !is_null($id)
            ? new \Ivoz\Provider\Domain\Model\Company\CompanyDto($id)
            : null;

        return $this->setCompany($value);
    }

    /**
     * @return integer | null
     */
    public function getCompanyId()
    {
        if ($dto = $this->getCompany()) {
            return $dto->getId();
        }

        return null;
    }

    /**
     * @param \Ivoz\Provider\Domain\Model\Locution\LocutionDto $periodicAnnounceLocution
     *
     * @return static
     */
    public function setPeriodicAnnounceLocution(\Ivoz\Provider\Domain\Model\Locution\LocutionDto $periodicAnnounceLocution = null)
    {
        $this->periodicAnnounceLocution = $periodicAnnounceLocution;

        return $this;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\Locution\LocutionDto
     */
    public function getPeriodicAnnounceLocution()
    {
        return $this->periodicAnnounceLocution;
    }

    /**
     * @param integer $id | null
     *
     * @return static
     */
    public function setPeriodicAnnounceLocutionId($id)
    {
        $value = !is_null($id)
            ? new \Ivoz\Provider\Domain\Model\Locution\LocutionDto($id)
            : null;

        return $this->setPeriodicAnnounceLocution($value);
    }

    /**
     * @return integer | null
     */
    public function getPeriodicAnnounceLocutionId()
    {
        if ($dto = $this->getPeriodicAnnounceLocution()) {
            return $dto->getId();
        }

        return null;
    }

    /**
     * @param \Ivoz\Provider\Domain\Model\Locution\LocutionDto $timeoutLocution
     *
     * @return static
     */
    public function setTimeoutLocution(\Ivoz\Provider\Domain\Model\Locution\LocutionDto $timeoutLocution = null)
    {
        $this->timeoutLocution = $timeoutLocution;

        return $this;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\Locution\LocutionDto
     */
    public function getTimeoutLocution()
    {
        return $this->timeoutLocution;
    }

    /**
     * @param integer $id | null
     *
     * @return static
     */
    public function setTimeoutLocutionId($id)
    {
        $value = !is_null($id)
            ? new \Ivoz\Provider\Domain\Model\Locution\LocutionDto($id)
            : null;

        return $this->setTimeoutLocution($value);
    }

    /**
     * @return integer | null
     */
    public function getTimeoutLocutionId()
    {
        if ($dto = $this->getTimeoutLocution()) {
            return $dto->getId();
        }

        return null;
    }

    /**
     * @param \Ivoz\Provider\Domain\Model\Extension\ExtensionDto $timeoutExtension
     *
     * @return static
     */
    public function setTimeoutExtension(\Ivoz\Provider\Domain\Model\Extension\ExtensionDto $timeoutExtension = null)
    {
        $this->timeoutExtension = $timeoutExtension;

        return $this;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\Extension\ExtensionDto
     */
    public function getTimeoutExtension()
    {
        return $this->timeoutExtension;
    }

    /**
     * @param integer $id | null
     *
     * @return static
     */
    public function setTimeoutExtensionId($id)
    {
        $value = !is_null($id)
            ? new \Ivoz\Provider\Domain\Model\Extension\ExtensionDto($id)
            : null;

        return $this->setTimeoutExtension($value);
    }

    /**
     * @return integer | null
     */
    public function getTimeoutExtensionId()
    {
        if ($dto = $this->getTimeoutExtension()) {
            return $dto->getId();
        }

        return null;
    }

    /**
     * @param \Ivoz\Provider\Domain\Model\User\UserDto $timeoutVoiceMailUser
     *
     * @return static
     */
    public function setTimeoutVoiceMailUser(\Ivoz\Provider\Domain\Model\User\UserDto $timeoutVoiceMailUser = null)
    {
        $this->timeoutVoiceMailUser = $timeoutVoiceMailUser;

        return $this;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\User\UserDto
     */
    public function getTimeoutVoiceMailUser()
    {
        return $this->timeoutVoiceMailUser;
    }

    /**
     * @param integer $id | null
     *
     * @return static
     */
    public function setTimeoutVoiceMailUserId($id)
    {
        $value = !is_null($id)
            ? new \Ivoz\Provider\Domain\Model\User\UserDto($id)
            : null;

        return $this->setTimeoutVoiceMailUser($value);
    }

    /**
     * @return integer | null
     */
    public function getTimeoutVoiceMailUserId()
    {
        if ($dto = $this->getTimeoutVoiceMailUser()) {
            return $dto->getId();
        }

        return null;
    }

    /**
     * @param \Ivoz\Provider\Domain\Model\Locution\LocutionDto $fullLocution
     *
     * @return static
     */
    public function setFullLocution(\Ivoz\Provider\Domain\Model\Locution\LocutionDto $fullLocution = null)
    {
        $this->fullLocution = $fullLocution;

        return $this;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\Locution\LocutionDto
     */
    public function getFullLocution()
    {
        return $this->fullLocution;
    }

    /**
     * @param integer $id | null
     *
     * @return static
     */
    public function setFullLocutionId($id)
    {
        $value = !is_null($id)
            ? new \Ivoz\Provider\Domain\Model\Locution\LocutionDto($id)
            : null;

        return $this->setFullLocution($value);
    }

    /**
     * @return integer | null
     */
    public function getFullLocutionId()
    {
        if ($dto = $this->getFullLocution()) {
            return $dto->getId();
        }

        return null;
    }

    /**
     * @param \Ivoz\Provider\Domain\Model\Extension\ExtensionDto $fullExtension
     *
     * @return static
     */
    public function setFullExtension(\Ivoz\Provider\Domain\Model\Extension\ExtensionDto $fullExtension = null)
    {
        $this->fullExtension = $fullExtension;

        return $this;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\Extension\ExtensionDto
     */
    public function getFullExtension()
    {
        return $this->fullExtension;
    }

    /**
     * @param integer $id | null
     *
     * @return static
     */
    public function setFullExtensionId($id)
    {
        $value = !is_null($id)
            ? new \Ivoz\Provider\Domain\Model\Extension\ExtensionDto($id)
            : null;

        return $this->setFullExtension($value);
    }

    /**
     * @return integer | null
     */
    public function getFullExtensionId()
    {
        if ($dto = $this->getFullExtension()) {
            return $dto->getId();
        }

        return null;
    }

    /**
     * @param \Ivoz\Provider\Domain\Model\User\UserDto $fullVoiceMailUser
     *
     * @return static
     */
    public function setFullVoiceMailUser(\Ivoz\Provider\Domain\Model\User\UserDto $fullVoiceMailUser = null)
    {
        $this->fullVoiceMailUser = $fullVoiceMailUser;

        return $this;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\User\UserDto
     */
    public function getFullVoiceMailUser()
    {
        return $this->fullVoiceMailUser;
    }

    /**
     * @param integer $id | null
     *
     * @return static
     */
    public function setFullVoiceMailUserId($id)
    {
        $value = !is_null($id)
            ? new \Ivoz\Provider\Domain\Model\User\UserDto($id)
            : null;

        return $this->setFullVoiceMailUser($value);
    }

    /**
     * @return integer | null
     */
    public function getFullVoiceMailUserId()
    {
        if ($dto = $this->getFullVoiceMailUser()) {
            return $dto->getId();
        }

        return null;
    }

    /**
     * @param \Ivoz\Provider\Domain\Model\Country\CountryDto $timeoutNumberCountry
     *
     * @return static
     */
    public function setTimeoutNumberCountry(\Ivoz\Provider\Domain\Model\Country\CountryDto $timeoutNumberCountry = null)
    {
        $this->timeoutNumberCountry = $timeoutNumberCountry;

        return $this;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\Country\CountryDto
     */
    public function getTimeoutNumberCountry()
    {
        return $this->timeoutNumberCountry;
    }

    /**
     * @param integer $id | null
     *
     * @return static
     */
    public function setTimeoutNumberCountryId($id)
    {
        $value = !is_null($id)
            ? new \Ivoz\Provider\Domain\Model\Country\CountryDto($id)
            : null;

        return $this->setTimeoutNumberCountry($value);
    }

    /**
     * @return integer | null
     */
    public function getTimeoutNumberCountryId()
    {
        if ($dto = $this->getTimeoutNumberCountry()) {
            return $dto->getId();
        }

        return null;
    }

    /**
     * @param \Ivoz\Provider\Domain\Model\Country\CountryDto $fullNumberCountry
     *
     * @return static
     */
    public function setFullNumberCountry(\Ivoz\Provider\Domain\Model\Country\CountryDto $fullNumberCountry = null)
    {
        $this->fullNumberCountry = $fullNumberCountry;

        return $this;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\Country\CountryDto
     */
    public function getFullNumberCountry()
    {
        return $this->fullNumberCountry;
    }

    /**
     * @param integer $id | null
     *
     * @return static
     */
    public function setFullNumberCountryId($id)
    {
        $value = !is_null($id)
            ? new \Ivoz\Provider\Domain\Model\Country\CountryDto($id)
            : null;

        return $this->setFullNumberCountry($value);
    }

    /**
     * @return integer | null
     */
    public function getFullNumberCountryId()
    {
        if ($dto = $this->getFullNumberCountry()) {
            return $dto->getId();
        }

        return null;
    }
}
