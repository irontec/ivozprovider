<?php

declare(strict_types=1);

namespace Ivoz\Kam\Domain\Model\TrunksLcrRuleTarget;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Kam\Domain\Model\TrunksLcrRule\TrunksLcrRuleInterface;
use Ivoz\Kam\Domain\Model\TrunksLcrGateway\TrunksLcrGatewayInterface;
use Ivoz\Provider\Domain\Model\OutgoingRouting\OutgoingRoutingInterface;
use Ivoz\Kam\Domain\Model\TrunksLcrRule\TrunksLcrRule;
use Ivoz\Kam\Domain\Model\TrunksLcrGateway\TrunksLcrGateway;
use Ivoz\Provider\Domain\Model\OutgoingRouting\OutgoingRouting;

/**
* TrunksLcrRuleTargetAbstract
* @codeCoverageIgnore
*/
abstract class TrunksLcrRuleTargetAbstract
{
    use ChangelogTrait;

    /**
     * @var int
     * column: lcr_id
     */
    protected $lcrId = 1;

    /**
     * @var int
     */
    protected $priority;

    /**
     * @var int
     */
    protected $weight = 1;

    /**
     * @var TrunksLcrRuleInterface
     */
    protected $rule;

    /**
     * @var TrunksLcrGatewayInterface
     */
    protected $gw;

    /**
     * @var OutgoingRoutingInterface
     * inversedBy lcrRuleTargets
     */
    protected $outgoingRouting;

    /**
     * Constructor
     */
    protected function __construct(
        int $lcrId,
        int $priority,
        int $weight
    ) {
        $this->setLcrId($lcrId);
        $this->setPriority($priority);
        $this->setWeight($weight);
    }

    abstract public function getId(): null|string|int;

    public function __toString(): string
    {
        return sprintf(
            "%s#%s",
            "TrunksLcrRuleTarget",
            (string) $this->getId()
        );
    }

    /**
     * @throws \Exception
     */
    protected function sanitizeValues(): void
    {
    }

    public static function createDto(string|int|null $id = null): TrunksLcrRuleTargetDto
    {
        return new TrunksLcrRuleTargetDto($id);
    }

    /**
     * @internal use EntityTools instead
     * @param null|TrunksLcrRuleTargetInterface $entity
     */
    public static function entityToDto(?EntityInterface $entity, int $depth = 0): ?TrunksLcrRuleTargetDto
    {
        if (!$entity) {
            return null;
        }

        Assertion::isInstanceOf($entity, TrunksLcrRuleTargetInterface::class);

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
     * @param TrunksLcrRuleTargetDto $dto
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
        Assertion::isInstanceOf($dto, TrunksLcrRuleTargetDto::class);
        $lcrId = $dto->getLcrId();
        Assertion::notNull($lcrId, 'getLcrId value is null, but non null value was expected.');
        $priority = $dto->getPriority();
        Assertion::notNull($priority, 'getPriority value is null, but non null value was expected.');
        $weight = $dto->getWeight();
        Assertion::notNull($weight, 'getWeight value is null, but non null value was expected.');
        $rule = $dto->getRule();
        Assertion::notNull($rule, 'getRule value is null, but non null value was expected.');
        $gw = $dto->getGw();
        Assertion::notNull($gw, 'getGw value is null, but non null value was expected.');
        $outgoingRouting = $dto->getOutgoingRouting();
        Assertion::notNull($outgoingRouting, 'getOutgoingRouting value is null, but non null value was expected.');

        $self = new static(
            $lcrId,
            $priority,
            $weight
        );

        $self
            ->setRule($fkTransformer->transform($rule))
            ->setGw($fkTransformer->transform($gw))
            ->setOutgoingRouting($fkTransformer->transform($outgoingRouting));

        $self->initChangelog();

        return $self;
    }

    /**
     * @internal use EntityTools instead
     * @param TrunksLcrRuleTargetDto $dto
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
        Assertion::isInstanceOf($dto, TrunksLcrRuleTargetDto::class);

        $lcrId = $dto->getLcrId();
        Assertion::notNull($lcrId, 'getLcrId value is null, but non null value was expected.');
        $priority = $dto->getPriority();
        Assertion::notNull($priority, 'getPriority value is null, but non null value was expected.');
        $weight = $dto->getWeight();
        Assertion::notNull($weight, 'getWeight value is null, but non null value was expected.');
        $rule = $dto->getRule();
        Assertion::notNull($rule, 'getRule value is null, but non null value was expected.');
        $gw = $dto->getGw();
        Assertion::notNull($gw, 'getGw value is null, but non null value was expected.');
        $outgoingRouting = $dto->getOutgoingRouting();
        Assertion::notNull($outgoingRouting, 'getOutgoingRouting value is null, but non null value was expected.');

        $this
            ->setLcrId($lcrId)
            ->setPriority($priority)
            ->setWeight($weight)
            ->setRule($fkTransformer->transform($rule))
            ->setGw($fkTransformer->transform($gw))
            ->setOutgoingRouting($fkTransformer->transform($outgoingRouting));

        return $this;
    }

    /**
     * @internal use EntityTools instead
     */
    public function toDto(int $depth = 0): TrunksLcrRuleTargetDto
    {
        return self::createDto()
            ->setLcrId(self::getLcrId())
            ->setPriority(self::getPriority())
            ->setWeight(self::getWeight())
            ->setRule(TrunksLcrRule::entityToDto(self::getRule(), $depth))
            ->setGw(TrunksLcrGateway::entityToDto(self::getGw(), $depth))
            ->setOutgoingRouting(OutgoingRouting::entityToDto(self::getOutgoingRouting(), $depth));
    }

    protected function __toArray(): array
    {
        return [
            'lcr_id' => self::getLcrId(),
            'priority' => self::getPriority(),
            'weight' => self::getWeight(),
            'ruleId' => self::getRule()->getId(),
            'gwId' => self::getGw()->getId(),
            'outgoingRoutingId' => self::getOutgoingRouting()->getId()
        ];
    }

    protected function setLcrId(int $lcrId): static
    {
        Assertion::greaterOrEqualThan($lcrId, 0, 'lcrId provided "%s" is not greater or equal than "%s".');

        $this->lcrId = $lcrId;

        return $this;
    }

    public function getLcrId(): int
    {
        return $this->lcrId;
    }

    protected function setPriority(int $priority): static
    {
        Assertion::greaterOrEqualThan($priority, 0, 'priority provided "%s" is not greater or equal than "%s".');

        $this->priority = $priority;

        return $this;
    }

    public function getPriority(): int
    {
        return $this->priority;
    }

    protected function setWeight(int $weight): static
    {
        Assertion::greaterOrEqualThan($weight, 0, 'weight provided "%s" is not greater or equal than "%s".');

        $this->weight = $weight;

        return $this;
    }

    public function getWeight(): int
    {
        return $this->weight;
    }

    protected function setRule(TrunksLcrRuleInterface $rule): static
    {
        $this->rule = $rule;

        return $this;
    }

    public function getRule(): TrunksLcrRuleInterface
    {
        return $this->rule;
    }

    protected function setGw(TrunksLcrGatewayInterface $gw): static
    {
        $this->gw = $gw;

        return $this;
    }

    public function getGw(): TrunksLcrGatewayInterface
    {
        return $this->gw;
    }

    public function setOutgoingRouting(OutgoingRoutingInterface $outgoingRouting): static
    {
        $this->outgoingRouting = $outgoingRouting;

        return $this;
    }

    public function getOutgoingRouting(): OutgoingRoutingInterface
    {
        return $this->outgoingRouting;
    }
}
