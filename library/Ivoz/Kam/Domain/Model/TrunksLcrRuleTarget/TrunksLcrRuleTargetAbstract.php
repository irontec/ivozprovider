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
     * column: lcr_id
     */
    protected $lcrId = 1;

    protected $priority;

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

    abstract public function getId();

    public function __toString()
    {
        return sprintf(
            "%s#%s",
            "TrunksLcrRuleTarget",
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
     */
    public static function createDto($id = null): TrunksLcrRuleTargetDto
    {
        return new TrunksLcrRuleTargetDto($id);
    }

    /**
     * @internal use EntityTools instead
     * @param TrunksLcrRuleTargetInterface|null $entity
     * @param int $depth
     * @return TrunksLcrRuleTargetDto|null
     */
    public static function entityToDto(EntityInterface $entity = null, $depth = 0)
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

        /** @var TrunksLcrRuleTargetDto $dto */
        $dto = $entity->toDto($depth - 1);

        return $dto;
    }

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param TrunksLcrRuleTargetDto $dto
     * @return self
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ) {
        Assertion::isInstanceOf($dto, TrunksLcrRuleTargetDto::class);

        $self = new static(
            $dto->getLcrId(),
            $dto->getPriority(),
            $dto->getWeight()
        );

        $self
            ->setRule($fkTransformer->transform($dto->getRule()))
            ->setGw($fkTransformer->transform($dto->getGw()))
            ->setOutgoingRouting($fkTransformer->transform($dto->getOutgoingRouting()));

        $self->initChangelog();

        return $self;
    }

    /**
     * @internal use EntityTools instead
     * @param TrunksLcrRuleTargetDto $dto
     * @return self
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ) {
        Assertion::isInstanceOf($dto, TrunksLcrRuleTargetDto::class);

        $this
            ->setLcrId($dto->getLcrId())
            ->setPriority($dto->getPriority())
            ->setWeight($dto->getWeight())
            ->setRule($fkTransformer->transform($dto->getRule()))
            ->setGw($fkTransformer->transform($dto->getGw()))
            ->setOutgoingRouting($fkTransformer->transform($dto->getOutgoingRouting()));

        return $this;
    }

    /**
     * @internal use EntityTools instead
     * @param int $depth
     */
    public function toDto($depth = 0): TrunksLcrRuleTargetDto
    {
        return self::createDto()
            ->setLcrId(self::getLcrId())
            ->setPriority(self::getPriority())
            ->setWeight(self::getWeight())
            ->setRule(TrunksLcrRule::entityToDto(self::getRule(), $depth))
            ->setGw(TrunksLcrGateway::entityToDto(self::getGw(), $depth))
            ->setOutgoingRouting(OutgoingRouting::entityToDto(self::getOutgoingRouting(), $depth));
    }

    /**
     * @return array
     */
    protected function __toArray()
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
