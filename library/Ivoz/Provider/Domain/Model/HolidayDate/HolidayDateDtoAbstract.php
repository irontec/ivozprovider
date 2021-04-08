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
    private $name = '';

    /**
     * @var \DateTime|string
     */
    private $eventDate;

    /**
     * @var bool
     */
    private $wholeDayEvent = true;

    /**
     * @var \DateTime|string|null
     */
    private $timeIn;

    /**
     * @var \DateTime|string|null
     */
    private $timeOut;

    /**
     * @var string|null
     */
    private $routeType;

    /**
     * @var string|null
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

    public function setName(?string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setEventDate(null|\DateTime|string $eventDate): static
    {
        $this->eventDate = $eventDate;

        return $this;
    }

    public function getEventDate(): \DateTime|string|null
    {
        return $this->eventDate;
    }

    public function setWholeDayEvent(?bool $wholeDayEvent): static
    {
        $this->wholeDayEvent = $wholeDayEvent;

        return $this;
    }

    public function getWholeDayEvent(): ?bool
    {
        return $this->wholeDayEvent;
    }

    public function setTimeIn(null|\DateTime|string $timeIn): static
    {
        $this->timeIn = $timeIn;

        return $this;
    }

    public function getTimeIn(): \DateTime|string|null
    {
        return $this->timeIn;
    }

    public function setTimeOut(null|\DateTime|string $timeOut): static
    {
        $this->timeOut = $timeOut;

        return $this;
    }

    public function getTimeOut(): \DateTime|string|null
    {
        return $this->timeOut;
    }

    public function setRouteType(?string $routeType): static
    {
        $this->routeType = $routeType;

        return $this;
    }

    public function getRouteType(): ?string
    {
        return $this->routeType;
    }

    public function setNumberValue(?string $numberValue): static
    {
        $this->numberValue = $numberValue;

        return $this;
    }

    public function getNumberValue(): ?string
    {
        return $this->numberValue;
    }

    public function setId($id): static
    {
        $this->id = $id;

        return $this;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setCalendar(?CalendarDto $calendar): static
    {
        $this->calendar = $calendar;

        return $this;
    }

    public function getCalendar(): ?CalendarDto
    {
        return $this->calendar;
    }

    public function setCalendarId($id): static
    {
        $value = !is_null($id)
            ? new CalendarDto($id)
            : null;

        return $this->setCalendar($value);
    }

    public function getCalendarId()
    {
        if ($dto = $this->getCalendar()) {
            return $dto->getId();
        }

        return null;
    }

    public function setLocution(?LocutionDto $locution): static
    {
        $this->locution = $locution;

        return $this;
    }

    public function getLocution(): ?LocutionDto
    {
        return $this->locution;
    }

    public function setLocutionId($id): static
    {
        $value = !is_null($id)
            ? new LocutionDto($id)
            : null;

        return $this->setLocution($value);
    }

    public function getLocutionId()
    {
        if ($dto = $this->getLocution()) {
            return $dto->getId();
        }

        return null;
    }

    public function setExtension(?ExtensionDto $extension): static
    {
        $this->extension = $extension;

        return $this;
    }

    public function getExtension(): ?ExtensionDto
    {
        return $this->extension;
    }

    public function setExtensionId($id): static
    {
        $value = !is_null($id)
            ? new ExtensionDto($id)
            : null;

        return $this->setExtension($value);
    }

    public function getExtensionId()
    {
        if ($dto = $this->getExtension()) {
            return $dto->getId();
        }

        return null;
    }

    public function setVoiceMailUser(?UserDto $voiceMailUser): static
    {
        $this->voiceMailUser = $voiceMailUser;

        return $this;
    }

    public function getVoiceMailUser(): ?UserDto
    {
        return $this->voiceMailUser;
    }

    public function setVoiceMailUserId($id): static
    {
        $value = !is_null($id)
            ? new UserDto($id)
            : null;

        return $this->setVoiceMailUser($value);
    }

    public function getVoiceMailUserId()
    {
        if ($dto = $this->getVoiceMailUser()) {
            return $dto->getId();
        }

        return null;
    }

    public function setNumberCountry(?CountryDto $numberCountry): static
    {
        $this->numberCountry = $numberCountry;

        return $this;
    }

    public function getNumberCountry(): ?CountryDto
    {
        return $this->numberCountry;
    }

    public function setNumberCountryId($id): static
    {
        $value = !is_null($id)
            ? new CountryDto($id)
            : null;

        return $this->setNumberCountry($value);
    }

    public function getNumberCountryId()
    {
        if ($dto = $this->getNumberCountry()) {
            return $dto->getId();
        }

        return null;
    }
}
