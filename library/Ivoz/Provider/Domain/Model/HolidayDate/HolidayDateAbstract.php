<?php
declare(strict_types = 1);

namespace Ivoz\Provider\Domain\Model\HolidayDate;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;
use \Ivoz\Core\Application\ForeignKeyTransformerInterface;
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
     * @var \DateTimeInterface | null
     */
    protected $timeIn;

    /**
     * @var \DateTimeInterface | null
     */
    protected $timeOut;

    /**
     * comment: enum:number|extension|voicemail
     * @var string | null
     */
    protected $routeType;

    /**
     * @var string | null
     */
    protected $numberValue;

    /**
     * @var CalendarInterface
     * inversedBy holidayDates
     */
    protected $calendar;

    /**
     * @var LocutionInterface
     */
    protected $locution;

    /**
     * @var ExtensionInterface
     */
    protected $extension;

    /**
     * @var UserInterface
     */
    protected $voiceMailUser;

    /**
     * @var CountryInterface
     */
    protected $numberCountry;

    /**
     * Constructor
     */
    protected function __construct(
        $name,
        $eventDate,
        $wholeDayEvent
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
     * @param null $id
     * @return HolidayDateDto
     */
    public static function createDto($id = null)
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
        $dto = $entity->toDto($depth-1);

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
     * @return HolidayDateDto
     */
    public function toDto($depth = 0)
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

    /**
     * Set name
     *
     * @param string $name
     *
     * @return static
     */
    protected function setName(string $name): HolidayDateInterface
    {
        Assertion::maxLength($name, 50, 'name value "%s" is too long, it should have no more than %d characters, but has %d characters.');

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
     * Set eventDate
     *
     * @param \DateTimeInterface $eventDate
     *
     * @return static
     */
    protected function setEventDate($eventDate): HolidayDateInterface
    {
        $this->eventDate = $eventDate;

        return $this;
    }

    /**
     * Get eventDate
     *
     * @return \DateTimeInterface
     */
    public function getEventDate(): \DateTimeInterface
    {
        return clone $this->eventDate;
    }

    /**
     * Set wholeDayEvent
     *
     * @param bool $wholeDayEvent
     *
     * @return static
     */
    protected function setWholeDayEvent(bool $wholeDayEvent): HolidayDateInterface
    {
        Assertion::between(intval($wholeDayEvent), 0, 1, 'wholeDayEvent provided "%s" is not a valid boolean value.');
        $wholeDayEvent = (bool) $wholeDayEvent;

        $this->wholeDayEvent = $wholeDayEvent;

        return $this;
    }

    /**
     * Get wholeDayEvent
     *
     * @return bool
     */
    public function getWholeDayEvent(): bool
    {
        return $this->wholeDayEvent;
    }

    /**
     * Set timeIn
     *
     * @param \DateTimeInterface $timeIn | null
     *
     * @return static
     */
    protected function setTimeIn($timeIn = null): HolidayDateInterface
    {
        $this->timeIn = $timeIn;

        return $this;
    }

    /**
     * Get timeIn
     *
     * @return \DateTimeInterface | null
     */
    public function getTimeIn(): ?\DateTimeInterface
    {
        return !is_null($this->timeIn) ? clone $this->timeIn : null;
    }

    /**
     * Set timeOut
     *
     * @param \DateTimeInterface $timeOut | null
     *
     * @return static
     */
    protected function setTimeOut($timeOut = null): HolidayDateInterface
    {
        $this->timeOut = $timeOut;

        return $this;
    }

    /**
     * Get timeOut
     *
     * @return \DateTimeInterface | null
     */
    public function getTimeOut(): ?\DateTimeInterface
    {
        return !is_null($this->timeOut) ? clone $this->timeOut : null;
    }

    /**
     * Set routeType
     *
     * @param string $routeType | null
     *
     * @return static
     */
    protected function setRouteType(?string $routeType = null): HolidayDateInterface
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

    /**
     * Get routeType
     *
     * @return string | null
     */
    public function getRouteType(): ?string
    {
        return $this->routeType;
    }

    /**
     * Set numberValue
     *
     * @param string $numberValue | null
     *
     * @return static
     */
    protected function setNumberValue(?string $numberValue = null): HolidayDateInterface
    {
        if (!is_null($numberValue)) {
            Assertion::maxLength($numberValue, 25, 'numberValue value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->numberValue = $numberValue;

        return $this;
    }

    /**
     * Get numberValue
     *
     * @return string | null
     */
    public function getNumberValue(): ?string
    {
        return $this->numberValue;
    }

    /**
     * Set calendar
     *
     * @param CalendarInterface
     *
     * @return static
     */
    public function setCalendar(CalendarInterface $calendar): HolidayDateInterface
    {
        $this->calendar = $calendar;

        return $this;
    }

    /**
     * Get calendar
     *
     * @return CalendarInterface
     */
    public function getCalendar(): CalendarInterface
    {
        return $this->calendar;
    }

    /**
     * Set locution
     *
     * @param LocutionInterface | null
     *
     * @return static
     */
    protected function setLocution(?LocutionInterface $locution = null): HolidayDateInterface
    {
        $this->locution = $locution;

        return $this;
    }

    /**
     * Get locution
     *
     * @return LocutionInterface | null
     */
    public function getLocution(): ?LocutionInterface
    {
        return $this->locution;
    }

    /**
     * Set extension
     *
     * @param ExtensionInterface | null
     *
     * @return static
     */
    protected function setExtension(?ExtensionInterface $extension = null): HolidayDateInterface
    {
        $this->extension = $extension;

        return $this;
    }

    /**
     * Get extension
     *
     * @return ExtensionInterface | null
     */
    public function getExtension(): ?ExtensionInterface
    {
        return $this->extension;
    }

    /**
     * Set voiceMailUser
     *
     * @param UserInterface | null
     *
     * @return static
     */
    protected function setVoiceMailUser(?UserInterface $voiceMailUser = null): HolidayDateInterface
    {
        $this->voiceMailUser = $voiceMailUser;

        return $this;
    }

    /**
     * Get voiceMailUser
     *
     * @return UserInterface | null
     */
    public function getVoiceMailUser(): ?UserInterface
    {
        return $this->voiceMailUser;
    }

    /**
     * Set numberCountry
     *
     * @param CountryInterface | null
     *
     * @return static
     */
    protected function setNumberCountry(?CountryInterface $numberCountry = null): HolidayDateInterface
    {
        $this->numberCountry = $numberCountry;

        return $this;
    }

    /**
     * Get numberCountry
     *
     * @return CountryInterface | null
     */
    public function getNumberCountry(): ?CountryInterface
    {
        return $this->numberCountry;
    }

}
