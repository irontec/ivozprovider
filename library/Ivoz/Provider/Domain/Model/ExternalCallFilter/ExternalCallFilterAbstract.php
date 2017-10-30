<?php

namespace Ivoz\Provider\Domain\Model\ExternalCallFilter;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;

/**
 * ExternalCallFilterAbstract
 * @codeCoverageIgnore
 */
abstract class ExternalCallFilterAbstract
{
    /**
     * @var string
     */
    protected $name;

    /**
     * @comment enum:number|extension|voicemail
     * @var string
     */
    protected $holidayTargetType;

    /**
     * @var string
     */
    protected $holidayNumberValue;

    /**
     * @comment enum:number|extension|voicemail
     * @var string
     */
    protected $outOfScheduleTargetType;

    /**
     * @var string
     */
    protected $outOfScheduleNumberValue;

    /**
     * @var \Ivoz\Provider\Domain\Model\Company\CompanyInterface
     */
    protected $company;

    /**
     * @var \Ivoz\Provider\Domain\Model\Locution\LocutionInterface
     */
    protected $welcomeLocution;

    /**
     * @var \Ivoz\Provider\Domain\Model\Locution\LocutionInterface
     */
    protected $holidayLocution;

    /**
     * @var \Ivoz\Provider\Domain\Model\Locution\LocutionInterface
     */
    protected $outOfScheduleLocution;

    /**
     * @var \Ivoz\Provider\Domain\Model\Extension\ExtensionInterface
     */
    protected $holidayExtension;

    /**
     * @var \Ivoz\Provider\Domain\Model\Extension\ExtensionInterface
     */
    protected $outOfScheduleExtension;

    /**
     * @var \Ivoz\Provider\Domain\Model\User\UserInterface
     */
    protected $holidayVoiceMailUser;

    /**
     * @var \Ivoz\Provider\Domain\Model\User\UserInterface
     */
    protected $outOfScheduleVoiceMailUser;


    /**
     * Changelog tracking purpose
     * @var array
     */
    protected $_initialValues = [];

    /**
     * Constructor
     */
    public function __construct($name)
    {
        $this->setName($name);

        $this->initChangelog();
    }

    /**
     * @param string $fieldName
     * @return mixed
     * @throws \Exception
     */
    public function initChangelog()
    {
        $values = $this->__toArray();
        if (!$this->getId()) {
            // Empty values for entities with no Id
            foreach ($values as $key => $val) {
                $values[$key] = null;
            }
        }

        $this->_initialValues = $values;
    }

    /**
     * @param string $fieldName
     * @return mixed
     * @throws \Exception
     */
    public function hasChanged($dbFieldName)
    {
        if (!array_key_exists($dbFieldName, $this->_initialValues)) {
            throw new \Exception($dbFieldName . ' field was not found');
        }
        $currentValues = $this->__toArray();

        return $currentValues[$dbFieldName] != $this->_initialValues[$dbFieldName];
    }

    public function getInitialValue($dbFieldName)
    {
        if (!array_key_exists($dbFieldName, $this->_initialValues)) {
            throw new \Exception($dbFieldName . ' field was not found');
        }

        return $this->_initialValues[$dbFieldName];
    }

    /**
     * @return array
     */
    protected function getChangeSet()
    {
        $changes = [];
        $currentValues = $this->__toArray();
        foreach ($currentValues as $key => $value) {

            if ($this->_initialValues[$key] == $currentValues[$key]) {
                continue;
            }

            $value = $currentValues[$key];
            if ($value instanceof \DateTime) {
                $value = $value->format('Y-m-d H:i:s');
            }

            $changes[$key] = $value;
        }

        return $changes;
    }

    /**
     * @return ExternalCallFilterDTO
     */
    public static function createDTO()
    {
        return new ExternalCallFilterDTO();
    }

