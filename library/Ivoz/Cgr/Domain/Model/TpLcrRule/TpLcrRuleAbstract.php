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
     * @var \DateTime
     */
    protected $activationTime;

    /**
     * @var float
     */
    protected $weight = 10;

    /**
     * column: created_at
     * @var \DateTime
     */
    protected $createdAt;

    /**
     * @var OutgoingRouting | null
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
     * @param mixed $id
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

    protected function setActivationTime($activationTime): static
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

    protected function setCreatedAt($createdAt): static
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

    public function getCreatedAt(): \DateTime
    {
        return clone $this->createdAt;
    }

    public function setOutgoingRouting(?OutgoingRouting $outgoingRouting = null): static
    {
        $this->outgoingRouting = $outgoingRouting;

        /** @var  $this */
        return $this;
    }

    public function getOutgoingRouting(): ?OutgoingRouting
    {
        return $this->outgoingRouting;
    }
}
