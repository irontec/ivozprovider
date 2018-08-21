<?php

namespace Ivoz\Cgr\Domain\Model\TpCdr;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;

/**
 * TpCdrAbstract
 * @codeCoverageIgnore
 */
abstract class TpCdrAbstract
{
    /**
     * @var string
     */
    protected $cgrid;

    /**
     * column: run_id
     * @var string
     */
    protected $runId;

    /**
     * column: origin_host
     * @var string
     */
    protected $originHost;

    /**
     * @var string
     */
    protected $source;

    /**
     * column: origin_id
     * @var string
     */
    protected $originId;

    /**
     * @var string
     */
    protected $tor;

    /**
     * column: request_type
     * @var string
     */
    protected $requestType;

    /**
     * @var string
     */
    protected $tenant;

    /**
     * @var string
     */
    protected $category;

    /**
     * @var string
     */
    protected $account;

    /**
     * @var string
     */
    protected $subject;

    /**
     * @var string
     */
    protected $destination;

    /**
     * column: setup_time
     * @var \DateTime
     */
    protected $setupTime;

    /**
     * column: answer_time
     * @var \DateTime
     */
    protected $answerTime;

    /**
     * @var integer
     */
    protected $usage;

    /**
     * column: extra_fields
     * @var string
     */
    protected $extraFields;

    /**
     * column: cost_source
     * @var string
     */
    protected $costSource;

    /**
     * @var string
     */
    protected $cost;

    /**
     * column: cost_details
     * @var array
     */
    protected $costDetails;

    /**
     * column: extra_info
     * @var string
     */
    protected $extraInfo;

    /**
     * column: created_at
     * @var \DateTime
     */
    protected $createdAt;

    /**
     * column: updated_at
     * @var \DateTime
     */
    protected $updatedAt;

    /**
     * column: deleted_at
     * @var \DateTime
     */
    protected $deletedAt;


    use ChangelogTrait;

    /**
     * Constructor
     */
    protected function __construct(
        $cgrid,
        $runId,
        $originHost,
        $source,
        $originId,
        $tor,
        $requestType,
        $tenant,
        $category,
        $account,
        $subject,
        $destination,
        $setupTime,
        $answerTime,
        $usage,
        $extraFields,
        $costSource,
        $cost,
        $costDetails,
        $extraInfo
    ) {
        $this->setCgrid($cgrid);
        $this->setRunId($runId);
        $this->setOriginHost($originHost);
        $this->setSource($source);
        $this->setOriginId($originId);
        $this->setTor($tor);
        $this->setRequestType($requestType);
        $this->setTenant($tenant);
        $this->setCategory($category);
        $this->setAccount($account);
        $this->setSubject($subject);
        $this->setDestination($destination);
        $this->setSetupTime($setupTime);
        $this->setAnswerTime($answerTime);
        $this->setUsage($usage);
        $this->setExtraFields($extraFields);
        $this->setCostSource($costSource);
        $this->setCost($cost);
        $this->setCostDetails($costDetails);
        $this->setExtraInfo($extraInfo);
    }

    abstract public function getId();

    public function __toString()
    {
        return sprintf("%s#%s",
            "TpCdr",
            $this->getId()
        );
    }

    /**
     * @return void
     * @throws \Exception
     */
    protected function sanitizeValues()
    {
    }

    /**
     * @param null $id
     * @return TpCdrDto
     */
    public static function createDto($id = null)
    {
        return new TpCdrDto($id);
    }

    /**
     * @param EntityInterface|null $entity
     * @param int $depth
     * @return TpCdrDto|null
     */
    public static function entityToDto(EntityInterface $entity = null, $depth = 0)
    {
        if (!$entity) {
            return null;
        }

        Assertion::isInstanceOf($entity, TpCdrInterface::class);

        if ($depth < 1) {
            return static::createDto($entity->getId());
        }

        if ($entity instanceof \Doctrine\ORM\Proxy\Proxy && !$entity->__isInitialized()) {
            return static::createDto($entity->getId());
        }

        return $entity->toDto($depth-1);
    }

