<?php

namespace Ivoz\Provider\Domain\Model\HolidayDate;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\Model\DtoNormalizer;
use Ivoz\Provider\Domain\Model\Calendar\CalendarDto;
use Ivoz\Provider\Domain\Model\Locution\LocutionDto;
use Ivoz\Provider\Domain\Model\Extension\ExtensionDto;
use Ivoz\Provider\Domain\Model\User\UserDto;
use Ivoz\Provider\Domain\Model\Country\CountryDto;

/**
* HolidayDateDtoAbstract
* @codeCoverageIgnore
*/
abstract class HolidayDateDtoAbstract implements DataTransferObjectInterface
{
    use DtoNormalizer;

    /**
     * @var string
     */
    private $name;

    /**
     * @var \DateTimeInterface
     */
    private $eventDate;

    /**
     * @var bool
     */
    private $wholeDayEvent = true;

    /**
     * @var \DateTimeInterface | null
     */
    private $timeIn;

    /**
     * @var \DateTimeInterface | null
     */
    private $timeOut;

    /**
     * @var string | null
     */
    private $routeType;

    /**
     * @var string | null
     */
    private $numberValue;

    /**
     * @var int
     */
    private $id;

    /**
     * @var CalendarDto | null
     */
    private $calendar;

    /**
     * @var LocutionDto | null
     */
    private $locution;

    /**
     * @var ExtensionDto | null
     */
    private $extension;

    /**
     * @var UserDto | null
     */
    private $voiceMailUser;

    /**
     * @var CountryDto | null
     */
    private $numberCountry;

    public function __construct($id = null)
    {
        $this->setId($id);
    }

    /**
    * @inheritdoc
    */
    public static function getPropertyMap(string $context = '', string $role = null)
    {
        if ($context === self::CONTEXT_COLLECTION) {
            return ['id' => 'id'];
        }

        return [
            'name' => 'name',
            'eventDate' => 'eventDate',
            'wholeDayEvent' => 'wholeDayEvent',
            'timeIn' => 'timeIn',
            'timeOut' => 'timeOut',
            'routeType' => 'routeType',
            'numberValue' => 'numberValue',
            'id' => 'id',
            'calendarId' => 'calendar',
            'locutionId' => 'locution',
            'extensionId' => 'extension',
            'voiceMailUserId' => 'voiceMailUser',
            'numberCountryId' => 'numberCountry'
        ];
    }

    /**
    * @return array
    */
    public function toArray($hideSensitiveData = false)
    {
        $response = [
            'name' => $this->getName(),
            'eventDate' => $this->getEventDate(),
            'wholeDayEvent' => $this->getWholeDayEvent(),
            'timeIn' => $this->getTimeIn(),
            'timeOut' => $this->getTimeOut(),
            'routeType' => $this->getRouteType(),
            'numberValue' => $this->getNumberValue(),
            'id' => $this->getId(),
            'calendar' => $this->getCalendar(),
            'locution' => $this->getLocution(),
            'extension' => $this->getExtension(),
            'voiceMailUser' => $this->getVoiceMailUser(),
            'numberCountry' => $this->getNumberCountry()
        ];

        if (!$hideSensitiveData) {
            return $response;
        }

        foreach ($this->sensitiveFields as $sensitiveField) {
            if (!array_key_exists($sensitiveField, $response)) {
                throw new \Exception($sensitiveField . ' field was not found');
            }
            $response[$sensitiveField] = '*****';
        }

        return $response;
    }

    /**
     * @param string $name | null
     *
     * @return static
     */
    public function setName(?string $name = null): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param \DateTimeInterface $eventDate | null
     *
     * @return static
     */
    public function setEventDate($eventDate = null): self
    {
        $this->eventDate = $eventDate;

        return $this;
    }

    /**
     * @return \DateTimeInterface | null
     */
    public function getEventDate()
    {
        return $this->eventDate;
    }

    /**
     * @param bool $wholeDayEvent | null
     *
     * @return static
     */
    public function setWholeDayEvent(?bool $wholeDayEvent = null): self
    {
        $this->wholeDayEvent = $wholeDayEvent;

        return $this;
    }

    /**
     * @return bool | null
     */
    public function getWholeDayEvent(): ?bool
    {
        return $this->wholeDayEvent;
    }

    /**
     * @param \DateTimeInterface $timeIn | null
     *
     * @return static
     */
    public function setTimeIn($timeIn = null): self
    {
        $this->timeIn = $timeIn;

        return $this;
    }

    /**
     * @return \DateTimeInterface | null
     */
    public function getTimeIn()
    {
        return $this->timeIn;
    }

