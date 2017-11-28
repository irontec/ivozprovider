<?php

namespace Ivoz\Provider\Domain\Model\Ivr;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Core\Application\CollectionTransformerInterface;

/**
 * @codeCoverageIgnore
 */
class IvrDTO implements DataTransferObjectInterface
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var integer
     */
    private $timeout;

    /**
     * @var integer
     */
    private $maxDigits;

    /**
     * @var boolean
     */
    private $allowExtensions = '0';

    /**
     * @var string
     */
    private $noInputRouteType;

    /**
     * @var string
     */
    private $noInputNumberValue;

    /**
     * @var string
     */
    private $errorRouteType;

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
    private $noInputLocutionId;

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
    private $noInputExtensionId;

    /**
     * @var mixed
     */
    private $errorExtensionId;

    /**
     * @var mixed
     */
    private $noInputVoiceMailUserId;

    /**
     * @var mixed
     */
    private $errorVoiceMailUserId;

    /**
     * @var mixed
     */
    private $noInputNumberCountryId;

    /**
     * @var mixed
     */
    private $errorNumberCountryId;

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
    private $noInputLocution;

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
    private $noInputExtension;

    /**
     * @var mixed
     */
    private $errorExtension;

    /**
     * @var mixed
     */
    private $noInputVoiceMailUser;

    /**
     * @var mixed
     */
    private $errorVoiceMailUser;

    /**
     * @var mixed
     */
    private $noInputNumberCountry;

    /**
     * @var mixed
     */
    private $errorNumberCountry;

    /**
     * @var array|null
     */
    private $entries = null;

    /**
     * @var array|null
     */
    private $excludedExtensions = null;

    /**
     * @return array
     */
    public function __toArray()
    {
        return [
            'name' => $this->getName(),
            'timeout' => $this->getTimeout(),
            'maxDigits' => $this->getMaxDigits(),
            'allowExtensions' => $this->getAllowExtensions(),
            'noInputRouteType' => $this->getNoInputRouteType(),
            'noInputNumberValue' => $this->getNoInputNumberValue(),
            'errorRouteType' => $this->getErrorRouteType(),
            'errorNumberValue' => $this->getErrorNumberValue(),
            'id' => $this->getId(),
            'companyId' => $this->getCompanyId(),
            'welcomeLocutionId' => $this->getWelcomeLocutionId(),
            'noInputLocutionId' => $this->getNoInputLocutionId(),
            'errorLocutionId' => $this->getErrorLocutionId(),
            'successLocutionId' => $this->getSuccessLocutionId(),
            'noInputExtensionId' => $this->getNoInputExtensionId(),
            'errorExtensionId' => $this->getErrorExtensionId(),
            'noInputVoiceMailUserId' => $this->getNoInputVoiceMailUserId(),
            'errorVoiceMailUserId' => $this->getErrorVoiceMailUserId(),
            'noInputNumberCountryId' => $this->getNoInputNumberCountryId(),
            'errorNumberCountryId' => $this->getErrorNumberCountryId(),
            'entries' => $this->getEntries(),
            'excludedExtensions' => $this->getExcludedExtensions()
        ];
    }

    /**
     * {@inheritDoc}
     */
    public function transformForeignKeys(ForeignKeyTransformerInterface $transformer)
    {
        $this->company = $transformer->transform('Ivoz\\Provider\\Domain\\Model\\Company\\Company', $this->getCompanyId());
        $this->welcomeLocution = $transformer->transform('Ivoz\\Provider\\Domain\\Model\\Locution\\Locution', $this->getWelcomeLocutionId());
        $this->noInputLocution = $transformer->transform('Ivoz\\Provider\\Domain\\Model\\Locution\\Locution', $this->getNoInputLocutionId());
        $this->errorLocution = $transformer->transform('Ivoz\\Provider\\Domain\\Model\\Locution\\Locution', $this->getErrorLocutionId());
        $this->successLocution = $transformer->transform('Ivoz\\Provider\\Domain\\Model\\Locution\\Locution', $this->getSuccessLocutionId());
        $this->noInputExtension = $transformer->transform('Ivoz\\Provider\\Domain\\Model\\Extension\\Extension', $this->getNoInputExtensionId());
        $this->errorExtension = $transformer->transform('Ivoz\\Provider\\Domain\\Model\\Extension\\Extension', $this->getErrorExtensionId());
        $this->noInputVoiceMailUser = $transformer->transform('Ivoz\\Provider\\Domain\\Model\\User\\User', $this->getNoInputVoiceMailUserId());
        $this->errorVoiceMailUser = $transformer->transform('Ivoz\\Provider\\Domain\\Model\\User\\User', $this->getErrorVoiceMailUserId());
        $this->noInputNumberCountry = $transformer->transform('Ivoz\\Provider\\Domain\\Model\\Country\\Country', $this->getNoInputNumberCountryId());
        $this->errorNumberCountry = $transformer->transform('Ivoz\\Provider\\Domain\\Model\\Country\\Country', $this->getErrorNumberCountryId());
        if (!is_null($this->entries)) {
            $items = $this->getEntries();
            $this->entries = [];
            foreach ($items as $item) {
                $this->entries[] = $transformer->transform(
                    'Ivoz\\Provider\\Domain\\Model\\IvrEntry\\IvrEntry',
                    $item->getId() ?? $item
                );
            }
        }

        if (!is_null($this->excludedExtensions)) {
            $items = $this->getExcludedExtensions();
            $this->excludedExtensions = [];
            foreach ($items as $item) {
                $this->excludedExtensions[] = $transformer->transform(
                    'Ivoz\\Provider\\Domain\\Model\\IvrExcludedExtension\\IvrExcludedExtension',
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
        $this->entries = $transformer->transform(
            'Ivoz\\Provider\\Domain\\Model\\IvrEntry\\IvrEntry',
            $this->entries
        );
        $this->excludedExtensions = $transformer->transform(
            'Ivoz\\Provider\\Domain\\Model\\IvrExcludedExtension\\IvrExcludedExtension',
            $this->excludedExtensions
        );
    }

    /**
     * @param string $name
     *
     * @return IvrDTO
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
     * @param integer $timeout
     *
     * @return IvrDTO
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
     * @return IvrDTO
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
     * @param boolean $allowExtensions
     *
     * @return IvrDTO
     */
    public function setAllowExtensions($allowExtensions)
    {
        $this->allowExtensions = $allowExtensions;

        return $this;
    }

    /**
     * @return boolean
     */
    public function getAllowExtensions()
    {
        return $this->allowExtensions;
    }

    /**
     * @param string $noInputRouteType
     *
     * @return IvrDTO
     */
    public function setNoInputRouteType($noInputRouteType = null)
    {
        $this->noInputRouteType = $noInputRouteType;

        return $this;
    }

    /**
     * @return string
     */
    public function getNoInputRouteType()
    {
        return $this->noInputRouteType;
    }

    /**
     * @param string $noInputNumberValue
     *
     * @return IvrDTO
     */
    public function setNoInputNumberValue($noInputNumberValue = null)
    {
        $this->noInputNumberValue = $noInputNumberValue;

        return $this;
    }

    /**
     * @return string
     */
    public function getNoInputNumberValue()
    {
        return $this->noInputNumberValue;
    }

    /**
     * @param string $errorRouteType
     *
     * @return IvrDTO
     */
    public function setErrorRouteType($errorRouteType = null)
    {
        $this->errorRouteType = $errorRouteType;

        return $this;
    }

    /**
     * @return string
     */
    public function getErrorRouteType()
    {
        return $this->errorRouteType;
    }

    /**
     * @param string $errorNumberValue
     *
     * @return IvrDTO
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
     * @return IvrDTO
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
     * @return IvrDTO
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
     * @return IvrDTO
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
     * @param integer $noInputLocutionId
     *
     * @return IvrDTO
     */
    public function setNoInputLocutionId($noInputLocutionId)
    {
        $this->noInputLocutionId = $noInputLocutionId;

        return $this;
    }

    /**
     * @return integer
     */
    public function getNoInputLocutionId()
    {
        return $this->noInputLocutionId;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\Locution\Locution
     */
    public function getNoInputLocution()
    {
        return $this->noInputLocution;
    }

    /**
     * @param integer $errorLocutionId
     *
     * @return IvrDTO
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
     * @return IvrDTO
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
     * @param integer $noInputExtensionId
     *
     * @return IvrDTO
     */
    public function setNoInputExtensionId($noInputExtensionId)
    {
        $this->noInputExtensionId = $noInputExtensionId;

        return $this;
    }

    /**
     * @return integer
     */
    public function getNoInputExtensionId()
    {
        return $this->noInputExtensionId;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\Extension\Extension
     */
    public function getNoInputExtension()
    {
        return $this->noInputExtension;
    }

    /**
     * @param integer $errorExtensionId
     *
     * @return IvrDTO
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
     * @param integer $noInputVoiceMailUserId
     *
     * @return IvrDTO
     */
    public function setNoInputVoiceMailUserId($noInputVoiceMailUserId)
    {
        $this->noInputVoiceMailUserId = $noInputVoiceMailUserId;

        return $this;
    }

    /**
     * @return integer
     */
    public function getNoInputVoiceMailUserId()
    {
        return $this->noInputVoiceMailUserId;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\User\User
     */
    public function getNoInputVoiceMailUser()
    {
        return $this->noInputVoiceMailUser;
    }

    /**
     * @param integer $errorVoiceMailUserId
     *
     * @return IvrDTO
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
     * @param integer $noInputNumberCountryId
     *
     * @return IvrDTO
     */
    public function setNoInputNumberCountryId($noInputNumberCountryId)
    {
        $this->noInputNumberCountryId = $noInputNumberCountryId;

        return $this;
    }

    /**
     * @return integer
     */
    public function getNoInputNumberCountryId()
    {
        return $this->noInputNumberCountryId;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\Country\Country
     */
    public function getNoInputNumberCountry()
    {
        return $this->noInputNumberCountry;
    }

    /**
     * @param integer $errorNumberCountryId
     *
     * @return IvrDTO
     */
    public function setErrorNumberCountryId($errorNumberCountryId)
    {
        $this->errorNumberCountryId = $errorNumberCountryId;

        return $this;
    }

    /**
     * @return integer
     */
    public function getErrorNumberCountryId()
    {
        return $this->errorNumberCountryId;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\Country\Country
     */
    public function getErrorNumberCountry()
    {
        return $this->errorNumberCountry;
    }

    /**
     * @param array $entries
     *
     * @return IvrDTO
     */
    public function setEntries($entries)
    {
        $this->entries = $entries;

        return $this;
    }

    /**
     * @return array
     */
    public function getEntries()
    {
        return $this->entries;
    }

    /**
     * @param array $excludedExtensions
     *
     * @return IvrDTO
     */
    public function setExcludedExtensions($excludedExtensions)
    {
        $this->excludedExtensions = $excludedExtensions;

        return $this;
    }

    /**
     * @return array
     */
    public function getExcludedExtensions()
    {
        return $this->excludedExtensions;
    }
}