    /**
     * Factory method
     * @param DataTransferObjectInterface $dto
     * @return self
     */
    public static function fromDto(DataTransferObjectInterface $dto)
    {
        /**
         * @var $dto TpCdrDto
         */
        Assertion::isInstanceOf($dto, TpCdrDto::class);

        $self = new static(
            $dto->getCgrid(),
            $dto->getRunId(),
            $dto->getOriginHost(),
            $dto->getSource(),
            $dto->getOriginId(),
            $dto->getTor(),
            $dto->getRequestType(),
            $dto->getTenant(),
            $dto->getCategory(),
            $dto->getAccount(),
            $dto->getSubject(),
            $dto->getDestination(),
            $dto->getSetupTime(),
            $dto->getAnswerTime(),
            $dto->getUsage(),
            $dto->getExtraFields(),
            $dto->getCostSource(),
            $dto->getCost(),
            $dto->getCostDetails(),
            $dto->getExtraInfo());

        $self
            ->setCreatedAt($dto->getCreatedAt())
            ->setUpdatedAt($dto->getUpdatedAt())
            ->setDeletedAt($dto->getDeletedAt())
        ;

        $self->sanitizeValues();
        $self->initChangelog();

        return $self;
    }

    /**
     * @param DataTransferObjectInterface $dto
     * @return self
     */
    public function updateFromDto(DataTransferObjectInterface $dto)
    {
        /**
         * @var $dto TpCdrDto
         */
        Assertion::isInstanceOf($dto, TpCdrDto::class);

        $this
            ->setCgrid($dto->getCgrid())
            ->setRunId($dto->getRunId())
            ->setOriginHost($dto->getOriginHost())
            ->setSource($dto->getSource())
            ->setOriginId($dto->getOriginId())
            ->setTor($dto->getTor())
            ->setRequestType($dto->getRequestType())
            ->setTenant($dto->getTenant())
            ->setCategory($dto->getCategory())
            ->setAccount($dto->getAccount())
            ->setSubject($dto->getSubject())
            ->setDestination($dto->getDestination())
            ->setSetupTime($dto->getSetupTime())
            ->setAnswerTime($dto->getAnswerTime())
            ->setUsage($dto->getUsage())
            ->setExtraFields($dto->getExtraFields())
            ->setCostSource($dto->getCostSource())
            ->setCost($dto->getCost())
            ->setCostDetails($dto->getCostDetails())
            ->setExtraInfo($dto->getExtraInfo())
            ->setCreatedAt($dto->getCreatedAt())
            ->setUpdatedAt($dto->getUpdatedAt())
            ->setDeletedAt($dto->getDeletedAt());



        $this->sanitizeValues();
        return $this;
    }

    /**
     * @param int $depth
     * @return TpCdrDto
     */
    public function toDto($depth = 0)
    {
        return self::createDto()
            ->setCgrid(self::getCgrid())
            ->setRunId(self::getRunId())
            ->setOriginHost(self::getOriginHost())
            ->setSource(self::getSource())
            ->setOriginId(self::getOriginId())
            ->setTor(self::getTor())
            ->setRequestType(self::getRequestType())
            ->setTenant(self::getTenant())
            ->setCategory(self::getCategory())
            ->setAccount(self::getAccount())
            ->setSubject(self::getSubject())
            ->setDestination(self::getDestination())
            ->setSetupTime(self::getSetupTime())
            ->setAnswerTime(self::getAnswerTime())
            ->setUsage(self::getUsage())
            ->setExtraFields(self::getExtraFields())
            ->setCostSource(self::getCostSource())
            ->setCost(self::getCost())
            ->setCostDetails(self::getCostDetails())
            ->setExtraInfo(self::getExtraInfo())
            ->setCreatedAt(self::getCreatedAt())
            ->setUpdatedAt(self::getUpdatedAt())
            ->setDeletedAt(self::getDeletedAt());
    }

