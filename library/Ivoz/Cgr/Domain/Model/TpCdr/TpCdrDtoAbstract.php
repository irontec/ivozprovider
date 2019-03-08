<?php

namespace Ivoz\Cgr\Domain\Model\TpCdr;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\Model\DtoNormalizer;

/**
 * @codeCoverageIgnore
 */
abstract class TpCdrDtoAbstract implements DataTransferObjectInterface
{
    /**
     * @var string
     */
    private $cgrid;

    /**
     * @var string
     */
    private $runId;

    /**
     * @var string
     */
    private $originHost;

    /**
     * @var string
     */
    private $source;

    /**
     * @var string
     */
    private $originId;

    /**
     * @var string
     */
    private $tor;

    /**
     * @var string
     */
    private $requestType;

    /**
     * @var string
     */
    private $tenant;

    /**
     * @var string
     */
    private $category;

    /**
     * @var string
     */
    private $account;

    /**
     * @var string
     */
    private $subject;

    /**
     * @var string
     */
    private $destination;

    /**
     * @var \DateTime
     */
    private $setupTime;

    /**
     * @var \DateTime
     */
    private $answerTime;

    /**
     * @var integer
     */
    private $usage;

    /**
     * @var string
     */
    private $extraFields;

    /**
     * @var string
     */
    private $costSource;

    /**
     * @var float
     */
    private $cost;

    /**
     * @var array
     */
    private $costDetails;

    /**
     * @var string
     */
    private $extraInfo;

    /**
     * @var \DateTime
     */
    private $createdAt;

    /**
     * @var \DateTime
     */
    private $updatedAt;

    /**
     * @var \DateTime
     */
    private $deletedAt;

