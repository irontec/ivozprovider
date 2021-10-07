<?php

declare(strict_types=1);

namespace Ivoz\Provider\Domain\Model\Queue;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use Ivoz\Provider\Domain\Model\Locution\LocutionInterface;
use Ivoz\Provider\Domain\Model\Extension\ExtensionInterface;
use Ivoz\Provider\Domain\Model\User\UserInterface;
use Ivoz\Provider\Domain\Model\Country\CountryInterface;
use Ivoz\Provider\Domain\Model\Company\Company;
use Ivoz\Provider\Domain\Model\Locution\Locution;
use Ivoz\Provider\Domain\Model\Extension\Extension;
use Ivoz\Provider\Domain\Model\User\User;
use Ivoz\Provider\Domain\Model\Country\Country;

/**
* QueueAbstract
* @codeCoverageIgnore
*/
abstract class QueueAbstract
{
    use ChangelogTrait;

    /**
     * @var string | null
     */
    protected $name;

    /**
     * @var int | null
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
     * @var int | null
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
     * @var int | null
     */
    protected $periodicAnnounceFrequency;

    /**
     * @var int | null
     */
    protected $memberCallRest;

    /**
     * @var int | null
     */
    protected $memberCallTimeout;

    /**
     * @var string | null
     */
    protected $strategy;

    /**
     * @var int | null
     */
    protected $weight;

    /**
     * @var int
     */
    protected $preventMissedCalls = 1;

    /**
     * @var CompanyInterface
     */
    protected $company;

    /**
     * @var LocutionInterface | null
     */
    protected $periodicAnnounceLocution;

    /**
     * @var LocutionInterface | null
     */
    protected $timeoutLocution;

    /**
     * @var ExtensionInterface | null
     */
    protected $timeoutExtension;

    /**
     * @var UserInterface | null
     */
    protected $timeoutVoiceMailUser;

    /**
     * @var LocutionInterface | null
     */
    protected $fullLocution;

    /**
     * @var ExtensionInterface | null
     */
    protected $fullExtension;

    /**
     * @var UserInterface | null
     */
    protected $fullVoiceMailUser;

    /**
     * @var CountryInterface | null
     */
    protected $timeoutNumberCountry;

    /**
     * @var CountryInterface | null
     */
    protected $fullNumberCountry;

