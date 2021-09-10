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
     * @var \DateTime|string
     */
    private $setupTime;

    /**
     * @var \DateTime|string
     */
    private $answerTime;

    /**
     * @var int
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
     * @var \DateTime|string|null
     */
    private $createdAt;

    /**
     * @var \DateTime|string|null
     */
    private $updatedAt;

    /**
     * @var \DateTime|string|null
     */
    private $deletedAt;

    /**
     * @var int
     */
    private $id;

    public function __construct($id = null)
    {
        $this->setId($id);
    }

    /**
    * @inheritdoc
    */
    public static function getPropertyMap(string $context = '', string $role = null)
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

    public function setCgrid(?string $cgrid): static
    {
        $this->cgrid = $cgrid;

        return $this;
    }

    public function getCgrid(): ?string
    {
        return $this->cgrid;
    }

    public function setRunId(?string $runId): static
    {
        $this->runId = $runId;

        return $this;
    }

    public function getRunId(): ?string
    {
        return $this->runId;
    }

    public function setOriginHost(?string $originHost): static
    {
        $this->originHost = $originHost;

        return $this;
    }

    public function getOriginHost(): ?string
    {
        return $this->originHost;
    }

    public function setSource(?string $source): static
    {
        $this->source = $source;

        return $this;
    }

    public function getSource(): ?string
    {
        return $this->source;
    }

    public function setOriginId(?string $originId): static
    {
        $this->originId = $originId;

        return $this;
    }

    public function getOriginId(): ?string
    {
        return $this->originId;
    }

    public function setTor(?string $tor): static
    {
        $this->tor = $tor;

        return $this;
    }

    public function getTor(): ?string
    {
        return $this->tor;
    }

    public function setRequestType(?string $requestType): static
    {
        $this->requestType = $requestType;

        return $this;
    }

    public function getRequestType(): ?string
    {
        return $this->requestType;
    }

    public function setTenant(?string $tenant): static
    {
        $this->tenant = $tenant;

        return $this;
    }

    public function getTenant(): ?string
    {
        return $this->tenant;
    }

    public function setCategory(?string $category): static
    {
        $this->category = $category;

        return $this;
    }

    public function getCategory(): ?string
    {
        return $this->category;
    }

    public function setAccount(?string $account): static
    {
        $this->account = $account;

        return $this;
    }

    public function getAccount(): ?string
    {
        return $this->account;
    }

    public function setSubject(?string $subject): static
    {
        $this->subject = $subject;

        return $this;
    }

    public function getSubject(): ?string
    {
        return $this->subject;
    }

    public function setDestination(?string $destination): static
    {
        $this->destination = $destination;

        return $this;
    }

    public function getDestination(): ?string
    {
        return $this->destination;
    }

    public function setSetupTime(null|\DateTime|string $setupTime): static
    {
        $this->setupTime = $setupTime;

        return $this;
    }

    public function getSetupTime(): \DateTime|string|null
    {
        return $this->setupTime;
    }

    public function setAnswerTime(null|\DateTime|string $answerTime): static
    {
        $this->answerTime = $answerTime;

        return $this;
    }

    public function getAnswerTime(): \DateTime|string|null
    {
        return $this->answerTime;
    }

    public function setUsage(?int $usage): static
    {
        $this->usage = $usage;

        return $this;
    }

    public function getUsage(): ?int
    {
        return $this->usage;
    }

    public function setExtraFields(?string $extraFields): static
    {
        $this->extraFields = $extraFields;

        return $this;
    }

    public function getExtraFields(): ?string
    {
        return $this->extraFields;
    }

    public function setCostSource(?string $costSource): static
    {
        $this->costSource = $costSource;

        return $this;
    }

    public function getCostSource(): ?string
    {
        return $this->costSource;
    }

    public function setCost(?float $cost): static
    {
        $this->cost = $cost;

        return $this;
    }

    public function getCost(): ?float
    {
        return $this->cost;
    }

    public function setCostDetails(?array $costDetails): static
    {
        $this->costDetails = $costDetails;

        return $this;
    }

    public function getCostDetails(): ?array
    {
        return $this->costDetails;
    }

    public function setExtraInfo(?string $extraInfo): static
    {
        $this->extraInfo = $extraInfo;

        return $this;
    }

    public function getExtraInfo(): ?string
    {
        return $this->extraInfo;
    }

    public function setCreatedAt(null|\DateTime|string $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getCreatedAt(): \DateTime|string|null
    {
        return $this->createdAt;
    }

    public function setUpdatedAt(null|\DateTime|string $updatedAt): static
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function getUpdatedAt(): \DateTime|string|null
    {
        return $this->updatedAt;
    }

    public function setDeletedAt(null|\DateTime|string $deletedAt): static
    {
        $this->deletedAt = $deletedAt;

        return $this;
    }

    public function getDeletedAt(): \DateTime|string|null
    {
        return $this->deletedAt;
    }

    public function setId($id): static
    {
        $this->id = $id;

        return $this;
    }

    public function getId()
    {
        return $this->id;
    }
}
