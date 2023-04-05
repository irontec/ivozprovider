<?php

declare(strict_types=1);

namespace Ivoz\Cgr\Domain\Model\TpLcrRule;

use Assert\Assertion;
use Ivoz\Core\Domain\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Domain\ForeignKeyTransformerInterface;
use Ivoz\Core\Domain\Model\Helper\DateTimeHelper;
use Ivoz\Provider\Domain\Model\OutgoingRouting\OutgoingRoutingInterface;
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
     * @var ?string
     */
    protected $subject = '*any';

    /**
     * @var ?string
     * column: destination_tag
     */
    protected $destinationTag = '*any';

    /**
     * @var string
     * column: rp_category
     */
    protected $rpCategory;

    /**
     * @var string
     */
    protected $strategy = '*lowest_cost';

    /**
     * @var ?string
     * column: strategy_params
     */
    protected $strategyParams = '';

    /**
     * @var \DateTime
     * column: activation_time
     */
    protected $activationTime;

    /**
     * @var float
     */
    protected $weight = 10;

    /**
     * @var \DateTime
     * column: created_at
     */
    protected $createdAt;

    /**
     * @var ?OutgoingRoutingInterface
     * inversedBy tpLcrRule
     */
    protected $outgoingRouting = null;

    /**
     * Constructor
     */
    protected function __construct(
        string $tpid,
        string $direction,
        string $tenant,
        string $category,
        string $account,
        string $rpCategory,
        string $strategy,
        \DateTimeInterface|string $activationTime,
        float $weight,
        \DateTimeInterface|string $createdAt
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

    abstract public function getId(): null|string|int;

    public function __toString(): string
    {
        return sprintf(
            "%s#%s",
            "TpLcrRule",
            (string) $this->getId()
        );
    }

    /**
     * @throws \Exception
     */
    protected function sanitizeValues(): void
    {
    }

    public static function createDto(string|int|null $id = null): TpLcrRuleDto
    {
        return new TpLcrRuleDto($id);
    }

    /**
     * @internal use EntityTools instead
     * @param null|TpLcrRuleInterface $entity
     */
    public static function entityToDto(?EntityInterface $entity, int $depth = 0): ?TpLcrRuleDto
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

        $dto = $entity->toDto($depth - 1);

        return $dto;
    }

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param TpLcrRuleDto $dto
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
        Assertion::isInstanceOf($dto, TpLcrRuleDto::class);
        $tpid = $dto->getTpid();
        Assertion::notNull($tpid, 'getTpid value is null, but non null value was expected.');
        $direction = $dto->getDirection();
        Assertion::notNull($direction, 'getDirection value is null, but non null value was expected.');
        $tenant = $dto->getTenant();
        Assertion::notNull($tenant, 'getTenant value is null, but non null value was expected.');
        $category = $dto->getCategory();
        Assertion::notNull($category, 'getCategory value is null, but non null value was expected.');
        $account = $dto->getAccount();
        Assertion::notNull($account, 'getAccount value is null, but non null value was expected.');
        $rpCategory = $dto->getRpCategory();
        Assertion::notNull($rpCategory, 'getRpCategory value is null, but non null value was expected.');
        $strategy = $dto->getStrategy();
        Assertion::notNull($strategy, 'getStrategy value is null, but non null value was expected.');
        $activationTime = $dto->getActivationTime();
        Assertion::notNull($activationTime, 'getActivationTime value is null, but non null value was expected.');
        $weight = $dto->getWeight();
        Assertion::notNull($weight, 'getWeight value is null, but non null value was expected.');
        $createdAt = $dto->getCreatedAt();
        Assertion::notNull($createdAt, 'getCreatedAt value is null, but non null value was expected.');

        $self = new static(
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
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
        Assertion::isInstanceOf($dto, TpLcrRuleDto::class);

        $tpid = $dto->getTpid();
        Assertion::notNull($tpid, 'getTpid value is null, but non null value was expected.');
        $direction = $dto->getDirection();
        Assertion::notNull($direction, 'getDirection value is null, but non null value was expected.');
        $tenant = $dto->getTenant();
        Assertion::notNull($tenant, 'getTenant value is null, but non null value was expected.');
        $category = $dto->getCategory();
        Assertion::notNull($category, 'getCategory value is null, but non null value was expected.');
        $account = $dto->getAccount();
        Assertion::notNull($account, 'getAccount value is null, but non null value was expected.');
        $rpCategory = $dto->getRpCategory();
        Assertion::notNull($rpCategory, 'getRpCategory value is null, but non null value was expected.');
        $strategy = $dto->getStrategy();
        Assertion::notNull($strategy, 'getStrategy value is null, but non null value was expected.');
        $activationTime = $dto->getActivationTime();
        Assertion::notNull($activationTime, 'getActivationTime value is null, but non null value was expected.');
        $weight = $dto->getWeight();
        Assertion::notNull($weight, 'getWeight value is null, but non null value was expected.');
        $createdAt = $dto->getCreatedAt();
        Assertion::notNull($createdAt, 'getCreatedAt value is null, but non null value was expected.');

        $this
            ->setTpid($tpid)
            ->setDirection($direction)
            ->setTenant($tenant)
            ->setCategory($category)
            ->setAccount($account)
            ->setSubject($dto->getSubject())
            ->setDestinationTag($dto->getDestinationTag())
            ->setRpCategory($rpCategory)
            ->setStrategy($strategy)
            ->setStrategyParams($dto->getStrategyParams())
            ->setActivationTime($activationTime)
            ->setWeight($weight)
            ->setCreatedAt($createdAt)
            ->setOutgoingRouting($fkTransformer->transform($dto->getOutgoingRouting()));

        return $this;
    }

    /**
     * @internal use EntityTools instead
     */
    public function toDto(int $depth = 0): TpLcrRuleDto
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
     * @return array<string, mixed>
     */
    protected function __toArray(): array
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
            'outgoingRoutingId' => self::getOutgoingRouting()?->getId()
        ];
    }

    protected function setTpid(string $tpid): static
    {
        Assertion::maxLength($tpid, 64, 'tpid value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->tpid = $tpid;

        return $this;
    }

    public function getTpid(): string
    {
        return $this->tpid;
    }

    protected function setDirection(string $direction): static
    {
        Assertion::maxLength($direction, 8, 'direction value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->direction = $direction;

        return $this;
    }

    public function getDirection(): string
    {
        return $this->direction;
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
        Assertion::maxLength($account, 64, 'account value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->account = $account;

        return $this;
    }

    public function getAccount(): string
    {
        return $this->account;
    }

    protected function setSubject(?string $subject = null): static
    {
        if (!is_null($subject)) {
            Assertion::maxLength($subject, 64, 'subject value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->subject = $subject;

        return $this;
    }

    public function getSubject(): ?string
    {
        return $this->subject;
    }

    protected function setDestinationTag(?string $destinationTag = null): static
    {
        if (!is_null($destinationTag)) {
            Assertion::maxLength($destinationTag, 64, 'destinationTag value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->destinationTag = $destinationTag;

        return $this;
    }

    public function getDestinationTag(): ?string
    {
        return $this->destinationTag;
    }

    protected function setRpCategory(string $rpCategory): static
    {
        Assertion::maxLength($rpCategory, 32, 'rpCategory value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->rpCategory = $rpCategory;

        return $this;
    }

    public function getRpCategory(): string
    {
        return $this->rpCategory;
    }

    protected function setStrategy(string $strategy): static
    {
        Assertion::maxLength($strategy, 18, 'strategy value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->strategy = $strategy;

        return $this;
    }

    public function getStrategy(): string
    {
        return $this->strategy;
    }

    protected function setStrategyParams(?string $strategyParams = null): static
    {
        if (!is_null($strategyParams)) {
            Assertion::maxLength($strategyParams, 256, 'strategyParams value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->strategyParams = $strategyParams;

        return $this;
    }

    public function getStrategyParams(): ?string
    {
        return $this->strategyParams;
    }

    protected function setActivationTime(string|\DateTimeInterface $activationTime): static
    {

        /** @var \DateTime */
        $activationTime = DateTimeHelper::createOrFix(
            $activationTime,
            'CURRENT_TIMESTAMP'
        );

        if ($this->isInitialized() && $this->activationTime == $activationTime) {
            return $this;
        }

        $this->activationTime = $activationTime;

        return $this;
    }

    public function getActivationTime(): \DateTime
    {
        return clone $this->activationTime;
    }

    protected function setWeight(float $weight): static
    {
        $this->weight = $weight;

        return $this;
    }

    public function getWeight(): float
    {
        return $this->weight;
    }

    protected function setCreatedAt(string|\DateTimeInterface $createdAt): static
    {

        /** @var \DateTime */
        $createdAt = DateTimeHelper::createOrFix(
            $createdAt,
            'CURRENT_TIMESTAMP'
        );

        if ($this->isInitialized() && $this->createdAt == $createdAt) {
            return $this;
        }

        $this->createdAt = $createdAt;

        return $this;
    }

    public function getCreatedAt(): \DateTime
    {
        return clone $this->createdAt;
    }

    public function setOutgoingRouting(?OutgoingRoutingInterface $outgoingRouting = null): static
    {
        $this->outgoingRouting = $outgoingRouting;

        return $this;
    }

    public function getOutgoingRouting(): ?OutgoingRoutingInterface
    {
        return $this->outgoingRouting;
    }
}
