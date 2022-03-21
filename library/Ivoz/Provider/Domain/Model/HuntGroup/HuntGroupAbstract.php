<?php

declare(strict_types=1);

namespace Ivoz\Provider\Domain\Model\HuntGroup;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use Ivoz\Provider\Domain\Model\Locution\LocutionInterface;
use Ivoz\Provider\Domain\Model\Extension\ExtensionInterface;
use Ivoz\Provider\Domain\Model\Voicemail\VoicemailInterface;
use Ivoz\Provider\Domain\Model\Country\CountryInterface;
use Ivoz\Provider\Domain\Model\Company\Company;
use Ivoz\Provider\Domain\Model\Locution\Locution;
use Ivoz\Provider\Domain\Model\Extension\Extension;
use Ivoz\Provider\Domain\Model\Voicemail\Voicemail;
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
     * @var string
     * comment: enum:ringAll|linear|roundRobin|random
     */
    protected $strategy;

    /**
     * @var ?int
     */
    protected $ringAllTimeout = null;

    /**
     * @var ?string
     * comment: enum:number|extension|voicemail
     */
    protected $noAnswerTargetType = null;

    /**
     * @var ?string
     */
    protected $noAnswerNumberValue = null;

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
     * @var ?LocutionInterface
     */
    protected $noAnswerLocution = null;

    /**
     * @var ?ExtensionInterface
     */
    protected $noAnswerExtension = null;

    /**
     * @var ?VoicemailInterface
     */
    protected $noAnswerVoicemail = null;

    /**
     * @var ?CountryInterface
     */
    protected $noAnswerNumberCountry = null;

    /**
     * Constructor
     */
    protected function __construct(
        string $name,
        string $description,
        string $strategy,
        int $preventMissedCalls,
        int $allowCallForwards
    ) {
        $this->setName($name);
        $this->setDescription($description);
        $this->setStrategy($strategy);
        $this->setPreventMissedCalls($preventMissedCalls);
        $this->setAllowCallForwards($allowCallForwards);
    }

    abstract public function getId(): null|string|int;

    public function __toString(): string
    {
        return sprintf(
            "%s#%s",
            "HuntGroup",
            (string) $this->getId()
        );
    }

    /**
     * @throws \Exception
     */
    protected function sanitizeValues(): void
    {
    }

    public static function createDto(string|int|null $id = null): HuntGroupDto
    {
        return new HuntGroupDto($id);
    }

    /**
     * @internal use EntityTools instead
     * @param null|HuntGroupInterface $entity
     */
    public static function entityToDto(?EntityInterface $entity, int $depth = 0): ?HuntGroupDto
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

        $dto = $entity->toDto($depth - 1);

        return $dto;
    }

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param HuntGroupDto $dto
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
        Assertion::isInstanceOf($dto, HuntGroupDto::class);
        $name = $dto->getName();
        Assertion::notNull($name, 'getName value is null, but non null value was expected.');
        $description = $dto->getDescription();
        Assertion::notNull($description, 'getDescription value is null, but non null value was expected.');
        $strategy = $dto->getStrategy();
        Assertion::notNull($strategy, 'getStrategy value is null, but non null value was expected.');
        $preventMissedCalls = $dto->getPreventMissedCalls();
        Assertion::notNull($preventMissedCalls, 'getPreventMissedCalls value is null, but non null value was expected.');
        $allowCallForwards = $dto->getAllowCallForwards();
        Assertion::notNull($allowCallForwards, 'getAllowCallForwards value is null, but non null value was expected.');
        $company = $dto->getCompany();
        Assertion::notNull($company, 'getCompany value is null, but non null value was expected.');

        $self = new static(
            $name,
            $description,
            $strategy,
            $preventMissedCalls,
            $allowCallForwards
        );

        $self
            ->setRingAllTimeout($dto->getRingAllTimeout())
            ->setNoAnswerTargetType($dto->getNoAnswerTargetType())
            ->setNoAnswerNumberValue($dto->getNoAnswerNumberValue())
            ->setCompany($fkTransformer->transform($company))
            ->setNoAnswerLocution($fkTransformer->transform($dto->getNoAnswerLocution()))
            ->setNoAnswerExtension($fkTransformer->transform($dto->getNoAnswerExtension()))
            ->setNoAnswerVoicemail($fkTransformer->transform($dto->getNoAnswerVoicemail()))
            ->setNoAnswerNumberCountry($fkTransformer->transform($dto->getNoAnswerNumberCountry()));

        $self->initChangelog();

        return $self;
    }

    /**
     * @internal use EntityTools instead
     * @param HuntGroupDto $dto
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
        Assertion::isInstanceOf($dto, HuntGroupDto::class);

        $name = $dto->getName();
        Assertion::notNull($name, 'getName value is null, but non null value was expected.');
        $description = $dto->getDescription();
        Assertion::notNull($description, 'getDescription value is null, but non null value was expected.');
        $strategy = $dto->getStrategy();
        Assertion::notNull($strategy, 'getStrategy value is null, but non null value was expected.');
        $preventMissedCalls = $dto->getPreventMissedCalls();
        Assertion::notNull($preventMissedCalls, 'getPreventMissedCalls value is null, but non null value was expected.');
        $allowCallForwards = $dto->getAllowCallForwards();
        Assertion::notNull($allowCallForwards, 'getAllowCallForwards value is null, but non null value was expected.');
        $company = $dto->getCompany();
        Assertion::notNull($company, 'getCompany value is null, but non null value was expected.');

        $this
            ->setName($name)
            ->setDescription($description)
            ->setStrategy($strategy)
            ->setRingAllTimeout($dto->getRingAllTimeout())
            ->setNoAnswerTargetType($dto->getNoAnswerTargetType())
            ->setNoAnswerNumberValue($dto->getNoAnswerNumberValue())
            ->setPreventMissedCalls($preventMissedCalls)
            ->setAllowCallForwards($allowCallForwards)
            ->setCompany($fkTransformer->transform($company))
            ->setNoAnswerLocution($fkTransformer->transform($dto->getNoAnswerLocution()))
            ->setNoAnswerExtension($fkTransformer->transform($dto->getNoAnswerExtension()))
            ->setNoAnswerVoicemail($fkTransformer->transform($dto->getNoAnswerVoicemail()))
            ->setNoAnswerNumberCountry($fkTransformer->transform($dto->getNoAnswerNumberCountry()));

        return $this;
    }

    /**
     * @internal use EntityTools instead
     */
    public function toDto(int $depth = 0): HuntGroupDto
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
            ->setNoAnswerVoicemail(Voicemail::entityToDto(self::getNoAnswerVoicemail(), $depth))
            ->setNoAnswerNumberCountry(Country::entityToDto(self::getNoAnswerNumberCountry(), $depth));
    }

    protected function __toArray(): array
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
            'noAnswerLocutionId' => self::getNoAnswerLocution()?->getId(),
            'noAnswerExtensionId' => self::getNoAnswerExtension()?->getId(),
            'noAnswerVoicemailId' => self::getNoAnswerVoicemail()?->getId(),
            'noAnswerNumberCountryId' => self::getNoAnswerNumberCountry()?->getId()
        ];
    }

    protected function setName(string $name): static
    {
        Assertion::maxLength($name, 100, 'name value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->name = $name;

        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    protected function setDescription(string $description): static
    {
        Assertion::maxLength($description, 500, 'description value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->description = $description;

        return $this;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    protected function setStrategy(string $strategy): static
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

    public function getStrategy(): string
    {
        return $this->strategy;
    }

    protected function setRingAllTimeout(?int $ringAllTimeout = null): static
    {
        $this->ringAllTimeout = $ringAllTimeout;

        return $this;
    }

    public function getRingAllTimeout(): ?int
    {
        return $this->ringAllTimeout;
    }

    protected function setNoAnswerTargetType(?string $noAnswerTargetType = null): static
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

    public function getNoAnswerTargetType(): ?string
    {
        return $this->noAnswerTargetType;
    }

    protected function setNoAnswerNumberValue(?string $noAnswerNumberValue = null): static
    {
        if (!is_null($noAnswerNumberValue)) {
            Assertion::maxLength($noAnswerNumberValue, 25, 'noAnswerNumberValue value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->noAnswerNumberValue = $noAnswerNumberValue;

        return $this;
    }

    public function getNoAnswerNumberValue(): ?string
    {
        return $this->noAnswerNumberValue;
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

    protected function setAllowCallForwards(int $allowCallForwards): static
    {
        Assertion::greaterOrEqualThan($allowCallForwards, 0, 'allowCallForwards provided "%s" is not greater or equal than "%s".');

        $this->allowCallForwards = $allowCallForwards;

        return $this;
    }

    public function getAllowCallForwards(): int
    {
        return $this->allowCallForwards;
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

    protected function setNoAnswerLocution(?LocutionInterface $noAnswerLocution = null): static
    {
        $this->noAnswerLocution = $noAnswerLocution;

        return $this;
    }

    public function getNoAnswerLocution(): ?LocutionInterface
    {
        return $this->noAnswerLocution;
    }

    protected function setNoAnswerExtension(?ExtensionInterface $noAnswerExtension = null): static
    {
        $this->noAnswerExtension = $noAnswerExtension;

        return $this;
    }

    public function getNoAnswerExtension(): ?ExtensionInterface
    {
        return $this->noAnswerExtension;
    }

    protected function setNoAnswerVoicemail(?VoicemailInterface $noAnswerVoicemail = null): static
    {
        $this->noAnswerVoicemail = $noAnswerVoicemail;

        return $this;
    }

    public function getNoAnswerVoicemail(): ?VoicemailInterface
    {
        return $this->noAnswerVoicemail;
    }

    protected function setNoAnswerNumberCountry(?CountryInterface $noAnswerNumberCountry = null): static
    {
        $this->noAnswerNumberCountry = $noAnswerNumberCountry;

        return $this;
    }

    public function getNoAnswerNumberCountry(): ?CountryInterface
    {
        return $this->noAnswerNumberCountry;
    }
}
