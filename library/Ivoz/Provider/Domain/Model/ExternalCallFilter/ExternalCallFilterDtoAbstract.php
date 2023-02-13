<?php

namespace Ivoz\Provider\Domain\Model\ExternalCallFilter;

use Ivoz\Core\Domain\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\DtoNormalizer;
use Ivoz\Provider\Domain\Model\Company\CompanyDto;
use Ivoz\Provider\Domain\Model\Locution\LocutionDto;
use Ivoz\Provider\Domain\Model\Extension\ExtensionDto;
use Ivoz\Provider\Domain\Model\Voicemail\VoicemailDto;
use Ivoz\Provider\Domain\Model\Country\CountryDto;
use Ivoz\Provider\Domain\Model\ExternalCallFilterRelCalendar\ExternalCallFilterRelCalendarDto;
use Ivoz\Provider\Domain\Model\ExternalCallFilterBlackList\ExternalCallFilterBlackListDto;
use Ivoz\Provider\Domain\Model\ExternalCallFilterWhiteList\ExternalCallFilterWhiteListDto;
use Ivoz\Provider\Domain\Model\ExternalCallFilterRelSchedule\ExternalCallFilterRelScheduleDto;

/**
* ExternalCallFilterDtoAbstract
* @codeCoverageIgnore
*/
abstract class ExternalCallFilterDtoAbstract implements DataTransferObjectInterface
{
    use DtoNormalizer;

    /**
     * @var string|null
     */
    private $name = null;

    /**
     * @var bool|null
     */
    private $holidayEnabled = false;

    /**
     * @var string|null
     */
    private $holidayTargetType = null;

    /**
     * @var string|null
     */
    private $holidayNumberValue = null;

    /**
     * @var bool|null
     */
    private $outOfScheduleEnabled = false;

    /**
     * @var string|null
     */
    private $outOfScheduleTargetType = null;

    /**
     * @var string|null
     */
    private $outOfScheduleNumberValue = null;

    /**
     * @var int|null
     */
    private $id = null;

    /**
     * @var CompanyDto | null
     */
    private $company = null;

    /**
     * @var LocutionDto | null
     */
    private $welcomeLocution = null;

    /**
     * @var LocutionDto | null
     */
    private $holidayLocution = null;

    /**
     * @var LocutionDto | null
     */
    private $outOfScheduleLocution = null;

    /**
     * @var ExtensionDto | null
     */
    private $holidayExtension = null;

    /**
     * @var ExtensionDto | null
     */
    private $outOfScheduleExtension = null;

    /**
     * @var VoicemailDto | null
     */
    private $holidayVoicemail = null;

    /**
     * @var VoicemailDto | null
     */
    private $outOfScheduleVoicemail = null;

    /**
     * @var CountryDto | null
     */
    private $holidayNumberCountry = null;

    /**
     * @var CountryDto | null
     */
    private $outOfScheduleNumberCountry = null;

    /**
     * @var ExternalCallFilterRelCalendarDto[] | null
     */
    private $calendars = null;

    /**
     * @var ExternalCallFilterBlackListDto[] | null
     */
    private $blackLists = null;

    /**
     * @var ExternalCallFilterWhiteListDto[] | null
     */
    private $whiteLists = null;

    /**
     * @var ExternalCallFilterRelScheduleDto[] | null
     */
    private $schedules = null;

    /**
     * @param string|int|null $id
     */
    public function __construct($id = null)
    {
        $this->setId($id);
    }

