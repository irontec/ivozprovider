<?php
declare(strict_types = 1);

namespace Ivoz\Provider\Domain\Model\HuntGroup;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;
use \Ivoz\Core\Application\ForeignKeyTransformerInterface;
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
* HuntGroupAbstract
* @codeCoverageIgnore
*/
abstract class HuntGroupAbstract
{
    use ChangelogTrait;

    /**
     * @var string
     */
    protected $name = '';

    /**
     * @var string
     */
    protected $description = '';

    /**
     * comment: enum:ringAll|linear|roundRobin|random
     * @var string
     */
    protected $strategy;

    /**
     * @var int | null
     */
    protected $ringAllTimeout;

    /**
     * comment: enum:number|extension|voicemail
     * @var string | null
     */
    protected $noAnswerTargetType;

    /**
     * @var string | null
     */
    protected $noAnswerNumberValue;

    /**
     * @var int
     */
    protected $preventMissedCalls = 1;

    /**
     * @var int
     */
    protected $allowCallForwards = 0;

    /**
     * @var CompanyInterface
     */
    protected $company;

    /**
     * @var LocutionInterface
     */
    protected $noAnswerLocution;

    /**
     * @var ExtensionInterface
     */
    protected $noAnswerExtension;

    /**
     * @var UserInterface
     */
    protected $noAnswerVoiceMailUser;

    /**
     * @var CountryInterface
     */
    protected $noAnswerNumberCountry;

    /**
     * Constructor
     */
    protected function __construct(
        $name,
        $description,
        $strategy,
        $preventMissedCalls,
        $allowCallForwards
    ) {
        $this->setName($name);
        $this->setDescription($description);
        $this->setStrategy($strategy);
        $this->setPreventMissedCalls($preventMissedCalls);
        $this->setAllowCallForwards($allowCallForwards);
    }

    abstract public function getId();

