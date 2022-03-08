<?php

declare(strict_types=1);

namespace Ivoz\Provider\Domain\Model\HolidayDate;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Provider\Domain\Model\Calendar\CalendarInterface;
use Ivoz\Provider\Domain\Model\Locution\LocutionInterface;
use Ivoz\Provider\Domain\Model\Extension\ExtensionInterface;
use Ivoz\Provider\Domain\Model\Voicemail\VoicemailInterface;
use Ivoz\Provider\Domain\Model\Country\CountryInterface;
use Ivoz\Provider\Domain\Model\Calendar\Calendar;
use Ivoz\Provider\Domain\Model\Locution\Locution;
use Ivoz\Provider\Domain\Model\Extension\Extension;
use Ivoz\Provider\Domain\Model\Voicemail\Voicemail;
use Ivoz\Provider\Domain\Model\Country\Country;

/**
* HolidayDateAbstract
* @codeCoverageIgnore
*/
abstract class HolidayDateAbstract
{
    use ChangelogTrait;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var \DateTimeInterface
     */
    protected $eventDate;

    /**
     * @var bool
     */
    protected $wholeDayEvent = true;

    /**
     * @var ?\DateTimeInterface
     */
    protected $timeIn = null;

    /**
     * @var ?\DateTimeInterface
     */
    protected $timeOut = null;

    /**
     * @var ?string
     * comment: enum:number|extension|voicemail
     */
    protected $routeType = null;

    /**
     * @var ?string
     */
    protected $numberValue = null;

    /**
     * @var CalendarInterface
     * inversedBy holidayDates
     */
    protected $calendar;

    /**
     * @var ?LocutionInterface
     */
    protected $locution = null;

    /**
     * @var ?ExtensionInterface
     */
    protected $extension = null;

    /**
     * @var ?VoicemailInterface
     */
    protected $voicemail = null;

    /**
     * @var ?CountryInterface
     */
    protected $numberCountry = null;

    /**
     * Constructor
     */
    protected function __construct(
        string $name,
        \DateTimeInterface $eventDate,
        bool $wholeDayEvent
    ) {
        $this->setName($name);
        $this->setEventDate($eventDate);
        $this->setWholeDayEvent($wholeDayEvent);
    }

    abstract public function getId(): null|string|int;

    public function __toString(): string
    {
        return sprintf(
            "%s#%s",
            "HolidayDate",
            (string) $this->getId()
        );
    }

    /**
     * @throws \Exception
     */
    protected function sanitizeValues(): void
    {
    }

    public static function createDto(string|int|null $id = null): HolidayDateDto
    {
        return new HolidayDateDto($id);
    }

    /**
     * @internal use EntityTools instead
     * @param null|HolidayDateInterface $entity
     */
    public static function entityToDto(?EntityInterface $entity, int $depth = 0): ?HolidayDateDto
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

        $dto = $entity->toDto($depth - 1);

        return $dto;
    }

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param HolidayDateDto $dto
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
        Assertion::isInstanceOf($dto, HolidayDateDto::class);
        $name = $dto->getName();
        Assertion::notNull($name, 'getName value is null, but non null value was expected.');
        $eventDate = $dto->getEventDate();
        Assertion::notNull($eventDate, 'getEventDate value is null, but non null value was expected.');
        $wholeDayEvent = $dto->getWholeDayEvent();
        Assertion::notNull($wholeDayEvent, 'getWholeDayEvent value is null, but non null value was expected.');
        $calendar = $dto->getCalendar();
        Assertion::notNull($calendar, 'getCalendar value is null, but non null value was expected.');

        $self = new static(
            $name,
            $eventDate,
            $wholeDayEvent
        );

        $self
            ->setTimeIn($dto->getTimeIn())
            ->setTimeOut($dto->getTimeOut())
            ->setRouteType($dto->getRouteType())
            ->setNumberValue($dto->getNumberValue())
            ->setCalendar($fkTransformer->transform($calendar))
            ->setLocution($fkTransformer->transform($dto->getLocution()))
            ->setExtension($fkTransformer->transform($dto->getExtension()))
            ->setVoicemail($fkTransformer->transform($dto->getVoicemail()))
            ->setNumberCountry($fkTransformer->transform($dto->getNumberCountry()));

        $self->initChangelog();

        return $self;
    }

    /**
     * @internal use EntityTools instead
     * @param HolidayDateDto $dto
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
        Assertion::isInstanceOf($dto, HolidayDateDto::class);

        $name = $dto->getName();
        Assertion::notNull($name, 'getName value is null, but non null value was expected.');
        $eventDate = $dto->getEventDate();
        Assertion::notNull($eventDate, 'getEventDate value is null, but non null value was expected.');
        $wholeDayEvent = $dto->getWholeDayEvent();
        Assertion::notNull($wholeDayEvent, 'getWholeDayEvent value is null, but non null value was expected.');
        $calendar = $dto->getCalendar();
        Assertion::notNull($calendar, 'getCalendar value is null, but non null value was expected.');

        $this
            ->setName($name)
            ->setEventDate($eventDate)
            ->setWholeDayEvent($wholeDayEvent)
            ->setTimeIn($dto->getTimeIn())
            ->setTimeOut($dto->getTimeOut())
            ->setRouteType($dto->getRouteType())
            ->setNumberValue($dto->getNumberValue())
            ->setCalendar($fkTransformer->transform($calendar))
            ->setLocution($fkTransformer->transform($dto->getLocution()))
            ->setExtension($fkTransformer->transform($dto->getExtension()))
            ->setVoicemail($fkTransformer->transform($dto->getVoicemail()))
            ->setNumberCountry($fkTransformer->transform($dto->getNumberCountry()));

        return $this;
    }

    /**
     * @internal use EntityTools instead
     */
    public function toDto(int $depth = 0): HolidayDateDto
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
            ->setVoicemail(Voicemail::entityToDto(self::getVoicemail(), $depth))
            ->setNumberCountry(Country::entityToDto(self::getNumberCountry(), $depth));
    }

    protected function __toArray(): array
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
            'locutionId' => self::getLocution()?->getId(),
            'extensionId' => self::getExtension()?->getId(),
            'voicemailId' => self::getVoicemail()?->getId(),
            'numberCountryId' => self::getNumberCountry()?->getId()
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

    protected function setEventDate(\DateTimeInterface $eventDate): static
    {
        $this->eventDate = $eventDate;

        return $this;
    }

    public function getEventDate(): \DateTimeInterface
    {
        return $this->eventDate;
    }

    protected function setWholeDayEvent(bool $wholeDayEvent): static
    {
        $this->wholeDayEvent = $wholeDayEvent;

        return $this;
    }

    public function getWholeDayEvent(): bool
    {
        return $this->wholeDayEvent;
    }

    protected function setTimeIn(?\DateTimeInterface $timeIn = null): static
    {
        $this->timeIn = $timeIn;

        return $this;
    }

    public function getTimeIn(): ?\DateTimeInterface
    {
        return $this->timeIn;
    }

    protected function setTimeOut(?\DateTimeInterface $timeOut = null): static
    {
        $this->timeOut = $timeOut;

        return $this;
    }

    public function getTimeOut(): ?\DateTimeInterface
    {
        return $this->timeOut;
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

    protected function setVoicemail(?VoicemailInterface $voicemail = null): static
    {
        $this->voicemail = $voicemail;

        return $this;
    }

    public function getVoicemail(): ?VoicemailInterface
    {
        return $this->voicemail;
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
