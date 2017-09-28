<?php

namespace Ivoz\Provider\Domain\Model\ExternalCallFilter;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Core\Application\CollectionTransformerInterface;

/**
 * @codeCoverageIgnore
 */
class ExternalCallFilterDTO implements DataTransferObjectInterface
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
     * @var mixed
     */
    private $companyId;

    /**
     * @var mixed
     */
    private $welcomeLocutionId;

    /**
     * @var mixed
     */
    private $holidayLocutionId;

    /**
     * @var mixed
     */
    private $outOfScheduleLocutionId;

    /**
     * @var mixed
     */
    private $holidayExtensionId;

    /**
     * @var mixed
     */
    private $outOfScheduleExtensionId;

    /**
     * @var mixed
     */
    private $holidayVoiceMailUserId;

    /**
     * @var mixed
     */
    private $outOfScheduleVoiceMailUserId;

    /**
     * @var mixed
     */
    private $company;

    /**
     * @var mixed
     */
    private $welcomeLocution;

    /**
     * @var mixed
     */
    private $holidayLocution;

    /**
     * @var mixed
     */
    private $outOfScheduleLocution;

    /**
     * @var mixed
     */
    private $holidayExtension;

    /**
     * @var mixed
     */
    private $outOfScheduleExtension;

    /**
     * @var mixed
     */
    private $holidayVoiceMailUser;

    /**
     * @var mixed
     */
    private $outOfScheduleVoiceMailUser;

    /**
     * @var array|null
     */
    private $calendars = null;

    /**
     * @var array|null
     */
    private $blackLists = null;

    /**
     * @var array|null
     */
    private $whiteLists = null;

    /**
     * @var array|null
     */
    private $schedules = null;

    /**
     * @return array
     */
    public function __toArray()
    {
        return [
            'name' => $this->getName(),
            'holidayTargetType' => $this->getHolidayTargetType(),
            'holidayNumberValue' => $this->getHolidayNumberValue(),
            'outOfScheduleTargetType' => $this->getOutOfScheduleTargetType(),
            'outOfScheduleNumberValue' => $this->getOutOfScheduleNumberValue(),
            'id' => $this->getId(),
            'companyId' => $this->getCompanyId(),
            'welcomeLocutionId' => $this->getWelcomeLocutionId(),
            'holidayLocutionId' => $this->getHolidayLocutionId(),
            'outOfScheduleLocutionId' => $this->getOutOfScheduleLocutionId(),
            'holidayExtensionId' => $this->getHolidayExtensionId(),
            'outOfScheduleExtensionId' => $this->getOutOfScheduleExtensionId(),
            'holidayVoiceMailUserId' => $this->getHolidayVoiceMailUserId(),
            'outOfScheduleVoiceMailUserId' => $this->getOutOfScheduleVoiceMailUserId(),
            'calendarsId' => $this->getCalendarsId(),
            'blackListsId' => $this->getBlackListsId(),
            'whiteListsId' => $this->getWhiteListsId(),
            'schedulesId' => $this->getSchedulesId()
        ];
    }

    /**
     * {@inheritDoc}
     */
    public function transformForeignKeys(ForeignKeyTransformerInterface $transformer)
    {
        $this->company = $transformer->transform('Ivoz\\Provider\\Domain\\Model\\Company\\Company', $this->getCompanyId());
        $this->welcomeLocution = $transformer->transform('Ivoz\\Provider\\Domain\\Model\\Locution\\Locution', $this->getWelcomeLocutionId());
        $this->holidayLocution = $transformer->transform('Ivoz\\Provider\\Domain\\Model\\Locution\\Locution', $this->getHolidayLocutionId());
        $this->outOfScheduleLocution = $transformer->transform('Ivoz\\Provider\\Domain\\Model\\Locution\\Locution', $this->getOutOfScheduleLocutionId());
        $this->holidayExtension = $transformer->transform('Ivoz\\Provider\\Domain\\Model\\Extension\\Extension', $this->getHolidayExtensionId());
        $this->outOfScheduleExtension = $transformer->transform('Ivoz\\Provider\\Domain\\Model\\Extension\\Extension', $this->getOutOfScheduleExtensionId());
        $this->holidayVoiceMailUser = $transformer->transform('Ivoz\\Provider\\Domain\\Model\\User\\User', $this->getHolidayVoiceMailUserId());
        $this->outOfScheduleVoiceMailUser = $transformer->transform('Ivoz\\Provider\\Domain\\Model\\User\\User', $this->getOutOfScheduleVoiceMailUserId());
        if (!is_null($this->calendars)) {
            $items = $this->getCalendars();
            $this->calendars = [];
            foreach ($items as $item) {
                $this->calendars[] = $transformer->transform(
                    'Ivoz\\Provider\\Domain\\Model\\ExternalCallFilterRelCalendar\\ExternalCallFilterRelCalendar',
                    $item->getId() ?? $item
                );
            }
        }

        if (!is_null($this->blackLists)) {
            $items = $this->getBlackLists();
            $this->blackLists = [];
            foreach ($items as $item) {
                $this->blackLists[] = $transformer->transform(
                    'Ivoz\\Provider\\Domain\\Model\\ExternalCallFilterBlackList\\ExternalCallFilterBlackList',
                    $item->getId() ?? $item
                );
            }
        }

        if (!is_null($this->whiteLists)) {
            $items = $this->getWhiteLists();
            $this->whiteLists = [];
            foreach ($items as $item) {
                $this->whiteLists[] = $transformer->transform(
                    'Ivoz\\Provider\\Domain\\Model\\ExternalCallFilterWhiteList\\ExternalCallFilterWhiteList',
                    $item->getId() ?? $item
                );
            }
        }

        if (!is_null($this->schedules)) {
            $items = $this->getSchedules();
            $this->schedules = [];
            foreach ($items as $item) {
                $this->schedules[] = $transformer->transform(
                    'Ivoz\\Provider\\Domain\\Model\\ExternalCallFilterRelSchedule\\ExternalCallFilterRelSchedule',
                    $item->getId() ?? $item
                );
            }
        }

    }

    /**
     * {@inheritDoc}
     */
    public function transformCollections(CollectionTransformerInterface $transformer)
    {
        $this->calendars = $transformer->transform(
            'Ivoz\\Provider\\Domain\\Model\\ExternalCallFilterRelCalendar\\ExternalCallFilterRelCalendar',
            $this->calendars
        );
        $this->blackLists = $transformer->transform(
            'Ivoz\\Provider\\Domain\\Model\\ExternalCallFilterBlackList\\ExternalCallFilterBlackList',
            $this->blackLists
        );
        $this->whiteLists = $transformer->transform(
            'Ivoz\\Provider\\Domain\\Model\\ExternalCallFilterWhiteList\\ExternalCallFilterWhiteList',
            $this->whiteLists
        );
        $this->schedules = $transformer->transform(
            'Ivoz\\Provider\\Domain\\Model\\ExternalCallFilterRelSchedule\\ExternalCallFilterRelSchedule',
            $this->schedules
        );
    }

    /**
     * @param string $name
     *
     * @return ExternalCallFilterDTO
     */
    public function setName($name)
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
     * @return ExternalCallFilterDTO
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
     * @return ExternalCallFilterDTO
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
     * @return ExternalCallFilterDTO
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
     * @return ExternalCallFilterDTO
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
     * @return ExternalCallFilterDTO
     */
    public function setId($id)
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
     * @param integer $companyId
     *
     * @return ExternalCallFilterDTO
     */
    public function setCompanyId($companyId)
    {
        $this->companyId = $companyId;

        return $this;
    }

    /**
     * @return integer
     */
    public function getCompanyId()
    {
        return $this->companyId;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\Company\Company
     */
    public function getCompany()
    {
        return $this->company;
    }

    /**
     * @param integer $welcomeLocutionId
     *
     * @return ExternalCallFilterDTO
     */
    public function setWelcomeLocutionId($welcomeLocutionId)
    {
        $this->welcomeLocutionId = $welcomeLocutionId;

        return $this;
    }

    /**
     * @return integer
     */
    public function getWelcomeLocutionId()
    {
        return $this->welcomeLocutionId;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\Locution\Locution
     */
    public function getWelcomeLocution()
    {
        return $this->welcomeLocution;
    }

    /**
     * @param integer $holidayLocutionId
     *
     * @return ExternalCallFilterDTO
     */
    public function setHolidayLocutionId($holidayLocutionId)
    {
        $this->holidayLocutionId = $holidayLocutionId;

        return $this;
    }

    /**
     * @return integer
     */
    public function getHolidayLocutionId()
    {
        return $this->holidayLocutionId;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\Locution\Locution
     */
    public function getHolidayLocution()
    {
        return $this->holidayLocution;
    }

    /**
     * @param integer $outOfScheduleLocutionId
     *
     * @return ExternalCallFilterDTO
     */
    public function setOutOfScheduleLocutionId($outOfScheduleLocutionId)
    {
        $this->outOfScheduleLocutionId = $outOfScheduleLocutionId;

        return $this;
    }

    /**
     * @return integer
     */
    public function getOutOfScheduleLocutionId()
    {
        return $this->outOfScheduleLocutionId;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\Locution\Locution
     */
    public function getOutOfScheduleLocution()
    {
        return $this->outOfScheduleLocution;
    }

    /**
     * @param integer $holidayExtensionId
     *
     * @return ExternalCallFilterDTO
     */
    public function setHolidayExtensionId($holidayExtensionId)
    {
        $this->holidayExtensionId = $holidayExtensionId;

        return $this;
    }

    /**
     * @return integer
     */
    public function getHolidayExtensionId()
    {
        return $this->holidayExtensionId;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\Extension\Extension
     */
    public function getHolidayExtension()
    {
        return $this->holidayExtension;
    }

    /**
     * @param integer $outOfScheduleExtensionId
     *
     * @return ExternalCallFilterDTO
     */
    public function setOutOfScheduleExtensionId($outOfScheduleExtensionId)
    {
        $this->outOfScheduleExtensionId = $outOfScheduleExtensionId;

        return $this;
    }

    /**
     * @return integer
     */
    public function getOutOfScheduleExtensionId()
    {
        return $this->outOfScheduleExtensionId;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\Extension\Extension
     */
    public function getOutOfScheduleExtension()
    {
        return $this->outOfScheduleExtension;
    }

    /**
     * @param integer $holidayVoiceMailUserId
     *
     * @return ExternalCallFilterDTO
     */
    public function setHolidayVoiceMailUserId($holidayVoiceMailUserId)
    {
        $this->holidayVoiceMailUserId = $holidayVoiceMailUserId;

        return $this;
    }

    /**
     * @return integer
     */
    public function getHolidayVoiceMailUserId()
    {
        return $this->holidayVoiceMailUserId;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\User\User
     */
    public function getHolidayVoiceMailUser()
    {
        return $this->holidayVoiceMailUser;
    }

    /**
     * @param integer $outOfScheduleVoiceMailUserId
     *
     * @return ExternalCallFilterDTO
     */
    public function setOutOfScheduleVoiceMailUserId($outOfScheduleVoiceMailUserId)
    {
        $this->outOfScheduleVoiceMailUserId = $outOfScheduleVoiceMailUserId;

        return $this;
    }

    /**
     * @return integer
     */
    public function getOutOfScheduleVoiceMailUserId()
    {
        return $this->outOfScheduleVoiceMailUserId;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\User\User
     */
    public function getOutOfScheduleVoiceMailUser()
    {
        return $this->outOfScheduleVoiceMailUser;
    }

    /**
     * @param array $calendars
     *
     * @return ExternalCallFilterDTO
     */
    public function setCalendars($calendars)
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
     * @return ExternalCallFilterDTO
     */
    public function setBlackLists($blackLists)
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
     * @return ExternalCallFilterDTO
     */
    public function setWhiteLists($whiteLists)
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
     * @return ExternalCallFilterDTO
     */
    public function setSchedules($schedules)
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

