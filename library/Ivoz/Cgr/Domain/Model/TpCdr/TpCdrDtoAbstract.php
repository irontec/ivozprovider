<?php

namespace Ivoz\Cgr\Domain\Model\TpCdr;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\Model\DtoNormalizer;

/**
* TpCdrDtoAbstract
* @codeCoverageIgnore
*/
abstract class TpCdrDtoAbstract implements DataTransferObjectInterface
{
    use DtoNormalizer;

    /**
     * @var string|null
     */
    private $cgrid = null;

    /**
     * @var string|null
     */
    private $runId = null;

    /**
     * @var string|null
     */
    private $originHost = null;

    /**
     * @var string|null
     */
    private $source = null;

    /**
     * @var string|null
     */
    private $originId = null;

    /**
     * @var string|null
     */
    private $tor = null;

    /**
     * @var string|null
     */
    private $requestType = null;

    /**
     * @var string|null
     */
    private $tenant = null;

    /**
     * @var string|null
     */
    private $category = null;

    /**
     * @var string|null
     */
    private $account = null;

    /**
     * @var string|null
     */
    private $subject = null;

    /**
     * @var string|null
     */
    private $destination = null;

    /**
     * @var \DateTimeInterface|string|null
     */
    private $setupTime = null;

    /**
     * @var \DateTimeInterface|string|null
     */
    private $answerTime = null;

    /**
     * @var string|null
     */
    private $usage = null;

    /**
     * @var string|null
     */
    private $extraFields = null;

    /**
     * @var string|null
     */
    private $costSource = null;

    /**
     * @var float|null
     */
    private $cost = null;

    /**
     * @var array|null
     */
    private $costDetails = null;

    /**
     * @var string|null
     */
    private $extraInfo = null;

    /**
     * @var \DateTimeInterface|string|null
     */
    private $createdAt = null;

    /**
     * @var \DateTimeInterface|string|null
     */
    private $updatedAt = null;

    /**
     * @var \DateTimeInterface|string|null
     */
    private $deletedAt = null;

    /**
     * @var int|null
     */
    private $id = null;

    /**
     * @param string|int|null $id
     */
    public function __construct($id = null)
    {
        $this->setId($id);
    }

    /**
    * @inheritdoc
    */
    public static function getPropertyMap(string $context = '', string $role = null): array
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
     * @return array<string, mixed>
     */
    public function toArray(bool $hideSensitiveData = false): array
    {
        $response = [
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

        if (!$hideSensitiveData) {
            return $response;
        }

        foreach ($this->sensitiveFields as $sensitiveField) {
            if (!array_key_exists($sensitiveField, $response)) {
                throw new \Exception($sensitiveField . ' field was not found');
            }
            $response[$sensitiveField] = '*****';
        }

        return $response;
    }

    public function setCgrid(string $cgrid): static
    {
        $this->cgrid = $cgrid;

        return $this;
    }

    public function getCgrid(): ?string
    {
        return $this->cgrid;
    }

    public function setRunId(string $runId): static
    {
        $this->runId = $runId;

        return $this;
    }

    public function getRunId(): ?string
    {
        return $this->runId;
    }

    public function setOriginHost(string $originHost): static
    {
        $this->originHost = $originHost;

        return $this;
    }

    public function getOriginHost(): ?string
    {
        return $this->originHost;
    }

    public function setSource(string $source): static
    {
        $this->source = $source;

        return $this;
    }

    public function getSource(): ?string
    {
        return $this->source;
    }

    public function setOriginId(string $originId): static
    {
        $this->originId = $originId;

        return $this;
    }

    public function getOriginId(): ?string
    {
        return $this->originId;
    }

    public function setTor(string $tor): static
    {
        $this->tor = $tor;

        return $this;
    }

    public function getTor(): ?string
    {
        return $this->tor;
    }

    public function setRequestType(string $requestType): static
    {
        $this->requestType = $requestType;

        return $this;
    }

    public function getRequestType(): ?string
    {
        return $this->requestType;
    }

    public function setTenant(string $tenant): static
    {
        $this->tenant = $tenant;

        return $this;
    }

    public function getTenant(): ?string
    {
        return $this->tenant;
    }

    public function setCategory(string $category): static
    {
        $this->category = $category;

        return $this;
    }

    public function getCategory(): ?string
    {
        return $this->category;
    }

    public function setAccount(string $account): static
    {
        $this->account = $account;

        return $this;
    }

    public function getAccount(): ?string
    {
        return $this->account;
    }

    public function setSubject(string $subject): static
    {
        $this->subject = $subject;

        return $this;
    }

    public function getSubject(): ?string
    {
        return $this->subject;
    }

    public function setDestination(string $destination): static
    {
        $this->destination = $destination;

        return $this;
    }

    public function getDestination(): ?string
    {
        return $this->destination;
    }

    public function setSetupTime(\DateTimeInterface|string $setupTime): static
    {
        $this->setupTime = $setupTime;

        return $this;
    }

    public function getSetupTime(): \DateTimeInterface|string|null
    {
        return $this->setupTime;
    }

    public function setAnswerTime(\DateTimeInterface|string $answerTime): static
    {
        $this->answerTime = $answerTime;

        return $this;
    }

    public function getAnswerTime(): \DateTimeInterface|string|null
    {
        return $this->answerTime;
    }

    public function setUsage(string $usage): static
    {
        $this->usage = $usage;

        return $this;
    }

    public function getUsage(): ?string
    {
        return $this->usage;
    }

    public function setExtraFields(string $extraFields): static
    {
        $this->extraFields = $extraFields;

        return $this;
    }

    public function getExtraFields(): ?string
    {
        return $this->extraFields;
    }

    public function setCostSource(string $costSource): static
    {
        $this->costSource = $costSource;

        return $this;
    }

    public function getCostSource(): ?string
    {
        return $this->costSource;
    }

    public function setCost(float $cost): static
    {
        $this->cost = $cost;

        return $this;
    }

    public function getCost(): ?float
    {
        return $this->cost;
    }

    public function setCostDetails(array $costDetails): static
    {
        $this->costDetails = $costDetails;

        return $this;
    }

    public function getCostDetails(): ?array
    {
        return $this->costDetails;
    }

    public function setExtraInfo(string $extraInfo): static
    {
        $this->extraInfo = $extraInfo;

        return $this;
    }

    public function getExtraInfo(): ?string
    {
        return $this->extraInfo;
    }

    public function setCreatedAt(null|\DateTimeInterface|string $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getCreatedAt(): \DateTimeInterface|string|null
    {
        return $this->createdAt;
    }

    public function setUpdatedAt(null|\DateTimeInterface|string $updatedAt): static
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function getUpdatedAt(): \DateTimeInterface|string|null
    {
        return $this->updatedAt;
    }

    public function setDeletedAt(null|\DateTimeInterface|string $deletedAt): static
    {
        $this->deletedAt = $deletedAt;

        return $this;
    }

    public function getDeletedAt(): \DateTimeInterface|string|null
    {
        return $this->deletedAt;
    }

    public function setId($id): static
    {
        $this->id = $id;

        return $this;
    }

    public function getId(): ?int
    {
        return $this->id;
    }
}
