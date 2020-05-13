<?php

namespace Ivoz\Cgr\Domain\Model\TpLcrRule;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\Model\DtoNormalizer;

/**
 * @codeCoverageIgnore
 */
abstract class TpLcrRuleDtoAbstract implements DataTransferObjectInterface
{
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
     * @var string
     */
    private $subject = '*any';

    /**
     * @var string
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
     * @var string
     */
    private $strategyParams = '';

    /**
     * @var \DateTime | string
     */
    private $activationTime = 'CURRENT_TIMESTAMP';

    /**
     * @var float
     */
    private $weight = 10;

    /**
     * @var \DateTime | string
     */
    private $createdAt = 'CURRENT_TIMESTAMP';

    /**
     * @var integer
     */
    private $id;

    /**
     * @var \Ivoz\Provider\Domain\Model\OutgoingRouting\OutgoingRoutingDto | null
     */
    private $outgoingRouting;


    use DtoNormalizer;

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
     * @param string $tpid
     *
     * @return static
     */
    public function setTpid($tpid = null)
    {
        $this->tpid = $tpid;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getTpid()
    {
        return $this->tpid;
    }

    /**
     * @param string $direction
     *
     * @return static
     */
    public function setDirection($direction = null)
    {
        $this->direction = $direction;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getDirection()
    {
        return $this->direction;
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
     * @return string | null
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
     * @return string | null
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
     * @return string | null
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
     * @return string | null
     */
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * @param string $destinationTag
     *
     * @return static
     */
    public function setDestinationTag($destinationTag = null)
    {
        $this->destinationTag = $destinationTag;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getDestinationTag()
    {
        return $this->destinationTag;
    }

    /**
     * @param string $rpCategory
     *
     * @return static
     */
    public function setRpCategory($rpCategory = null)
    {
        $this->rpCategory = $rpCategory;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getRpCategory()
    {
        return $this->rpCategory;
    }

    /**
     * @param string $strategy
     *
     * @return static
     */
    public function setStrategy($strategy = null)
    {
        $this->strategy = $strategy;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getStrategy()
    {
        return $this->strategy;
    }

    /**
     * @param string $strategyParams
     *
     * @return static
     */
    public function setStrategyParams($strategyParams = null)
    {
        $this->strategyParams = $strategyParams;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getStrategyParams()
    {
        return $this->strategyParams;
    }

    /**
     * @param \DateTime $activationTime
     *
     * @return static
     */
    public function setActivationTime($activationTime = null)
    {
        $this->activationTime = $activationTime;

        return $this;
    }

    /**
     * @return \DateTime | null
     */
    public function getActivationTime()
    {
        return $this->activationTime;
    }

    /**
     * @param float $weight
     *
     * @return static
     */
    public function setWeight($weight = null)
    {
        $this->weight = $weight;

        return $this;
    }

    /**
     * @return float | null
     */
    public function getWeight()
    {
        return $this->weight;
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
     * @return \DateTime | null
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
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
     * @return integer | null
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param \Ivoz\Provider\Domain\Model\OutgoingRouting\OutgoingRoutingDto $outgoingRouting
     *
     * @return static
     */
    public function setOutgoingRouting(\Ivoz\Provider\Domain\Model\OutgoingRouting\OutgoingRoutingDto $outgoingRouting = null)
    {
        $this->outgoingRouting = $outgoingRouting;

        return $this;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\OutgoingRouting\OutgoingRoutingDto | null
     */
    public function getOutgoingRouting()
    {
        return $this->outgoingRouting;
    }

    /**
     * @param mixed | null $id
     *
     * @return static
     */
    public function setOutgoingRoutingId($id)
    {
        $value = !is_null($id)
            ? new \Ivoz\Provider\Domain\Model\OutgoingRouting\OutgoingRoutingDto($id)
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
