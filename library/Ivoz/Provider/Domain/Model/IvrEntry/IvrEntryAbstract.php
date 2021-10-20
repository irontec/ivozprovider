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
use Ivoz\Provider\Domain\Model\User\UserInterface;
use Ivoz\Provider\Domain\Model\ConditionalRoute\ConditionalRouteInterface;
use Ivoz\Provider\Domain\Model\Country\CountryInterface;
use Ivoz\Provider\Domain\Model\Ivr\Ivr;
use Ivoz\Provider\Domain\Model\Locution\Locution;
use Ivoz\Provider\Domain\Model\Extension\Extension;
use Ivoz\Provider\Domain\Model\User\User;
use Ivoz\Provider\Domain\Model\ConditionalRoute\ConditionalRoute;
use Ivoz\Provider\Domain\Model\Country\Country;

/**
* IvrEntryAbstract
* @codeCoverageIgnore
*/
abstract class IvrEntryAbstract
{
    use ChangelogTrait;

    protected $entry;

    /**
     * comment: enum:number|extension|voicemail|conditional
     */
    protected $routeType;

    protected $numberValue;

    /**
     * @var IvrInterface
     * inversedBy entries
     */
    protected $ivr;

    /**
     * @var LocutionInterface | null
     */
    protected $welcomeLocution;

    /**
     * @var ExtensionInterface | null
     */
    protected $extension;

    /**
     * @var UserInterface | null
     */
    protected $voiceMailUser;

    /**
     * @var ConditionalRouteInterface | null
     */
    protected $conditionalRoute;

    /**
     * @var CountryInterface | null
     */
    protected $numberCountry;

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

    abstract public function getId();

    public function __toString()
    {
        return sprintf(
            "%s#%s",
            "IvrEntry",
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
     */
    public static function createDto($id = null): IvrEntryDto
    {
        return new IvrEntryDto($id);
    }

    /**
     * @internal use EntityTools instead
     * @param IvrEntryInterface|null $entity
     * @param int $depth
     * @return IvrEntryDto|null
     */
    public static function entityToDto(EntityInterface $entity = null, $depth = 0)
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

        /** @var IvrEntryDto $dto */
        $dto = $entity->toDto($depth - 1);

        return $dto;
    }

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param IvrEntryDto $dto
     * @return self
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ) {
        Assertion::isInstanceOf($dto, IvrEntryDto::class);

        $self = new static(
            $dto->getEntry(),
            $dto->getRouteType()
        );

        $self
            ->setNumberValue($dto->getNumberValue())
            ->setIvr($fkTransformer->transform($dto->getIvr()))
            ->setWelcomeLocution($fkTransformer->transform($dto->getWelcomeLocution()))
            ->setExtension($fkTransformer->transform($dto->getExtension()))
            ->setVoiceMailUser($fkTransformer->transform($dto->getVoiceMailUser()))
            ->setConditionalRoute($fkTransformer->transform($dto->getConditionalRoute()))
            ->setNumberCountry($fkTransformer->transform($dto->getNumberCountry()));

        $self->initChangelog();

        return $self;
    }

    /**
     * @internal use EntityTools instead
     * @param IvrEntryDto $dto
     * @return self
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ) {
        Assertion::isInstanceOf($dto, IvrEntryDto::class);

        $this
            ->setEntry($dto->getEntry())
            ->setRouteType($dto->getRouteType())
            ->setNumberValue($dto->getNumberValue())
            ->setIvr($fkTransformer->transform($dto->getIvr()))
            ->setWelcomeLocution($fkTransformer->transform($dto->getWelcomeLocution()))
            ->setExtension($fkTransformer->transform($dto->getExtension()))
            ->setVoiceMailUser($fkTransformer->transform($dto->getVoiceMailUser()))
            ->setConditionalRoute($fkTransformer->transform($dto->getConditionalRoute()))
            ->setNumberCountry($fkTransformer->transform($dto->getNumberCountry()));

        return $this;
    }

    /**
     * @internal use EntityTools instead
     * @param int $depth
     */
    public function toDto($depth = 0): IvrEntryDto
    {
        return self::createDto()
            ->setEntry(self::getEntry())
            ->setRouteType(self::getRouteType())
            ->setNumberValue(self::getNumberValue())
            ->setIvr(Ivr::entityToDto(self::getIvr(), $depth))
            ->setWelcomeLocution(Locution::entityToDto(self::getWelcomeLocution(), $depth))
            ->setExtension(Extension::entityToDto(self::getExtension(), $depth))
            ->setVoiceMailUser(User::entityToDto(self::getVoiceMailUser(), $depth))
            ->setConditionalRoute(ConditionalRoute::entityToDto(self::getConditionalRoute(), $depth))
            ->setNumberCountry(Country::entityToDto(self::getNumberCountry(), $depth));
    }

    /**
     * @return array
     */
    protected function __toArray()
    {
        return [
            'entry' => self::getEntry(),
            'routeType' => self::getRouteType(),
            'numberValue' => self::getNumberValue(),
            'ivrId' => self::getIvr()->getId(),
            'welcomeLocutionId' => self::getWelcomeLocution() ? self::getWelcomeLocution()->getId() : null,
            'extensionId' => self::getExtension() ? self::getExtension()->getId() : null,
            'voiceMailUserId' => self::getVoiceMailUser() ? self::getVoiceMailUser()->getId() : null,
            'conditionalRouteId' => self::getConditionalRoute() ? self::getConditionalRoute()->getId() : null,
            'numberCountryId' => self::getNumberCountry() ? self::getNumberCountry()->getId() : null
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

        /** @var  $this */
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

    protected function setVoiceMailUser(?UserInterface $voiceMailUser = null): static
    {
        $this->voiceMailUser = $voiceMailUser;

        return $this;
    }

    public function getVoiceMailUser(): ?UserInterface
    {
        return $this->voiceMailUser;
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
