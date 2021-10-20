<?php

namespace Ivoz\Provider\Domain\Model\CalendarPeriod;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\Model\DtoNormalizer;
use Ivoz\Provider\Domain\Model\Calendar\CalendarDto;
use Ivoz\Provider\Domain\Model\Locution\LocutionDto;
use Ivoz\Provider\Domain\Model\Extension\ExtensionDto;
use Ivoz\Provider\Domain\Model\User\UserDto;
use Ivoz\Provider\Domain\Model\Country\CountryDto;
use Ivoz\Provider\Domain\Model\CalendarPeriodsRelSchedule\CalendarPeriodsRelScheduleDto;

/**
* CalendarPeriodDtoAbstract
* @codeCoverageIgnore
*/
abstract class CalendarPeriodDtoAbstract implements DataTransferObjectInterface
{
    use DtoNormalizer;

    /**
     * @var \DateTimeInterface|string
     */
    private $startDate;

    /**
     * @var \DateTimeInterface|string
     */
    private $endDate;

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

    /**
     * @var CalendarPeriodsRelScheduleDto[] | null
     */
    private $relSchedules;

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
            'startDate' => 'startDate',
            'endDate' => 'endDate',
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
            'startDate' => $this->getStartDate(),
            'endDate' => $this->getEndDate(),
            'routeType' => $this->getRouteType(),
            'numberValue' => $this->getNumberValue(),
            'id' => $this->getId(),
            'calendar' => $this->getCalendar(),
            'locution' => $this->getLocution(),
            'extension' => $this->getExtension(),
            'voiceMailUser' => $this->getVoiceMailUser(),
            'numberCountry' => $this->getNumberCountry(),
            'relSchedules' => $this->getRelSchedules()
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

    public function setStartDate(null|\DateTimeInterface|string $startDate): static
    {
        $this->startDate = $startDate;

        return $this;
    }

    public function getStartDate(): \DateTimeInterface|string|null
    {
        return $this->startDate;
    }

    public function setEndDate(null|\DateTimeInterface|string $endDate): static
    {
        $this->endDate = $endDate;

        return $this;
    }

    public function getEndDate(): \DateTimeInterface|string|null
    {
        return $this->endDate;
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

    public function setRelSchedules(?array $relSchedules): static
    {
        $this->relSchedules = $relSchedules;

        return $this;
    }

    public function getRelSchedules(): ?array
    {
        return $this->relSchedules;
    }
}
