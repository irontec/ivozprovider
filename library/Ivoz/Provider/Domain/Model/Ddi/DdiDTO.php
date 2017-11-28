<?php

namespace Ivoz\Provider\Domain\Model\Ddi;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Core\Application\CollectionTransformerInterface;

/**
 * @codeCoverageIgnore
 */
class DdiDTO implements DataTransferObjectInterface
{
    /**
     * @var string
     */
    private $ddi;

    /**
     * @var string
     */
    private $ddie164;

    /**
     * @var string
     */
    private $recordCalls = 'none';

    /**
     * @var string
     */
    private $displayName;

    /**
     * @var string
     */
    private $routeType;

    /**
     * @var boolean
     */
    private $billInboundCalls = '0';

    /**
     * @var string
     */
    private $friendValue;

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
    private $brandId;

    /**
     * @var mixed
     */
    private $conferenceRoomId;

    /**
     * @var mixed
     */
    private $languageId;

    /**
     * @var mixed
     */
    private $queueId;

    /**
     * @var mixed
     */
    private $externalCallFilterId;

    /**
     * @var mixed
     */
    private $userId;

    /**
     * @var mixed
     */
    private $ivrId;

    /**
     * @var mixed
     */
    private $huntGroupId;

    /**
     * @var mixed
     */
    private $faxId;

    /**
     * @var mixed
     */
    private $peeringContractId;

    /**
     * @var mixed
     */
    private $countryId;

    /**
     * @var mixed
     */
    private $retailAccountId;

    /**
     * @var mixed
     */
    private $conditionalRouteId;

    /**
     * @var mixed
     */
    private $company;

    /**
     * @var mixed
     */
    private $brand;

    /**
     * @var mixed
     */
    private $conferenceRoom;

    /**
     * @var mixed
     */
    private $language;

    /**
     * @var mixed
     */
    private $queue;

    /**
     * @var mixed
     */
    private $externalCallFilter;

    /**
     * @var mixed
     */
    private $user;

    /**
     * @var mixed
     */
    private $ivr;

    /**
     * @var mixed
     */
    private $huntGroup;

    /**
     * @var mixed
     */
    private $fax;

    /**
     * @var mixed
     */
    private $peeringContract;

    /**
     * @var mixed
     */
    private $country;

    /**
     * @var mixed
     */
    private $retailAccount;

    /**
     * @var mixed
     */
    private $conditionalRoute;

    /**
     * @return array
     */
    public function __toArray()
    {
        return [
            'ddi' => $this->getDdi(),
            'ddie164' => $this->getDdie164(),
            'recordCalls' => $this->getRecordCalls(),
            'displayName' => $this->getDisplayName(),
            'routeType' => $this->getRouteType(),
            'billInboundCalls' => $this->getBillInboundCalls(),
            'friendValue' => $this->getFriendValue(),
            'id' => $this->getId(),
            'companyId' => $this->getCompanyId(),
            'brandId' => $this->getBrandId(),
            'conferenceRoomId' => $this->getConferenceRoomId(),
            'languageId' => $this->getLanguageId(),
            'queueId' => $this->getQueueId(),
            'externalCallFilterId' => $this->getExternalCallFilterId(),
            'userId' => $this->getUserId(),
            'ivrId' => $this->getIvrId(),
            'huntGroupId' => $this->getHuntGroupId(),
            'faxId' => $this->getFaxId(),
            'peeringContractId' => $this->getPeeringContractId(),
            'countryId' => $this->getCountryId(),
            'retailAccountId' => $this->getRetailAccountId(),
            'conditionalRouteId' => $this->getConditionalRouteId()
        ];
    }

