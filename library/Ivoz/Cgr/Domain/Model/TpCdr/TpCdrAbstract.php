<?php
declare(strict_types = 1);

namespace Ivoz\Cgr\Domain\Model\TpCdr;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;
use \Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Core\Domain\Model\Helper\DateTimeHelper;

/**
* TpCdrAbstract
* @codeCoverageIgnore
*/
abstract class TpCdrAbstract
{
    use ChangelogTrait;

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
     * @var \DateTimeInterface
     */
    protected $setupTime;

    /**
     * column: answer_time
     * @var \DateTimeInterface
     */
    protected $answerTime;

    /**
     * @var int
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
     * @var float
     */
    protected $cost;

    /**
     * column: cost_details
     * @var array
     */
    protected $costDetails = [];

    /**
     * column: extra_info
     * @var string
     */
    protected $extraInfo;

    /**
     * column: created_at
     * @var \DateTimeInterface | null
     */
    protected $createdAt;

    /**
     * column: updated_at
     * @var \DateTimeInterface | null
     */
    protected $updatedAt;

    /**
     * column: deleted_at
     * @var \DateTimeInterface | null
     */
    protected $deletedAt;

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
        return sprintf(
            "%s#%s",
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
     * @internal use EntityTools instead
     * @param TpCdrInterface|null $entity
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

        /** @var TpCdrDto $dto */
        $dto = $entity->toDto($depth-1);

        return $dto;
    }

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param TpCdrDto $dto
     * @return self
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ) {
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
            $dto->getExtraInfo()
        );

        $self
            ->setCreatedAt($dto->getCreatedAt())
            ->setUpdatedAt($dto->getUpdatedAt())
            ->setDeletedAt($dto->getDeletedAt());

        $self->initChangelog();

        return $self;
    }

    /**
     * @internal use EntityTools instead
     * @param TpCdrDto $dto
     * @return self
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ) {
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

        return $this;
    }

    /**
     * @internal use EntityTools instead
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

    /**
     * Set cgrid
     *
     * @param string $cgrid
     *
     * @return static
     */
    protected function setCgrid(string $cgrid): TpCdrInterface
    {
        Assertion::maxLength($cgrid, 40, 'cgrid value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->cgrid = $cgrid;

        return $this;
    }

    /**
     * Get cgrid
     *
     * @return string
     */
    public function getCgrid(): string
    {
        return $this->cgrid;
    }

    /**
     * Set runId
     *
     * @param string $runId
     *
     * @return static
     */
    protected function setRunId(string $runId): TpCdrInterface
    {
        Assertion::maxLength($runId, 64, 'runId value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->runId = $runId;

        return $this;
    }

    /**
     * Get runId
     *
     * @return string
     */
    public function getRunId(): string
    {
        return $this->runId;
    }

    /**
     * Set originHost
     *
     * @param string $originHost
     *
     * @return static
     */
    protected function setOriginHost(string $originHost): TpCdrInterface
    {
        Assertion::maxLength($originHost, 64, 'originHost value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->originHost = $originHost;

        return $this;
    }

    /**
     * Get originHost
     *
     * @return string
     */
    public function getOriginHost(): string
    {
        return $this->originHost;
    }

    /**
     * Set source
     *
     * @param string $source
     *
     * @return static
     */
    protected function setSource(string $source): TpCdrInterface
    {
        Assertion::maxLength($source, 64, 'source value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->source = $source;

        return $this;
    }

    /**
     * Get source
     *
     * @return string
     */
    public function getSource(): string
    {
        return $this->source;
    }

    /**
     * Set originId
     *
     * @param string $originId
     *
     * @return static
     */
    protected function setOriginId(string $originId): TpCdrInterface
    {
        Assertion::maxLength($originId, 128, 'originId value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->originId = $originId;

        return $this;
    }

    /**
     * Get originId
     *
     * @return string
     */
    public function getOriginId(): string
    {
        return $this->originId;
    }

    /**
     * Set tor
     *
     * @param string $tor
     *
     * @return static
     */
    protected function setTor(string $tor): TpCdrInterface
    {
        Assertion::maxLength($tor, 16, 'tor value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->tor = $tor;

        return $this;
    }

    /**
     * Get tor
     *
     * @return string
     */
    public function getTor(): string
    {
        return $this->tor;
    }

    /**
     * Set requestType
     *
     * @param string $requestType
     *
     * @return static
     */
    protected function setRequestType(string $requestType): TpCdrInterface
    {
        Assertion::maxLength($requestType, 24, 'requestType value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->requestType = $requestType;

        return $this;
    }

    /**
     * Get requestType
     *
     * @return string
     */
    public function getRequestType(): string
    {
        return $this->requestType;
    }

    /**
     * Set tenant
     *
     * @param string $tenant
     *
     * @return static
     */
    protected function setTenant(string $tenant): TpCdrInterface
    {
        Assertion::maxLength($tenant, 64, 'tenant value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->tenant = $tenant;

        return $this;
    }

    /**
     * Get tenant
     *
     * @return string
     */
    public function getTenant(): string
    {
        return $this->tenant;
    }

    /**
     * Set category
     *
     * @param string $category
     *
     * @return static
     */
    protected function setCategory(string $category): TpCdrInterface
    {
        Assertion::maxLength($category, 32, 'category value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return string
     */
    public function getCategory(): string
    {
        return $this->category;
    }

    /**
     * Set account
     *
     * @param string $account
     *
     * @return static
     */
    protected function setAccount(string $account): TpCdrInterface
    {
        Assertion::maxLength($account, 128, 'account value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->account = $account;

        return $this;
    }

    /**
     * Get account
     *
     * @return string
     */
    public function getAccount(): string
    {
        return $this->account;
    }

    /**
     * Set subject
     *
     * @param string $subject
     *
     * @return static
     */
    protected function setSubject(string $subject): TpCdrInterface
    {
        Assertion::maxLength($subject, 128, 'subject value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->subject = $subject;

        return $this;
    }

    /**
     * Get subject
     *
     * @return string
     */
    public function getSubject(): string
    {
        return $this->subject;
    }

    /**
     * Set destination
     *
     * @param string $destination
     *
     * @return static
     */
    protected function setDestination(string $destination): TpCdrInterface
    {
        Assertion::maxLength($destination, 128, 'destination value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->destination = $destination;

        return $this;
    }

    /**
     * Get destination
     *
     * @return string
     */
    public function getDestination(): string
    {
        return $this->destination;
    }

    /**
     * Set setupTime
     *
     * @param \DateTimeInterface $setupTime
     *
     * @return static
     */
    protected function setSetupTime($setupTime): TpCdrInterface
    {

        $setupTime = DateTimeHelper::createOrFix(
            $setupTime,
            null
        );

        if ($this->setupTime == $setupTime) {
            return $this;
        }

        $this->setupTime = $setupTime;

        return $this;
    }

    /**
     * Get setupTime
     *
     * @return \DateTimeInterface
     */
    public function getSetupTime(): \DateTimeInterface
    {
        return clone $this->setupTime;
    }

    /**
     * Set answerTime
     *
     * @param \DateTimeInterface $answerTime
     *
     * @return static
     */
    protected function setAnswerTime($answerTime): TpCdrInterface
    {

        $answerTime = DateTimeHelper::createOrFix(
            $answerTime,
            null
        );

        if ($this->answerTime == $answerTime) {
            return $this;
        }

        $this->answerTime = $answerTime;

        return $this;
    }

    /**
     * Get answerTime
     *
     * @return \DateTimeInterface
     */
    public function getAnswerTime(): \DateTimeInterface
    {
        return clone $this->answerTime;
    }

    /**
     * Set usage
     *
     * @param int $usage
     *
     * @return static
     */
    protected function setUsage(int $usage): TpCdrInterface
    {
        $this->usage = $usage;

        return $this;
    }

    /**
     * Get usage
     *
     * @return int
     */
    public function getUsage(): int
    {
        return $this->usage;
    }

    /**
     * Set extraFields
     *
     * @param string $extraFields
     *
     * @return static
     */
    protected function setExtraFields(string $extraFields): TpCdrInterface
    {
        $this->extraFields = $extraFields;

        return $this;
    }

    /**
     * Get extraFields
     *
     * @return string
     */
    public function getExtraFields(): string
    {
        return $this->extraFields;
    }

    /**
     * Set costSource
     *
     * @param string $costSource
     *
     * @return static
     */
    protected function setCostSource(string $costSource): TpCdrInterface
    {
        Assertion::maxLength($costSource, 64, 'costSource value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->costSource = $costSource;

        return $this;
    }

    /**
     * Get costSource
     *
     * @return string
     */
    public function getCostSource(): string
    {
        return $this->costSource;
    }

    /**
     * Set cost
     *
     * @param float $cost
     *
     * @return static
     */
    protected function setCost(float $cost): TpCdrInterface
    {
        $this->cost = $cost;

        return $this;
    }

    /**
     * Get cost
     *
     * @return float
     */
    public function getCost(): float
    {
        return $this->cost;
    }

    /**
     * Set costDetails
     *
     * @param array $costDetails
     *
     * @return static
     */
    protected function setCostDetails(array $costDetails): TpCdrInterface
    {
        $this->costDetails = $costDetails;

        return $this;
    }

    /**
     * Get costDetails
     *
     * @return array
     */
    public function getCostDetails(): array
    {
        return $this->costDetails;
    }

    /**
     * Set extraInfo
     *
     * @param string $extraInfo
     *
     * @return static
     */
    protected function setExtraInfo(string $extraInfo): TpCdrInterface
    {
        $this->extraInfo = $extraInfo;

        return $this;
    }

    /**
     * Get extraInfo
     *
     * @return string
     */
    public function getExtraInfo(): string
    {
        return $this->extraInfo;
    }

    /**
     * Set createdAt
     *
     * @param \DateTimeInterface $createdAt | null
     *
     * @return static
     */
    protected function setCreatedAt($createdAt = null): TpCdrInterface
    {
        if (!is_null($createdAt)) {
            Assertion::notNull(
                $createdAt,
                'createdAt value "%s" is null, but non null value was expected.'
            );
            $createdAt = DateTimeHelper::createOrFix(
                $createdAt,
                null
            );

            if ($this->createdAt == $createdAt) {
                return $this;
            }
        }

        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTimeInterface | null
     */
    public function getCreatedAt(): ?\DateTimeInterface
    {
        return !is_null($this->createdAt) ? clone $this->createdAt : null;
    }

    /**
     * Set updatedAt
     *
     * @param \DateTimeInterface $updatedAt | null
     *
     * @return static
     */
    protected function setUpdatedAt($updatedAt = null): TpCdrInterface
    {
        if (!is_null($updatedAt)) {
            Assertion::notNull(
                $updatedAt,
                'updatedAt value "%s" is null, but non null value was expected.'
            );
            $updatedAt = DateTimeHelper::createOrFix(
                $updatedAt,
                null
            );

            if ($this->updatedAt == $updatedAt) {
                return $this;
            }
        }

        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTimeInterface | null
     */
    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return !is_null($this->updatedAt) ? clone $this->updatedAt : null;
    }

    /**
     * Set deletedAt
     *
     * @param \DateTimeInterface $deletedAt | null
     *
     * @return static
     */
    protected function setDeletedAt($deletedAt = null): TpCdrInterface
    {
        if (!is_null($deletedAt)) {
            Assertion::notNull(
                $deletedAt,
                'deletedAt value "%s" is null, but non null value was expected.'
            );
            $deletedAt = DateTimeHelper::createOrFix(
                $deletedAt,
                null
            );

            if ($this->deletedAt == $deletedAt) {
                return $this;
            }
        }

        $this->deletedAt = $deletedAt;

        return $this;
    }

    /**
     * Get deletedAt
     *
     * @return \DateTimeInterface | null
     */
    public function getDeletedAt(): ?\DateTimeInterface
    {
        return !is_null($this->deletedAt) ? clone $this->deletedAt : null;
    }

}
