<?php
declare(strict_types = 1);

namespace Ivoz\Kam\Domain\Model\TrunksLcrRuleTarget;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;
use \Ivoz\Core\Application\ForeignKeyTransformerInterface;
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
     * @var int
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
        $lcrId,
        $priority,
        $weight
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
     * @param null $id
     * @return TrunksLcrRuleTargetDto
     */
    public static function createDto($id = null)
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
        $dto = $entity->toDto($depth-1);

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
     * @return TrunksLcrRuleTargetDto
     */
    public function toDto($depth = 0)
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

    /**
     * Set lcrId
     *
     * @param int $lcrId
     *
     * @return static
     */
    protected function setLcrId(int $lcrId): TrunksLcrRuleTargetInterface
    {
        Assertion::greaterOrEqualThan($lcrId, 0, 'lcrId provided "%s" is not greater or equal than "%s".');

        $this->lcrId = $lcrId;

        return $this;
    }

    /**
     * Get lcrId
     *
     * @return int
     */
    public function getLcrId(): int
    {
        return $this->lcrId;
    }

    /**
     * Set priority
     *
     * @param int $priority
     *
     * @return static
     */
    protected function setPriority(int $priority): TrunksLcrRuleTargetInterface
    {
        Assertion::greaterOrEqualThan($priority, 0, 'priority provided "%s" is not greater or equal than "%s".');

        $this->priority = $priority;

        return $this;
    }

    /**
     * Get priority
     *
     * @return int
     */
    public function getPriority(): int
    {
        return $this->priority;
    }

    /**
     * Set weight
     *
     * @param int $weight
     *
     * @return static
     */
    protected function setWeight(int $weight): TrunksLcrRuleTargetInterface
    {
        Assertion::greaterOrEqualThan($weight, 0, 'weight provided "%s" is not greater or equal than "%s".');

        $this->weight = $weight;

        return $this;
    }

    /**
     * Get weight
     *
     * @return int
     */
    public function getWeight(): int
    {
        return $this->weight;
    }

    /**
     * Set rule
     *
     * @param TrunksLcrRuleInterface
     *
     * @return static
     */
    protected function setRule(TrunksLcrRuleInterface $rule): TrunksLcrRuleTargetInterface
    {
        $this->rule = $rule;

        return $this;
    }

    /**
     * Get rule
     *
     * @return TrunksLcrRuleInterface
     */
    public function getRule(): TrunksLcrRuleInterface
    {
        return $this->rule;
    }

    /**
     * Set gw
     *
     * @param TrunksLcrGatewayInterface
     *
     * @return static
     */
    protected function setGw(TrunksLcrGatewayInterface $gw): TrunksLcrRuleTargetInterface
    {
        $this->gw = $gw;

        return $this;
    }

    /**
     * Get gw
     *
     * @return TrunksLcrGatewayInterface
     */
    public function getGw(): TrunksLcrGatewayInterface
    {
        return $this->gw;
    }

    /**
     * Set outgoingRouting
     *
     * @param OutgoingRoutingInterface
     *
     * @return static
     */
    public function setOutgoingRouting(OutgoingRoutingInterface $outgoingRouting): TrunksLcrRuleTargetInterface
    {
        $this->outgoingRouting = $outgoingRouting;

        return $this;
    }

    /**
     * Get outgoingRouting
     *
     * @return OutgoingRoutingInterface
     */
    public function getOutgoingRouting(): OutgoingRoutingInterface
    {
        return $this->outgoingRouting;
    }

}
