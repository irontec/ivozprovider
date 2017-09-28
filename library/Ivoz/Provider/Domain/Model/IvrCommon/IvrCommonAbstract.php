<?php

namespace Ivoz\Provider\Domain\Model\IvrCommon;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;

/**
 * IvrCommonAbstract
 * @codeCoverageIgnore
 */
abstract class IvrCommonAbstract
{
    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $blackListRegExp;

    /**
     * @var integer
     */
    protected $timeout;

    /**
     * @var integer
     */
    protected $maxDigits;

    /**
     * @var integer
     */
    protected $noAnswerTimeout = '10';

    /**
     * @comment enum:number|extension|voicemail
     * @var string
     */
    protected $timeoutTargetType;

    /**
     * @var string
     */
    protected $timeoutNumberValue;

    /**
     * @comment enum:number|extension|voicemail
     * @var string
     */
    protected $errorTargetType;

    /**
     * @var string
     */
    protected $errorNumberValue;

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
    protected $noAnswerLocution;

    /**
     * @var \Ivoz\Provider\Domain\Model\Locution\LocutionInterface
     */
    protected $errorLocution;

    /**
     * @var \Ivoz\Provider\Domain\Model\Locution\LocutionInterface
     */
    protected $successLocution;

    /**
     * @var \Ivoz\Provider\Domain\Model\Extension\ExtensionInterface
     */
    protected $timeoutExtension;

    /**
     * @var \Ivoz\Provider\Domain\Model\Extension\ExtensionInterface
     */
    protected $errorExtension;

    /**
     * @var \Ivoz\Provider\Domain\Model\User\UserInterface
     */
    protected $timeoutVoiceMailUser;

    /**
     * @var \Ivoz\Provider\Domain\Model\User\UserInterface
     */
    protected $errorVoiceMailUser;


    /**
     * Changelog tracking purpose
     * @var array
     */
    protected $_initialValues = [];

