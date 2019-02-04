<?php

namespace Ivoz\Provider\Domain\Model\Queue;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;

/**
 * QueueAbstract
 * @codeCoverageIgnore
 */
abstract class QueueAbstract
{
    /**
     * @var string | null
     */
    protected $name;

    /**
     * @var integer | null
     */
    protected $maxWaitTime;

    /**
     * comment: enum:number|extension|voicemail
     * @var string | null
     */
    protected $timeoutTargetType;

    /**
     * @var string | null
     */
    protected $timeoutNumberValue;

    /**
     * @var integer | null
     */
    protected $maxlen;

    /**
     * comment: enum:number|extension|voicemail
     * @var string | null
     */
    protected $fullTargetType;

    /**
     * @var string | null
     */
    protected $fullNumberValue;

    /**
     * @var integer | null
     */
    protected $periodicAnnounceFrequency;

    /**
     * @var integer | null
     */
    protected $memberCallRest;

    /**
     * @var integer | null
     */
    protected $memberCallTimeout;

    /**
     * @var string | null
     */
    protected $strategy;

    /**
     * @var integer | null
     */
    protected $weight;

    /**
     * @var \Ivoz\Provider\Domain\Model\Company\CompanyInterface
     */
    protected $company;

    /**
     * @var \Ivoz\Provider\Domain\Model\Locution\LocutionInterface
     */
    protected $periodicAnnounceLocution;

    /**
     * @var \Ivoz\Provider\Domain\Model\Locution\LocutionInterface
     */
    protected $timeoutLocution;

    /**
     * @var \Ivoz\Provider\Domain\Model\Extension\ExtensionInterface
     */
    protected $timeoutExtension;

    /**
     * @var \Ivoz\Provider\Domain\Model\User\UserInterface
     */
    protected $timeoutVoiceMailUser;

    /**
     * @var \Ivoz\Provider\Domain\Model\Locution\LocutionInterface
     */
    protected $fullLocution;

    /**
     * @var \Ivoz\Provider\Domain\Model\Extension\ExtensionInterface
     */
    protected $fullExtension;

    /**
     * @var \Ivoz\Provider\Domain\Model\User\UserInterface
     */
    protected $fullVoiceMailUser;

    /**
     * @var \Ivoz\Provider\Domain\Model\Country\CountryInterface
     */
    protected $timeoutNumberCountry;

    /**
     * @var \Ivoz\Provider\Domain\Model\Country\CountryInterface
     */
    protected $fullNumberCountry;


    use ChangelogTrait;

    /**
     * Constructor
     */
    protected function __construct()
    {
    }

    abstract public function getId();