    /**
     * {@inheritDoc}
     */
    public function transformForeignKeys(ForeignKeyTransformerInterface $transformer)
    {
        $this->company = $transformer->transform('Ivoz\\Provider\\Domain\\Model\\Company\\Company', $this->getCompanyId());
        $this->brand = $transformer->transform('Ivoz\\Provider\\Domain\\Model\\Brand\\Brand', $this->getBrandId());
        $this->conferenceRoom = $transformer->transform('Ivoz\\Provider\\Domain\\Model\\ConferenceRoom\\ConferenceRoom', $this->getConferenceRoomId());
        $this->language = $transformer->transform('Ivoz\\Provider\\Domain\\Model\\Language\\Language', $this->getLanguageId());
        $this->queue = $transformer->transform('Ivoz\\Provider\\Domain\\Model\\Queue\\Queue', $this->getQueueId());
        $this->externalCallFilter = $transformer->transform('Ivoz\\Provider\\Domain\\Model\\ExternalCallFilter\\ExternalCallFilter', $this->getExternalCallFilterId());
        $this->user = $transformer->transform('Ivoz\\Provider\\Domain\\Model\\User\\User', $this->getUserId());
        $this->ivr = $transformer->transform('Ivoz\\Provider\\Domain\\Model\\Ivr\\Ivr', $this->getIvrId());
        $this->huntGroup = $transformer->transform('Ivoz\\Provider\\Domain\\Model\\HuntGroup\\HuntGroup', $this->getHuntGroupId());
        $this->fax = $transformer->transform('Ivoz\\Provider\\Domain\\Model\\Fax\\Fax', $this->getFaxId());
        $this->peeringContract = $transformer->transform('Ivoz\\Provider\\Domain\\Model\\PeeringContract\\PeeringContract', $this->getPeeringContractId());
        $this->country = $transformer->transform('Ivoz\\Provider\\Domain\\Model\\Country\\Country', $this->getCountryId());
        $this->retailAccount = $transformer->transform('Ivoz\\Provider\\Domain\\Model\\RetailAccount\\RetailAccount', $this->getRetailAccountId());
        $this->conditionalRoute = $transformer->transform('Ivoz\\Provider\\Domain\\Model\\ConditionalRoute\\ConditionalRoute', $this->getConditionalRouteId());
    }

    /**
     * {@inheritDoc}
     */
    public function transformCollections(CollectionTransformerInterface $transformer)
    {

    }

    /**
     * @param string $ddi
     *
     * @return DdiDTO
     */
    public function setDdi($ddi)
    {
        $this->ddi = $ddi;

        return $this;
    }

    /**
     * @return string
     */
    public function getDdi()
    {
        return $this->ddi;
    }

    /**
     * @param string $ddie164
     *
     * @return DdiDTO
     */
    public function setDdie164($ddie164 = null)
    {
        $this->ddie164 = $ddie164;

        return $this;
    }

    /**
     * @return string
     */
    public function getDdie164()
    {
        return $this->ddie164;
    }

    /**
     * @param string $recordCalls
     *
     * @return DdiDTO
     */
    public function setRecordCalls($recordCalls)
    {
        $this->recordCalls = $recordCalls;

        return $this;
    }

    /**
     * @return string
     */
    public function getRecordCalls()
    {
        return $this->recordCalls;
    }

    /**
     * @param string $displayName
     *
     * @return DdiDTO
     */
    public function setDisplayName($displayName = null)
    {
        $this->displayName = $displayName;

        return $this;
    }

    /**
     * @return string
     */
    public function getDisplayName()
    {
        return $this->displayName;
    }

    /**
     * @param string $routeType
     *
     * @return DdiDTO
     */
    public function setRouteType($routeType = null)
    {
        $this->routeType = $routeType;

        return $this;
    }

    /**
     * @return string
     */
    public function getRouteType()
    {
        return $this->routeType;
    }

    /**
     * @param boolean $billInboundCalls
     *
     * @return DdiDTO
     */
    public function setBillInboundCalls($billInboundCalls)
    {
        $this->billInboundCalls = $billInboundCalls;

        return $this;
    }

    /**
     * @return boolean
     */
    public function getBillInboundCalls()
    {
        return $this->billInboundCalls;
    }

    /**
     * @param string $friendValue
     *
     * @return DdiDTO
     */
    public function setFriendValue($friendValue = null)
    {
        $this->friendValue = $friendValue;

        return $this;
    }

    /**
     * @return string
     */
    public function getFriendValue()
    {
        return $this->friendValue;
    }

    /**
     * @param integer $id
     *
     * @return DdiDTO
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
     * @return DdiDTO
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
     * @param integer $brandId
     *
     * @return DdiDTO
     */
    public function setBrandId($brandId)
    {
        $this->brandId = $brandId;

        return $this;
    }