    /**
    * @inheritdoc
    */
    public static function getPropertyMap(string $context = '', string $role = null): array
    {
        if ($context === self::CONTEXT_COLLECTION) {
            return ['id' => 'id'];
        }

        return [
            'name' => 'name',
            'holidayEnabled' => 'holidayEnabled',
            'holidayTargetType' => 'holidayTargetType',
            'holidayNumberValue' => 'holidayNumberValue',
            'outOfScheduleEnabled' => 'outOfScheduleEnabled',
            'outOfScheduleTargetType' => 'outOfScheduleTargetType',
            'outOfScheduleNumberValue' => 'outOfScheduleNumberValue',
            'id' => 'id',
            'companyId' => 'company',
            'welcomeLocutionId' => 'welcomeLocution',
            'holidayLocutionId' => 'holidayLocution',
            'outOfScheduleLocutionId' => 'outOfScheduleLocution',
            'holidayExtensionId' => 'holidayExtension',
            'outOfScheduleExtensionId' => 'outOfScheduleExtension',
            'holidayVoicemailId' => 'holidayVoicemail',
            'outOfScheduleVoicemailId' => 'outOfScheduleVoicemail',
            'holidayNumberCountryId' => 'holidayNumberCountry',
            'outOfScheduleNumberCountryId' => 'outOfScheduleNumberCountry'
        ];
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(bool $hideSensitiveData = false): array
    {
        $response = [
            'name' => $this->getName(),
            'holidayEnabled' => $this->getHolidayEnabled(),
            'holidayTargetType' => $this->getHolidayTargetType(),
            'holidayNumberValue' => $this->getHolidayNumberValue(),
            'outOfScheduleEnabled' => $this->getOutOfScheduleEnabled(),
            'outOfScheduleTargetType' => $this->getOutOfScheduleTargetType(),
            'outOfScheduleNumberValue' => $this->getOutOfScheduleNumberValue(),
            'id' => $this->getId(),
            'company' => $this->getCompany(),
            'welcomeLocution' => $this->getWelcomeLocution(),
            'holidayLocution' => $this->getHolidayLocution(),
            'outOfScheduleLocution' => $this->getOutOfScheduleLocution(),
            'holidayExtension' => $this->getHolidayExtension(),
            'outOfScheduleExtension' => $this->getOutOfScheduleExtension(),
            'holidayVoicemail' => $this->getHolidayVoicemail(),
            'outOfScheduleVoicemail' => $this->getOutOfScheduleVoicemail(),
            'holidayNumberCountry' => $this->getHolidayNumberCountry(),
            'outOfScheduleNumberCountry' => $this->getOutOfScheduleNumberCountry(),
            'calendars' => $this->getCalendars(),
            'blackLists' => $this->getBlackLists(),
            'whiteLists' => $this->getWhiteLists(),
            'schedules' => $this->getSchedules()
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

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setHolidayEnabled(bool $holidayEnabled): static
    {
        $this->holidayEnabled = $holidayEnabled;

        return $this;
    }

    public function getHolidayEnabled(): ?bool
    {
        return $this->holidayEnabled;
    }

    public function setHolidayTargetType(?string $holidayTargetType): static
    {
        $this->holidayTargetType = $holidayTargetType;

        return $this;
    }

    public function getHolidayTargetType(): ?string
    {
        return $this->holidayTargetType;
    }

    public function setHolidayNumberValue(?string $holidayNumberValue): static
    {
        $this->holidayNumberValue = $holidayNumberValue;

        return $this;
    }

    public function getHolidayNumberValue(): ?string
    {
        return $this->holidayNumberValue;
    }

    public function setOutOfScheduleEnabled(bool $outOfScheduleEnabled): static
    {
        $this->outOfScheduleEnabled = $outOfScheduleEnabled;

        return $this;
    }

    public function getOutOfScheduleEnabled(): ?bool
    {
        return $this->outOfScheduleEnabled;
    }

    public function setOutOfScheduleTargetType(?string $outOfScheduleTargetType): static
    {
        $this->outOfScheduleTargetType = $outOfScheduleTargetType;

        return $this;
    }

    public function getOutOfScheduleTargetType(): ?string
    {
        return $this->outOfScheduleTargetType;
    }

    public function setOutOfScheduleNumberValue(?string $outOfScheduleNumberValue): static
    {
        $this->outOfScheduleNumberValue = $outOfScheduleNumberValue;

        return $this;
    }

    public function getOutOfScheduleNumberValue(): ?string
    {
        return $this->outOfScheduleNumberValue;
    }

    public function setId($id): static
    {
        $this->id = $id;

        return $this;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setCompany(?CompanyDto $company): static
    {
        $this->company = $company;

        return $this;
    }

    public function getCompany(): ?CompanyDto
    {
        return $this->company;
    }

    public function setCompanyId($id): static
    {
        $value = !is_null($id)
            ? new CompanyDto($id)
            : null;

        return $this->setCompany($value);
    }

    public function getCompanyId()
    {
        if ($dto = $this->getCompany()) {
            return $dto->getId();
        }

        return null;
    }

    public function setWelcomeLocution(?LocutionDto $welcomeLocution): static
    {
        $this->welcomeLocution = $welcomeLocution;

        return $this;
    }

    public function getWelcomeLocution(): ?LocutionDto
    {
        return $this->welcomeLocution;
    }

    public function setWelcomeLocutionId($id): static
    {
        $value = !is_null($id)
            ? new LocutionDto($id)
            : null;

        return $this->setWelcomeLocution($value);
    }

    public function getWelcomeLocutionId()
    {
        if ($dto = $this->getWelcomeLocution()) {
            return $dto->getId();
        }

        return null;
    }

    public function setHolidayLocution(?LocutionDto $holidayLocution): static
    {
        $this->holidayLocution = $holidayLocution;

        return $this;
    }

    public function getHolidayLocution(): ?LocutionDto
    {
        return $this->holidayLocution;
    }

    public function setHolidayLocutionId($id): static
    {
        $value = !is_null($id)
            ? new LocutionDto($id)
            : null;

        return $this->setHolidayLocution($value);
    }

    public function getHolidayLocutionId()
    {
        if ($dto = $this->getHolidayLocution()) {
            return $dto->getId();
        }

        return null;
    }

    public function setOutOfScheduleLocution(?LocutionDto $outOfScheduleLocution): static
    {
        $this->outOfScheduleLocution = $outOfScheduleLocution;

        return $this;
    }

    public function getOutOfScheduleLocution(): ?LocutionDto
    {
        return $this->outOfScheduleLocution;
    }

    public function setOutOfScheduleLocutionId($id): static
    {
        $value = !is_null($id)
            ? new LocutionDto($id)
            : null;

        return $this->setOutOfScheduleLocution($value);
    }

    public function getOutOfScheduleLocutionId()
    {
        if ($dto = $this->getOutOfScheduleLocution()) {
            return $dto->getId();
        }

        return null;
    }

    public function setHolidayExtension(?ExtensionDto $holidayExtension): static
    {
        $this->holidayExtension = $holidayExtension;

        return $this;
    }

    public function getHolidayExtension(): ?ExtensionDto
    {
        return $this->holidayExtension;
    }

    public function setHolidayExtensionId($id): static
    {
        $value = !is_null($id)
            ? new ExtensionDto($id)
            : null;

        return $this->setHolidayExtension($value);
    }

    public function getHolidayExtensionId()
    {
        if ($dto = $this->getHolidayExtension()) {
            return $dto->getId();
        }

        return null;
    }

    public function setOutOfScheduleExtension(?ExtensionDto $outOfScheduleExtension): static
    {
        $this->outOfScheduleExtension = $outOfScheduleExtension;

        return $this;
    }

    public function getOutOfScheduleExtension(): ?ExtensionDto
    {
        return $this->outOfScheduleExtension;
    }

    public function setOutOfScheduleExtensionId($id): static
    {
        $value = !is_null($id)
            ? new ExtensionDto($id)
            : null;

        return $this->setOutOfScheduleExtension($value);
    }

    public function getOutOfScheduleExtensionId()
    {
        if ($dto = $this->getOutOfScheduleExtension()) {
            return $dto->getId();
        }

        return null;
    }

    public function setHolidayVoicemail(?VoicemailDto $holidayVoicemail): static
    {
        $this->holidayVoicemail = $holidayVoicemail;

        return $this;
    }

    public function getHolidayVoicemail(): ?VoicemailDto
    {
        return $this->holidayVoicemail;
    }

    public function setHolidayVoicemailId($id): static
    {
        $value = !is_null($id)
            ? new VoicemailDto($id)
            : null;

        return $this->setHolidayVoicemail($value);
    }

    public function getHolidayVoicemailId()
    {
        if ($dto = $this->getHolidayVoicemail()) {
            return $dto->getId();
        }

        return null;
    }

    public function setOutOfScheduleVoicemail(?VoicemailDto $outOfScheduleVoicemail): static
    {
        $this->outOfScheduleVoicemail = $outOfScheduleVoicemail;

        return $this;
    }

    public function getOutOfScheduleVoicemail(): ?VoicemailDto
    {
        return $this->outOfScheduleVoicemail;
    }

    public function setOutOfScheduleVoicemailId($id): static
    {
        $value = !is_null($id)
            ? new VoicemailDto($id)
            : null;

        return $this->setOutOfScheduleVoicemail($value);
    }

    public function getOutOfScheduleVoicemailId()
    {
        if ($dto = $this->getOutOfScheduleVoicemail()) {
            return $dto->getId();
        }

        return null;
    }

    public function setHolidayNumberCountry(?CountryDto $holidayNumberCountry): static
    {
        $this->holidayNumberCountry = $holidayNumberCountry;

        return $this;
    }

    public function getHolidayNumberCountry(): ?CountryDto
    {
        return $this->holidayNumberCountry;
    }

    public function setHolidayNumberCountryId($id): static
    {
        $value = !is_null($id)
            ? new CountryDto($id)
            : null;

        return $this->setHolidayNumberCountry($value);
    }

    public function getHolidayNumberCountryId()
    {
        if ($dto = $this->getHolidayNumberCountry()) {
            return $dto->getId();
        }

        return null;
    }

    public function setOutOfScheduleNumberCountry(?CountryDto $outOfScheduleNumberCountry): static
    {
        $this->outOfScheduleNumberCountry = $outOfScheduleNumberCountry;

        return $this;
    }

    public function getOutOfScheduleNumberCountry(): ?CountryDto
    {
        return $this->outOfScheduleNumberCountry;
    }

    public function setOutOfScheduleNumberCountryId($id): static
    {
        $value = !is_null($id)
            ? new CountryDto($id)
            : null;

        return $this->setOutOfScheduleNumberCountry($value);
    }

    public function getOutOfScheduleNumberCountryId()
    {
        if ($dto = $this->getOutOfScheduleNumberCountry()) {
            return $dto->getId();
        }

        return null;
    }

    public function setCalendars(?array $calendars): static
    {
        $this->calendars = $calendars;

        return $this;
    }

    public function getCalendars(): ?array
    {
        return $this->calendars;
    }

    public function setBlackLists(?array $blackLists): static
    {
        $this->blackLists = $blackLists;

        return $this;
    }

    public function getBlackLists(): ?array
    {
        return $this->blackLists;
    }

    public function setWhiteLists(?array $whiteLists): static
    {
        $this->whiteLists = $whiteLists;

        return $this;
    }

    public function getWhiteLists(): ?array
    {
        return $this->whiteLists;
    }

    public function setSchedules(?array $schedules): static
    {
        $this->schedules = $schedules;

        return $this;
    }

    public function getSchedules(): ?array
    {
        return $this->schedules;
    }
}
