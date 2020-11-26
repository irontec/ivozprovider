<?php
declare(strict_types = 1);

namespace Ivoz\Cgr\Domain\Model\TpLcrRule;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;
use \Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Core\Domain\Model\Helper\DateTimeHelper;
use Ivoz\Provider\Domain\Model\OutgoingRouting\OutgoingRouting;

/**
* TpLcrRuleAbstract
* @codeCoverageIgnore
*/
abstract class TpLcrRuleAbstract
{
    use ChangelogTrait;

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
     * @var \DateTimeInterface
     */
    protected $activationTime = 'CURRENT_TIMESTAMP';

    /**
     * @var float
     */
    protected $weight = 10;

    /**
     * column: created_at
     * @var \DateTimeInterface
     */
    protected $createdAt = 'CURRENT_TIMESTAMP';

    /**
     * @var OutgoingRouting
     * inversedBy tpLcrRule
     */
    protected $outgoingRouting;

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
     * @param TpLcrRuleInterface|null $entity
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

        /** @var TpLcrRuleDto $dto */
        $dto = $entity->toDto($depth-1);

        return $dto;
    }

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param TpLcrRuleDto $dto
     * @return self
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ) {
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
            ->setOutgoingRouting($fkTransformer->transform($dto->getOutgoingRouting()));

        $self->initChangelog();

        return $self;
    }

    /**
     * @internal use EntityTools instead
     * @param TpLcrRuleDto $dto
     * @return self
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ) {
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
            ->setOutgoingRouting(OutgoingRouting::entityToDto(self::getOutgoingRouting(), $depth));
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

    /**
     * Set tpid
     *
     * @param string $tpid
     *
     * @return static
     */
    protected function setTpid(string $tpid): TpLcrRuleInterface
    {
        Assertion::maxLength($tpid, 64, 'tpid value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->tpid = $tpid;

        return $this;
    }

    /**
     * Get tpid
     *
     * @return string
     */
    public function getTpid(): string
    {
        return $this->tpid;
    }

    /**
     * Set direction
     *
     * @param string $direction
     *
     * @return static
     */
    protected function setDirection(string $direction): TpLcrRuleInterface
    {
        Assertion::maxLength($direction, 8, 'direction value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->direction = $direction;

        return $this;
    }

    /**
     * Get direction
     *
     * @return string
     */
    public function getDirection(): string
    {
        return $this->direction;
    }

    /**
     * Set tenant
     *
     * @param string $tenant
     *
     * @return static
     */
    protected function setTenant(string $tenant): TpLcrRuleInterface
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
    protected function setCategory(string $category): TpLcrRuleInterface
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
    protected function setAccount(string $account): TpLcrRuleInterface
    {
        Assertion::maxLength($account, 64, 'account value "%s" is too long, it should have no more than %d characters, but has %d characters.');

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
     * @param string $subject | null
     *
     * @return static
     */
    protected function setSubject(?string $subject = null): TpLcrRuleInterface
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
    public function getSubject(): ?string
    {
        return $this->subject;
    }

    /**
     * Set destinationTag
     *
     * @param string $destinationTag | null
     *
     * @return static
     */
    protected function setDestinationTag(?string $destinationTag = null): TpLcrRuleInterface
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
    public function getDestinationTag(): ?string
    {
        return $this->destinationTag;
    }

    /**
     * Set rpCategory
     *
     * @param string $rpCategory
     *
     * @return static
     */
    protected function setRpCategory(string $rpCategory): TpLcrRuleInterface
    {
        Assertion::maxLength($rpCategory, 32, 'rpCategory value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->rpCategory = $rpCategory;

        return $this;
    }

    /**
     * Get rpCategory
     *
     * @return string
     */
    public function getRpCategory(): string
    {
        return $this->rpCategory;
    }

    /**
     * Set strategy
     *
     * @param string $strategy
     *
     * @return static
     */
    protected function setStrategy(string $strategy): TpLcrRuleInterface
    {
        Assertion::maxLength($strategy, 18, 'strategy value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->strategy = $strategy;

        return $this;
    }

    /**
     * Get strategy
     *
     * @return string
     */
    public function getStrategy(): string
    {
        return $this->strategy;
    }

    /**
     * Set strategyParams
     *
     * @param string $strategyParams | null
     *
     * @return static
     */
    protected function setStrategyParams(?string $strategyParams = null): TpLcrRuleInterface
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
    public function getStrategyParams(): ?string
    {
        return $this->strategyParams;
    }

    /**
     * Set activationTime
     *
     * @param \DateTimeInterface $activationTime
     *
     * @return static
     */
    protected function setActivationTime($activationTime): TpLcrRuleInterface
    {

        $activationTime = DateTimeHelper::createOrFix(
            $activationTime,
            'CURRENT_TIMESTAMP'
        );

        if ($this->activationTime == $activationTime) {
            return $this;
        }

        $this->activationTime = $activationTime;

        return $this;
    }

    /**
     * Get activationTime
     *
     * @return \DateTimeInterface
     */
    public function getActivationTime(): \DateTimeInterface
    {
        return clone $this->activationTime;
    }

    /**
     * Set weight
     *
     * @param float $weight
     *
     * @return static
     */
    protected function setWeight(float $weight): TpLcrRuleInterface
    {
        $this->weight = $weight;

        return $this;
    }

    /**
     * Get weight
     *
     * @return float
     */
    public function getWeight(): float
    {
        return $this->weight;
    }

    /**
     * Set createdAt
     *
     * @param \DateTimeInterface $createdAt
     *
     * @return static
     */
    protected function setCreatedAt($createdAt): TpLcrRuleInterface
    {

        $createdAt = DateTimeHelper::createOrFix(
            $createdAt,
            'CURRENT_TIMESTAMP'
        );

        if ($this->createdAt == $createdAt) {
            return $this;
        }

        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTimeInterface
     */
    public function getCreatedAt(): \DateTimeInterface
    {
        return clone $this->createdAt;
    }

    /**
     * Set outgoingRouting
     *
     * @param OutgoingRouting | null
     *
     * @return static
     */
    public function setOutgoingRouting(?OutgoingRouting $outgoingRouting = null): TpLcrRuleInterface
    {
        $this->outgoingRouting = $outgoingRouting;

        return $this;
    }

    /**
     * Get outgoingRouting
     *
     * @return OutgoingRouting | null
     */
    public function getOutgoingRouting(): ?OutgoingRouting
    {
        return $this->outgoingRouting;
    }

}
