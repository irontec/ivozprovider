<?php

declare(strict_types=1);

namespace Ivoz\Provider\Domain\Model\HolidayDate;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Core\Domain\Model\Helper\DateTimeHelper;
use Ivoz\Provider\Domain\Model\Calendar\CalendarInterface;
use Ivoz\Provider\Domain\Model\Locution\LocutionInterface;
use Ivoz\Provider\Domain\Model\Extension\ExtensionInterface;
use Ivoz\Provider\Domain\Model\User\UserInterface;
use Ivoz\Provider\Domain\Model\Country\CountryInterface;
use Ivoz\Provider\Domain\Model\Calendar\Calendar;
use Ivoz\Provider\Domain\Model\Locution\Locution;
use Ivoz\Provider\Domain\Model\Extension\Extension;
use Ivoz\Provider\Domain\Model\User\User;
use Ivoz\Provider\Domain\Model\Country\Country;

/**
* HolidayDateAbstract
* @codeCoverageIgnore
*/
abstract class HolidayDateAbstract
{
    use ChangelogTrait;

    protected $name;

    protected $eventDate;

    protected $wholeDayEvent = true;

    protected $timeIn;

    protected $timeOut;

    /**
     * comment: enum:number|extension|voicemail
     */
    protected $routeType;

    protected $numberValue;

    /**
     * @var CalendarInterface
     * inversedBy holidayDates
     */
    protected $calendar;

    /**
     * @var LocutionInterface | null
     */
    protected $locution;

    /**
     * @var ExtensionInterface | null
     */
    protected $extension;

    /**
     * @var UserInterface | null
     */
    protected $voiceMailUser;

    /**
     * @var CountryInterface | null
     */
    protected $numberCountry;

    /**
     * Constructor
     */
    protected function __construct(
        string $name,
        \DateTimeInterface|string $eventDate,
        bool $wholeDayEvent
    ) {
        $this->setName($name);
        $this->setEventDate($eventDate);
        $this->setWholeDayEvent($wholeDayEvent);
    }

    abstract public function getId();

