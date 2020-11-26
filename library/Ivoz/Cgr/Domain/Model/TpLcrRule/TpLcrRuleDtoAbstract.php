<?php

namespace Ivoz\Cgr\Domain\Model\TpLcrRule;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\Model\DtoNormalizer;
use Ivoz\Provider\Domain\Model\OutgoingRouting\OutgoingRoutingDto;

/**
* TpLcrRuleDtoAbstract
* @codeCoverageIgnore
*/
abstract class TpLcrRuleDtoAbstract implements DataTransferObjectInterface
{
    use DtoNormalizer;

    /**
     * @var string
     */
    private $tpid = 'ivozprovider';

    /**
     * @var string
     */
    private $direction = '*out';

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
    private $account = '*any';

    /**
     * @var string | null
     */
    private $subject = '*any';

    /**
     * @var string | null
     */
    private $destinationTag = '*any';

    /**
     * @var string
     */
    private $rpCategory;

    /**
     * @var string
     */
    private $strategy = '*lowest_cost';

    /**
     * @var string | null
     */
    private $strategyParams = '';

    /**
     * @var \DateTimeInterface
     */
    private $activationTime = 'CURRENT_TIMESTAMP';

    /**
     * @var float
     */
    private $weight = 10;

    /**
     * @var \DateTimeInterface
     */
    private $createdAt = 'CURRENT_TIMESTAMP';

    /**
     * @var int
     */
    private $id;

    /**
     * @var OutgoingRoutingDto | null
     */
    private $outgoingRouting;

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
            'tpid' => 'tpid',
            'direction' => 'direction',
            'tenant' => 'tenant',
            'category' => 'category',
            'account' => 'account',
            'subject' => 'subject',
            'destinationTag' => 'destinationTag',
            'rpCategory' => 'rpCategory',
            'strategy' => 'strategy',
            'strategyParams' => 'strategyParams',
            'activationTime' => 'activationTime',
            'weight' => 'weight',
            'createdAt' => 'createdAt',
            'id' => 'id',
            'outgoingRoutingId' => 'outgoingRouting'
        ];
    }

    /**
    * @return array
    */
    public function toArray($hideSensitiveData = false)
    {
        $response = [
            'tpid' => $this->getTpid(),
            'direction' => $this->getDirection(),
            'tenant' => $this->getTenant(),
            'category' => $this->getCategory(),
            'account' => $this->getAccount(),
            'subject' => $this->getSubject(),
            'destinationTag' => $this->getDestinationTag(),
            'rpCategory' => $this->getRpCategory(),
            'strategy' => $this->getStrategy(),
            'strategyParams' => $this->getStrategyParams(),
            'activationTime' => $this->getActivationTime(),
            'weight' => $this->getWeight(),
            'createdAt' => $this->getCreatedAt(),
            'id' => $this->getId(),
            'outgoingRouting' => $this->getOutgoingRouting()
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
     * @param string $tpid | null
     *
     * @return static
     */
    public function setTpid(?string $tpid = null): self
    {
        $this->tpid = $tpid;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getTpid(): ?string
    {
        return $this->tpid;
    }

    /**
     * @param string $direction | null
     *
     * @return static
     */
    public function setDirection(?string $direction = null): self
    {
        $this->direction = $direction;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getDirection(): ?string
    {
        return $this->direction;
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
     * @param string $destinationTag | null
     *
     * @return static
     */
    public function setDestinationTag(?string $destinationTag = null): self
    {
        $this->destinationTag = $destinationTag;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getDestinationTag(): ?string
    {
        return $this->destinationTag;
    }

    /**
     * @param string $rpCategory | null
     *
     * @return static
     */
    public function setRpCategory(?string $rpCategory = null): self
    {
        $this->rpCategory = $rpCategory;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getRpCategory(): ?string
    {
        return $this->rpCategory;
    }

    /**
     * @param string $strategy | null
     *
     * @return static
     */
    public function setStrategy(?string $strategy = null): self
    {
        $this->strategy = $strategy;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getStrategy(): ?string
    {
        return $this->strategy;
    }

    /**
     * @param string $strategyParams | null
     *
     * @return static
     */
    public function setStrategyParams(?string $strategyParams = null): self
    {
        $this->strategyParams = $strategyParams;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getStrategyParams(): ?string
    {
        return $this->strategyParams;
    }

    /**
     * @param \DateTimeInterface $activationTime | null
     *
     * @return static
     */
    public function setActivationTime($activationTime = null): self
    {
        $this->activationTime = $activationTime;

        return $this;
    }

    /**
     * @return \DateTimeInterface | null
     */
    public function getActivationTime()
    {
        return $this->activationTime;
    }

    /**
     * @param float $weight | null
     *
     * @return static
     */
    public function setWeight(?float $weight = null): self
    {
        $this->weight = $weight;

        return $this;
    }

    /**
     * @return float | null
     */
    public function getWeight(): ?float
    {
        return $this->weight;
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

    /**
     * @param OutgoingRoutingDto | null
     *
     * @return static
     */
    public function setOutgoingRouting(?OutgoingRoutingDto $outgoingRouting = null): self
    {
        $this->outgoingRouting = $outgoingRouting;

        return $this;
    }

    /**
     * @return OutgoingRoutingDto | null
     */
    public function getOutgoingRouting(): ?OutgoingRoutingDto
    {
        return $this->outgoingRouting;
    }

    /**
     * @return static
     */
    public function setOutgoingRoutingId($id): self
    {
        $value = !is_null($id)
            ? new OutgoingRoutingDto($id)
            : null;

        return $this->setOutgoingRouting($value);
    }

    /**
     * @return mixed | null
     */
    public function getOutgoingRoutingId()
    {
        if ($dto = $this->getOutgoingRouting()) {
            return $dto->getId();
        }

        return null;
    }

}