    public function __toString()
    {
        return sprintf(
            "%s#%s",
            "Queue",
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
     * @return QueueDto
     */
    public static function createDto($id = null)
    {
        return new QueueDto($id);
    }

    /**
     * @internal use EntityTools instead
     * @param EntityInterface|null $entity
     * @param int $depth
     * @return QueueDto|null
     */
    public static function entityToDto(EntityInterface $entity = null, $depth = 0)
    {
        if (!$entity) {
            return null;
        }

        Assertion::isInstanceOf($entity, QueueInterface::class);

        if ($depth < 1) {
            return static::createDto($entity->getId());
        }

        if ($entity instanceof \Doctrine\ORM\Proxy\Proxy && !$entity->__isInitialized()) {
            return static::createDto($entity->getId());
        }

        return $entity->toDto($depth-1);
    }

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param DataTransferObjectInterface $dto
     * @return self
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        \Ivoz\Core\Application\ForeignKeyTransformerInterface $fkTransformer
    ) {
        /**
         * @var $dto QueueDto
         */
        Assertion::isInstanceOf($dto, QueueDto::class);

        $self = new static();

        $self
            ->setName($dto->getName())
            ->setMaxWaitTime($dto->getMaxWaitTime())
            ->setTimeoutTargetType($dto->getTimeoutTargetType())
            ->setTimeoutNumberValue($dto->getTimeoutNumberValue())
            ->setMaxlen($dto->getMaxlen())
            ->setFullTargetType($dto->getFullTargetType())
            ->setFullNumberValue($dto->getFullNumberValue())
            ->setPeriodicAnnounceFrequency($dto->getPeriodicAnnounceFrequency())
            ->setMemberCallRest($dto->getMemberCallRest())
            ->setMemberCallTimeout($dto->getMemberCallTimeout())
            ->setStrategy($dto->getStrategy())
            ->setWeight($dto->getWeight())
            ->setCompany($fkTransformer->transform($dto->getCompany()))
            ->setPeriodicAnnounceLocution($fkTransformer->transform($dto->getPeriodicAnnounceLocution()))
            ->setTimeoutLocution($fkTransformer->transform($dto->getTimeoutLocution()))
            ->setTimeoutExtension($fkTransformer->transform($dto->getTimeoutExtension()))
            ->setTimeoutVoiceMailUser($fkTransformer->transform($dto->getTimeoutVoiceMailUser()))
            ->setFullLocution($fkTransformer->transform($dto->getFullLocution()))
            ->setFullExtension($fkTransformer->transform($dto->getFullExtension()))
            ->setFullVoiceMailUser($fkTransformer->transform($dto->getFullVoiceMailUser()))
            ->setTimeoutNumberCountry($fkTransformer->transform($dto->getTimeoutNumberCountry()))
            ->setFullNumberCountry($fkTransformer->transform($dto->getFullNumberCountry()))
        ;

        $self->sanitizeValues();
        $self->initChangelog();

        return $self;
    }

    /**
     * @internal use EntityTools instead
     * @param DataTransferObjectInterface $dto
     * @return self
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        \Ivoz\Core\Application\ForeignKeyTransformerInterface $fkTransformer
    ) {
        /**
         * @var $dto QueueDto
         */
        Assertion::isInstanceOf($dto, QueueDto::class);

        $this
            ->setName($dto->getName())
            ->setMaxWaitTime($dto->getMaxWaitTime())
            ->setTimeoutTargetType($dto->getTimeoutTargetType())
            ->setTimeoutNumberValue($dto->getTimeoutNumberValue())
            ->setMaxlen($dto->getMaxlen())
            ->setFullTargetType($dto->getFullTargetType())
            ->setFullNumberValue($dto->getFullNumberValue())
            ->setPeriodicAnnounceFrequency($dto->getPeriodicAnnounceFrequency())
            ->setMemberCallRest($dto->getMemberCallRest())
            ->setMemberCallTimeout($dto->getMemberCallTimeout())
            ->setStrategy($dto->getStrategy())
            ->setWeight($dto->getWeight())
            ->setCompany($fkTransformer->transform($dto->getCompany()))
            ->setPeriodicAnnounceLocution($fkTransformer->transform($dto->getPeriodicAnnounceLocution()))
            ->setTimeoutLocution($fkTransformer->transform($dto->getTimeoutLocution()))
            ->setTimeoutExtension($fkTransformer->transform($dto->getTimeoutExtension()))
            ->setTimeoutVoiceMailUser($fkTransformer->transform($dto->getTimeoutVoiceMailUser()))
            ->setFullLocution($fkTransformer->transform($dto->getFullLocution()))
            ->setFullExtension($fkTransformer->transform($dto->getFullExtension()))
            ->setFullVoiceMailUser($fkTransformer->transform($dto->getFullVoiceMailUser()))
            ->setTimeoutNumberCountry($fkTransformer->transform($dto->getTimeoutNumberCountry()))
            ->setFullNumberCountry($fkTransformer->transform($dto->getFullNumberCountry()));



        $this->sanitizeValues();
        return $this;
    }

