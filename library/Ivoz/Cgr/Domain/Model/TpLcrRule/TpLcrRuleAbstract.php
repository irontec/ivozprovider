<?php

namespace Ivoz\Cgr\Domain\Model\TpLcrRule;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;

/**
 * TpLcrRuleAbstract
 * @codeCoverageIgnore
 */
abstract class TpLcrRuleAbstract
{
    /**
     * @var string
     */
    protected $tpid = 'ivozprovider';

    /**
     * @var string
     */
    protected $direction = '*out';

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
    protected $account = '*any';

    /**
     * @var string | null
     */
    protected $subject = '*any';

    /**
     * column: destination_tag
     * @var string | null
     */
    protected $destinationTag = '*any';

    /**
     * column: rp_category
     * @var string
     */
    protected $rpCategory;

    /**
     * @var string
     */
    protected $strategy = '*lowest_cost';

    /**
     * column: strategy_params
     * @var string | null
     */
    protected $strategyParams = '';

    /**
     * column: activation_time
     * @var \DateTime
     */
    protected $activationTime;

    /**
     * @var string
     */
    protected $weight = 10;

    /**
     * column: created_at
     * @var \DateTime
     */
    protected $createdAt;

    /**
     * @var \Ivoz\Provider\Domain\Model\OutgoingRouting\OutgoingRoutingInterface
     */
    protected $outgoingRouting;


    use ChangelogTrait;

    /**
     * Constructor
     */
    protected function __construct(
        $tpid,
        $direction,
        $tenant,
        $category,
        $account,
        $rpCategory,
        $strategy,
        $activationTime,
        $weight,
        $createdAt
    ) {
        $this->setTpid($tpid);
        $this->setDirection($direction);
        $this->setTenant($tenant);
        $this->setCategory($category);
        $this->setAccount($account);
        $this->setRpCategory($rpCategory);
        $this->setStrategy($strategy);
        $this->setActivationTime($activationTime);
        $this->setWeight($weight);
        $this->setCreatedAt($createdAt);
    }

    abstract public function getId();