    /**
     * @return array
     */
    protected function __toArray()
    {
        return [
            'cgrid' => self::getCgrid(),
            'run_id' => self::getRunId(),
            'origin_host' => self::getOriginHost(),
            'source' => self::getSource(),
            'origin_id' => self::getOriginId(),
            'tor' => self::getTor(),
            'request_type' => self::getRequestType(),
            'tenant' => self::getTenant(),
            'category' => self::getCategory(),
            'account' => self::getAccount(),
            'subject' => self::getSubject(),
            'destination' => self::getDestination(),
            'setup_time' => self::getSetupTime(),
            'answer_time' => self::getAnswerTime(),
            'usage' => self::getUsage(),
            'extra_fields' => self::getExtraFields(),
            'cost_source' => self::getCostSource(),
            'cost' => self::getCost(),
            'cost_details' => self::getCostDetails(),
            'extra_info' => self::getExtraInfo(),
            'created_at' => self::getCreatedAt(),
            'updated_at' => self::getUpdatedAt(),
            'deleted_at' => self::getDeletedAt()
        ];
    }


    // @codeCoverageIgnoreStart

    /**
     * @deprecated
     * Set cgrid
     *
     * @param string $cgrid
     *
     * @return self
     */
    public function setCgrid($cgrid)
    {
        Assertion::notNull($cgrid, 'cgrid value "%s" is null, but non null value was expected.');
        Assertion::maxLength($cgrid, 40, 'cgrid value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->cgrid = $cgrid;

        return $this;
    }

    /**
     * Get cgrid
     *
     * @return string
     */
    public function getCgrid()
    {
        return $this->cgrid;
    }

    /**
     * @deprecated
     * Set runId
     *
     * @param string $runId
     *
     * @return self
     */
    public function setRunId($runId)
    {
        Assertion::notNull($runId, 'runId value "%s" is null, but non null value was expected.');
        Assertion::maxLength($runId, 64, 'runId value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->runId = $runId;

        return $this;
    }

    /**
     * Get runId
     *
     * @return string
     */
    public function getRunId()
    {
        return $this->runId;
    }

    /**
     * @deprecated
     * Set originHost
     *
     * @param string $originHost
     *
     * @return self
     */
    public function setOriginHost($originHost)
    {
        Assertion::notNull($originHost, 'originHost value "%s" is null, but non null value was expected.');
        Assertion::maxLength($originHost, 64, 'originHost value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->originHost = $originHost;

        return $this;
    }

    /**
     * Get originHost
     *
     * @return string
     */
    public function getOriginHost()
    {
        return $this->originHost;
    }

    /**
     * @deprecated
     * Set source
     *
     * @param string $source
     *
     * @return self
     */
    public function setSource($source)
    {
        Assertion::notNull($source, 'source value "%s" is null, but non null value was expected.');
        Assertion::maxLength($source, 64, 'source value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->source = $source;

        return $this;
    }

    /**
     * Get source
     *
     * @return string
     */
    public function getSource()
    {
        return $this->source;
    }

    /**
     * @deprecated
     * Set originId
     *
     * @param string $originId
     *
     * @return self
     */
    public function setOriginId($originId)
    {
        Assertion::notNull($originId, 'originId value "%s" is null, but non null value was expected.');
        Assertion::maxLength($originId, 128, 'originId value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->originId = $originId;

        return $this;
    }

    /**
     * Get originId
     *
     * @return string
     */
    public function getOriginId()
    {
        return $this->originId;
    }

    /**
     * @deprecated
     * Set tor
     *
     * @param string $tor
     *
     * @return self
     */
    public function setTor($tor)
    {
        Assertion::notNull($tor, 'tor value "%s" is null, but non null value was expected.');
        Assertion::maxLength($tor, 16, 'tor value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->tor = $tor;

        return $this;
    }

    /**
     * Get tor
     *
     * @return string
     */
    public function getTor()
    {
        return $this->tor;
    }

    /**
     * @deprecated
     * Set requestType
     *
     * @param string $requestType
     *
     * @return self
     */
    public function setRequestType($requestType)
    {
        Assertion::notNull($requestType, 'requestType value "%s" is null, but non null value was expected.');
        Assertion::maxLength($requestType, 24, 'requestType value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->requestType = $requestType;

        return $this;
    }

    /**
     * Get requestType
     *
     * @return string
     */
    public function getRequestType()
    {
        return $this->requestType;
    }

    /**
     * @deprecated
     * Set tenant
     *
     * @param string $tenant
     *
     * @return self
     */
    public function setTenant($tenant)
    {
        Assertion::notNull($tenant, 'tenant value "%s" is null, but non null value was expected.');
        Assertion::maxLength($tenant, 64, 'tenant value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->tenant = $tenant;

        return $this;
    }

    /**
     * Get tenant
     *
     * @return string
     */
    public function getTenant()
    {
        return $this->tenant;
    }

    /**
     * @deprecated
     * Set category
     *
     * @param string $category
     *
     * @return self
     */
    public function setCategory($category)
    {
        Assertion::notNull($category, 'category value "%s" is null, but non null value was expected.');
        Assertion::maxLength($category, 32, 'category value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return string
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * @deprecated
     * Set account
     *
     * @param string $account
     *
     * @return self
     */
    public function setAccount($account)
    {
        Assertion::notNull($account, 'account value "%s" is null, but non null value was expected.');
        Assertion::maxLength($account, 128, 'account value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->account = $account;

        return $this;
    }

    /**
     * Get account
     *
     * @return string
     */
    public function getAccount()
    {
        return $this->account;
    }

    /**
     * @deprecated
     * Set subject
     *
     * @param string $subject
     *
     * @return self
     */
    public function setSubject($subject)
    {
        Assertion::notNull($subject, 'subject value "%s" is null, but non null value was expected.');
        Assertion::maxLength($subject, 128, 'subject value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->subject = $subject;

        return $this;
    }

    /**
     * Get subject
     *
     * @return string
     */
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * @deprecated
     * Set destination
     *
     * @param string $destination
     *
     * @return self
     */
    public function setDestination($destination)
    {
        Assertion::notNull($destination, 'destination value "%s" is null, but non null value was expected.');
        Assertion::maxLength($destination, 128, 'destination value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->destination = $destination;

        return $this;
    }

    /**
     * Get destination
     *
     * @return string
     */
    public function getDestination()
    {
        return $this->destination;
    }

    /**
     * @deprecated
     * Set setupTime
     *
     * @param \DateTime $setupTime
     *
     * @return self
     */
    public function setSetupTime($setupTime)
    {
        Assertion::notNull($setupTime, 'setupTime value "%s" is null, but non null value was expected.');
        $setupTime = \Ivoz\Core\Domain\Model\Helper\DateTimeHelper::createOrFix(
            $setupTime,
            null
        );

        $this->setupTime = $setupTime;

        return $this;
    }

    /**
     * Get setupTime
     *
     * @return \DateTime
     */
    public function getSetupTime()
    {
        return $this->setupTime;
    }

    /**
     * @deprecated
     * Set answerTime
     *
     * @param \DateTime $answerTime
     *
     * @return self
     */
    public function setAnswerTime($answerTime)
    {
        Assertion::notNull($answerTime, 'answerTime value "%s" is null, but non null value was expected.');
        $answerTime = \Ivoz\Core\Domain\Model\Helper\DateTimeHelper::createOrFix(
            $answerTime,
            null
        );

        $this->answerTime = $answerTime;

        return $this;
    }

    /**
     * Get answerTime
     *
     * @return \DateTime
     */
    public function getAnswerTime()
    {
        return $this->answerTime;
    }

    /**
     * @deprecated
     * Set usage
     *
     * @param integer $usage
     *
     * @return self
     */
    public function setUsage($usage)
    {
        Assertion::notNull($usage, 'usage value "%s" is null, but non null value was expected.');
        Assertion::integerish($usage, 'usage value "%s" is not an integer or a number castable to integer.');

        $this->usage = $usage;

        return $this;
    }

    /**
     * Get usage
     *
     * @return integer
     */
    public function getUsage()
    {
        return $this->usage;
    }

    /**
     * @deprecated
     * Set extraFields
     *
     * @param string $extraFields
     *
     * @return self
     */
    public function setExtraFields($extraFields)
    {
        Assertion::notNull($extraFields, 'extraFields value "%s" is null, but non null value was expected.');

        $this->extraFields = $extraFields;

        return $this;
    }

    /**
     * Get extraFields
     *
     * @return string
     */
    public function getExtraFields()
    {
        return $this->extraFields;
    }

    /**
     * @deprecated
     * Set costSource
     *
     * @param string $costSource
     *
     * @return self
     */
    public function setCostSource($costSource)
    {
        Assertion::notNull($costSource, 'costSource value "%s" is null, but non null value was expected.');
        Assertion::maxLength($costSource, 64, 'costSource value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->costSource = $costSource;

        return $this;
    }

    /**
     * Get costSource
     *
     * @return string
     */
    public function getCostSource()
    {
        return $this->costSource;
    }

    /**
     * @deprecated
     * Set cost
     *
     * @param string $cost
     *
     * @return self
     */
    public function setCost($cost)
    {
        Assertion::notNull($cost, 'cost value "%s" is null, but non null value was expected.');
        Assertion::numeric($cost);
        $cost = (float) $cost;

        $this->cost = $cost;

        return $this;
    }

    /**
     * Get cost
     *
     * @return string
     */
    public function getCost()
    {
        return $this->cost;
    }

    /**
     * @deprecated
     * Set costDetails
     *
     * @param array $costDetails
     *
     * @return self
     */
    public function setCostDetails($costDetails)
    {
        Assertion::notNull($costDetails, 'costDetails value "%s" is null, but non null value was expected.');

        $this->costDetails = $costDetails;

        return $this;
    }

    /**
     * Get costDetails
     *
     * @return array
     */
    public function getCostDetails()
    {
        return $this->costDetails;
    }

    /**
     * @deprecated
     * Set extraInfo
     *
     * @param string $extraInfo
     *
     * @return self
     */
    public function setExtraInfo($extraInfo)
    {
        Assertion::notNull($extraInfo, 'extraInfo value "%s" is null, but non null value was expected.');

        $this->extraInfo = $extraInfo;

        return $this;
    }

    /**
     * Get extraInfo
     *
     * @return string
     */
    public function getExtraInfo()
    {
        return $this->extraInfo;
    }

    /**
     * @deprecated
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return self
     */
    public function setCreatedAt($createdAt = null)
    {
        if (!is_null($createdAt)) {
        $createdAt = \Ivoz\Core\Domain\Model\Helper\DateTimeHelper::createOrFix(
            $createdAt,
            NULL
        );
        }

        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @deprecated
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     *
     * @return self
     */
    public function setUpdatedAt($updatedAt = null)
    {
        if (!is_null($updatedAt)) {
        $updatedAt = \Ivoz\Core\Domain\Model\Helper\DateTimeHelper::createOrFix(
            $updatedAt,
            NULL
        );
        }

        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * @deprecated
     * Set deletedAt
     *
     * @param \DateTime $deletedAt
     *
     * @return self
     */
    public function setDeletedAt($deletedAt = null)
    {
        if (!is_null($deletedAt)) {
        $deletedAt = \Ivoz\Core\Domain\Model\Helper\DateTimeHelper::createOrFix(
            $deletedAt,
            NULL
        );
        }

        $this->deletedAt = $deletedAt;

        return $this;
    }

    /**
     * Get deletedAt
     *
     * @return \DateTime
     */
    public function getDeletedAt()
    {
        return $this->deletedAt;
    }



    // @codeCoverageIgnoreEnd
}

