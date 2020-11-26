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
    private $name;

    /**
     * @var string | null
     */
    private $holidayTargetType;

    /**
     * @var string | null
     */
    private $holidayNumberValue;

    /**
     * @var string | null
     */
    private $outOfScheduleTargetType;

    /**
     * @var string | null
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
     * @param string $holidayTargetType | null
     *
     * @return static
     */
    public function setHolidayTargetType(?string $holidayTargetType = null): self
    {
        $this->holidayTargetType = $holidayTargetType;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getHolidayTargetType(): ?string
    {
        return $this->holidayTargetType;
    }

    /**
     * @param string $holidayNumberValue | null
     *
     * @return static
     */
    public function setHolidayNumberValue(?string $holidayNumberValue = null): self
    {
        $this->holidayNumberValue = $holidayNumberValue;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getHolidayNumberValue(): ?string
    {
        return $this->holidayNumberValue;
    }

    /**
     * @param string $outOfScheduleTargetType | null
     *
     * @return static
     */
    public function setOutOfScheduleTargetType(?string $outOfScheduleTargetType = null): self
    {
        $this->outOfScheduleTargetType = $outOfScheduleTargetType;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getOutOfScheduleTargetType(): ?string
    {
        return $this->outOfScheduleTargetType;
    }

    /**
     * @param string $outOfScheduleNumberValue | null
     *
     * @return static
     */
    public function setOutOfScheduleNumberValue(?string $outOfScheduleNumberValue = null): self
    {
        $this->outOfScheduleNumberValue = $outOfScheduleNumberValue;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getOutOfScheduleNumberValue(): ?string
    {
        return $this->outOfScheduleNumberValue;
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
     * @param CompanyDto | null
     *
     * @return static
     */
    public function setCompany(?CompanyDto $company = null): self
    {
        $this->company = $company;

        return $this;
    }

    /**
     * @return CompanyDto | null
     */
    public function getCompany(): ?CompanyDto
    {
        return $this->company;
    }

    /**
     * @return static
     */
    public function setCompanyId($id): self
    {
        $value = !is_null($id)
            ? new CompanyDto($id)
            : null;

        return $this->setCompany($value);
    }

    /**
     * @return mixed | null
     */
    public function getCompanyId()
    {
        if ($dto = $this->getCompany()) {
            return $dto->getId();
        }

        return null;
    }

    /**
     * @param LocutionDto | null
     *
     * @return static
     */
    public function setWelcomeLocution(?LocutionDto $welcomeLocution = null): self
    {
        $this->welcomeLocution = $welcomeLocution;

        return $this;
    }

    /**
     * @return LocutionDto | null
     */
    public function getWelcomeLocution(): ?LocutionDto
    {
        return $this->welcomeLocution;
    }

    /**
     * @return static
     */
    public function setWelcomeLocutionId($id): self
    {
        $value = !is_null($id)
            ? new LocutionDto($id)
            : null;

        return $this->setWelcomeLocution($value);
    }

    /**
     * @return mixed | null
     */
    public function getWelcomeLocutionId()
    {
        if ($dto = $this->getWelcomeLocution()) {
            return $dto->getId();
        }

        return null;
    }

    /**
     * @param LocutionDto | null
     *
     * @return static
     */
    public function setHolidayLocution(?LocutionDto $holidayLocution = null): self
    {
        $this->holidayLocution = $holidayLocution;

        return $this;
    }

    /**
     * @return LocutionDto | null
     */
    public function getHolidayLocution(): ?LocutionDto
    {
        return $this->holidayLocution;
    }

    /**
     * @return static
     */
    public function setHolidayLocutionId($id): self
    {
        $value = !is_null($id)
            ? new LocutionDto($id)
            : null;

        return $this->setHolidayLocution($value);
    }

    /**
     * @return mixed | null
     */
    public function getHolidayLocutionId()
    {
        if ($dto = $this->getHolidayLocution()) {
            return $dto->getId();
        }

        return null;
    }

    /**
     * @param LocutionDto | null
     *
     * @return static
     */
    public function setOutOfScheduleLocution(?LocutionDto $outOfScheduleLocution = null): self
    {
        $this->outOfScheduleLocution = $outOfScheduleLocution;

        return $this;
    }

    /**
     * @return LocutionDto | null
     */
    public function getOutOfScheduleLocution(): ?LocutionDto
    {
        return $this->outOfScheduleLocution;
    }

    /**
     * @return static
     */
    public function setOutOfScheduleLocutionId($id): self
    {
        $value = !is_null($id)
            ? new LocutionDto($id)
            : null;

        return $this->setOutOfScheduleLocution($value);
    }

    /**
     * @return mixed | null
     */
    public function getOutOfScheduleLocutionId()
    {
        if ($dto = $this->getOutOfScheduleLocution()) {
            return $dto->getId();
        }

        return null;
    }

    /**
     * @param ExtensionDto | null
     *
     * @return static
     */
    public function setHolidayExtension(?ExtensionDto $holidayExtension = null): self
    {
        $this->holidayExtension = $holidayExtension;

        return $this;
    }

    /**
     * @return ExtensionDto | null
     */
    public function getHolidayExtension(): ?ExtensionDto
    {
        return $this->holidayExtension;
    }

    /**
     * @return static
     */
    public function setHolidayExtensionId($id): self
    {
        $value = !is_null($id)
            ? new ExtensionDto($id)
            : null;

        return $this->setHolidayExtension($value);
    }

    /**
     * @return mixed | null
     */
    public function getHolidayExtensionId()
    {
        if ($dto = $this->getHolidayExtension()) {
            return $dto->getId();
        }

        return null;
    }

    /**
     * @param ExtensionDto | null
     *
     * @return static
     */
    public function setOutOfScheduleExtension(?ExtensionDto $outOfScheduleExtension = null): self
    {
        $this->outOfScheduleExtension = $outOfScheduleExtension;

        return $this;
    }

    /**
     * @return ExtensionDto | null
     */
    public function getOutOfScheduleExtension(): ?ExtensionDto
    {
        return $this->outOfScheduleExtension;
    }

    /**
     * @return static
     */
    public function setOutOfScheduleExtensionId($id): self
    {
        $value = !is_null($id)
            ? new ExtensionDto($id)
            : null;

        return $this->setOutOfScheduleExtension($value);
    }

    /**
     * @return mixed | null
     */
    public function getOutOfScheduleExtensionId()
    {
        if ($dto = $this->getOutOfScheduleExtension()) {
            return $dto->getId();
        }

        return null;
    }

    /**
     * @param UserDto | null
     *
     * @return static
     */
    public function setHolidayVoiceMailUser(?UserDto $holidayVoiceMailUser = null): self
    {
        $this->holidayVoiceMailUser = $holidayVoiceMailUser;

        return $this;
    }

    /**
     * @return UserDto | null
     */
    public function getHolidayVoiceMailUser(): ?UserDto
    {
        return $this->holidayVoiceMailUser;
    }

    /**
     * @return static
     */
    public function setHolidayVoiceMailUserId($id): self
    {
        $value = !is_null($id)
            ? new UserDto($id)
            : null;

        return $this->setHolidayVoiceMailUser($value);
    }

    /**
     * @return mixed | null
     */
    public function getHolidayVoiceMailUserId()
    {
        if ($dto = $this->getHolidayVoiceMailUser()) {
            return $dto->getId();
        }

        return null;
    }

    /**
     * @param UserDto | null
     *
     * @return static
     */
    public function setOutOfScheduleVoiceMailUser(?UserDto $outOfScheduleVoiceMailUser = null): self
    {
        $this->outOfScheduleVoiceMailUser = $outOfScheduleVoiceMailUser;

        return $this;
    }

    /**
     * @return UserDto | null
     */
    public function getOutOfScheduleVoiceMailUser(): ?UserDto
    {
        return $this->outOfScheduleVoiceMailUser;
    }

    /**
     * @return static
     */
    public function setOutOfScheduleVoiceMailUserId($id): self
    {
        $value = !is_null($id)
            ? new UserDto($id)
            : null;

        return $this->setOutOfScheduleVoiceMailUser($value);
    }

    /**
     * @return mixed | null
     */
    public function getOutOfScheduleVoiceMailUserId()
    {
        if ($dto = $this->getOutOfScheduleVoiceMailUser()) {
            return $dto->getId();
        }

        return null;
    }

    /**
     * @param CountryDto | null
     *
     * @return static
     */
    public function setHolidayNumberCountry(?CountryDto $holidayNumberCountry = null): self
    {
        $this->holidayNumberCountry = $holidayNumberCountry;

        return $this;
    }

    /**
     * @return CountryDto | null
     */
    public function getHolidayNumberCountry(): ?CountryDto
    {
        return $this->holidayNumberCountry;
    }

    /**
     * @return static
     */
    public function setHolidayNumberCountryId($id): self
    {
        $value = !is_null($id)
            ? new CountryDto($id)
            : null;

        return $this->setHolidayNumberCountry($value);
    }

    /**
     * @return mixed | null
     */
    public function getHolidayNumberCountryId()
    {
        if ($dto = $this->getHolidayNumberCountry()) {
            return $dto->getId();
        }

        return null;
    }

    /**
     * @param CountryDto | null
     *
     * @return static
     */
    public function setOutOfScheduleNumberCountry(?CountryDto $outOfScheduleNumberCountry = null): self
    {
        $this->outOfScheduleNumberCountry = $outOfScheduleNumberCountry;

        return $this;
    }

    /**
     * @return CountryDto | null
     */
    public function getOutOfScheduleNumberCountry(): ?CountryDto
    {
        return $this->outOfScheduleNumberCountry;
    }

    /**
     * @return static
     */
    public function setOutOfScheduleNumberCountryId($id): self
    {
        $value = !is_null($id)
            ? new CountryDto($id)
            : null;

        return $this->setOutOfScheduleNumberCountry($value);
    }

    /**
     * @return mixed | null
     */
    public function getOutOfScheduleNumberCountryId()
    {
        if ($dto = $this->getOutOfScheduleNumberCountry()) {
            return $dto->getId();
        }

        return null;
    }

    /**
     * @param ExternalCallFilterRelCalendarDto[] | null
     *
     * @return static
     */
    public function setCalendars(?array $calendars = null): self
    {
        $this->calendars = $calendars;

        return $this;
    }

    /**
     * @return ExternalCallFilterRelCalendarDto[] | null
     */
    public function getCalendars(): ?array
    {
        return $this->calendars;
    }

    /**
     * @param ExternalCallFilterBlackListDto[] | null
     *
     * @return static
     */
    public function setBlackLists(?array $blackLists = null): self
    {
        $this->blackLists = $blackLists;

        return $this;
    }

    /**
     * @return ExternalCallFilterBlackListDto[] | null
     */
    public function getBlackLists(): ?array
    {
        return $this->blackLists;
    }

    /**
     * @param ExternalCallFilterWhiteListDto[] | null
     *
     * @return static
     */
    public function setWhiteLists(?array $whiteLists = null): self
    {
        $this->whiteLists = $whiteLists;

        return $this;
    }

    /**
     * @return ExternalCallFilterWhiteListDto[] | null
     */
    public function getWhiteLists(): ?array
    {
        return $this->whiteLists;
    }

    /**
     * @param ExternalCallFilterRelScheduleDto[] | null
     *
     * @return static
     */
    public function setSchedules(?array $schedules = null): self
    {
        $this->schedules = $schedules;

        return $this;
    }

    /**
     * @return ExternalCallFilterRelScheduleDto[] | null
     */
    public function getSchedules(): ?array
    {
        return $this->schedules;
    }

}