    public function __toString()
    {
        return sprintf(
            "%s#%s",
            "TpLcrRule",
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
     * @return TpLcrRuleDto
     */
    public static function createDto($id = null)
    {
        return new TpLcrRuleDto($id);
    }

    /**
     * @internal use EntityTools instead
     * @param EntityInterface|null $entity
     * @param int $depth
     * @return TpLcrRuleDto|null
     */
    public static function entityToDto(EntityInterface $entity = null, $depth = 0)
    {
        if (!$entity) {
            return null;
        }

        Assertion::isInstanceOf($entity, TpLcrRuleInterface::class);

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
     * @internal use EntityTools instead
     * @param DataTransferObjectInterface $dto
     * @return self
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        \Ivoz\Core\Application\ForeignKeyTransformerInterface $fkTransformer
    ) {
        /**
         * @var $dto TpLcrRuleDto
         */
        Assertion::isInstanceOf($dto, TpLcrRuleDto::class);

        $self = new static(
            $dto->getTpid(),
            $dto->getDirection(),
            $dto->getTenant(),
            $dto->getCategory(),
            $dto->getAccount(),
            $dto->getRpCategory(),
            $dto->getStrategy(),
            $dto->getActivationTime(),
            $dto->getWeight(),
            $dto->getCreatedAt()
        );

        $self
            ->setSubject($dto->getSubject())
            ->setDestinationTag($dto->getDestinationTag())
            ->setStrategyParams($dto->getStrategyParams())
            ->setOutgoingRouting($fkTransformer->transform($dto->getOutgoingRouting()))
        ;

        $self->sanitizeValues();
        $self->initChangelog();

        return $self;
    }

    /**
     * @internal use EntityTools instead
     * @param DataTransferObjectInterface $dto
     * @return self
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        \Ivoz\Core\Application\ForeignKeyTransformerInterface $fkTransformer
    ) {
        /**
         * @var $dto TpLcrRuleDto
         */
        Assertion::isInstanceOf($dto, TpLcrRuleDto::class);

        $this
            ->setTpid($dto->getTpid())
            ->setDirection($dto->getDirection())
            ->setTenant($dto->getTenant())
            ->setCategory($dto->getCategory())
            ->setAccount($dto->getAccount())
            ->setSubject($dto->getSubject())
            ->setDestinationTag($dto->getDestinationTag())
            ->setRpCategory($dto->getRpCategory())
            ->setStrategy($dto->getStrategy())
            ->setStrategyParams($dto->getStrategyParams())
            ->setActivationTime($dto->getActivationTime())
            ->setWeight($dto->getWeight())
            ->setCreatedAt($dto->getCreatedAt())
            ->setOutgoingRouting($fkTransformer->transform($dto->getOutgoingRouting()));



        $this->sanitizeValues();
        return $this;
    }

    /**
     * @internal use EntityTools instead
     * @param int $depth
     * @return TpLcrRuleDto
     */
    public function toDto($depth = 0)
    {
        return self::createDto()
            ->setTpid(self::getTpid())
            ->setDirection(self::getDirection())
            ->setTenant(self::getTenant())
            ->setCategory(self::getCategory())
            ->setAccount(self::getAccount())
            ->setSubject(self::getSubject())
            ->setDestinationTag(self::getDestinationTag())
            ->setRpCategory(self::getRpCategory())
            ->setStrategy(self::getStrategy())
            ->setStrategyParams(self::getStrategyParams())
            ->setActivationTime(self::getActivationTime())
            ->setWeight(self::getWeight())
            ->setCreatedAt(self::getCreatedAt())
            ->setOutgoingRouting(\Ivoz\Provider\Domain\Model\OutgoingRouting\OutgoingRouting::entityToDto(self::getOutgoingRouting(), $depth));
    }

    /**
     * @return array
     */
    protected function __toArray()
    {
        return [
            'tpid' => self::getTpid(),
            'direction' => self::getDirection(),
            'tenant' => self::getTenant(),
            'category' => self::getCategory(),
            'account' => self::getAccount(),
            'subject' => self::getSubject(),
            'destination_tag' => self::getDestinationTag(),
            'rp_category' => self::getRpCategory(),
            'strategy' => self::getStrategy(),
            'strategy_params' => self::getStrategyParams(),
            'activation_time' => self::getActivationTime(),
            'weight' => self::getWeight(),
            'created_at' => self::getCreatedAt(),
            'outgoingRoutingId' => self::getOutgoingRouting() ? self::getOutgoingRouting()->getId() : null
        ];
    }
    // @codeCoverageIgnoreStart

    /**
     * Set tpid
     *
     * @param string $tpid
     *
     * @return self
     */
    protected function setTpid($tpid)
    {
        Assertion::notNull($tpid, 'tpid value "%s" is null, but non null value was expected.');
        Assertion::maxLength($tpid, 64, 'tpid value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->tpid = $tpid;

        return $this;
    }

    /**
     * Get tpid
     *
     * @return string
     */
    public function getTpid()
    {
        return $this->tpid;
    }

    /**
     * Set direction
     *
     * @param string $direction
     *
     * @return self
     */
    protected function setDirection($direction)
    {
        Assertion::notNull($direction, 'direction value "%s" is null, but non null value was expected.');
        Assertion::maxLength($direction, 8, 'direction value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->direction = $direction;

        return $this;
    }

    /**
     * Get direction
     *
     * @return string
     */
    public function getDirection()
    {
        return $this->direction;
    }

    /**
     * Set tenant
     *
     * @param string $tenant
     *
     * @return self
     */
    protected function setTenant($tenant)
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
     * Set category
     *
     * @param string $category
     *
     * @return self
     */
    protected function setCategory($category)
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
     * Set account
     *
     * @param string $account
     *
     * @return self
     */
    protected function setAccount($account)
    {
        Assertion::notNull($account, 'account value "%s" is null, but non null value was expected.');
        Assertion::maxLength($account, 64, 'account value "%s" is too long, it should have no more than %d characters, but has %d characters.');

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
     * Set subject
     *
     * @param string $subject
     *
     * @return self
     */
    protected function setSubject($subject = null)
    {
        if (!is_null($subject)) {
            Assertion::maxLength($subject, 64, 'subject value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->subject = $subject;

        return $this;
    }

    /**
     * Get subject
     *
     * @return string | null
     */
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * Set destinationTag
     *
     * @param string $destinationTag
     *
     * @return self
     */
    protected function setDestinationTag($destinationTag = null)
    {
        if (!is_null($destinationTag)) {
            Assertion::maxLength($destinationTag, 64, 'destinationTag value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->destinationTag = $destinationTag;

        return $this;
    }

    /**
     * Get destinationTag
     *
     * @return string | null
     */
    public function getDestinationTag()
    {
        return $this->destinationTag;
    }

    /**
     * Set rpCategory
     *
     * @param string $rpCategory
     *
     * @return self
     */
    protected function setRpCategory($rpCategory)
    {
        Assertion::notNull($rpCategory, 'rpCategory value "%s" is null, but non null value was expected.');
        Assertion::maxLength($rpCategory, 32, 'rpCategory value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->rpCategory = $rpCategory;

        return $this;
    }

    /**
     * Get rpCategory
     *
     * @return string
     */
    public function getRpCategory()
    {
        return $this->rpCategory;
    }

    /**
     * Set strategy
     *
     * @param string $strategy
     *
     * @return self
     */
    protected function setStrategy($strategy)
    {
        Assertion::notNull($strategy, 'strategy value "%s" is null, but non null value was expected.');
        Assertion::maxLength($strategy, 18, 'strategy value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->strategy = $strategy;

        return $this;
    }

    /**
     * Get strategy
     *
     * @return string
     */
    public function getStrategy()
    {
        return $this->strategy;
    }

    /**
     * Set strategyParams
     *
     * @param string $strategyParams
     *
     * @return self
     */
    protected function setStrategyParams($strategyParams = null)
    {
        if (!is_null($strategyParams)) {
            Assertion::maxLength($strategyParams, 256, 'strategyParams value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->strategyParams = $strategyParams;

        return $this;
    }

    /**
     * Get strategyParams
     *
     * @return string | null
     */
    public function getStrategyParams()
    {
        return $this->strategyParams;
    }

    /**
     * Set activationTime
     *
     * @param \DateTime $activationTime
     *
     * @return self
     */
    protected function setActivationTime($activationTime)
    {
        Assertion::notNull($activationTime, 'activationTime value "%s" is null, but non null value was expected.');
        $activationTime = \Ivoz\Core\Domain\Model\Helper\DateTimeHelper::createOrFix(
            $activationTime,
            'CURRENT_TIMESTAMP'
        );

        $this->activationTime = $activationTime;

        return $this;
    }

    /**
     * Get activationTime
     *
     * @return \DateTime
     */
    public function getActivationTime()
    {
        return clone $this->activationTime;
    }

    /**
     * Set weight
     *
     * @param string $weight
     *
     * @return self
     */
    protected function setWeight($weight)
    {
        Assertion::notNull($weight, 'weight value "%s" is null, but non null value was expected.');
        Assertion::numeric($weight);
        $weight = (float) $weight;

        $this->weight = $weight;

        return $this;
    }

    /**
     * Get weight
     *
     * @return string
     */
    public function getWeight()
    {
        return $this->weight;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return self
     */
    protected function setCreatedAt($createdAt)
    {
        Assertion::notNull($createdAt, 'createdAt value "%s" is null, but non null value was expected.');
        $createdAt = \Ivoz\Core\Domain\Model\Helper\DateTimeHelper::createOrFix(
            $createdAt,
            'CURRENT_TIMESTAMP'
        );

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
        return clone $this->createdAt;
    }

    /**
     * Set outgoingRouting
     *
     * @param \Ivoz\Provider\Domain\Model\OutgoingRouting\OutgoingRoutingInterface $outgoingRouting
     *
     * @return self
     */
    public function setOutgoingRouting(\Ivoz\Provider\Domain\Model\OutgoingRouting\OutgoingRoutingInterface $outgoingRouting = null)
    {
        $this->outgoingRouting = $outgoingRouting;

        return $this;
    }

    /**
     * Get outgoingRouting
     *
     * @return \Ivoz\Provider\Domain\Model\OutgoingRouting\OutgoingRoutingInterface | null
     */
    public function getOutgoingRouting()
    {
        return $this->outgoingRouting;
    }

    // @codeCoverageIgnoreEnd
}