    /**
     * Factory method
     * @param DataTransferObjectInterface $dto
     * @return self
     */
    public static function fromDTO(DataTransferObjectInterface $dto)
    {
        /**
         * @var $dto ExternalCallFilterDTO
         */
        Assertion::isInstanceOf($dto, ExternalCallFilterDTO::class);

        $self = new static(
            $dto->getName());

        return $self
            ->setHolidayTargetType($dto->getHolidayTargetType())
            ->setHolidayNumberValue($dto->getHolidayNumberValue())
            ->setOutOfScheduleTargetType($dto->getOutOfScheduleTargetType())
            ->setOutOfScheduleNumberValue($dto->getOutOfScheduleNumberValue())
            ->setCompany($dto->getCompany())
            ->setWelcomeLocution($dto->getWelcomeLocution())
            ->setHolidayLocution($dto->getHolidayLocution())
            ->setOutOfScheduleLocution($dto->getOutOfScheduleLocution())
            ->setHolidayExtension($dto->getHolidayExtension())
            ->setOutOfScheduleExtension($dto->getOutOfScheduleExtension())
            ->setHolidayVoiceMailUser($dto->getHolidayVoiceMailUser())
            ->setOutOfScheduleVoiceMailUser($dto->getOutOfScheduleVoiceMailUser())
        ;
    }

    /**
     * @param DataTransferObjectInterface $dto
     * @return self
     */
    public function updateFromDTO(DataTransferObjectInterface $dto)
    {
        /**
         * @var $dto ExternalCallFilterDTO
         */
        Assertion::isInstanceOf($dto, ExternalCallFilterDTO::class);

        $this
            ->setName($dto->getName())
            ->setHolidayTargetType($dto->getHolidayTargetType())
            ->setHolidayNumberValue($dto->getHolidayNumberValue())
            ->setOutOfScheduleTargetType($dto->getOutOfScheduleTargetType())
            ->setOutOfScheduleNumberValue($dto->getOutOfScheduleNumberValue())
            ->setCompany($dto->getCompany())
            ->setWelcomeLocution($dto->getWelcomeLocution())
            ->setHolidayLocution($dto->getHolidayLocution())
            ->setOutOfScheduleLocution($dto->getOutOfScheduleLocution())
            ->setHolidayExtension($dto->getHolidayExtension())
            ->setOutOfScheduleExtension($dto->getOutOfScheduleExtension())
            ->setHolidayVoiceMailUser($dto->getHolidayVoiceMailUser())
            ->setOutOfScheduleVoiceMailUser($dto->getOutOfScheduleVoiceMailUser());


        return $this;
    }

    /**
     * @return ExternalCallFilterDTO
     */
    public function toDTO()
    {
        return self::createDTO()
            ->setName($this->getName())
            ->setHolidayTargetType($this->getHolidayTargetType())
            ->setHolidayNumberValue($this->getHolidayNumberValue())
            ->setOutOfScheduleTargetType($this->getOutOfScheduleTargetType())
            ->setOutOfScheduleNumberValue($this->getOutOfScheduleNumberValue())
            ->setCompanyId($this->getCompany() ? $this->getCompany()->getId() : null)
            ->setWelcomeLocutionId($this->getWelcomeLocution() ? $this->getWelcomeLocution()->getId() : null)
            ->setHolidayLocutionId($this->getHolidayLocution() ? $this->getHolidayLocution()->getId() : null)
            ->setOutOfScheduleLocutionId($this->getOutOfScheduleLocution() ? $this->getOutOfScheduleLocution()->getId() : null)
            ->setHolidayExtensionId($this->getHolidayExtension() ? $this->getHolidayExtension()->getId() : null)
            ->setOutOfScheduleExtensionId($this->getOutOfScheduleExtension() ? $this->getOutOfScheduleExtension()->getId() : null)
            ->setHolidayVoiceMailUserId($this->getHolidayVoiceMailUser() ? $this->getHolidayVoiceMailUser()->getId() : null)
            ->setOutOfScheduleVoiceMailUserId($this->getOutOfScheduleVoiceMailUser() ? $this->getOutOfScheduleVoiceMailUser()->getId() : null);
    }

    /**
     * @return array
     */
    protected function __toArray()
    {
        return [
            'name' => self::getName(),
            'holidayTargetType' => self::getHolidayTargetType(),
            'holidayNumberValue' => self::getHolidayNumberValue(),
            'outOfScheduleTargetType' => self::getOutOfScheduleTargetType(),
            'outOfScheduleNumberValue' => self::getOutOfScheduleNumberValue(),
            'companyId' => self::getCompany() ? self::getCompany()->getId() : null,
            'welcomeLocutionId' => self::getWelcomeLocution() ? self::getWelcomeLocution()->getId() : null,
            'holidayLocutionId' => self::getHolidayLocution() ? self::getHolidayLocution()->getId() : null,
            'outOfScheduleLocutionId' => self::getOutOfScheduleLocution() ? self::getOutOfScheduleLocution()->getId() : null,
            'holidayExtensionId' => self::getHolidayExtension() ? self::getHolidayExtension()->getId() : null,
            'outOfScheduleExtensionId' => self::getOutOfScheduleExtension() ? self::getOutOfScheduleExtension()->getId() : null,
            'holidayVoiceMailUserId' => self::getHolidayVoiceMailUser() ? self::getHolidayVoiceMailUser()->getId() : null,
            'outOfScheduleVoiceMailUserId' => self::getOutOfScheduleVoiceMailUser() ? self::getOutOfScheduleVoiceMailUser()->getId() : null
        ];
    }


