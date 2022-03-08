<?php

declare(strict_types=1);

namespace Ivoz\Provider\Domain\Model\IvrEntry;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Provider\Domain\Model\Ivr\IvrInterface;
use Ivoz\Provider\Domain\Model\Locution\LocutionInterface;
use Ivoz\Provider\Domain\Model\Extension\ExtensionInterface;
use Ivoz\Provider\Domain\Model\Voicemail\VoicemailInterface;
use Ivoz\Provider\Domain\Model\ConditionalRoute\ConditionalRouteInterface;
use Ivoz\Provider\Domain\Model\Country\CountryInterface;
use Ivoz\Provider\Domain\Model\Ivr\Ivr;
use Ivoz\Provider\Domain\Model\Locution\Locution;
use Ivoz\Provider\Domain\Model\Extension\Extension;
use Ivoz\Provider\Domain\Model\Voicemail\Voicemail;
use Ivoz\Provider\Domain\Model\ConditionalRoute\ConditionalRoute;
use Ivoz\Provider\Domain\Model\Country\Country;

/**
* IvrEntryAbstract
* @codeCoverageIgnore
*/
abstract class IvrEntryAbstract
{
    use ChangelogTrait;

    /**
     * @var string
     */
    protected $entry;

    /**
     * @var string
     * comment: enum:number|extension|voicemail|conditional
     */
    protected $routeType;

    /**
     * @var ?string
     */
    protected $numberValue = null;

    /**
     * @var IvrInterface
     * inversedBy entries
     */
    protected $ivr;

    /**
     * @var ?LocutionInterface
     */
    protected $welcomeLocution = null;

    /**
     * @var ?ExtensionInterface
     */
    protected $extension = null;

    /**
     * @var ?VoicemailInterface
     */
    protected $voicemail = null;

    /**
     * @var ?ConditionalRouteInterface
     */
    protected $conditionalRoute = null;

    /**
     * @var ?CountryInterface
     */
    protected $numberCountry = null;

    /**
     * Constructor
     */
    protected function __construct(
        string $entry,
        string $routeType
    ) {
        $this->setEntry($entry);
        $this->setRouteType($routeType);
    }

    abstract public function getId(): null|string|int;

    public function __toString(): string
    {
        return sprintf(
            "%s#%s",
            "IvrEntry",
            (string) $this->getId()
        );
    }

    /**
     * @throws \Exception
     */
    protected function sanitizeValues(): void
    {
    }

    public static function createDto(string|int|null $id = null): IvrEntryDto
    {
        return new IvrEntryDto($id);
    }

    /**
     * @internal use EntityTools instead
     * @param null|IvrEntryInterface $entity
     */
    public static function entityToDto(?EntityInterface $entity, int $depth = 0): ?IvrEntryDto
    {
        if (!$entity) {
            return null;
        }

        Assertion::isInstanceOf($entity, IvrEntryInterface::class);

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
     * @param IvrEntryDto $dto
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
        Assertion::isInstanceOf($dto, IvrEntryDto::class);
        $entry = $dto->getEntry();
        Assertion::notNull($entry, 'getEntry value is null, but non null value was expected.');
        $routeType = $dto->getRouteType();
        Assertion::notNull($routeType, 'getRouteType value is null, but non null value was expected.');
        $ivr = $dto->getIvr();
        Assertion::notNull($ivr, 'getIvr value is null, but non null value was expected.');

        $self = new static(
            $entry,
            $routeType
        );

        $self
            ->setNumberValue($dto->getNumberValue())
            ->setIvr($fkTransformer->transform($ivr))
            ->setWelcomeLocution($fkTransformer->transform($dto->getWelcomeLocution()))
            ->setExtension($fkTransformer->transform($dto->getExtension()))
            ->setVoicemail($fkTransformer->transform($dto->getVoicemail()))
            ->setConditionalRoute($fkTransformer->transform($dto->getConditionalRoute()))
            ->setNumberCountry($fkTransformer->transform($dto->getNumberCountry()));

        $self->initChangelog();

        return $self;
    }

