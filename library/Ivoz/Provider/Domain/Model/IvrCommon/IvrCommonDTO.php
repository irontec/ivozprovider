<?php

namespace Ivoz\Provider\Domain\Model\IvrCommon;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Core\Application\CollectionTransformerInterface;

/**
 * @codeCoverageIgnore
 */
class IvrCommonDTO implements DataTransferObjectInterface
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $blackListRegExp;

    /**
     * @var integer
     */
    private $timeout;

    /**
     * @var integer
     */
    private $maxDigits;

    /**
     * @var integer
     */
    private $noAnswerTimeout = '10';

    /**
     * @var string
     */
    private $timeoutTargetType;

    /**
     * @var string
     */
    private $timeoutNumberValue;

    /**
     * @var string
     */
    private $errorTargetType;

    /**
     * @var string
     */
    private $errorNumberValue;

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
    private $noAnswerLocutionId;

    /**
     * @var mixed
     */
    private $errorLocutionId;

    /**
     * @var mixed
     */
    private $successLocutionId;

    /**
     * @var mixed
     */
    private $timeoutExtensionId;

    /**
     * @var mixed
     */
    private $errorExtensionId;

    /**
     * @var mixed
     */
    private $timeoutVoiceMailUserId;

    /**
     * @var mixed
     */
    private $errorVoiceMailUserId;

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
    private $noAnswerLocution;

    /**
     * @var mixed
     */
    private $errorLocution;

    /**
     * @var mixed
     */
    private $successLocution;

    /**
     * @var mixed
     */
    private $timeoutExtension;

    /**
     * @var mixed
     */
    private $errorExtension;

    /**
     * @var mixed
     */
    private $timeoutVoiceMailUser;

    /**
     * @var mixed
     */
    private $errorVoiceMailUser;

    /**
     * @var array|null
     */
    private $extensions = null;

    /**
     * @return array
     */
    public function __toArray()
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
            'id' => $this->getId(),
            'companyId' => $this->getCompanyId(),
            'welcomeLocutionId' => $this->getWelcomeLocutionId(),
            'noAnswerLocutionId' => $this->getNoAnswerLocutionId(),
            'errorLocutionId' => $this->getErrorLocutionId(),
            'successLocutionId' => $this->getSuccessLocutionId(),
            'timeoutExtensionId' => $this->getTimeoutExtensionId(),
            'errorExtensionId' => $this->getErrorExtensionId(),
            'timeoutVoiceMailUserId' => $this->getTimeoutVoiceMailUserId(),
            'errorVoiceMailUserId' => $this->getErrorVoiceMailUserId(),
            'extensionsId' => $this->getExtensionsId()
        ];
    }

    /**
     * {@inheritDoc}
     */
    public function transformForeignKeys(ForeignKeyTransformerInterface $transformer)
    {
        $this->company = $transformer->transform('Ivoz\\Provider\\Domain\\Model\\Company\\Company', $this->getCompanyId());
        $this->welcomeLocution = $transformer->transform('Ivoz\\Provider\\Domain\\Model\\Locution\\Locution', $this->getWelcomeLocutionId());
        $this->noAnswerLocution = $transformer->transform('Ivoz\\Provider\\Domain\\Model\\Locution\\Locution', $this->getNoAnswerLocutionId());
        $this->errorLocution = $transformer->transform('Ivoz\\Provider\\Domain\\Model\\Locution\\Locution', $this->getErrorLocutionId());
        $this->successLocution = $transformer->transform('Ivoz\\Provider\\Domain\\Model\\Locution\\Locution', $this->getSuccessLocutionId());
        $this->timeoutExtension = $transformer->transform('Ivoz\\Provider\\Domain\\Model\\Extension\\Extension', $this->getTimeoutExtensionId());
        $this->errorExtension = $transformer->transform('Ivoz\\Provider\\Domain\\Model\\Extension\\Extension', $this->getErrorExtensionId());
        $this->timeoutVoiceMailUser = $transformer->transform('Ivoz\\Provider\\Domain\\Model\\User\\User', $this->getTimeoutVoiceMailUserId());
        $this->errorVoiceMailUser = $transformer->transform('Ivoz\\Provider\\Domain\\Model\\User\\User', $this->getErrorVoiceMailUserId());
        if (!is_null($this->extensions)) {
            $items = $this->getExtensions();
            $this->extensions = [];
            foreach ($items as $item) {
                $this->extensions[] = $transformer->transform(
                    'Ivoz\\Provider\\Domain\\Model\\Extension\\Extension',
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
        $this->extensions = $transformer->transform(
            'Ivoz\\Provider\\Domain\\Model\\Extension\\Extension',
            $this->extensions
        );
    }

    /**
     * @param string $name
     *
     * @return IvrCommonDTO
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
     * @param string $blackListRegExp
     *
     * @return IvrCommonDTO
     */
    public function setBlackListRegExp($blackListRegExp = null)
    {
        $this->blackListRegExp = $blackListRegExp;

        return $this;
    }

    /**
     * @return string
     */
    public function getBlackListRegExp()
    {
        return $this->blackListRegExp;
    }

    /**
     * @param integer $timeout
     *
     * @return IvrCommonDTO
     */
    public function setTimeout($timeout)
    {
        $this->timeout = $timeout;

        return $this;
    }

    /**
     * @return integer
     */
    public function getTimeout()
    {
        return $this->timeout;
    }

    /**
     * @param integer $maxDigits
     *
     * @return IvrCommonDTO
     */
    public function setMaxDigits($maxDigits)
    {
        $this->maxDigits = $maxDigits;

        return $this;
    }

    /**
     * @return integer
     */
    public function getMaxDigits()
    {
        return $this->maxDigits;
    }

    /**
     * @param integer $noAnswerTimeout
     *
     * @return IvrCommonDTO
     */
    public function setNoAnswerTimeout($noAnswerTimeout = null)
    {
        $this->noAnswerTimeout = $noAnswerTimeout;

        return $this;
    }

    /**
     * @return integer
     */
    public function getNoAnswerTimeout()
    {
        return $this->noAnswerTimeout;
    }

    /**
     * @param string $timeoutTargetType
     *
     * @return IvrCommonDTO
     */
    public function setTimeoutTargetType($timeoutTargetType = null)
    {
        $this->timeoutTargetType = $timeoutTargetType;

        return $this;
    }

    /**
     * @return string
     */
    public function getTimeoutTargetType()
    {
        return $this->timeoutTargetType;
    }

    /**
     * @param string $timeoutNumberValue
     *
     * @return IvrCommonDTO
     */
    public function setTimeoutNumberValue($timeoutNumberValue = null)
    {
        $this->timeoutNumberValue = $timeoutNumberValue;

        return $this;
    }

    /**
     * @return string
     */
    public function getTimeoutNumberValue()
    {
        return $this->timeoutNumberValue;
    }

    /**
     * @param string $errorTargetType
     *
     * @return IvrCommonDTO
     */
    public function setErrorTargetType($errorTargetType = null)
    {
        $this->errorTargetType = $errorTargetType;

        return $this;
    }

    /**
     * @return string
     */
    public function getErrorTargetType()
    {
        return $this->errorTargetType;
    }

    /**
     * @param string $errorNumberValue
     *
     * @return IvrCommonDTO
     */
    public function setErrorNumberValue($errorNumberValue = null)
    {
        $this->errorNumberValue = $errorNumberValue;

        return $this;
    }

    /**
     * @return string
     */
    public function getErrorNumberValue()
    {
        return $this->errorNumberValue;
    }

    /**
     * @param integer $id
     *
     * @return IvrCommonDTO
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
     * @return IvrCommonDTO
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
     * @return IvrCommonDTO
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
     * @param integer $noAnswerLocutionId
     *
     * @return IvrCommonDTO
     */
    public function setNoAnswerLocutionId($noAnswerLocutionId)
    {
        $this->noAnswerLocutionId = $noAnswerLocutionId;

        return $this;
    }

    /**
     * @return integer
     */
    public function getNoAnswerLocutionId()
    {
        return $this->noAnswerLocutionId;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\Locution\Locution
     */
    public function getNoAnswerLocution()
    {
        return $this->noAnswerLocution;
    }

    /**
     * @param integer $errorLocutionId
     *
     * @return IvrCommonDTO
     */
    public function setErrorLocutionId($errorLocutionId)
    {
        $this->errorLocutionId = $errorLocutionId;

        return $this;
    }

    /**
     * @return integer
     */
    public function getErrorLocutionId()
    {
        return $this->errorLocutionId;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\Locution\Locution
     */
    public function getErrorLocution()
    {
        return $this->errorLocution;
    }

    /**
     * @param integer $successLocutionId
     *
     * @return IvrCommonDTO
     */
    public function setSuccessLocutionId($successLocutionId)
    {
        $this->successLocutionId = $successLocutionId;

        return $this;
    }

    /**
     * @return integer
     */
    public function getSuccessLocutionId()
    {
        return $this->successLocutionId;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\Locution\Locution
     */
    public function getSuccessLocution()
    {
        return $this->successLocution;
    }

    /**
     * @param integer $timeoutExtensionId
     *
     * @return IvrCommonDTO
     */
    public function setTimeoutExtensionId($timeoutExtensionId)
    {
        $this->timeoutExtensionId = $timeoutExtensionId;

        return $this;
    }

    /**
     * @return integer
     */
    public function getTimeoutExtensionId()
    {
        return $this->timeoutExtensionId;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\Extension\Extension
     */
    public function getTimeoutExtension()
    {
        return $this->timeoutExtension;
    }

    /**
     * @param integer $errorExtensionId
     *
     * @return IvrCommonDTO
     */
    public function setErrorExtensionId($errorExtensionId)
    {
        $this->errorExtensionId = $errorExtensionId;

        return $this;
    }

    /**
     * @return integer
     */
    public function getErrorExtensionId()
    {
        return $this->errorExtensionId;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\Extension\Extension
     */
    public function getErrorExtension()
    {
        return $this->errorExtension;
    }

    /**
     * @param integer $timeoutVoiceMailUserId
     *
     * @return IvrCommonDTO
     */
    public function setTimeoutVoiceMailUserId($timeoutVoiceMailUserId)
    {
        $this->timeoutVoiceMailUserId = $timeoutVoiceMailUserId;

        return $this;
    }

    /**
     * @return integer
     */
    public function getTimeoutVoiceMailUserId()
    {
        return $this->timeoutVoiceMailUserId;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\User\User
     */
    public function getTimeoutVoiceMailUser()
    {
        return $this->timeoutVoiceMailUser;
    }

    /**
     * @param integer $errorVoiceMailUserId
     *
     * @return IvrCommonDTO
     */
    public function setErrorVoiceMailUserId($errorVoiceMailUserId)
    {
        $this->errorVoiceMailUserId = $errorVoiceMailUserId;

        return $this;
    }

    /**
     * @return integer
     */
    public function getErrorVoiceMailUserId()
    {
        return $this->errorVoiceMailUserId;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\User\User
     */
    public function getErrorVoiceMailUser()
    {
        return $this->errorVoiceMailUser;
    }

    /**
     * @param array $extensions
     *
     * @return IvrCommonDTO
     */
    public function setExtensions($extensions)
    {
        $this->extensions = $extensions;

        return $this;
    }

    /**
     * @return array
     */
    public function getExtensions()
    {
        return $this->extensions;
    }
}