    /**
     * @param \DateTimeInterface $timeOut | null
     *
     * @return static
     */
    public function setTimeOut($timeOut = null): self
    {
        $this->timeOut = $timeOut;

        return $this;
    }

    /**
     * @return \DateTimeInterface | null
     */
    public function getTimeOut()
    {
        return $this->timeOut;
    }

    /**
     * @param string $routeType | null
     *
     * @return static
     */
    public function setRouteType(?string $routeType = null): self
    {
        $this->routeType = $routeType;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getRouteType(): ?string
    {
        return $this->routeType;
    }

    /**
     * @param string $numberValue | null
     *
     * @return static
     */
    public function setNumberValue(?string $numberValue = null): self
    {
        $this->numberValue = $numberValue;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getNumberValue(): ?string
    {
        return $this->numberValue;
    }

    /**
     * @param int $id | null
     *
     * @return static
     */
    public function setId(?int $id = null): self
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return int | null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param CalendarDto | null
     *
     * @return static
     */
    public function setCalendar(?CalendarDto $calendar = null): self
    {
        $this->calendar = $calendar;

        return $this;
    }

    /**
     * @return CalendarDto | null
     */
    public function getCalendar(): ?CalendarDto
    {
        return $this->calendar;
    }

    /**
     * @return static
     */
    public function setCalendarId($id): self
    {
        $value = !is_null($id)
            ? new CalendarDto($id)
            : null;

        return $this->setCalendar($value);
    }

    /**
     * @return mixed | null
     */
    public function getCalendarId()
    {
        if ($dto = $this->getCalendar()) {
            return $dto->getId();
        }

        return null;
    }

    /**
     * @param LocutionDto | null
     *
     * @return static
     */
    public function setLocution(?LocutionDto $locution = null): self
    {
        $this->locution = $locution;

        return $this;
    }

    /**
     * @return LocutionDto | null
     */
    public function getLocution(): ?LocutionDto
    {
        return $this->locution;
    }

    /**
     * @return static
     */
    public function setLocutionId($id): self
    {
        $value = !is_null($id)
            ? new LocutionDto($id)
            : null;

        return $this->setLocution($value);
    }

    /**
     * @return mixed | null
     */
    public function getLocutionId()
    {
        if ($dto = $this->getLocution()) {
            return $dto->getId();
        }

        return null;
    }

    /**
     * @param ExtensionDto | null
     *
     * @return static
     */
    public function setExtension(?ExtensionDto $extension = null): self
    {
        $this->extension = $extension;

        return $this;
    }

    /**
     * @return ExtensionDto | null
     */
    public function getExtension(): ?ExtensionDto
    {
        return $this->extension;
    }

    /**
     * @return static
     */
    public function setExtensionId($id): self
    {
        $value = !is_null($id)
            ? new ExtensionDto($id)
            : null;

        return $this->setExtension($value);
    }

    /**
     * @return mixed | null
     */
    public function getExtensionId()
    {
        if ($dto = $this->getExtension()) {
            return $dto->getId();
        }

        return null;
    }

    /**
     * @param UserDto | null
     *
     * @return static
     */
    public function setVoiceMailUser(?UserDto $voiceMailUser = null): self
    {
        $this->voiceMailUser = $voiceMailUser;

        return $this;
    }

    /**
     * @return UserDto | null
     */
    public function getVoiceMailUser(): ?UserDto
    {
        return $this->voiceMailUser;
    }

    /**
     * @return static
     */
    public function setVoiceMailUserId($id): self
    {
        $value = !is_null($id)
            ? new UserDto($id)
            : null;

        return $this->setVoiceMailUser($value);
    }

    /**
     * @return mixed | null
     */
    public function getVoiceMailUserId()
    {
        if ($dto = $this->getVoiceMailUser()) {
            return $dto->getId();
        }

        return null;
    }

    /**
     * @param CountryDto | null
     *
     * @return static
     */
    public function setNumberCountry(?CountryDto $numberCountry = null): self
    {
        $this->numberCountry = $numberCountry;

        return $this;
    }

    /**
     * @return CountryDto | null
     */
    public function getNumberCountry(): ?CountryDto
    {
        return $this->numberCountry;
    }

    /**
     * @return static
     */
    public function setNumberCountryId($id): self
    {
        $value = !is_null($id)
            ? new CountryDto($id)
            : null;

        return $this->setNumberCountry($value);
    }

    /**
     * @return mixed | null
     */
    public function getNumberCountryId()
    {
        if ($dto = $this->getNumberCountry()) {
            return $dto->getId();
        }

        return null;
    }

}