    /**
     * Constructor
     */
    public function __construct($name, $timeout, $maxDigits)
    {
        $this->setName($name);
        $this->setTimeout($timeout);
        $this->setMaxDigits($maxDigits);

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
    public function hasChanged($fieldName)
    {
        if (!array_key_exists($fieldName, $this->_initialValues)) {
            throw new \Exception($fieldName . ' field was not found');
        }
        $currentValues = $this->__toArray();

        return $currentValues[$fieldName] != $this->_initialValues[$fieldName];
    }

    public function getInitialValue($fieldName)
    {
        if (!array_key_exists($fieldName, $this->_initialValues)) {
            throw new \Exception($fieldName . ' field was not found');
        }

        return $this->_initialValues[$fieldName];
    }

    /**
     * @return IvrCommonDTO
     */
    public static function createDTO()
    {
        return new IvrCommonDTO();
    }

    /**
     * Factory method
     * @param DataTransferObjectInterface $dto
     * @return self
     */
    public static function fromDTO(DataTransferObjectInterface $dto)
    {
        /**
         * @var $dto IvrCommonDTO
         */
        Assertion::isInstanceOf($dto, IvrCommonDTO::class);

        $self = new static(
            $dto->getName(),
            $dto->getTimeout(),
            $dto->getMaxDigits());

        return $self
            ->setBlackListRegExp($dto->getBlackListRegExp())
            ->setNoAnswerTimeout($dto->getNoAnswerTimeout())
            ->setTimeoutTargetType($dto->getTimeoutTargetType())
            ->setTimeoutNumberValue($dto->getTimeoutNumberValue())
            ->setErrorTargetType($dto->getErrorTargetType())
            ->setErrorNumberValue($dto->getErrorNumberValue())
            ->setCompany($dto->getCompany())
            ->setWelcomeLocution($dto->getWelcomeLocution())
            ->setNoAnswerLocution($dto->getNoAnswerLocution())
            ->setErrorLocution($dto->getErrorLocution())
            ->setSuccessLocution($dto->getSuccessLocution())
            ->setTimeoutExtension($dto->getTimeoutExtension())
            ->setErrorExtension($dto->getErrorExtension())
            ->setTimeoutVoiceMailUser($dto->getTimeoutVoiceMailUser())
            ->setErrorVoiceMailUser($dto->getErrorVoiceMailUser())
        ;
    }

    /**
     * @param DataTransferObjectInterface $dto
     * @return self
     */
    public function updateFromDTO(DataTransferObjectInterface $dto)
    {
        /**
         * @var $dto IvrCommonDTO
         */
        Assertion::isInstanceOf($dto, IvrCommonDTO::class);

        $this
            ->setName($dto->getName())
            ->setBlackListRegExp($dto->getBlackListRegExp())
            ->setTimeout($dto->getTimeout())
            ->setMaxDigits($dto->getMaxDigits())
            ->setNoAnswerTimeout($dto->getNoAnswerTimeout())
            ->setTimeoutTargetType($dto->getTimeoutTargetType())
            ->setTimeoutNumberValue($dto->getTimeoutNumberValue())
            ->setErrorTargetType($dto->getErrorTargetType())
            ->setErrorNumberValue($dto->getErrorNumberValue())
            ->setCompany($dto->getCompany())
            ->setWelcomeLocution($dto->getWelcomeLocution())
            ->setNoAnswerLocution($dto->getNoAnswerLocution())
            ->setErrorLocution($dto->getErrorLocution())
            ->setSuccessLocution($dto->getSuccessLocution())
            ->setTimeoutExtension($dto->getTimeoutExtension())
            ->setErrorExtension($dto->getErrorExtension())
            ->setTimeoutVoiceMailUser($dto->getTimeoutVoiceMailUser())
            ->setErrorVoiceMailUser($dto->getErrorVoiceMailUser());


        return $this;
    }

    /**
     * @return IvrCommonDTO
     */
    public function toDTO()
    {
        return self::createDTO()
            ->setName($this->getName())
            ->setBlackListRegExp($this->getBlackListRegExp())
            ->setTimeout($this->getTimeout())
            ->setMaxDigits($this->getMaxDigits())
            ->setNoAnswerTimeout($this->getNoAnswerTimeout())
            ->setTimeoutTargetType($this->getTimeoutTargetType())
            ->setTimeoutNumberValue($this->getTimeoutNumberValue())
            ->setErrorTargetType($this->getErrorTargetType())
            ->setErrorNumberValue($this->getErrorNumberValue())
            ->setCompanyId($this->getCompany() ? $this->getCompany()->getId() : null)
            ->setWelcomeLocutionId($this->getWelcomeLocution() ? $this->getWelcomeLocution()->getId() : null)
            ->setNoAnswerLocutionId($this->getNoAnswerLocution() ? $this->getNoAnswerLocution()->getId() : null)
            ->setErrorLocutionId($this->getErrorLocution() ? $this->getErrorLocution()->getId() : null)
            ->setSuccessLocutionId($this->getSuccessLocution() ? $this->getSuccessLocution()->getId() : null)
            ->setTimeoutExtensionId($this->getTimeoutExtension() ? $this->getTimeoutExtension()->getId() : null)
            ->setErrorExtensionId($this->getErrorExtension() ? $this->getErrorExtension()->getId() : null)
            ->setTimeoutVoiceMailUserId($this->getTimeoutVoiceMailUser() ? $this->getTimeoutVoiceMailUser()->getId() : null)
            ->setErrorVoiceMailUserId($this->getErrorVoiceMailUser() ? $this->getErrorVoiceMailUser()->getId() : null);
    }

    /**
     * @return array
     */
    protected function __toArray()
    {
        return [
            'name' => $this->getName(),
            'blackListRegExp' => $this->getBlackListRegExp(),
            'timeout' => $this->getTimeout(),
            'maxDigits' => $this->getMaxDigits(),
            'noAnswerTimeout' => $this->getNoAnswerTimeout(),
            'timeoutTargetType' => $this->getTimeoutTargetType(),
            'timeoutNumberValue' => $this->getTimeoutNumberValue(),
            'errorTargetType' => $this->getErrorTargetType(),
            'errorNumberValue' => $this->getErrorNumberValue(),
            'companyId' => $this->getCompany() ? $this->getCompany()->getId() : null,
            'welcomeLocutionId' => $this->getWelcomeLocution() ? $this->getWelcomeLocution()->getId() : null,
            'noAnswerLocutionId' => $this->getNoAnswerLocution() ? $this->getNoAnswerLocution()->getId() : null,
            'errorLocutionId' => $this->getErrorLocution() ? $this->getErrorLocution()->getId() : null,
            'successLocutionId' => $this->getSuccessLocution() ? $this->getSuccessLocution()->getId() : null,
            'timeoutExtensionId' => $this->getTimeoutExtension() ? $this->getTimeoutExtension()->getId() : null,
            'errorExtensionId' => $this->getErrorExtension() ? $this->getErrorExtension()->getId() : null,
            'timeoutVoiceMailUserId' => $this->getTimeoutVoiceMailUser() ? $this->getTimeoutVoiceMailUser()->getId() : null,
            'errorVoiceMailUserId' => $this->getErrorVoiceMailUser() ? $this->getErrorVoiceMailUser()->getId() : null
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
     * Set blackListRegExp
     *
     * @param string $blackListRegExp
     *
     * @return self
     */
    public function setBlackListRegExp($blackListRegExp = null)
    {
        if (!is_null($blackListRegExp)) {
            Assertion::maxLength($blackListRegExp, 255);
        }

        $this->blackListRegExp = $blackListRegExp;

        return $this;
    }

    /**
     * Get blackListRegExp
     *
     * @return string
     */
    public function getBlackListRegExp()
    {
        return $this->blackListRegExp;
    }

    /**
     * Set timeout
     *
     * @param integer $timeout
     *
     * @return self
     */
    public function setTimeout($timeout)
    {
        Assertion::notNull($timeout);
        Assertion::integerish($timeout);
        Assertion::greaterOrEqualThan($timeout, 0);

        $this->timeout = $timeout;

        return $this;
    }

    /**
     * Get timeout
     *
     * @return integer
     */
    public function getTimeout()
    {
        return $this->timeout;
    }

    /**
     * Set maxDigits
     *
     * @param integer $maxDigits
     *
     * @return self
     */
    public function setMaxDigits($maxDigits)
    {
        Assertion::notNull($maxDigits);
        Assertion::integerish($maxDigits);
        Assertion::greaterOrEqualThan($maxDigits, 0);

        $this->maxDigits = $maxDigits;

        return $this;
    }

    /**
     * Get maxDigits
     *
     * @return integer
     */
    public function getMaxDigits()
    {
        return $this->maxDigits;
    }

    /**
     * Set noAnswerTimeout
     *
     * @param integer $noAnswerTimeout
     *
     * @return self
     */
    public function setNoAnswerTimeout($noAnswerTimeout = null)
    {
        if (!is_null($noAnswerTimeout)) {
            if (!is_null($noAnswerTimeout)) {
                Assertion::integerish($noAnswerTimeout);
            }
        }

        $this->noAnswerTimeout = $noAnswerTimeout;

        return $this;
    }

    /**
     * Get noAnswerTimeout
     *
     * @return integer
     */
    public function getNoAnswerTimeout()
    {
        return $this->noAnswerTimeout;
    }

    /**
     * Set timeoutTargetType
     *
     * @param string $timeoutTargetType
     *
     * @return self
     */
    public function setTimeoutTargetType($timeoutTargetType = null)
    {
        if (!is_null($timeoutTargetType)) {
            Assertion::maxLength($timeoutTargetType, 25);
        Assertion::choice($timeoutTargetType, array (
          0 => 'number',
          1 => 'extension',
          2 => 'voicemail',
        ));
        }

        $this->timeoutTargetType = $timeoutTargetType;

        return $this;
    }

    /**
     * Get timeoutTargetType
     *
     * @return string
     */
    public function getTimeoutTargetType()
    {
        return $this->timeoutTargetType;
    }

    /**
     * Set timeoutNumberValue
     *
     * @param string $timeoutNumberValue
     *
     * @return self
     */
    public function setTimeoutNumberValue($timeoutNumberValue = null)
    {
        if (!is_null($timeoutNumberValue)) {
            Assertion::maxLength($timeoutNumberValue, 25);
        }

        $this->timeoutNumberValue = $timeoutNumberValue;

        return $this;
    }

    /**
     * Get timeoutNumberValue
     *
     * @return string
     */
    public function getTimeoutNumberValue()
    {
        return $this->timeoutNumberValue;
    }

    /**
     * Set errorTargetType
     *
     * @param string $errorTargetType
     *
     * @return self
     */
    public function setErrorTargetType($errorTargetType = null)
    {
        if (!is_null($errorTargetType)) {
            Assertion::maxLength($errorTargetType, 25);
        Assertion::choice($errorTargetType, array (
          0 => 'number',
          1 => 'extension',
          2 => 'voicemail',
        ));
        }

        $this->errorTargetType = $errorTargetType;

        return $this;
    }

    /**
     * Get errorTargetType
     *
     * @return string
     */
    public function getErrorTargetType()
    {
        return $this->errorTargetType;
    }

    /**
     * Set errorNumberValue
     *
     * @param string $errorNumberValue
     *
     * @return self
     */
    public function setErrorNumberValue($errorNumberValue = null)
    {
        if (!is_null($errorNumberValue)) {
            Assertion::maxLength($errorNumberValue, 25);
        }

        $this->errorNumberValue = $errorNumberValue;

        return $this;
    }

    /**
     * Get errorNumberValue
     *
     * @return string
     */
    public function getErrorNumberValue()
    {
        return $this->errorNumberValue;
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
     * Set noAnswerLocution
     *
     * @param \Ivoz\Provider\Domain\Model\Locution\LocutionInterface $noAnswerLocution
     *
     * @return self
     */
    public function setNoAnswerLocution(\Ivoz\Provider\Domain\Model\Locution\LocutionInterface $noAnswerLocution = null)
    {
        $this->noAnswerLocution = $noAnswerLocution;

        return $this;
    }

    /**
     * Get noAnswerLocution
     *
     * @return \Ivoz\Provider\Domain\Model\Locution\LocutionInterface
     */
    public function getNoAnswerLocution()
    {
        return $this->noAnswerLocution;
    }

    /**
     * Set errorLocution
     *
     * @param \Ivoz\Provider\Domain\Model\Locution\LocutionInterface $errorLocution
     *
     * @return self
     */
    public function setErrorLocution(\Ivoz\Provider\Domain\Model\Locution\LocutionInterface $errorLocution = null)
    {
        $this->errorLocution = $errorLocution;

        return $this;
    }

    /**
     * Get errorLocution
     *
     * @return \Ivoz\Provider\Domain\Model\Locution\LocutionInterface
     */
    public function getErrorLocution()
    {
        return $this->errorLocution;
    }

    /**
     * Set successLocution
     *
     * @param \Ivoz\Provider\Domain\Model\Locution\LocutionInterface $successLocution
     *
     * @return self
     */
    public function setSuccessLocution(\Ivoz\Provider\Domain\Model\Locution\LocutionInterface $successLocution = null)
    {
        $this->successLocution = $successLocution;

        return $this;
    }

    /**
     * Get successLocution
     *
     * @return \Ivoz\Provider\Domain\Model\Locution\LocutionInterface
     */
    public function getSuccessLocution()
    {
        return $this->successLocution;
    }

    /**
     * Set timeoutExtension
     *
     * @param \Ivoz\Provider\Domain\Model\Extension\ExtensionInterface $timeoutExtension
     *
     * @return self
     */
    public function setTimeoutExtension(\Ivoz\Provider\Domain\Model\Extension\ExtensionInterface $timeoutExtension = null)
    {
        $this->timeoutExtension = $timeoutExtension;

        return $this;
    }

    /**
     * Get timeoutExtension
     *
     * @return \Ivoz\Provider\Domain\Model\Extension\ExtensionInterface
     */
    public function getTimeoutExtension()
    {
        return $this->timeoutExtension;
    }

    /**
     * Set errorExtension
     *
     * @param \Ivoz\Provider\Domain\Model\Extension\ExtensionInterface $errorExtension
     *
     * @return self
     */
    public function setErrorExtension(\Ivoz\Provider\Domain\Model\Extension\ExtensionInterface $errorExtension = null)
    {
        $this->errorExtension = $errorExtension;

        return $this;
    }

    /**
     * Get errorExtension
     *
     * @return \Ivoz\Provider\Domain\Model\Extension\ExtensionInterface
     */
    public function getErrorExtension()
    {
        return $this->errorExtension;
    }

    /**
     * Set timeoutVoiceMailUser
     *
     * @param \Ivoz\Provider\Domain\Model\User\UserInterface $timeoutVoiceMailUser
     *
     * @return self
     */
    public function setTimeoutVoiceMailUser(\Ivoz\Provider\Domain\Model\User\UserInterface $timeoutVoiceMailUser = null)
    {
        $this->timeoutVoiceMailUser = $timeoutVoiceMailUser;

        return $this;
    }

    /**
     * Get timeoutVoiceMailUser
     *
     * @return \Ivoz\Provider\Domain\Model\User\UserInterface
     */
    public function getTimeoutVoiceMailUser()
    {
        return $this->timeoutVoiceMailUser;
    }

    /**
     * Set errorVoiceMailUser
     *
     * @param \Ivoz\Provider\Domain\Model\User\UserInterface $errorVoiceMailUser
     *
     * @return self
     */
    public function setErrorVoiceMailUser(\Ivoz\Provider\Domain\Model\User\UserInterface $errorVoiceMailUser = null)
    {
        $this->errorVoiceMailUser = $errorVoiceMailUser;

        return $this;
    }

    /**
     * Get errorVoiceMailUser
     *
     * @return \Ivoz\Provider\Domain\Model\User\UserInterface
     */
    public function getErrorVoiceMailUser()
    {
        return $this->errorVoiceMailUser;
    }



    // @codeCoverageIgnoreEnd
}