    public function __toString()
    {
        return sprintf(
            "%s#%s",
            "HuntGroup",
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
     * @return HuntGroupDto
     */
    public static function createDto($id = null)
    {
        return new HuntGroupDto($id);
    }

    /**
     * @internal use EntityTools instead
     * @param HuntGroupInterface|null $entity
     * @param int $depth
     * @return HuntGroupDto|null
     */
    public static function entityToDto(EntityInterface $entity = null, $depth = 0)
    {
        if (!$entity) {
            return null;
        }

        Assertion::isInstanceOf($entity, HuntGroupInterface::class);

        if ($depth < 1) {
            return static::createDto($entity->getId());
        }

        if ($entity instanceof \Doctrine\ORM\Proxy\Proxy && !$entity->__isInitialized()) {
            return static::createDto($entity->getId());
        }

        /** @var HuntGroupDto $dto */
        $dto = $entity->toDto($depth-1);

        return $dto;
    }

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param HuntGroupDto $dto
     * @return self
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ) {
        Assertion::isInstanceOf($dto, HuntGroupDto::class);

        $self = new static(
            $dto->getName(),
            $dto->getDescription(),
            $dto->getStrategy(),
            $dto->getPreventMissedCalls(),
            $dto->getAllowCallForwards()
        );

        $self
            ->setRingAllTimeout($dto->getRingAllTimeout())
            ->setNoAnswerTargetType($dto->getNoAnswerTargetType())
            ->setNoAnswerNumberValue($dto->getNoAnswerNumberValue())
            ->setCompany($fkTransformer->transform($dto->getCompany()))
            ->setNoAnswerLocution($fkTransformer->transform($dto->getNoAnswerLocution()))
            ->setNoAnswerExtension($fkTransformer->transform($dto->getNoAnswerExtension()))
            ->setNoAnswerVoiceMailUser($fkTransformer->transform($dto->getNoAnswerVoiceMailUser()))
            ->setNoAnswerNumberCountry($fkTransformer->transform($dto->getNoAnswerNumberCountry()));

        $self->initChangelog();

        return $self;
    }

    /**
     * @internal use EntityTools instead
     * @param HuntGroupDto $dto
     * @return self
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ) {
        Assertion::isInstanceOf($dto, HuntGroupDto::class);

        $this
            ->setName($dto->getName())
            ->setDescription($dto->getDescription())
            ->setStrategy($dto->getStrategy())
            ->setRingAllTimeout($dto->getRingAllTimeout())
            ->setNoAnswerTargetType($dto->getNoAnswerTargetType())
            ->setNoAnswerNumberValue($dto->getNoAnswerNumberValue())
            ->setPreventMissedCalls($dto->getPreventMissedCalls())
            ->setAllowCallForwards($dto->getAllowCallForwards())
            ->setCompany($fkTransformer->transform($dto->getCompany()))
            ->setNoAnswerLocution($fkTransformer->transform($dto->getNoAnswerLocution()))
            ->setNoAnswerExtension($fkTransformer->transform($dto->getNoAnswerExtension()))
            ->setNoAnswerVoiceMailUser($fkTransformer->transform($dto->getNoAnswerVoiceMailUser()))
            ->setNoAnswerNumberCountry($fkTransformer->transform($dto->getNoAnswerNumberCountry()));

        return $this;
    }

    /**
     * @internal use EntityTools instead
     * @param int $depth
     * @return HuntGroupDto
     */
    public function toDto($depth = 0)
    {
        return self::createDto()
            ->setName(self::getName())
            ->setDescription(self::getDescription())
            ->setStrategy(self::getStrategy())
            ->setRingAllTimeout(self::getRingAllTimeout())
            ->setNoAnswerTargetType(self::getNoAnswerTargetType())
            ->setNoAnswerNumberValue(self::getNoAnswerNumberValue())
            ->setPreventMissedCalls(self::getPreventMissedCalls())
            ->setAllowCallForwards(self::getAllowCallForwards())
            ->setCompany(Company::entityToDto(self::getCompany(), $depth))
            ->setNoAnswerLocution(Locution::entityToDto(self::getNoAnswerLocution(), $depth))
            ->setNoAnswerExtension(Extension::entityToDto(self::getNoAnswerExtension(), $depth))
            ->setNoAnswerVoiceMailUser(User::entityToDto(self::getNoAnswerVoiceMailUser(), $depth))
            ->setNoAnswerNumberCountry(Country::entityToDto(self::getNoAnswerNumberCountry(), $depth));
    }

    /**
     * @return array
     */
    protected function __toArray()
    {
        return [
            'name' => self::getName(),
            'description' => self::getDescription(),
            'strategy' => self::getStrategy(),
            'ringAllTimeout' => self::getRingAllTimeout(),
            'noAnswerTargetType' => self::getNoAnswerTargetType(),
            'noAnswerNumberValue' => self::getNoAnswerNumberValue(),
            'preventMissedCalls' => self::getPreventMissedCalls(),
            'allowCallForwards' => self::getAllowCallForwards(),
            'companyId' => self::getCompany()->getId(),
            'noAnswerLocutionId' => self::getNoAnswerLocution() ? self::getNoAnswerLocution()->getId() : null,
            'noAnswerExtensionId' => self::getNoAnswerExtension() ? self::getNoAnswerExtension()->getId() : null,
            'noAnswerVoiceMailUserId' => self::getNoAnswerVoiceMailUser() ? self::getNoAnswerVoiceMailUser()->getId() : null,
            'noAnswerNumberCountryId' => self::getNoAnswerNumberCountry() ? self::getNoAnswerNumberCountry()->getId() : null
        ];
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return static
     */
    protected function setName(string $name): HuntGroupInterface
    {
        Assertion::maxLength($name, 100, 'name value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return static
     */
    protected function setDescription(string $description): HuntGroupInterface
    {
        Assertion::maxLength($description, 500, 'description value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * Set strategy
     *
     * @param string $strategy
     *
     * @return static
     */
    protected function setStrategy(string $strategy): HuntGroupInterface
    {
        Assertion::maxLength($strategy, 25, 'strategy value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        Assertion::choice(
            $strategy,
            [
                HuntGroupInterface::STRATEGY_RINGALL,
                HuntGroupInterface::STRATEGY_LINEAR,
                HuntGroupInterface::STRATEGY_ROUNDROBIN,
                HuntGroupInterface::STRATEGY_RANDOM,
            ],
            'strategyvalue "%s" is not an element of the valid values: %s'
        );

        $this->strategy = $strategy;

        return $this;
    }

    /**
     * Get strategy
     *
     * @return string
     */
    public function getStrategy(): string
    {
        return $this->strategy;
    }

    /**
     * Set ringAllTimeout
     *
     * @param int $ringAllTimeout | null
     *
     * @return static
     */
    protected function setRingAllTimeout(?int $ringAllTimeout = null): HuntGroupInterface
    {
        $this->ringAllTimeout = $ringAllTimeout;

        return $this;
    }

    /**
     * Get ringAllTimeout
     *
     * @return int | null
     */
    public function getRingAllTimeout(): ?int
    {
        return $this->ringAllTimeout;
    }

    /**
     * Set noAnswerTargetType
     *
     * @param string $noAnswerTargetType | null
     *
     * @return static
     */
    protected function setNoAnswerTargetType(?string $noAnswerTargetType = null): HuntGroupInterface
    {
        if (!is_null($noAnswerTargetType)) {
            Assertion::maxLength($noAnswerTargetType, 25, 'noAnswerTargetType value "%s" is too long, it should have no more than %d characters, but has %d characters.');
            Assertion::choice(
                $noAnswerTargetType,
                [
                    HuntGroupInterface::NOANSWERTARGETTYPE_NUMBER,
                    HuntGroupInterface::NOANSWERTARGETTYPE_EXTENSION,
                    HuntGroupInterface::NOANSWERTARGETTYPE_VOICEMAIL,
                ],
                'noAnswerTargetTypevalue "%s" is not an element of the valid values: %s'
            );
        }

        $this->noAnswerTargetType = $noAnswerTargetType;

        return $this;
    }

    /**
     * Get noAnswerTargetType
     *
     * @return string | null
     */
    public function getNoAnswerTargetType(): ?string
    {
        return $this->noAnswerTargetType;
    }

    /**
     * Set noAnswerNumberValue
     *
     * @param string $noAnswerNumberValue | null
     *
     * @return static
     */
    protected function setNoAnswerNumberValue(?string $noAnswerNumberValue = null): HuntGroupInterface
    {
        if (!is_null($noAnswerNumberValue)) {
            Assertion::maxLength($noAnswerNumberValue, 25, 'noAnswerNumberValue value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->noAnswerNumberValue = $noAnswerNumberValue;

        return $this;
    }

    /**
     * Get noAnswerNumberValue
     *
     * @return string | null
     */
    public function getNoAnswerNumberValue(): ?string
    {
        return $this->noAnswerNumberValue;
    }

    /**
     * Set preventMissedCalls
     *
     * @param int $preventMissedCalls
     *
     * @return static
     */
    protected function setPreventMissedCalls(int $preventMissedCalls): HuntGroupInterface
    {
        Assertion::greaterOrEqualThan($preventMissedCalls, 0, 'preventMissedCalls provided "%s" is not greater or equal than "%s".');

        $this->preventMissedCalls = $preventMissedCalls;

        return $this;
    }

    /**
     * Get preventMissedCalls
     *
     * @return int
     */
    public function getPreventMissedCalls(): int
    {
        return $this->preventMissedCalls;
    }

    /**
     * Set allowCallForwards
     *
     * @param int $allowCallForwards
     *
     * @return static
     */
    protected function setAllowCallForwards(int $allowCallForwards): HuntGroupInterface
    {
        Assertion::greaterOrEqualThan($allowCallForwards, 0, 'allowCallForwards provided "%s" is not greater or equal than "%s".');

        $this->allowCallForwards = $allowCallForwards;

        return $this;
    }

    /**
     * Get allowCallForwards
     *
     * @return int
     */
    public function getAllowCallForwards(): int
    {
        return $this->allowCallForwards;
    }

    /**
     * Set company
     *
     * @param CompanyInterface
     *
     * @return static
     */
    protected function setCompany(CompanyInterface $company): HuntGroupInterface
    {
        $this->company = $company;

        return $this;
    }

    /**
     * Get company
     *
     * @return CompanyInterface
     */
    public function getCompany(): CompanyInterface
    {
        return $this->company;
    }

    /**
     * Set noAnswerLocution
     *
     * @param LocutionInterface | null
     *
     * @return static
     */
    protected function setNoAnswerLocution(?LocutionInterface $noAnswerLocution = null): HuntGroupInterface
    {
        $this->noAnswerLocution = $noAnswerLocution;

        return $this;
    }

    /**
     * Get noAnswerLocution
     *
     * @return LocutionInterface | null
     */
    public function getNoAnswerLocution(): ?LocutionInterface
    {
        return $this->noAnswerLocution;
    }

    /**
     * Set noAnswerExtension
     *
     * @param ExtensionInterface | null
     *
     * @return static
     */
    protected function setNoAnswerExtension(?ExtensionInterface $noAnswerExtension = null): HuntGroupInterface
    {
        $this->noAnswerExtension = $noAnswerExtension;

        return $this;
    }

    /**
     * Get noAnswerExtension
     *
     * @return ExtensionInterface | null
     */
    public function getNoAnswerExtension(): ?ExtensionInterface
    {
        return $this->noAnswerExtension;
    }

    /**
     * Set noAnswerVoiceMailUser
     *
     * @param UserInterface | null
     *
     * @return static
     */
    protected function setNoAnswerVoiceMailUser(?UserInterface $noAnswerVoiceMailUser = null): HuntGroupInterface
    {
        $this->noAnswerVoiceMailUser = $noAnswerVoiceMailUser;

        return $this;
    }

    /**
     * Get noAnswerVoiceMailUser
     *
     * @return UserInterface | null
     */
    public function getNoAnswerVoiceMailUser(): ?UserInterface
    {
        return $this->noAnswerVoiceMailUser;
    }

    /**
     * Set noAnswerNumberCountry
     *
     * @param CountryInterface | null
     *
     * @return static
     */
    protected function setNoAnswerNumberCountry(?CountryInterface $noAnswerNumberCountry = null): HuntGroupInterface
    {
        $this->noAnswerNumberCountry = $noAnswerNumberCountry;

        return $this;
    }

    /**
     * Get noAnswerNumberCountry
     *
     * @return CountryInterface | null
     */
    public function getNoAnswerNumberCountry(): ?CountryInterface
    {
        return $this->noAnswerNumberCountry;
    }

}