    // @codeCoverageIgnoreStart

    /**
     * Set name
     *
     * @param string $name
     *
     * @return self
     */
    public function setName($name)
    {
        Assertion::notNull($name);
        Assertion::maxLength($name, 50);

        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set holidayTargetType
     *
     * @param string $holidayTargetType
     *
     * @return self
     */
    public function setHolidayTargetType($holidayTargetType = null)
    {
        if (!is_null($holidayTargetType)) {
            Assertion::maxLength($holidayTargetType, 25);
        Assertion::choice($holidayTargetType, array (
          0 => 'number',
          1 => 'extension',
          2 => 'voicemail',
        ));
        }

        $this->holidayTargetType = $holidayTargetType;

        return $this;
    }

    /**
     * Get holidayTargetType
     *
     * @return string
     */
    public function getHolidayTargetType()
    {
        return $this->holidayTargetType;
    }

    /**
     * Set holidayNumberValue
     *
     * @param string $holidayNumberValue
     *
     * @return self
     */
    public function setHolidayNumberValue($holidayNumberValue = null)
    {
        if (!is_null($holidayNumberValue)) {
            Assertion::maxLength($holidayNumberValue, 25);
        }

        $this->holidayNumberValue = $holidayNumberValue;

        return $this;
    }

    /**
     * Get holidayNumberValue
     *
     * @return string
     */
    public function getHolidayNumberValue()
    {
        return $this->holidayNumberValue;
    }

    /**
     * Set outOfScheduleTargetType
     *
     * @param string $outOfScheduleTargetType
     *
     * @return self
     */
    public function setOutOfScheduleTargetType($outOfScheduleTargetType = null)
    {
        if (!is_null($outOfScheduleTargetType)) {
            Assertion::maxLength($outOfScheduleTargetType, 25);
        Assertion::choice($outOfScheduleTargetType, array (
          0 => 'number',
          1 => 'extension',
          2 => 'voicemail',
        ));
        }

        $this->outOfScheduleTargetType = $outOfScheduleTargetType;

        return $this;
    }

    /**
     * Get outOfScheduleTargetType
     *
     * @return string
     */
    public function getOutOfScheduleTargetType()
    {
        return $this->outOfScheduleTargetType;
    }

    /**
     * Set outOfScheduleNumberValue
     *
     * @param string $outOfScheduleNumberValue
     *
     * @return self
     */
    public function setOutOfScheduleNumberValue($outOfScheduleNumberValue = null)
    {
        if (!is_null($outOfScheduleNumberValue)) {
            Assertion::maxLength($outOfScheduleNumberValue, 25);
        }

        $this->outOfScheduleNumberValue = $outOfScheduleNumberValue;

        return $this;
    }

    /**
     * Get outOfScheduleNumberValue
     *
     * @return string
     */
    public function getOutOfScheduleNumberValue()
    {
        return $this->outOfScheduleNumberValue;
    }

    /**
     * Set company
     *
     * @param \Ivoz\Provider\Domain\Model\Company\CompanyInterface $company
     *
     * @return self
     */
    public function setCompany(\Ivoz\Provider\Domain\Model\Company\CompanyInterface $company)
    {
        $this->company = $company;

        return $this;
    }

    /**
     * Get company
     *
     * @return \Ivoz\Provider\Domain\Model\Company\CompanyInterface
     */
    public function getCompany()
    {
        return $this->company;
    }

    /**
     * Set welcomeLocution
     *
     * @param \Ivoz\Provider\Domain\Model\Locution\LocutionInterface $welcomeLocution
     *
     * @return self
     */
    public function setWelcomeLocution(\Ivoz\Provider\Domain\Model\Locution\LocutionInterface $welcomeLocution = null)
    {
        $this->welcomeLocution = $welcomeLocution;

        return $this;
    }

    /**
     * Get welcomeLocution
     *
     * @return \Ivoz\Provider\Domain\Model\Locution\LocutionInterface
     */
    public function getWelcomeLocution()
    {
        return $this->welcomeLocution;
    }

    /**
     * Set holidayLocution
     *
     * @param \Ivoz\Provider\Domain\Model\Locution\LocutionInterface $holidayLocution
     *
     * @return self
     */
    public function setHolidayLocution(\Ivoz\Provider\Domain\Model\Locution\LocutionInterface $holidayLocution = null)
    {
        $this->holidayLocution = $holidayLocution;

        return $this;
    }

    /**
     * Get holidayLocution
     *
     * @return \Ivoz\Provider\Domain\Model\Locution\LocutionInterface
     */
    public function getHolidayLocution()
    {
        return $this->holidayLocution;
    }

    /**
     * Set outOfScheduleLocution
     *
     * @param \Ivoz\Provider\Domain\Model\Locution\LocutionInterface $outOfScheduleLocution
     *
     * @return self
     */
    public function setOutOfScheduleLocution(\Ivoz\Provider\Domain\Model\Locution\LocutionInterface $outOfScheduleLocution = null)
    {
        $this->outOfScheduleLocution = $outOfScheduleLocution;

        return $this;
    }

    /**
     * Get outOfScheduleLocution
     *
     * @return \Ivoz\Provider\Domain\Model\Locution\LocutionInterface
     */
    public function getOutOfScheduleLocution()
    {
        return $this->outOfScheduleLocution;
    }

    /**
     * Set holidayExtension
     *
     * @param \Ivoz\Provider\Domain\Model\Extension\ExtensionInterface $holidayExtension
     *
     * @return self
     */
    public function setHolidayExtension(\Ivoz\Provider\Domain\Model\Extension\ExtensionInterface $holidayExtension = null)
    {
        $this->holidayExtension = $holidayExtension;

        return $this;
    }

    /**
     * Get holidayExtension
     *
     * @return \Ivoz\Provider\Domain\Model\Extension\ExtensionInterface
     */
    public function getHolidayExtension()
    {
        return $this->holidayExtension;
    }

    /**
     * Set outOfScheduleExtension
     *
     * @param \Ivoz\Provider\Domain\Model\Extension\ExtensionInterface $outOfScheduleExtension
     *
     * @return self
     */
    public function setOutOfScheduleExtension(\Ivoz\Provider\Domain\Model\Extension\ExtensionInterface $outOfScheduleExtension = null)
    {
        $this->outOfScheduleExtension = $outOfScheduleExtension;

        return $this;
    }

    /**
     * Get outOfScheduleExtension
     *
     * @return \Ivoz\Provider\Domain\Model\Extension\ExtensionInterface
     */
    public function getOutOfScheduleExtension()
    {
        return $this->outOfScheduleExtension;
    }

    /**
     * Set holidayVoiceMailUser
     *
     * @param \Ivoz\Provider\Domain\Model\User\UserInterface $holidayVoiceMailUser
     *
     * @return self
     */
    public function setHolidayVoiceMailUser(\Ivoz\Provider\Domain\Model\User\UserInterface $holidayVoiceMailUser = null)
    {
        $this->holidayVoiceMailUser = $holidayVoiceMailUser;

        return $this;
    }

    /**
     * Get holidayVoiceMailUser
     *
     * @return \Ivoz\Provider\Domain\Model\User\UserInterface
     */
    public function getHolidayVoiceMailUser()
    {
        return $this->holidayVoiceMailUser;
    }

    /**
     * Set outOfScheduleVoiceMailUser
     *
     * @param \Ivoz\Provider\Domain\Model\User\UserInterface $outOfScheduleVoiceMailUser
     *
     * @return self
     */
    public function setOutOfScheduleVoiceMailUser(\Ivoz\Provider\Domain\Model\User\UserInterface $outOfScheduleVoiceMailUser = null)
    {
        $this->outOfScheduleVoiceMailUser = $outOfScheduleVoiceMailUser;

        return $this;
    }

    /**
     * Get outOfScheduleVoiceMailUser
     *
     * @return \Ivoz\Provider\Domain\Model\User\UserInterface
     */
    public function getOutOfScheduleVoiceMailUser()
    {
        return $this->outOfScheduleVoiceMailUser;
    }



    // @codeCoverageIgnoreEnd
}

