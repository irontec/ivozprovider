<?php

declare(strict_types=1);

namespace Ivoz\Cgr\Domain\Model\TpCdr;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
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
     * @var string
     * column: run_id
     */
    protected $runId;

    /**
     * @var string
     * column: origin_host
     */
    protected $originHost;

    /**
     * @var string
     */
    protected $source;

    /**
     * @var string
     * column: origin_id
     */
    protected $originId;

    /**
     * @var string
     */
    protected $tor;

    /**
     * @var string
     * column: request_type
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
     * @var \DateTime
     * column: setup_time
     */
    protected $setupTime;

    /**
     * @var \DateTime
     * column: answer_time
     */
    protected $answerTime;

    /**
     * @var string
     */
    protected $usage;

    /**
     * @var string
     * column: extra_fields
     */
    protected $extraFields;

    /**
     * @var string
     * column: cost_source
     */
    protected $costSource;

    /**
     * @var float
     */
    protected $cost;

    /**
     * @var array
     * column: cost_details
     */
    protected $costDetails = [];

    /**
     * @var string
     * column: extra_info
     */
    protected $extraInfo;

    /**
     * @var ?\DateTime
     * column: created_at
     */
    protected $createdAt = null;

    /**
     * @var ?\DateTime
     * column: updated_at
     */
    protected $updatedAt = null;

    /**
     * @var ?\DateTime
     * column: deleted_at
     */
    protected $deletedAt = null;

    /**
     * Constructor
     */
    protected function __construct(
        string $cgrid,
        string $runId,
        string $originHost,
        string $source,
        string $originId,
        string $tor,
        string $requestType,
        string $tenant,
        string $category,
        string $account,
        string $subject,
        string $destination,
        \DateTimeInterface|string $setupTime,
        \DateTimeInterface|string $answerTime,
        string $usage,
        string $extraFields,
        string $costSource,
        float $cost,
        array $costDetails,
        string $extraInfo
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

    abstract public function getId(): null|string|int;

    public function __toString(): string
    {
        return sprintf(
            "%s#%s",
            "TpCdr",
            (string) $this->getId()
        );
    }

    /**
     * @throws \Exception
     */
    protected function sanitizeValues(): void
    {
    }

    public static function createDto(string|int|null $id = null): TpCdrDto
    {
        return new TpCdrDto($id);
    }

    /**
     * @internal use EntityTools instead
     * @param null|TpCdrInterface $entity
     */
    public static function entityToDto(?EntityInterface $entity, int $depth = 0): ?TpCdrDto
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

        $dto = $entity->toDto($depth - 1);

        return $dto;
    }

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param TpCdrDto $dto
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
        Assertion::isInstanceOf($dto, TpCdrDto::class);
        $cgrid = $dto->getCgrid();
        Assertion::notNull($cgrid, 'getCgrid value is null, but non null value was expected.');
        $runId = $dto->getRunId();
        Assertion::notNull($runId, 'getRunId value is null, but non null value was expected.');
        $originHost = $dto->getOriginHost();
        Assertion::notNull($originHost, 'getOriginHost value is null, but non null value was expected.');
        $source = $dto->getSource();
        Assertion::notNull($source, 'getSource value is null, but non null value was expected.');
        $originId = $dto->getOriginId();
        Assertion::notNull($originId, 'getOriginId value is null, but non null value was expected.');
        $tor = $dto->getTor();
        Assertion::notNull($tor, 'getTor value is null, but non null value was expected.');
        $requestType = $dto->getRequestType();
        Assertion::notNull($requestType, 'getRequestType value is null, but non null value was expected.');
        $tenant = $dto->getTenant();
        Assertion::notNull($tenant, 'getTenant value is null, but non null value was expected.');
        $category = $dto->getCategory();
        Assertion::notNull($category, 'getCategory value is null, but non null value was expected.');
        $account = $dto->getAccount();
        Assertion::notNull($account, 'getAccount value is null, but non null value was expected.');
        $subject = $dto->getSubject();
        Assertion::notNull($subject, 'getSubject value is null, but non null value was expected.');
        $destination = $dto->getDestination();
        Assertion::notNull($destination, 'getDestination value is null, but non null value was expected.');
        $setupTime = $dto->getSetupTime();
        Assertion::notNull($setupTime, 'getSetupTime value is null, but non null value was expected.');
        $answerTime = $dto->getAnswerTime();
        Assertion::notNull($answerTime, 'getAnswerTime value is null, but non null value was expected.');
        $usage = $dto->getUsage();
        Assertion::notNull($usage, 'getUsage value is null, but non null value was expected.');
        $extraFields = $dto->getExtraFields();
        Assertion::notNull($extraFields, 'getExtraFields value is null, but non null value was expected.');
        $costSource = $dto->getCostSource();
        Assertion::notNull($costSource, 'getCostSource value is null, but non null value was expected.');
        $cost = $dto->getCost();
        Assertion::notNull($cost, 'getCost value is null, but non null value was expected.');
        $costDetails = $dto->getCostDetails();
        Assertion::notNull($costDetails, 'getCostDetails value is null, but non null value was expected.');
        $extraInfo = $dto->getExtraInfo();
        Assertion::notNull($extraInfo, 'getExtraInfo value is null, but non null value was expected.');

        $self = new static(
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
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
        Assertion::isInstanceOf($dto, TpCdrDto::class);

        $cgrid = $dto->getCgrid();
        Assertion::notNull($cgrid, 'getCgrid value is null, but non null value was expected.');
        $runId = $dto->getRunId();
        Assertion::notNull($runId, 'getRunId value is null, but non null value was expected.');
        $originHost = $dto->getOriginHost();
        Assertion::notNull($originHost, 'getOriginHost value is null, but non null value was expected.');
        $source = $dto->getSource();
        Assertion::notNull($source, 'getSource value is null, but non null value was expected.');
        $originId = $dto->getOriginId();
        Assertion::notNull($originId, 'getOriginId value is null, but non null value was expected.');
        $tor = $dto->getTor();
        Assertion::notNull($tor, 'getTor value is null, but non null value was expected.');
        $requestType = $dto->getRequestType();
        Assertion::notNull($requestType, 'getRequestType value is null, but non null value was expected.');
        $tenant = $dto->getTenant();
        Assertion::notNull($tenant, 'getTenant value is null, but non null value was expected.');
        $category = $dto->getCategory();
        Assertion::notNull($category, 'getCategory value is null, but non null value was expected.');
        $account = $dto->getAccount();
        Assertion::notNull($account, 'getAccount value is null, but non null value was expected.');
        $subject = $dto->getSubject();
        Assertion::notNull($subject, 'getSubject value is null, but non null value was expected.');
        $destination = $dto->getDestination();
        Assertion::notNull($destination, 'getDestination value is null, but non null value was expected.');
        $setupTime = $dto->getSetupTime();
        Assertion::notNull($setupTime, 'getSetupTime value is null, but non null value was expected.');
        $answerTime = $dto->getAnswerTime();
        Assertion::notNull($answerTime, 'getAnswerTime value is null, but non null value was expected.');
        $usage = $dto->getUsage();
        Assertion::notNull($usage, 'getUsage value is null, but non null value was expected.');
        $extraFields = $dto->getExtraFields();
        Assertion::notNull($extraFields, 'getExtraFields value is null, but non null value was expected.');
        $costSource = $dto->getCostSource();
        Assertion::notNull($costSource, 'getCostSource value is null, but non null value was expected.');
        $cost = $dto->getCost();
        Assertion::notNull($cost, 'getCost value is null, but non null value was expected.');
        $costDetails = $dto->getCostDetails();
        Assertion::notNull($costDetails, 'getCostDetails value is null, but non null value was expected.');
        $extraInfo = $dto->getExtraInfo();
        Assertion::notNull($extraInfo, 'getExtraInfo value is null, but non null value was expected.');

        $this
            ->setCgrid($cgrid)
            ->setRunId($runId)
            ->setOriginHost($originHost)
            ->setSource($source)
            ->setOriginId($originId)
            ->setTor($tor)
            ->setRequestType($requestType)
            ->setTenant($tenant)
            ->setCategory($category)
            ->setAccount($account)
            ->setSubject($subject)
            ->setDestination($destination)
            ->setSetupTime($setupTime)
            ->setAnswerTime($answerTime)
            ->setUsage($usage)
            ->setExtraFields($extraFields)
            ->setCostSource($costSource)
            ->setCost($cost)
            ->setCostDetails($costDetails)
            ->setExtraInfo($extraInfo)
            ->setCreatedAt($dto->getCreatedAt())
            ->setUpdatedAt($dto->getUpdatedAt())
            ->setDeletedAt($dto->getDeletedAt());

        return $this;
    }

    /**
     * @internal use EntityTools instead
     */
    public function toDto(int $depth = 0): TpCdrDto
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
     * @return array<string, mixed>
     */
    protected function __toArray(): array
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

    protected function setCgrid(string $cgrid): static
    {
        Assertion::maxLength($cgrid, 40, 'cgrid value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->cgrid = $cgrid;

        return $this;
    }

    public function getCgrid(): string
    {
        return $this->cgrid;
    }

    protected function setRunId(string $runId): static
    {
        Assertion::maxLength($runId, 64, 'runId value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->runId = $runId;

        return $this;
    }

    public function getRunId(): string
    {
        return $this->runId;
    }

    protected function setOriginHost(string $originHost): static
    {
        Assertion::maxLength($originHost, 64, 'originHost value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->originHost = $originHost;

        return $this;
    }

    public function getOriginHost(): string
    {
        return $this->originHost;
    }

    protected function setSource(string $source): static
    {
        Assertion::maxLength($source, 64, 'source value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->source = $source;

        return $this;
    }

    public function getSource(): string
    {
        return $this->source;
    }

    protected function setOriginId(string $originId): static
    {
        Assertion::maxLength($originId, 128, 'originId value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->originId = $originId;

        return $this;
    }

    public function getOriginId(): string
    {
        return $this->originId;
    }

    protected function setTor(string $tor): static
    {
        Assertion::maxLength($tor, 16, 'tor value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->tor = $tor;

        return $this;
    }

    public function getTor(): string
    {
        return $this->tor;
    }

    protected function setRequestType(string $requestType): static
    {
        Assertion::maxLength($requestType, 24, 'requestType value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->requestType = $requestType;

        return $this;
    }

    public function getRequestType(): string
    {
        return $this->requestType;
    }

    protected function setTenant(string $tenant): static
    {
        Assertion::maxLength($tenant, 64, 'tenant value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->tenant = $tenant;

        return $this;
    }

    public function getTenant(): string
    {
        return $this->tenant;
    }

    protected function setCategory(string $category): static
    {
        Assertion::maxLength($category, 32, 'category value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->category = $category;

        return $this;
    }

    public function getCategory(): string
    {
        return $this->category;
    }

    protected function setAccount(string $account): static
    {
        Assertion::maxLength($account, 128, 'account value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->account = $account;

        return $this;
    }

    public function getAccount(): string
    {
        return $this->account;
    }

    protected function setSubject(string $subject): static
    {
        Assertion::maxLength($subject, 128, 'subject value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->subject = $subject;

        return $this;
    }

    public function getSubject(): string
    {
        return $this->subject;
    }

    protected function setDestination(string $destination): static
    {
        Assertion::maxLength($destination, 128, 'destination value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->destination = $destination;

        return $this;
    }

    public function getDestination(): string
    {
        return $this->destination;
    }

    protected function setSetupTime(string|\DateTimeInterface $setupTime): static
    {

        /** @var \DateTime */
        $setupTime = DateTimeHelper::createOrFix(
            $setupTime,
            null
        );

        if ($this->isInitialized() && $this->setupTime == $setupTime) {
            return $this;
        }

        $this->setupTime = $setupTime;

        return $this;
    }

    public function getSetupTime(): \DateTime
    {
        return clone $this->setupTime;
    }

    protected function setAnswerTime(string|\DateTimeInterface $answerTime): static
    {

        /** @var \DateTime */
        $answerTime = DateTimeHelper::createOrFix(
            $answerTime,
            null
        );

        if ($this->isInitialized() && $this->answerTime == $answerTime) {
            return $this;
        }

        $this->answerTime = $answerTime;

        return $this;
    }

    public function getAnswerTime(): \DateTime
    {
        return clone $this->answerTime;
    }

    protected function setUsage(string $usage): static
    {
        $this->usage = $usage;

        return $this;
    }

    public function getUsage(): string
    {
        return $this->usage;
    }

    protected function setExtraFields(string $extraFields): static
    {
        $this->extraFields = $extraFields;

        return $this;
    }

    public function getExtraFields(): string
    {
        return $this->extraFields;
    }

    protected function setCostSource(string $costSource): static
    {
        Assertion::maxLength($costSource, 64, 'costSource value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->costSource = $costSource;

        return $this;
    }

    public function getCostSource(): string
    {
        return $this->costSource;
    }

    protected function setCost(float $cost): static
    {
        $this->cost = $cost;

        return $this;
    }

    public function getCost(): float
    {
        return $this->cost;
    }

    protected function setCostDetails(array $costDetails): static
    {
        $this->costDetails = $costDetails;

        return $this;
    }

    public function getCostDetails(): array
    {
        return $this->costDetails;
    }

    protected function setExtraInfo(string $extraInfo): static
    {
        $this->extraInfo = $extraInfo;

        return $this;
    }

    public function getExtraInfo(): string
    {
        return $this->extraInfo;
    }

    protected function setCreatedAt(string|\DateTimeInterface|null $createdAt = null): static
    {
        if (!is_null($createdAt)) {

            /** @var ?\DateTime */
            $createdAt = DateTimeHelper::createOrFix(
                $createdAt,
                null
            );

            if ($this->isInitialized() && $this->createdAt == $createdAt) {
                return $this;
            }
        }

        $this->createdAt = $createdAt;

        return $this;
    }

    public function getCreatedAt(): ?\DateTime
    {
        return !is_null($this->createdAt) ? clone $this->createdAt : null;
    }

    protected function setUpdatedAt(string|\DateTimeInterface|null $updatedAt = null): static
    {
        if (!is_null($updatedAt)) {

            /** @var ?\DateTime */
            $updatedAt = DateTimeHelper::createOrFix(
                $updatedAt,
                null
            );

            if ($this->isInitialized() && $this->updatedAt == $updatedAt) {
                return $this;
            }
        }

        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTime
    {
        return !is_null($this->updatedAt) ? clone $this->updatedAt : null;
    }

    protected function setDeletedAt(string|\DateTimeInterface|null $deletedAt = null): static
    {
        if (!is_null($deletedAt)) {

            /** @var ?\DateTime */
            $deletedAt = DateTimeHelper::createOrFix(
                $deletedAt,
                null
            );

            if ($this->isInitialized() && $this->deletedAt == $deletedAt) {
                return $this;
            }
        }

        $this->deletedAt = $deletedAt;

        return $this;
    }

    public function getDeletedAt(): ?\DateTime
    {
        return !is_null($this->deletedAt) ? clone $this->deletedAt : null;
    }
}