    /**
     * @internal use EntityTools instead
     * @param IvrEntryDto $dto
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
        Assertion::isInstanceOf($dto, IvrEntryDto::class);

        $entry = $dto->getEntry();
        Assertion::notNull($entry, 'getEntry value is null, but non null value was expected.');
        $routeType = $dto->getRouteType();
        Assertion::notNull($routeType, 'getRouteType value is null, but non null value was expected.');
        $ivr = $dto->getIvr();
        Assertion::notNull($ivr, 'getIvr value is null, but non null value was expected.');

        $this
            ->setEntry($entry)
            ->setRouteType($routeType)
            ->setNumberValue($dto->getNumberValue())
            ->setIvr($fkTransformer->transform($ivr))
            ->setWelcomeLocution($fkTransformer->transform($dto->getWelcomeLocution()))
            ->setExtension($fkTransformer->transform($dto->getExtension()))
            ->setVoicemail($fkTransformer->transform($dto->getVoicemail()))
            ->setConditionalRoute($fkTransformer->transform($dto->getConditionalRoute()))
            ->setNumberCountry($fkTransformer->transform($dto->getNumberCountry()));

        return $this;
    }

    /**
     * @internal use EntityTools instead
     */
    public function toDto(int $depth = 0): IvrEntryDto
    {
        return self::createDto()
            ->setEntry(self::getEntry())
            ->setRouteType(self::getRouteType())
            ->setNumberValue(self::getNumberValue())
            ->setIvr(Ivr::entityToDto(self::getIvr(), $depth))
            ->setWelcomeLocution(Locution::entityToDto(self::getWelcomeLocution(), $depth))
            ->setExtension(Extension::entityToDto(self::getExtension(), $depth))
            ->setVoicemail(Voicemail::entityToDto(self::getVoicemail(), $depth))
            ->setConditionalRoute(ConditionalRoute::entityToDto(self::getConditionalRoute(), $depth))
            ->setNumberCountry(Country::entityToDto(self::getNumberCountry(), $depth));
    }

    protected function __toArray(): array
    {
        return [
            'entry' => self::getEntry(),
            'routeType' => self::getRouteType(),
            'numberValue' => self::getNumberValue(),
            'ivrId' => self::getIvr()->getId(),
            'welcomeLocutionId' => self::getWelcomeLocution()?->getId(),
            'extensionId' => self::getExtension()?->getId(),
            'voicemailId' => self::getVoicemail()?->getId(),
            'conditionalRouteId' => self::getConditionalRoute()?->getId(),
            'numberCountryId' => self::getNumberCountry()?->getId()
        ];
    }

    protected function setEntry(string $entry): static
    {
        Assertion::maxLength($entry, 40, 'entry value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->entry = $entry;

        return $this;
    }

    public function getEntry(): string
    {
        return $this->entry;
    }

    protected function setRouteType(string $routeType): static
    {
        Assertion::maxLength($routeType, 25, 'routeType value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        Assertion::choice(
            $routeType,
            [
                IvrEntryInterface::ROUTETYPE_NUMBER,
                IvrEntryInterface::ROUTETYPE_EXTENSION,
                IvrEntryInterface::ROUTETYPE_VOICEMAIL,
                IvrEntryInterface::ROUTETYPE_CONDITIONAL,
            ],
            'routeTypevalue "%s" is not an element of the valid values: %s'
        );

        $this->routeType = $routeType;

        return $this;
    }

    public function getRouteType(): string
    {
        return $this->routeType;
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

    public function setIvr(IvrInterface $ivr): static
    {
        $this->ivr = $ivr;

        return $this;
    }

    public function getIvr(): IvrInterface
    {
        return $this->ivr;
    }

    protected function setWelcomeLocution(?LocutionInterface $welcomeLocution = null): static
    {
        $this->welcomeLocution = $welcomeLocution;

        return $this;
    }

    public function getWelcomeLocution(): ?LocutionInterface
    {
        return $this->welcomeLocution;
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

    protected function setVoicemail(?VoicemailInterface $voicemail = null): static
    {
        $this->voicemail = $voicemail;

        return $this;
    }

    public function getVoicemail(): ?VoicemailInterface
    {
        return $this->voicemail;
    }

    protected function setConditionalRoute(?ConditionalRouteInterface $conditionalRoute = null): static
    {
        $this->conditionalRoute = $conditionalRoute;

        return $this;
    }

    public function getConditionalRoute(): ?ConditionalRouteInterface
    {
        return $this->conditionalRoute;
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
}
