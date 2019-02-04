<?php

namespace Ivoz\Provider\Domain\Model\ExternalCallFilter;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\Model\DtoNormalizer;

/**
 * @codeCoverageIgnore
 */
abstract class ExternalCallFilterDtoAbstract implements DataTransferObjectInterface
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $holidayTargetType;

    /**
     * @var string
     */
    private $holidayNumberValue;

    /**
     * @var string
     */
    private $outOfScheduleTargetType;

    /**
     * @var string
     */
    private $outOfScheduleNumberValue;

    /**
     * @var integer
     */
    private $id;

    /**
     * @var \Ivoz\Provider\Domain\Model\Company\CompanyDto | null
     */
    private $company;

    /**
     * @var \Ivoz\Provider\Domain\Model\Locution\LocutionDto | null
     */
    private $welcomeLocution;

    /**
     * @var \Ivoz\Provider\Domain\Model\Locution\LocutionDto | null
     */
    private $holidayLocution;

    /**
     * @var \Ivoz\Provider\Domain\Model\Locution\LocutionDto | null
     */
    private $outOfScheduleLocution;

    /**
     * @var \Ivoz\Provider\Domain\Model\Extension\ExtensionDto | null
     */
    private $holidayExtension;

    /**
     * @var \Ivoz\Provider\Domain\Model\Extension\ExtensionDto | null
     */
    private $outOfScheduleExtension;

    /**
     * @var \Ivoz\Provider\Domain\Model\User\UserDto | null
     */
    private $holidayVoiceMailUser;

    /**
     * @var \Ivoz\Provider\Domain\Model\User\UserDto | null
     */
    private $outOfScheduleVoiceMailUser;

    /**
     * @var \Ivoz\Provider\Domain\Model\Country\CountryDto | null
     */
    private $holidayNumberCountry;

    /**
     * @var \Ivoz\Provider\Domain\Model\Country\CountryDto | null
     */
    private $outOfScheduleNumberCountry;

    /**
     * @var \Ivoz\Provider\Domain\Model\ExternalCallFilterRelCalendar\ExternalCallFilterRelCalendarDto[] | null
     */
    private $calendars = null;

    /**
     * @var \Ivoz\Provider\Domain\Model\ExternalCallFilterBlackList\ExternalCallFilterBlackListDto[] | null
     */
    private $blackLists = null;

    /**
     * @var \Ivoz\Provider\Domain\Model\ExternalCallFilterWhiteList\ExternalCallFilterWhiteListDto[] | null
     */
    private $whiteLists = null;

    /**
     * @var \Ivoz\Provider\Domain\Model\ExternalCallFilterRelSchedule\ExternalCallFilterRelScheduleDto[] | null
     */
    private $schedules = null;


    use DtoNormalizer;

    public function __construct($id = null)
    {
        $this->setId($id);
    }

    /**
     * @inheritdoc
     */
    public static function getPropertyMap(string $context = '')
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
        return [
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
    }

    /**
     * @param string $name
     *
     * @return static
     */
    public function setName($name = null)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $holidayTargetType
     *
     * @return static
     */
    public function setHolidayTargetType($holidayTargetType = null)
    {
        $this->holidayTargetType = $holidayTargetType;

        return $this;
    }

    /**
     * @return string
     */
    public function getHolidayTargetType()
    {
        return $this->holidayTargetType;
    }

    /**
     * @param string $holidayNumberValue
     *
     * @return static
     */
    public function setHolidayNumberValue($holidayNumberValue = null)
    {
        $this->holidayNumberValue = $holidayNumberValue;

        return $this;
    }

    /**
     * @return string
     */
    public function getHolidayNumberValue()
    {
        return $this->holidayNumberValue;
    }

    /**
     * @param string $outOfScheduleTargetType
     *
     * @return static
     */
    public function setOutOfScheduleTargetType($outOfScheduleTargetType = null)
    {
        $this->outOfScheduleTargetType = $outOfScheduleTargetType;

        return $this;
    }

    /**
     * @return string
     */
    public function getOutOfScheduleTargetType()
    {
        return $this->outOfScheduleTargetType;
    }

    /**
     * @param string $outOfScheduleNumberValue
     *
     * @return static
     */
    public function setOutOfScheduleNumberValue($outOfScheduleNumberValue = null)
    {
        $this->outOfScheduleNumberValue = $outOfScheduleNumberValue;

        return $this;
    }

    /**
     * @return string
     */
    public function getOutOfScheduleNumberValue()
    {
        return $this->outOfScheduleNumberValue;
    }

    /**
     * @param integer $id
     *
     * @return static
     */
    public function setId($id = null)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param \Ivoz\Provider\Domain\Model\Company\CompanyDto $company
     *
     * @return static
     */
    public function setCompany(\Ivoz\Provider\Domain\Model\Company\CompanyDto $company = null)
    {
        $this->company = $company;

        return $this;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\Company\CompanyDto
     */
    public function getCompany()
    {
        return $this->company;
    }

    /**
     * @param integer $id | null
     *
     * @return static
     */
    public function setCompanyId($id)
    {
        $value = !is_null($id)
            ? new \Ivoz\Provider\Domain\Model\Company\CompanyDto($id)
            : null;

        return $this->setCompany($value);
    }

    /**
     * @return integer | null
     */
    public function getCompanyId()
    {
        if ($dto = $this->getCompany()) {
            return $dto->getId();
        }

        return null;
    }

    /**
     * @param \Ivoz\Provider\Domain\Model\Locution\LocutionDto $welcomeLocution
     *
     * @return static
     */
    public function setWelcomeLocution(\Ivoz\Provider\Domain\Model\Locution\LocutionDto $welcomeLocution = null)
    {
        $this->welcomeLocution = $welcomeLocution;

        return $this;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\Locution\LocutionDto
     */
    public function getWelcomeLocution()
    {
        return $this->welcomeLocution;
    }

    /**
     * @param integer $id | null
     *
     * @return static
     */
    public function setWelcomeLocutionId($id)
    {
        $value = !is_null($id)
            ? new \Ivoz\Provider\Domain\Model\Locution\LocutionDto($id)
            : null;

        return $this->setWelcomeLocution($value);
    }

    /**
     * @return integer | null
     */
    public function getWelcomeLocutionId()
    {
        if ($dto = $this->getWelcomeLocution()) {
            return $dto->getId();
        }

        return null;
    }

    /**
     * @param \Ivoz\Provider\Domain\Model\Locution\LocutionDto $holidayLocution
     *
     * @return static
     */
    public function setHolidayLocution(\Ivoz\Provider\Domain\Model\Locution\LocutionDto $holidayLocution = null)
    {
        $this->holidayLocution = $holidayLocution;

        return $this;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\Locution\LocutionDto
     */
    public function getHolidayLocution()
    {
        return $this->holidayLocution;
    }

    /**
     * @param integer $id | null
     *
     * @return static
     */
    public function setHolidayLocutionId($id)
    {
        $value = !is_null($id)
            ? new \Ivoz\Provider\Domain\Model\Locution\LocutionDto($id)
            : null;

        return $this->setHolidayLocution($value);
    }

    /**
     * @return integer | null
     */
    public function getHolidayLocutionId()
    {
        if ($dto = $this->getHolidayLocution()) {
            return $dto->getId();
        }

        return null;
    }

    /**
     * @param \Ivoz\Provider\Domain\Model\Locution\LocutionDto $outOfScheduleLocution
     *
     * @return static
     */
    public function setOutOfScheduleLocution(\Ivoz\Provider\Domain\Model\Locution\LocutionDto $outOfScheduleLocution = null)
    {
        $this->outOfScheduleLocution = $outOfScheduleLocution;

        return $this;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\Locution\LocutionDto
     */
    public function getOutOfScheduleLocution()
    {
        return $this->outOfScheduleLocution;
    }

    /**
     * @param integer $id | null
     *
     * @return static
     */
    public function setOutOfScheduleLocutionId($id)
    {
        $value = !is_null($id)
            ? new \Ivoz\Provider\Domain\Model\Locution\LocutionDto($id)
            : null;

        return $this->setOutOfScheduleLocution($value);
    }

    /**
     * @return integer | null
     */
    public function getOutOfScheduleLocutionId()
    {
        if ($dto = $this->getOutOfScheduleLocution()) {
            return $dto->getId();
        }

        return null;
    }

    /**
     * @param \Ivoz\Provider\Domain\Model\Extension\ExtensionDto $holidayExtension
     *
     * @return static
     */
    public function setHolidayExtension(\Ivoz\Provider\Domain\Model\Extension\ExtensionDto $holidayExtension = null)
    {
        $this->holidayExtension = $holidayExtension;

        return $this;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\Extension\ExtensionDto
     */
    public function getHolidayExtension()
    {
        return $this->holidayExtension;
    }

    /**
     * @param integer $id | null
     *
     * @return static
     */
    public function setHolidayExtensionId($id)
    {
        $value = !is_null($id)
            ? new \Ivoz\Provider\Domain\Model\Extension\ExtensionDto($id)
            : null;

        return $this->setHolidayExtension($value);
    }

    /**
     * @return integer | null
     */
    public function getHolidayExtensionId()
    {
        if ($dto = $this->getHolidayExtension()) {
            return $dto->getId();
        }

        return null;
    }

    /**
     * @param \Ivoz\Provider\Domain\Model\Extension\ExtensionDto $outOfScheduleExtension
     *
     * @return static
     */
    public function setOutOfScheduleExtension(\Ivoz\Provider\Domain\Model\Extension\ExtensionDto $outOfScheduleExtension = null)
    {
        $this->outOfScheduleExtension = $outOfScheduleExtension;

        return $this;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\Extension\ExtensionDto
     */
    public function getOutOfScheduleExtension()
    {
        return $this->outOfScheduleExtension;
    }

    /**
     * @param integer $id | null
     *
     * @return static
     */
    public function setOutOfScheduleExtensionId($id)
    {
        $value = !is_null($id)
            ? new \Ivoz\Provider\Domain\Model\Extension\ExtensionDto($id)
            : null;

        return $this->setOutOfScheduleExtension($value);
    }

    /**
     * @return integer | null
     */
    public function getOutOfScheduleExtensionId()
    {
        if ($dto = $this->getOutOfScheduleExtension()) {
            return $dto->getId();
        }

        return null;
    }

    /**
     * @param \Ivoz\Provider\Domain\Model\User\UserDto $holidayVoiceMailUser
     *
     * @return static
     */
    public function setHolidayVoiceMailUser(\Ivoz\Provider\Domain\Model\User\UserDto $holidayVoiceMailUser = null)
    {
        $this->holidayVoiceMailUser = $holidayVoiceMailUser;

        return $this;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\User\UserDto
     */
    public function getHolidayVoiceMailUser()
    {
        return $this->holidayVoiceMailUser;
    }

    /**
     * @param integer $id | null
     *
     * @return static
     */
    public function setHolidayVoiceMailUserId($id)
    {
        $value = !is_null($id)
            ? new \Ivoz\Provider\Domain\Model\User\UserDto($id)
            : null;

        return $this->setHolidayVoiceMailUser($value);
    }

    /**
     * @return integer | null
     */
    public function getHolidayVoiceMailUserId()
    {
        if ($dto = $this->getHolidayVoiceMailUser()) {
            return $dto->getId();
        }

        return null;
    }

    /**
     * @param \Ivoz\Provider\Domain\Model\User\UserDto $outOfScheduleVoiceMailUser
     *
     * @return static
     */
    public function setOutOfScheduleVoiceMailUser(\Ivoz\Provider\Domain\Model\User\UserDto $outOfScheduleVoiceMailUser = null)
    {
        $this->outOfScheduleVoiceMailUser = $outOfScheduleVoiceMailUser;

        return $this;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\User\UserDto
     */
    public function getOutOfScheduleVoiceMailUser()
    {
        return $this->outOfScheduleVoiceMailUser;
    }

    /**
     * @param integer $id | null
     *
     * @return static
     */
    public function setOutOfScheduleVoiceMailUserId($id)
    {
        $value = !is_null($id)
            ? new \Ivoz\Provider\Domain\Model\User\UserDto($id)
            : null;

        return $this->setOutOfScheduleVoiceMailUser($value);
    }

    /**
     * @return integer | null
     */
    public function getOutOfScheduleVoiceMailUserId()
    {
        if ($dto = $this->getOutOfScheduleVoiceMailUser()) {
            return $dto->getId();
        }

        return null;
    }

    /**
     * @param \Ivoz\Provider\Domain\Model\Country\CountryDto $holidayNumberCountry
     *
     * @return static
     */
    public function setHolidayNumberCountry(\Ivoz\Provider\Domain\Model\Country\CountryDto $holidayNumberCountry = null)
    {
        $this->holidayNumberCountry = $holidayNumberCountry;

        return $this;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\Country\CountryDto
     */
    public function getHolidayNumberCountry()
    {
        return $this->holidayNumberCountry;
    }

    /**
     * @param integer $id | null
     *
     * @return static
     */
    public function setHolidayNumberCountryId($id)
    {
        $value = !is_null($id)
            ? new \Ivoz\Provider\Domain\Model\Country\CountryDto($id)
            : null;

        return $this->setHolidayNumberCountry($value);
    }

    /**
     * @return integer | null
     */
    public function getHolidayNumberCountryId()
    {
        if ($dto = $this->getHolidayNumberCountry()) {
            return $dto->getId();
        }

        return null;
    }

    /**
     * @param \Ivoz\Provider\Domain\Model\Country\CountryDto $outOfScheduleNumberCountry
     *
     * @return static
     */
    public function setOutOfScheduleNumberCountry(\Ivoz\Provider\Domain\Model\Country\CountryDto $outOfScheduleNumberCountry = null)
    {
        $this->outOfScheduleNumberCountry = $outOfScheduleNumberCountry;

        return $this;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\Country\CountryDto
     */
    public function getOutOfScheduleNumberCountry()
    {
        return $this->outOfScheduleNumberCountry;
    }

    /**
     * @param integer $id | null
     *
     * @return static
     */
    public function setOutOfScheduleNumberCountryId($id)
    {
        $value = !is_null($id)
            ? new \Ivoz\Provider\Domain\Model\Country\CountryDto($id)
            : null;

        return $this->setOutOfScheduleNumberCountry($value);
    }

    /**
     * @return integer | null
     */
    public function getOutOfScheduleNumberCountryId()
    {
        if ($dto = $this->getOutOfScheduleNumberCountry()) {
            return $dto->getId();
        }

        return null;
    }

    /**
     * @param array $calendars
     *
     * @return static
     */
    public function setCalendars($calendars = null)
    {
        $this->calendars = $calendars;

        return $this;
    }

    /**
     * @return array
     */
    public function getCalendars()
    {
        return $this->calendars;
    }

    /**
     * @param array $blackLists
     *
     * @return static
     */
    public function setBlackLists($blackLists = null)
    {
        $this->blackLists = $blackLists;

        return $this;
    }

    /**
     * @return array
     */
    public function getBlackLists()
    {
        return $this->blackLists;
    }

    /**
     * @param array $whiteLists
     *
     * @return static
     */
    public function setWhiteLists($whiteLists = null)
    {
        $this->whiteLists = $whiteLists;

        return $this;
    }

    /**
     * @return array
     */
    public function getWhiteLists()
    {
        return $this->whiteLists;
    }

    /**
     * @param array $schedules
     *
     * @return static
     */
    public function setSchedules($schedules = null)
    {
        $this->schedules = $schedules;

        return $this;
    }

    /**
     * @return array
     */
    public function getSchedules()
    {
        return $this->schedules;
    }
}