    /**
     * @var integer
     */
    private $id;


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
            'cgrid' => 'cgrid',
            'runId' => 'runId',
            'originHost' => 'originHost',
            'source' => 'source',
            'originId' => 'originId',
            'tor' => 'tor',
            'requestType' => 'requestType',
            'tenant' => 'tenant',
            'category' => 'category',
            'account' => 'account',
            'subject' => 'subject',
            'destination' => 'destination',
            'setupTime' => 'setupTime',
            'answerTime' => 'answerTime',
            'usage' => 'usage',
            'extraFields' => 'extraFields',
            'costSource' => 'costSource',
            'cost' => 'cost',
            'costDetails' => 'costDetails',
            'extraInfo' => 'extraInfo',
            'createdAt' => 'createdAt',
            'updatedAt' => 'updatedAt',
            'deletedAt' => 'deletedAt',
            'id' => 'id'
        ];
    }

    /**
     * @return array
     */
    public function toArray($hideSensitiveData = false)
    {
        return [
            'cgrid' => $this->getCgrid(),
            'runId' => $this->getRunId(),
            'originHost' => $this->getOriginHost(),
            'source' => $this->getSource(),
            'originId' => $this->getOriginId(),
            'tor' => $this->getTor(),
            'requestType' => $this->getRequestType(),
            'tenant' => $this->getTenant(),
            'category' => $this->getCategory(),
            'account' => $this->getAccount(),
            'subject' => $this->getSubject(),
            'destination' => $this->getDestination(),
            'setupTime' => $this->getSetupTime(),
            'answerTime' => $this->getAnswerTime(),
            'usage' => $this->getUsage(),
            'extraFields' => $this->getExtraFields(),
            'costSource' => $this->getCostSource(),
            'cost' => $this->getCost(),
            'costDetails' => $this->getCostDetails(),
            'extraInfo' => $this->getExtraInfo(),
            'createdAt' => $this->getCreatedAt(),
            'updatedAt' => $this->getUpdatedAt(),
            'deletedAt' => $this->getDeletedAt(),
            'id' => $this->getId()
        ];
    }

    /**
     * @param string $cgrid
     *
     * @return static
     */
    public function setCgrid($cgrid = null)
    {
        $this->cgrid = $cgrid;

        return $this;
    }

    /**
     * @return string
     */
    public function getCgrid()
    {
        return $this->cgrid;
    }

    /**
     * @param string $runId
     *
     * @return static
     */
    public function setRunId($runId = null)
    {
        $this->runId = $runId;

        return $this;
    }

    /**
     * @return string
     */
    public function getRunId()
    {
        return $this->runId;
    }

    /**
     * @param string $originHost
     *
     * @return static
     */
    public function setOriginHost($originHost = null)
    {
        $this->originHost = $originHost;

        return $this;
    }

    /**
     * @return string
     */
    public function getOriginHost()
    {
        return $this->originHost;
    }

    /**
     * @param string $source
     *
     * @return static
     */
    public function setSource($source = null)
    {
        $this->source = $source;

        return $this;
    }

    /**
     * @return string
     */
    public function getSource()
    {
        return $this->source;
    }

    /**
     * @param string $originId
     *
     * @return static
     */
    public function setOriginId($originId = null)
    {
        $this->originId = $originId;

        return $this;
    }

    /**
     * @return string
     */
    public function getOriginId()
    {
        return $this->originId;
    }

    /**
     * @param string $tor
     *
     * @return static
     */
    public function setTor($tor = null)
    {
        $this->tor = $tor;

        return $this;
    }

    /**
     * @return string
     */
    public function getTor()
    {
        return $this->tor;
    }

    /**
     * @param string $requestType
     *
     * @return static
     */
    public function setRequestType($requestType = null)
    {
        $this->requestType = $requestType;

        return $this;
    }

    /**
     * @return string
     */
    public function getRequestType()
    {
        return $this->requestType;
    }

    /**
     * @param string $tenant
     *
     * @return static
     */
    public function setTenant($tenant = null)
    {
        $this->tenant = $tenant;

        return $this;
    }

    /**
     * @return string
     */
    public function getTenant()
    {
        return $this->tenant;
    }

    /**
     * @param string $category
     *
     * @return static
     */
    public function setCategory($category = null)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * @return string
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * @param string $account
     *
     * @return static
     */
    public function setAccount($account = null)
    {
        $this->account = $account;

        return $this;
    }

    /**
     * @return string
     */
    public function getAccount()
    {
        return $this->account;
    }

    /**
     * @param string $subject
     *
     * @return static
     */
    public function setSubject($subject = null)
    {
        $this->subject = $subject;

        return $this;
    }

    /**
     * @return string
     */
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * @param string $destination
     *
     * @return static
     */
    public function setDestination($destination = null)
    {
        $this->destination = $destination;

        return $this;
    }

    /**
     * @return string
     */
    public function getDestination()
    {
        return $this->destination;
    }

    /**
     * @param \DateTime $setupTime
     *
     * @return static
     */
    public function setSetupTime($setupTime = null)
    {
        $this->setupTime = $setupTime;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getSetupTime()
    {
        return $this->setupTime;
    }

    /**
     * @param \DateTime $answerTime
     *
     * @return static
     */
    public function setAnswerTime($answerTime = null)
    {
        $this->answerTime = $answerTime;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getAnswerTime()
    {
        return $this->answerTime;
    }

    /**
     * @param integer $usage
     *
     * @return static
     */
    public function setUsage($usage = null)
    {
        $this->usage = $usage;

        return $this;
    }

    /**
     * @return integer
     */
    public function getUsage()
    {
        return $this->usage;
    }

    /**
     * @param string $extraFields
     *
     * @return static
     */
    public function setExtraFields($extraFields = null)
    {
        $this->extraFields = $extraFields;

        return $this;
    }

    /**
     * @return string
     */
    public function getExtraFields()
    {
        return $this->extraFields;
    }

    /**
     * @param string $costSource
     *
     * @return static
     */
    public function setCostSource($costSource = null)
    {
        $this->costSource = $costSource;

        return $this;
    }

    /**
     * @return string
     */
    public function getCostSource()
    {
        return $this->costSource;
    }

    /**
     * @param float $cost
     *
     * @return static
     */
    public function setCost($cost = null)
    {
        $this->cost = $cost;

        return $this;
    }

    /**
     * @return float
     */
    public function getCost()
    {
        return $this->cost;
    }

    /**
     * @param array $costDetails
     *
     * @return static
     */
    public function setCostDetails($costDetails = null)
    {
        $this->costDetails = $costDetails;

        return $this;
    }

    /**
     * @return array
     */
    public function getCostDetails()
    {
        return $this->costDetails;
    }

    /**
     * @param string $extraInfo
     *
     * @return static
     */
    public function setExtraInfo($extraInfo = null)
    {
        $this->extraInfo = $extraInfo;

        return $this;
    }

    /**
     * @return string
     */
    public function getExtraInfo()
    {
        return $this->extraInfo;
    }

    /**
     * @param \DateTime $createdAt
     *
     * @return static
     */
    public function setCreatedAt($createdAt = null)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @param \DateTime $updatedAt
     *
     * @return static
     */
    public function setUpdatedAt($updatedAt = null)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * @param \DateTime $deletedAt
     *
     * @return static
     */
    public function setDeletedAt($deletedAt = null)
    {
        $this->deletedAt = $deletedAt;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getDeletedAt()
    {
        return $this->deletedAt;
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
}