    /**
     * @internal use EntityTools instead
     * @param int $depth
     * @return QueueDto
     */
    public function toDto($depth = 0)
    {
        return self::createDto()
            ->setName(self::getName())
            ->setMaxWaitTime(self::getMaxWaitTime())
            ->setTimeoutTargetType(self::getTimeoutTargetType())
            ->setTimeoutNumberValue(self::getTimeoutNumberValue())
            ->setMaxlen(self::getMaxlen())
            ->setFullTargetType(self::getFullTargetType())
            ->setFullNumberValue(self::getFullNumberValue())
            ->setPeriodicAnnounceFrequency(self::getPeriodicAnnounceFrequency())
            ->setMemberCallRest(self::getMemberCallRest())
            ->setMemberCallTimeout(self::getMemberCallTimeout())
            ->setStrategy(self::getStrategy())
            ->setWeight(self::getWeight())
            ->setCompany(\Ivoz\Provider\Domain\Model\Company\Company::entityToDto(self::getCompany(), $depth))
            ->setPeriodicAnnounceLocution(\Ivoz\Provider\Domain\Model\Locution\Locution::entityToDto(self::getPeriodicAnnounceLocution(), $depth))
            ->setTimeoutLocution(\Ivoz\Provider\Domain\Model\Locution\Locution::entityToDto(self::getTimeoutLocution(), $depth))
            ->setTimeoutExtension(\Ivoz\Provider\Domain\Model\Extension\Extension::entityToDto(self::getTimeoutExtension(), $depth))
            ->setTimeoutVoiceMailUser(\Ivoz\Provider\Domain\Model\User\User::entityToDto(self::getTimeoutVoiceMailUser(), $depth))
            ->setFullLocution(\Ivoz\Provider\Domain\Model\Locution\Locution::entityToDto(self::getFullLocution(), $depth))
            ->setFullExtension(\Ivoz\Provider\Domain\Model\Extension\Extension::entityToDto(self::getFullExtension(), $depth))
            ->setFullVoiceMailUser(\Ivoz\Provider\Domain\Model\User\User::entityToDto(self::getFullVoiceMailUser(), $depth))
            ->setTimeoutNumberCountry(\Ivoz\Provider\Domain\Model\Country\Country::entityToDto(self::getTimeoutNumberCountry(), $depth))
            ->setFullNumberCountry(\Ivoz\Provider\Domain\Model\Country\Country::entityToDto(self::getFullNumberCountry(), $depth));
    }

    /**
     * @return array
     */
    protected function __toArray()
    {
        return [
            'name' => self::getName(),
            'maxWaitTime' => self::getMaxWaitTime(),
            'timeoutTargetType' => self::getTimeoutTargetType(),
            'timeoutNumberValue' => self::getTimeoutNumberValue(),
            'maxlen' => self::getMaxlen(),
            'fullTargetType' => self::getFullTargetType(),
            'fullNumberValue' => self::getFullNumberValue(),
            'periodicAnnounceFrequency' => self::getPeriodicAnnounceFrequency(),
            'memberCallRest' => self::getMemberCallRest(),
            'memberCallTimeout' => self::getMemberCallTimeout(),
            'strategy' => self::getStrategy(),
            'weight' => self::getWeight(),
            'companyId' => self::getCompany() ? self::getCompany()->getId() : null,
            'periodicAnnounceLocutionId' => self::getPeriodicAnnounceLocution() ? self::getPeriodicAnnounceLocution()->getId() : null,
            'timeoutLocutionId' => self::getTimeoutLocution() ? self::getTimeoutLocution()->getId() : null,
            'timeoutExtensionId' => self::getTimeoutExtension() ? self::getTimeoutExtension()->getId() : null,
            'timeoutVoiceMailUserId' => self::getTimeoutVoiceMailUser() ? self::getTimeoutVoiceMailUser()->getId() : null,
            'fullLocutionId' => self::getFullLocution() ? self::getFullLocution()->getId() : null,
            'fullExtensionId' => self::getFullExtension() ? self::getFullExtension()->getId() : null,
            'fullVoiceMailUserId' => self::getFullVoiceMailUser() ? self::getFullVoiceMailUser()->getId() : null,
            'timeoutNumberCountryId' => self::getTimeoutNumberCountry() ? self::getTimeoutNumberCountry()->getId() : null,
            'fullNumberCountryId' => self::getFullNumberCountry() ? self::getFullNumberCountry()->getId() : null
        ];
    }
    // @codeCoverageIgnoreStart