    public function __toString()
    {
        return sprintf(
            "%s#%s",
            "HolidayDate",
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
    public static function createDto($id = null): HolidayDateDto
    {
        return new HolidayDateDto($id);
    }

    /**
     * @internal use EntityTools instead
     * @param HolidayDateInterface|null $entity
     * @param int $depth
     * @return HolidayDateDto|null
     */
    public static function entityToDto(EntityInterface $entity = null, $depth = 0)
    {
        if (!$entity) {
            return null;
        }

        Assertion::isInstanceOf($entity, HolidayDateInterface::class);

        if ($depth < 1) {
            return static::createDto($entity->getId());
        }

        if ($entity instanceof \Doctrine\ORM\Proxy\Proxy && !$entity->__isInitialized()) {
            return static::createDto($entity->getId());
        }

        /** @var HolidayDateDto $dto */
        $dto = $entity->toDto($depth - 1);

        return $dto;
    }

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param HolidayDateDto $dto
     * @return self
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ) {
        Assertion::isInstanceOf($dto, HolidayDateDto::class);

        $self = new static(
            $dto->getName(),
            $dto->getEventDate(),
            $dto->getWholeDayEvent()
        );

        $self
            ->setTimeIn($dto->getTimeIn())
            ->setTimeOut($dto->getTimeOut())
            ->setRouteType($dto->getRouteType())
            ->setNumberValue($dto->getNumberValue())
            ->setCalendar($fkTransformer->transform($dto->getCalendar()))
            ->setLocution($fkTransformer->transform($dto->getLocution()))
            ->setExtension($fkTransformer->transform($dto->getExtension()))
            ->setVoiceMailUser($fkTransformer->transform($dto->getVoiceMailUser()))
            ->setNumberCountry($fkTransformer->transform($dto->getNumberCountry()));

        $self->initChangelog();

        return $self;
    }

    /**
     * @internal use EntityTools instead
     * @param HolidayDateDto $dto
     * @return self
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ) {
        Assertion::isInstanceOf($dto, HolidayDateDto::class);

        $this
            ->setName($dto->getName())
            ->setEventDate($dto->getEventDate())
            ->setWholeDayEvent($dto->getWholeDayEvent())
            ->setTimeIn($dto->getTimeIn())
            ->setTimeOut($dto->getTimeOut())
            ->setRouteType($dto->getRouteType())
            ->setNumberValue($dto->getNumberValue())
            ->setCalendar($fkTransformer->transform($dto->getCalendar()))
            ->setLocution($fkTransformer->transform($dto->getLocution()))
            ->setExtension($fkTransformer->transform($dto->getExtension()))
            ->setVoiceMailUser($fkTransformer->transform($dto->getVoiceMailUser()))
            ->setNumberCountry($fkTransformer->transform($dto->getNumberCountry()));

        return $this;
    }

    /**
     * @internal use EntityTools instead
     * @param int $depth
     */
    public function toDto($depth = 0): HolidayDateDto
    {
        return self::createDto()
            ->setName(self::getName())
            ->setEventDate(self::getEventDate())
            ->setWholeDayEvent(self::getWholeDayEvent())
            ->setTimeIn(self::getTimeIn())
            ->setTimeOut(self::getTimeOut())
            ->setRouteType(self::getRouteType())
            ->setNumberValue(self::getNumberValue())
            ->setCalendar(Calendar::entityToDto(self::getCalendar(), $depth))
            ->setLocution(Locution::entityToDto(self::getLocution(), $depth))
            ->setExtension(Extension::entityToDto(self::getExtension(), $depth))
            ->setVoiceMailUser(User::entityToDto(self::getVoiceMailUser(), $depth))
            ->setNumberCountry(Country::entityToDto(self::getNumberCountry(), $depth));
    }

    /**
     * @return array
     */
    protected function __toArray()
    {
        return [
            'name' => self::getName(),
            'eventDate' => self::getEventDate(),
            'wholeDayEvent' => self::getWholeDayEvent(),
            'timeIn' => self::getTimeIn(),
            'timeOut' => self::getTimeOut(),
            'routeType' => self::getRouteType(),
            'numberValue' => self::getNumberValue(),
            'calendarId' => self::getCalendar()->getId(),
            'locutionId' => self::getLocution() ? self::getLocution()->getId() : null,
            'extensionId' => self::getExtension() ? self::getExtension()->getId() : null,
            'voiceMailUserId' => self::getVoiceMailUser() ? self::getVoiceMailUser()->getId() : null,
            'numberCountryId' => self::getNumberCountry() ? self::getNumberCountry()->getId() : null
        ];
    }

    protected function setName(string $name): static
    {
        Assertion::maxLength($name, 50, 'name value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->name = $name;

        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    protected function setEventDate($eventDate): static
    {
        $this->eventDate = $eventDate;

        return $this;
    }

    /**
     * @return \DateTime|\DateTimeImmutable
     */
    public function getEventDate(): \DateTimeInterface
    {
        return clone $this->eventDate;
    }

    protected function setWholeDayEvent(bool $wholeDayEvent): static
    {
        Assertion::between((int) $wholeDayEvent, 0, 1, 'wholeDayEvent provided "%s" is not a valid boolean value.');
        $wholeDayEvent = (bool) $wholeDayEvent;

        $this->wholeDayEvent = $wholeDayEvent;

        return $this;
    }

    public function getWholeDayEvent(): bool
    {
        return $this->wholeDayEvent;
    }

    protected function setTimeIn($timeIn = null): static
    {
        $this->timeIn = $timeIn;

        return $this;
    }

    /**
     * @return \DateTime|\DateTimeImmutable
     */
    public function getTimeIn(): ?\DateTimeInterface
    {
        return !is_null($this->timeIn) ? clone $this->timeIn : null;
    }

    protected function setTimeOut($timeOut = null): static
    {
        $this->timeOut = $timeOut;

        return $this;
    }

    /**
     * @return \DateTime|\DateTimeImmutable
     */
    public function getTimeOut(): ?\DateTimeInterface
    {
        return !is_null($this->timeOut) ? clone $this->timeOut : null;
    }

    protected function setRouteType(?string $routeType = null): static
    {
        if (!is_null($routeType)) {
            Assertion::maxLength($routeType, 25, 'routeType value "%s" is too long, it should have no more than %d characters, but has %d characters.');
            Assertion::choice(
                $routeType,
                [
                    HolidayDateInterface::ROUTETYPE_NUMBER,
                    HolidayDateInterface::ROUTETYPE_EXTENSION,
                    HolidayDateInterface::ROUTETYPE_VOICEMAIL,
                ],
                'routeTypevalue "%s" is not an element of the valid values: %s'
            );
        }

        $this->routeType = $routeType;

        return $this;
    }

    public function getRouteType(): ?string
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

    public function setCalendar(CalendarInterface $calendar): static
    {
        $this->calendar = $calendar;

        return $this;
    }

    public function getCalendar(): CalendarInterface
    {
        return $this->calendar;
    }

    protected function setLocution(?LocutionInterface $locution = null): static
    {
        $this->locution = $locution;

        return $this;
    }

    public function getLocution(): ?LocutionInterface
    {
        return $this->locution;
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