    /**
     * Constructor
     */
    protected function __construct(
        $preventMissedCalls
    ) {
        $this->setPreventMissedCalls($preventMissedCalls);
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
     * @param mixed $id
     * @return QueueDto
     */
    public static function createDto($id = null)
    {
        return new QueueDto($id);
    }

    /**
     * @internal use EntityTools instead
     * @param QueueInterface|null $entity
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

        /** @var QueueDto $dto */
        $dto = $entity->toDto($depth - 1);

        return $dto;
    }

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param QueueDto $dto
     * @return self
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ) {
        Assertion::isInstanceOf($dto, QueueDto::class);

        $self = new static(
            $dto->getPreventMissedCalls()
        );

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
            ->setFullNumberCountry($fkTransformer->transform($dto->getFullNumberCountry()));

        $self->initChangelog();

        return $self;
    }

    /**
     * @internal use EntityTools instead
     * @param QueueDto $dto
     * @return self
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ) {
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
            ->setPreventMissedCalls($dto->getPreventMissedCalls())
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
            ->setPreventMissedCalls(self::getPreventMissedCalls())
            ->setCompany(Company::entityToDto(self::getCompany(), $depth))
            ->setPeriodicAnnounceLocution(Locution::entityToDto(self::getPeriodicAnnounceLocution(), $depth))
            ->setTimeoutLocution(Locution::entityToDto(self::getTimeoutLocution(), $depth))
            ->setTimeoutExtension(Extension::entityToDto(self::getTimeoutExtension(), $depth))
            ->setTimeoutVoiceMailUser(User::entityToDto(self::getTimeoutVoiceMailUser(), $depth))
            ->setFullLocution(Locution::entityToDto(self::getFullLocution(), $depth))
            ->setFullExtension(Extension::entityToDto(self::getFullExtension(), $depth))
            ->setFullVoiceMailUser(User::entityToDto(self::getFullVoiceMailUser(), $depth))
            ->setTimeoutNumberCountry(Country::entityToDto(self::getTimeoutNumberCountry(), $depth))
            ->setFullNumberCountry(Country::entityToDto(self::getFullNumberCountry(), $depth));
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
            'preventMissedCalls' => self::getPreventMissedCalls(),
            'companyId' => self::getCompany()->getId(),
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

    protected function setName(?string $name = null): static
    {
        if (!is_null($name)) {
            Assertion::maxLength($name, 128, 'name value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->name = $name;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    protected function setMaxWaitTime(?int $maxWaitTime = null): static
    {
        $this->maxWaitTime = $maxWaitTime;

        return $this;
    }

    public function getMaxWaitTime(): ?int
    {
        return $this->maxWaitTime;
    }

    protected function setTimeoutTargetType(?string $timeoutTargetType = null): static
    {
        if (!is_null($timeoutTargetType)) {
            Assertion::maxLength($timeoutTargetType, 25, 'timeoutTargetType value "%s" is too long, it should have no more than %d characters, but has %d characters.');
            Assertion::choice(
                $timeoutTargetType,
                [
                    QueueInterface::TIMEOUTTARGETTYPE_NUMBER,
                    QueueInterface::TIMEOUTTARGETTYPE_EXTENSION,
                    QueueInterface::TIMEOUTTARGETTYPE_VOICEMAIL,
                ],
                'timeoutTargetTypevalue "%s" is not an element of the valid values: %s'
            );
        }

        $this->timeoutTargetType = $timeoutTargetType;

        return $this;
    }

    public function getTimeoutTargetType(): ?string
    {
        return $this->timeoutTargetType;
    }

    protected function setTimeoutNumberValue(?string $timeoutNumberValue = null): static
    {
        if (!is_null($timeoutNumberValue)) {
            Assertion::maxLength($timeoutNumberValue, 25, 'timeoutNumberValue value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->timeoutNumberValue = $timeoutNumberValue;

        return $this;
    }

    public function getTimeoutNumberValue(): ?string
    {
        return $this->timeoutNumberValue;
    }

    protected function setMaxlen(?int $maxlen = null): static
    {
        $this->maxlen = $maxlen;

        return $this;
    }

    public function getMaxlen(): ?int
    {
        return $this->maxlen;
    }

    protected function setFullTargetType(?string $fullTargetType = null): static
    {
        if (!is_null($fullTargetType)) {
            Assertion::maxLength($fullTargetType, 25, 'fullTargetType value "%s" is too long, it should have no more than %d characters, but has %d characters.');
            Assertion::choice(
                $fullTargetType,
                [
                    QueueInterface::FULLTARGETTYPE_NUMBER,
                    QueueInterface::FULLTARGETTYPE_EXTENSION,
                    QueueInterface::FULLTARGETTYPE_VOICEMAIL,
                ],
                'fullTargetTypevalue "%s" is not an element of the valid values: %s'
            );
        }

        $this->fullTargetType = $fullTargetType;

        return $this;
    }

    public function getFullTargetType(): ?string
    {
        return $this->fullTargetType;
    }

    protected function setFullNumberValue(?string $fullNumberValue = null): static
    {
        if (!is_null($fullNumberValue)) {
            Assertion::maxLength($fullNumberValue, 25, 'fullNumberValue value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->fullNumberValue = $fullNumberValue;

        return $this;
    }

    public function getFullNumberValue(): ?string
    {
        return $this->fullNumberValue;
    }

    protected function setPeriodicAnnounceFrequency(?int $periodicAnnounceFrequency = null): static
    {
        $this->periodicAnnounceFrequency = $periodicAnnounceFrequency;

        return $this;
    }

    public function getPeriodicAnnounceFrequency(): ?int
    {
        return $this->periodicAnnounceFrequency;
    }

    protected function setMemberCallRest(?int $memberCallRest = null): static
    {
        $this->memberCallRest = $memberCallRest;

        return $this;
    }

    public function getMemberCallRest(): ?int
    {
        return $this->memberCallRest;
    }

    protected function setMemberCallTimeout(?int $memberCallTimeout = null): static
    {
        $this->memberCallTimeout = $memberCallTimeout;

        return $this;
    }

    public function getMemberCallTimeout(): ?int
    {
        return $this->memberCallTimeout;
    }

    protected function setStrategy(?string $strategy = null): static
    {
        $this->strategy = $strategy;

        return $this;
    }

    public function getStrategy(): ?string
    {
        return $this->strategy;
    }

    protected function setWeight(?int $weight = null): static
    {
        $this->weight = $weight;

        return $this;
    }

    public function getWeight(): ?int
    {
        return $this->weight;
    }

    protected function setPreventMissedCalls(int $preventMissedCalls): static
    {
        Assertion::greaterOrEqualThan($preventMissedCalls, 0, 'preventMissedCalls provided "%s" is not greater or equal than "%s".');

        $this->preventMissedCalls = $preventMissedCalls;

        return $this;
    }

    public function getPreventMissedCalls(): int
    {
        return $this->preventMissedCalls;
    }

    protected function setCompany(CompanyInterface $company): static
    {
        $this->company = $company;

        return $this;
    }

    public function getCompany(): CompanyInterface
    {
        return $this->company;
    }

    protected function setPeriodicAnnounceLocution(?LocutionInterface $periodicAnnounceLocution = null): static
    {
        $this->periodicAnnounceLocution = $periodicAnnounceLocution;

        return $this;
    }

    public function getPeriodicAnnounceLocution(): ?LocutionInterface
    {
        return $this->periodicAnnounceLocution;
    }

    protected function setTimeoutLocution(?LocutionInterface $timeoutLocution = null): static
    {
        $this->timeoutLocution = $timeoutLocution;

        return $this;
    }

    public function getTimeoutLocution(): ?LocutionInterface
    {
        return $this->timeoutLocution;
    }

    protected function setTimeoutExtension(?ExtensionInterface $timeoutExtension = null): static
    {
        $this->timeoutExtension = $timeoutExtension;

        return $this;
    }

    public function getTimeoutExtension(): ?ExtensionInterface
    {
        return $this->timeoutExtension;
    }

    protected function setTimeoutVoiceMailUser(?UserInterface $timeoutVoiceMailUser = null): static
    {
        $this->timeoutVoiceMailUser = $timeoutVoiceMailUser;

        return $this;
    }

    public function getTimeoutVoiceMailUser(): ?UserInterface
    {
        return $this->timeoutVoiceMailUser;
    }

    protected function setFullLocution(?LocutionInterface $fullLocution = null): static
    {
        $this->fullLocution = $fullLocution;

        return $this;
    }

    public function getFullLocution(): ?LocutionInterface
    {
        return $this->fullLocution;
    }

    protected function setFullExtension(?ExtensionInterface $fullExtension = null): static
    {
        $this->fullExtension = $fullExtension;

        return $this;
    }

    public function getFullExtension(): ?ExtensionInterface
    {
        return $this->fullExtension;
    }

    protected function setFullVoiceMailUser(?UserInterface $fullVoiceMailUser = null): static
    {
        $this->fullVoiceMailUser = $fullVoiceMailUser;

        return $this;
    }

    public function getFullVoiceMailUser(): ?UserInterface
    {
        return $this->fullVoiceMailUser;
    }

    protected function setTimeoutNumberCountry(?CountryInterface $timeoutNumberCountry = null): static
    {
        $this->timeoutNumberCountry = $timeoutNumberCountry;

        return $this;
    }

    public function getTimeoutNumberCountry(): ?CountryInterface
    {
        return $this->timeoutNumberCountry;
    }

    protected function setFullNumberCountry(?CountryInterface $fullNumberCountry = null): static
    {
        $this->fullNumberCountry = $fullNumberCountry;

        return $this;
    }

    public function getFullNumberCountry(): ?CountryInterface
    {
        return $this->fullNumberCountry;
    }
}