    /**
     * Set name
     *
     * @param string $name
     *
     * @return self
     */
    protected function setName($name = null)
    {
        if (!is_null($name)) {
            Assertion::maxLength($name, 128, 'name value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string | null
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set maxWaitTime
     *
     * @param integer $maxWaitTime
     *
     * @return self
     */
    protected function setMaxWaitTime($maxWaitTime = null)
    {
        if (!is_null($maxWaitTime)) {
            if (!is_null($maxWaitTime)) {
                Assertion::integerish($maxWaitTime, 'maxWaitTime value "%s" is not an integer or a number castable to integer.');
            }
        }

        $this->maxWaitTime = $maxWaitTime;

        return $this;
    }

    /**
     * Get maxWaitTime
     *
     * @return integer | null
     */
    public function getMaxWaitTime()
    {
        return $this->maxWaitTime;
    }

    /**
     * Set timeoutTargetType
     *
     * @param string $timeoutTargetType
     *
     * @return self
     */
    protected function setTimeoutTargetType($timeoutTargetType = null)
    {
        if (!is_null($timeoutTargetType)) {
            Assertion::maxLength($timeoutTargetType, 25, 'timeoutTargetType value "%s" is too long, it should have no more than %d characters, but has %d characters.');
            Assertion::choice($timeoutTargetType, array (
              0 => 'number',
              1 => 'extension',
              2 => 'voicemail',
            ), 'timeoutTargetTypevalue "%s" is not an element of the valid values: %s');
        }

        $this->timeoutTargetType = $timeoutTargetType;

        return $this;
    }

    /**
     * Get timeoutTargetType
     *
     * @return string | null
     */
    public function getTimeoutTargetType()
    {
        return $this->timeoutTargetType;
    }

    /**
     * Set timeoutNumberValue
     *
     * @param string $timeoutNumberValue
     *
     * @return self
     */
    protected function setTimeoutNumberValue($timeoutNumberValue = null)
    {
        if (!is_null($timeoutNumberValue)) {
            Assertion::maxLength($timeoutNumberValue, 25, 'timeoutNumberValue value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->timeoutNumberValue = $timeoutNumberValue;

        return $this;
    }

    /**
     * Get timeoutNumberValue
     *
     * @return string | null
     */
    public function getTimeoutNumberValue()
    {
        return $this->timeoutNumberValue;
    }

    /**
     * Set maxlen
     *
     * @param integer $maxlen
     *
     * @return self
     */
    protected function setMaxlen($maxlen = null)
    {
        if (!is_null($maxlen)) {
            if (!is_null($maxlen)) {
                Assertion::integerish($maxlen, 'maxlen value "%s" is not an integer or a number castable to integer.');
            }
        }

        $this->maxlen = $maxlen;

        return $this;
    }

    /**
     * Get maxlen
     *
     * @return integer | null
     */
    public function getMaxlen()
    {
        return $this->maxlen;
    }

    /**
     * Set fullTargetType
     *
     * @param string $fullTargetType
     *
     * @return self
     */
    protected function setFullTargetType($fullTargetType = null)
    {
        if (!is_null($fullTargetType)) {
            Assertion::maxLength($fullTargetType, 25, 'fullTargetType value "%s" is too long, it should have no more than %d characters, but has %d characters.');
            Assertion::choice($fullTargetType, array (
              0 => 'number',
              1 => 'extension',
              2 => 'voicemail',
            ), 'fullTargetTypevalue "%s" is not an element of the valid values: %s');
        }

        $this->fullTargetType = $fullTargetType;

        return $this;
    }

    /**
     * Get fullTargetType
     *
     * @return string | null
     */
    public function getFullTargetType()
    {
        return $this->fullTargetType;
    }

    /**
     * Set fullNumberValue
     *
     * @param string $fullNumberValue
     *
     * @return self
     */
    protected function setFullNumberValue($fullNumberValue = null)
    {
        if (!is_null($fullNumberValue)) {
            Assertion::maxLength($fullNumberValue, 25, 'fullNumberValue value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->fullNumberValue = $fullNumberValue;

        return $this;
    }

    /**
     * Get fullNumberValue
     *
     * @return string | null
     */
    public function getFullNumberValue()
    {
        return $this->fullNumberValue;
    }

    /**
     * Set periodicAnnounceFrequency
     *
     * @param integer $periodicAnnounceFrequency
     *
     * @return self
     */
    protected function setPeriodicAnnounceFrequency($periodicAnnounceFrequency = null)
    {
        if (!is_null($periodicAnnounceFrequency)) {
            if (!is_null($periodicAnnounceFrequency)) {
                Assertion::integerish($periodicAnnounceFrequency, 'periodicAnnounceFrequency value "%s" is not an integer or a number castable to integer.');
            }
        }

        $this->periodicAnnounceFrequency = $periodicAnnounceFrequency;

        return $this;
    }

    /**
     * Get periodicAnnounceFrequency
     *
     * @return integer | null
     */
    public function getPeriodicAnnounceFrequency()
    {
        return $this->periodicAnnounceFrequency;
    }

    /**
     * Set memberCallRest
     *
     * @param integer $memberCallRest
     *
     * @return self
     */
    protected function setMemberCallRest($memberCallRest = null)
    {
        if (!is_null($memberCallRest)) {
            if (!is_null($memberCallRest)) {
                Assertion::integerish($memberCallRest, 'memberCallRest value "%s" is not an integer or a number castable to integer.');
            }
        }

        $this->memberCallRest = $memberCallRest;

        return $this;
    }

    /**
     * Get memberCallRest
     *
     * @return integer | null
     */
    public function getMemberCallRest()
    {
        return $this->memberCallRest;
    }

    /**
     * Set memberCallTimeout
     *
     * @param integer $memberCallTimeout
     *
     * @return self
     */
    protected function setMemberCallTimeout($memberCallTimeout = null)
    {
        if (!is_null($memberCallTimeout)) {
            if (!is_null($memberCallTimeout)) {
                Assertion::integerish($memberCallTimeout, 'memberCallTimeout value "%s" is not an integer or a number castable to integer.');
            }
        }

        $this->memberCallTimeout = $memberCallTimeout;

        return $this;
    }

    /**
     * Get memberCallTimeout
     *
     * @return integer | null
     */
    public function getMemberCallTimeout()
    {
        return $this->memberCallTimeout;
    }

    /**
     * Set strategy
     *
     * @param string $strategy
     *
     * @return self
     */
    protected function setStrategy($strategy = null)
    {
        if (!is_null($strategy)) {
        }

        $this->strategy = $strategy;

        return $this;
    }

    /**
     * Get strategy
     *
     * @return string | null
     */
    public function getStrategy()
    {
        return $this->strategy;
    }

    /**
     * Set weight
     *
     * @param integer $weight
     *
     * @return self
     */
    protected function setWeight($weight = null)
    {
        if (!is_null($weight)) {
            if (!is_null($weight)) {
                Assertion::integerish($weight, 'weight value "%s" is not an integer or a number castable to integer.');
            }
        }

        $this->weight = $weight;

        return $this;
    }

    /**
     * Get weight
     *
     * @return integer | null
     */
    public function getWeight()
    {
        return $this->weight;
    }

    /**
     * Set company
     *
     * @param \Ivoz\Provider\Domain\Model\Company\CompanyInterface $company
     *
     * @return self
     */
    public function setCompany(\Ivoz\Provider\Domain\Model\Company\CompanyInterface $company)
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
     * Set periodicAnnounceLocution
     *
     * @param \Ivoz\Provider\Domain\Model\Locution\LocutionInterface $periodicAnnounceLocution
     *
     * @return self
     */
    public function setPeriodicAnnounceLocution(\Ivoz\Provider\Domain\Model\Locution\LocutionInterface $periodicAnnounceLocution = null)
    {
        $this->periodicAnnounceLocution = $periodicAnnounceLocution;

        return $this;
    }

    /**
     * Get periodicAnnounceLocution
     *
     * @return \Ivoz\Provider\Domain\Model\Locution\LocutionInterface
     */
    public function getPeriodicAnnounceLocution()
    {
        return $this->periodicAnnounceLocution;
    }

    /**
     * Set timeoutLocution
     *
     * @param \Ivoz\Provider\Domain\Model\Locution\LocutionInterface $timeoutLocution
     *
     * @return self
     */
    public function setTimeoutLocution(\Ivoz\Provider\Domain\Model\Locution\LocutionInterface $timeoutLocution = null)
    {
        $this->timeoutLocution = $timeoutLocution;

        return $this;
    }

    /**
     * Get timeoutLocution
     *
     * @return \Ivoz\Provider\Domain\Model\Locution\LocutionInterface
     */
    public function getTimeoutLocution()
    {
        return $this->timeoutLocution;
    }

    /**
     * Set timeoutExtension
     *
     * @param \Ivoz\Provider\Domain\Model\Extension\ExtensionInterface $timeoutExtension
     *
     * @return self
     */
    public function setTimeoutExtension(\Ivoz\Provider\Domain\Model\Extension\ExtensionInterface $timeoutExtension = null)
    {
        $this->timeoutExtension = $timeoutExtension;

        return $this;
    }

    /**
     * Get timeoutExtension
     *
     * @return \Ivoz\Provider\Domain\Model\Extension\ExtensionInterface
     */
    public function getTimeoutExtension()
    {
        return $this->timeoutExtension;
    }

    /**
     * Set timeoutVoiceMailUser
     *
     * @param \Ivoz\Provider\Domain\Model\User\UserInterface $timeoutVoiceMailUser
     *
     * @return self
     */
    public function setTimeoutVoiceMailUser(\Ivoz\Provider\Domain\Model\User\UserInterface $timeoutVoiceMailUser = null)
    {
        $this->timeoutVoiceMailUser = $timeoutVoiceMailUser;

        return $this;
    }

    /**
     * Get timeoutVoiceMailUser
     *
     * @return \Ivoz\Provider\Domain\Model\User\UserInterface
     */
    public function getTimeoutVoiceMailUser()
    {
        return $this->timeoutVoiceMailUser;
    }

    /**
     * Set fullLocution
     *
     * @param \Ivoz\Provider\Domain\Model\Locution\LocutionInterface $fullLocution
     *
     * @return self
     */
    public function setFullLocution(\Ivoz\Provider\Domain\Model\Locution\LocutionInterface $fullLocution = null)
    {
        $this->fullLocution = $fullLocution;

        return $this;
    }

    /**
     * Get fullLocution
     *
     * @return \Ivoz\Provider\Domain\Model\Locution\LocutionInterface
     */
    public function getFullLocution()
    {
        return $this->fullLocution;
    }

    /**
     * Set fullExtension
     *
     * @param \Ivoz\Provider\Domain\Model\Extension\ExtensionInterface $fullExtension
     *
     * @return self
     */
    public function setFullExtension(\Ivoz\Provider\Domain\Model\Extension\ExtensionInterface $fullExtension = null)
    {
        $this->fullExtension = $fullExtension;

        return $this;
    }

    /**
     * Get fullExtension
     *
     * @return \Ivoz\Provider\Domain\Model\Extension\ExtensionInterface
     */
    public function getFullExtension()
    {
        return $this->fullExtension;
    }

    /**
     * Set fullVoiceMailUser
     *
     * @param \Ivoz\Provider\Domain\Model\User\UserInterface $fullVoiceMailUser
     *
     * @return self
     */
    public function setFullVoiceMailUser(\Ivoz\Provider\Domain\Model\User\UserInterface $fullVoiceMailUser = null)
    {
        $this->fullVoiceMailUser = $fullVoiceMailUser;

        return $this;
    }

    /**
     * Get fullVoiceMailUser
     *
     * @return \Ivoz\Provider\Domain\Model\User\UserInterface
     */
    public function getFullVoiceMailUser()
    {
        return $this->fullVoiceMailUser;
    }

    /**
     * Set timeoutNumberCountry
     *
     * @param \Ivoz\Provider\Domain\Model\Country\CountryInterface $timeoutNumberCountry
     *
     * @return self
     */
    public function setTimeoutNumberCountry(\Ivoz\Provider\Domain\Model\Country\CountryInterface $timeoutNumberCountry = null)
    {
        $this->timeoutNumberCountry = $timeoutNumberCountry;

        return $this;
    }

    /**
     * Get timeoutNumberCountry
     *
     * @return \Ivoz\Provider\Domain\Model\Country\CountryInterface
     */
    public function getTimeoutNumberCountry()
    {
        return $this->timeoutNumberCountry;
    }

    /**
     * Set fullNumberCountry
     *
     * @param \Ivoz\Provider\Domain\Model\Country\CountryInterface $fullNumberCountry
     *
     * @return self
     */
    public function setFullNumberCountry(\Ivoz\Provider\Domain\Model\Country\CountryInterface $fullNumberCountry = null)
    {
        $this->fullNumberCountry = $fullNumberCountry;

        return $this;
    }

    /**
     * Get fullNumberCountry
     *
     * @return \Ivoz\Provider\Domain\Model\Country\CountryInterface
     */
    public function getFullNumberCountry()
    {
        return $this->fullNumberCountry;
    }

    // @codeCoverageIgnoreEnd
}