    /**
     * @return integer
     */
    public function getBrandId()
    {
        return $this->brandId;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\Brand\Brand
     */
    public function getBrand()
    {
        return $this->brand;
    }

    /**
     * @param integer $conferenceRoomId
     *
     * @return DdiDTO
     */
    public function setConferenceRoomId($conferenceRoomId)
    {
        $this->conferenceRoomId = $conferenceRoomId;

        return $this;
    }

    /**
     * @return integer
     */
    public function getConferenceRoomId()
    {
        return $this->conferenceRoomId;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\ConferenceRoom\ConferenceRoom
     */
    public function getConferenceRoom()
    {
        return $this->conferenceRoom;
    }

    /**
     * @param integer $languageId
     *
     * @return DdiDTO
     */
    public function setLanguageId($languageId)
    {
        $this->languageId = $languageId;

        return $this;
    }

    /**
     * @return integer
     */
    public function getLanguageId()
    {
        return $this->languageId;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\Language\Language
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * @param integer $queueId
     *
     * @return DdiDTO
     */
    public function setQueueId($queueId)
    {
        $this->queueId = $queueId;

        return $this;
    }

    /**
     * @return integer
     */
    public function getQueueId()
    {
        return $this->queueId;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\Queue\Queue
     */
    public function getQueue()
    {
        return $this->queue;
    }

    /**
     * @param integer $externalCallFilterId
     *
     * @return DdiDTO
     */
    public function setExternalCallFilterId($externalCallFilterId)
    {
        $this->externalCallFilterId = $externalCallFilterId;

        return $this;
    }

    /**
     * @return integer
     */
    public function getExternalCallFilterId()
    {
        return $this->externalCallFilterId;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\ExternalCallFilter\ExternalCallFilter
     */
    public function getExternalCallFilter()
    {
        return $this->externalCallFilter;
    }

    /**
     * @param integer $userId
     *
     * @return DdiDTO
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;

        return $this;
    }

    /**
     * @return integer
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\User\User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param integer $ivrId
     *
     * @return DdiDTO
     */
    public function setIvrId($ivrId)
    {
        $this->ivrId = $ivrId;

        return $this;
    }

    /**
     * @return integer
     */
    public function getIvrId()
    {
        return $this->ivrId;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\Ivr\Ivr
     */
    public function getIvr()
    {
        return $this->ivr;
    }

    /**
     * @param integer $huntGroupId
     *
     * @return DdiDTO
     */
    public function setHuntGroupId($huntGroupId)
    {
        $this->huntGroupId = $huntGroupId;

        return $this;
    }

    /**
     * @return integer
     */
    public function getHuntGroupId()
    {
        return $this->huntGroupId;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\HuntGroup\HuntGroup
     */
    public function getHuntGroup()
    {
        return $this->huntGroup;
    }

    /**
     * @param integer $faxId
     *
     * @return DdiDTO
     */
    public function setFaxId($faxId)
    {
        $this->faxId = $faxId;

        return $this;
    }

    /**
     * @return integer
     */
    public function getFaxId()
    {
        return $this->faxId;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\Fax\Fax
     */
    public function getFax()
    {
        return $this->fax;
    }

    /**
     * @param integer $peeringContractId
     *
     * @return DdiDTO
     */
    public function setPeeringContractId($peeringContractId)
    {
        $this->peeringContractId = $peeringContractId;

        return $this;
    }

    /**
     * @return integer
     */
    public function getPeeringContractId()
    {
        return $this->peeringContractId;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\PeeringContract\PeeringContract
     */
    public function getPeeringContract()
    {
        return $this->peeringContract;
    }

    /**
     * @param integer $countryId
     *
     * @return DdiDTO
     */
    public function setCountryId($countryId)
    {
        $this->countryId = $countryId;

        return $this;
    }

    /**
     * @return integer
     */
    public function getCountryId()
    {
        return $this->countryId;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\Country\Country
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * @param integer $retailAccountId
     *
     * @return DdiDTO
     */
    public function setRetailAccountId($retailAccountId)
    {
        $this->retailAccountId = $retailAccountId;

        return $this;
    }

    /**
     * @return integer
     */
    public function getRetailAccountId()
    {
        return $this->retailAccountId;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\RetailAccount\RetailAccount
     */
    public function getRetailAccount()
    {
        return $this->retailAccount;
    }

    /**
     * @param integer $conditionalRouteId
     *
     * @return DdiDTO
     */
    public function setConditionalRouteId($conditionalRouteId)
    {
        $this->conditionalRouteId = $conditionalRouteId;

        return $this;
    }

    /**
     * @return integer
     */
    public function getConditionalRouteId()
    {
        return $this->conditionalRouteId;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\ConditionalRoute\ConditionalRoute
     */
    public function getConditionalRoute()
    {
        return $this->conditionalRoute;
    }
}


