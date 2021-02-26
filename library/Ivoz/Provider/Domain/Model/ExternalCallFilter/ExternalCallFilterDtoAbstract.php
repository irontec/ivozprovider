<?php

namespace Ivoz\Provider\Domain\Model\ExternalCallFilter;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\Model\DtoNormalizer;
use Ivoz\Provider\Domain\Model\Company\CompanyDto;
use Ivoz\Provider\Domain\Model\Locution\LocutionDto;
use Ivoz\Provider\Domain\Model\Extension\ExtensionDto;
use Ivoz\Provider\Domain\Model\User\UserDto;
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
     * @var string
     */
    private $name = '';

    /**
     * @var string|null
     */
    private $holidayTargetType;

    /**
     * @var string|null
     */
    private $holidayNumberValue;

    /**
     * @var string|null
     */
    private $outOfScheduleTargetType;

    /**
     * @var string|null
     */
    private $outOfScheduleNumberValue;

    /**
     * @var int
     */
    private $id;

    /**
     * @var CompanyDto | null
     */
    private $company;

    /**
     * @var LocutionDto | null
     */
    private $welcomeLocution;

    /**
     * @var LocutionDto | null
     */
    private $holidayLocution;

    /**
     * @var LocutionDto | null
     */
    private $outOfScheduleLocution;

    /**
     * @var ExtensionDto | null
     */
    private $holidayExtension;

    /**
     * @var ExtensionDto | null
     */
    private $outOfScheduleExtension;

    /**
     * @var UserDto | null
     */
    private $holidayVoiceMailUser;

    /**
     * @var UserDto | null
     */
    private $outOfScheduleVoiceMailUser;

    /**
     * @var CountryDto | null
     */
    private $holidayNumberCountry;

    /**
     * @var CountryDto | null
     */
    private $outOfScheduleNumberCountry;

    /**
     * @var ExternalCallFilterRelCalendarDto[] | null
     */
    private $calendars;

    /**
     * @var ExternalCallFilterBlackListDto[] | null
     */
    private $blackLists;

    /**
     * @var ExternalCallFilterWhiteListDto[] | null
     */
    private $whiteLists;

    /**
     * @var ExternalCallFilterRelScheduleDto[] | null
     */
    private $schedules;

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
            'holidayTargetType' => 'holidayTargetType',
            'holidayNumberValue' => 'holidayNumberValue',
            'outOfScheduleTargetType' => 'outOfScheduleTargetType',
            'outOfScheduleNumberValue' => 'outOfScheduleNumberValue',
            'id' => 'id',
            'companyId' => 'company',
            'welcomeLocutionId' => 'welcomeLocution',
            'holidayLocutionId' => 'holidayLocution',
            'outOfScheduleLocutionId' => 'outOfScheduleLocution',
            'holidayExtensionId' => 'holidayExtension',
            'outOfScheduleExtensionId' => 'outOfScheduleExtension',
            'holidayVoiceMailUserId' => 'holidayVoiceMailUser',
            'outOfScheduleVoiceMailUserId' => 'outOfScheduleVoiceMailUser',
            'holidayNumberCountryId' => 'holidayNumberCountry',
            'outOfScheduleNumberCountryId' => 'outOfScheduleNumberCountry'
        ];
    }

    /**
    * @return array
    */
    public function toArray($hideSensitiveData = false)
    {
        $response = [
            'name' => $this->getName(),
            'holidayTargetType' => $this->getHolidayTargetType(),
            'holidayNumberValue' => $this->getHolidayNumberValue(),
            'outOfScheduleTargetType' => $this->getOutOfScheduleTargetType(),
            'outOfScheduleNumberValue' => $this->getOutOfScheduleNumberValue(),
            'id' => $this->getId(),
            'company' => $this->getCompany(),
            'welcomeLocution' => $this->getWelcomeLocution(),
            'holidayLocution' => $this->getHolidayLocution(),
            'outOfScheduleLocution' => $this->getOutOfScheduleLocution(),
            'holidayExtension' => $this->getHolidayExtension(),
            'outOfScheduleExtension' => $this->getOutOfScheduleExtension(),
            'holidayVoiceMailUser' => $this->getHolidayVoiceMailUser(),
            'outOfScheduleVoiceMailUser' => $this->getOutOfScheduleVoiceMailUser(),
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

    public function setName(?string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
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

    public function getId()
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

    public function setHolidayVoiceMailUser(?UserDto $holidayVoiceMailUser): static
    {
        $this->holidayVoiceMailUser = $holidayVoiceMailUser;

        return $this;
    }

    public function getHolidayVoiceMailUser(): ?UserDto
    {
        return $this->holidayVoiceMailUser;
    }

    public function setHolidayVoiceMailUserId($id): static
    {
        $value = !is_null($id)
            ? new UserDto($id)
            : null;

        return $this->setHolidayVoiceMailUser($value);
    }

    public function getHolidayVoiceMailUserId()
    {
        if ($dto = $this->getHolidayVoiceMailUser()) {
            return $dto->getId();
        }

        return null;
    }

    public function setOutOfScheduleVoiceMailUser(?UserDto $outOfScheduleVoiceMailUser): static
    {
        $this->outOfScheduleVoiceMailUser = $outOfScheduleVoiceMailUser;

        return $this;
    }

    public function getOutOfScheduleVoiceMailUser(): ?UserDto
    {
        return $this->outOfScheduleVoiceMailUser;
    }

    public function setOutOfScheduleVoiceMailUserId($id): static
    {
        $value = !is_null($id)
            ? new UserDto($id)
            : null;

        return $this->setOutOfScheduleVoiceMailUser($value);
    }

    public function getOutOfScheduleVoiceMailUserId()
    {
        if ($dto = $this->getOutOfScheduleVoiceMailUser()) {
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
