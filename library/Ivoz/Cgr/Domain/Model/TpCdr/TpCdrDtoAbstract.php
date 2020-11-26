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
     * @var \DateTimeInterface
     */
    private $setupTime;

    /**
     * @var \DateTimeInterface
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
     * @var \DateTimeInterface | null
     */
    private $createdAt;

    /**
     * @var \DateTimeInterface | null
     */
    private $updatedAt;

    /**
     * @var \DateTimeInterface | null
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

    /**
     * @param string $cgrid | null
     *
     * @return static
     */
    public function setCgrid(?string $cgrid = null): self
    {
        $this->cgrid = $cgrid;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getCgrid(): ?string
    {
        return $this->cgrid;
    }

    /**
     * @param string $runId | null
     *
     * @return static
     */
    public function setRunId(?string $runId = null): self
    {
        $this->runId = $runId;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getRunId(): ?string
    {
        return $this->runId;
    }

    /**
     * @param string $originHost | null
     *
     * @return static
     */
    public function setOriginHost(?string $originHost = null): self
    {
        $this->originHost = $originHost;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getOriginHost(): ?string
    {
        return $this->originHost;
    }

    /**
     * @param string $source | null
     *
     * @return static
     */
    public function setSource(?string $source = null): self
    {
        $this->source = $source;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getSource(): ?string
    {
        return $this->source;
    }

    /**
     * @param string $originId | null
     *
     * @return static
     */
    public function setOriginId(?string $originId = null): self
    {
        $this->originId = $originId;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getOriginId(): ?string
    {
        return $this->originId;
    }

    /**
     * @param string $tor | null
     *
     * @return static
     */
    public function setTor(?string $tor = null): self
    {
        $this->tor = $tor;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getTor(): ?string
    {
        return $this->tor;
    }

    /**
     * @param string $requestType | null
     *
     * @return static
     */
    public function setRequestType(?string $requestType = null): self
    {
        $this->requestType = $requestType;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getRequestType(): ?string
    {
        return $this->requestType;
    }

    /**
     * @param string $tenant | null
     *
     * @return static
     */
    public function setTenant(?string $tenant = null): self
    {
        $this->tenant = $tenant;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getTenant(): ?string
    {
        return $this->tenant;
    }

    /**
     * @param string $category | null
     *
     * @return static
     */
    public function setCategory(?string $category = null): self
    {
        $this->category = $category;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getCategory(): ?string
    {
        return $this->category;
    }

    /**
     * @param string $account | null
     *
     * @return static
     */
    public function setAccount(?string $account = null): self
    {
        $this->account = $account;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getAccount(): ?string
    {
        return $this->account;
    }

    /**
     * @param string $subject | null
     *
     * @return static
     */
    public function setSubject(?string $subject = null): self
    {
        $this->subject = $subject;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getSubject(): ?string
    {
        return $this->subject;
    }

    /**
     * @param string $destination | null
     *
     * @return static
     */
    public function setDestination(?string $destination = null): self
    {
        $this->destination = $destination;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getDestination(): ?string
    {
        return $this->destination;
    }

    /**
     * @param \DateTimeInterface $setupTime | null
     *
     * @return static
     */
    public function setSetupTime($setupTime = null): self
    {
        $this->setupTime = $setupTime;

        return $this;
    }

    /**
     * @return \DateTimeInterface | null
     */
    public function getSetupTime()
    {
        return $this->setupTime;
    }

    /**
     * @param \DateTimeInterface $answerTime | null
     *
     * @return static
     */
    public function setAnswerTime($answerTime = null): self
    {
        $this->answerTime = $answerTime;

        return $this;
    }

    /**
     * @return \DateTimeInterface | null
     */
    public function getAnswerTime()
    {
        return $this->answerTime;
    }

    /**
     * @param int $usage | null
     *
     * @return static
     */
    public function setUsage(?int $usage = null): self
    {
        $this->usage = $usage;

        return $this;
    }

    /**
     * @return int | null
     */
    public function getUsage(): ?int
    {
        return $this->usage;
    }

    /**
     * @param string $extraFields | null
     *
     * @return static
     */
    public function setExtraFields(?string $extraFields = null): self
    {
        $this->extraFields = $extraFields;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getExtraFields(): ?string
    {
        return $this->extraFields;
    }

    /**
     * @param string $costSource | null
     *
     * @return static
     */
    public function setCostSource(?string $costSource = null): self
    {
        $this->costSource = $costSource;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getCostSource(): ?string
    {
        return $this->costSource;
    }

    /**
     * @param float $cost | null
     *
     * @return static
     */
    public function setCost(?float $cost = null): self
    {
        $this->cost = $cost;

        return $this;
    }

    /**
     * @return float | null
     */
    public function getCost(): ?float
    {
        return $this->cost;
    }

    /**
     * @param array $costDetails | null
     *
     * @return static
     */
    public function setCostDetails(?array $costDetails = null): self
    {
        $this->costDetails = $costDetails;

        return $this;
    }

    /**
     * @return array | null
     */
    public function getCostDetails(): ?array
    {
        return $this->costDetails;
    }

    /**
     * @param string $extraInfo | null
     *
     * @return static
     */
    public function setExtraInfo(?string $extraInfo = null): self
    {
        $this->extraInfo = $extraInfo;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getExtraInfo(): ?string
    {
        return $this->extraInfo;
    }

    /**
     * @param \DateTimeInterface $createdAt | null
     *
     * @return static
     */
    public function setCreatedAt($createdAt = null): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * @return \DateTimeInterface | null
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @param \DateTimeInterface $updatedAt | null
     *
     * @return static
     */
    public function setUpdatedAt($updatedAt = null): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * @return \DateTimeInterface | null
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * @param \DateTimeInterface $deletedAt | null
     *
     * @return static
     */
    public function setDeletedAt($deletedAt = null): self
    {
        $this->deletedAt = $deletedAt;

        return $this;
    }

    /**
     * @return \DateTimeInterface | null
     */
    public function getDeletedAt()
    {
        return $this->deletedAt;
    }

    /**
     * @param int $id | null
     *
     * @return static
     */
    public function setId(?int $id = null): self
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return int | null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

}
