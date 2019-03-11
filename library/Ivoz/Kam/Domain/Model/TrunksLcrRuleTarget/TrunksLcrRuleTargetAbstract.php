<?php

namespace Ivoz\Kam\Domain\Model\TrunksLcrRuleTarget;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;

/**
 * TrunksLcrRuleTargetAbstract
 * @codeCoverageIgnore
 */
abstract class TrunksLcrRuleTargetAbstract
{
    /**
     * column: lcr_id
     * @var integer
     */
    protected $lcrId = 1;

    /**
     * @var integer
     */
    protected $priority;

    /**
     * @var integer
     */
    protected $weight = 1;

    /**
     * @var \Ivoz\Kam\Domain\Model\TrunksLcrRule\TrunksLcrRuleInterface
     */
    protected $rule;

    /**
     * @var \Ivoz\Kam\Domain\Model\TrunksLcrGateway\TrunksLcrGatewayInterface
     */
    protected $gw;

    /**
     * @var \Ivoz\Provider\Domain\Model\OutgoingRouting\OutgoingRoutingInterface
     */
    protected $outgoingRouting;


    use ChangelogTrait;

    /**
     * Constructor
     */
    protected function __construct($lcrId, $priority, $weight)
    {
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
     * @param EntityInterface|null $entity
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
         * @var $dto TrunksLcrRuleTargetDto
         */
        Assertion::isInstanceOf($dto, TrunksLcrRuleTargetDto::class);

        $self = new static(
            $dto->getLcrId(),
            $dto->getPriority(),
            $dto->getWeight()
        );

        $self
            ->setRule($fkTransformer->transform($dto->getRule()))
            ->setGw($fkTransformer->transform($dto->getGw()))
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
         * @var $dto TrunksLcrRuleTargetDto
         */
        Assertion::isInstanceOf($dto, TrunksLcrRuleTargetDto::class);

        $this
            ->setLcrId($dto->getLcrId())
            ->setPriority($dto->getPriority())
            ->setWeight($dto->getWeight())
            ->setRule($fkTransformer->transform($dto->getRule()))
            ->setGw($fkTransformer->transform($dto->getGw()))
            ->setOutgoingRouting($fkTransformer->transform($dto->getOutgoingRouting()));



        $this->sanitizeValues();
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
            ->setRule(\Ivoz\Kam\Domain\Model\TrunksLcrRule\TrunksLcrRule::entityToDto(self::getRule(), $depth))
            ->setGw(\Ivoz\Kam\Domain\Model\TrunksLcrGateway\TrunksLcrGateway::entityToDto(self::getGw(), $depth))
            ->setOutgoingRouting(\Ivoz\Provider\Domain\Model\OutgoingRouting\OutgoingRouting::entityToDto(self::getOutgoingRouting(), $depth));
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
            'ruleId' => self::getRule() ? self::getRule()->getId() : null,
            'gwId' => self::getGw() ? self::getGw()->getId() : null,
            'outgoingRoutingId' => self::getOutgoingRouting() ? self::getOutgoingRouting()->getId() : null
        ];
    }
    // @codeCoverageIgnoreStart

    /**
     * Set lcrId
     *
     * @param integer $lcrId
     *
     * @return self
     */
    protected function setLcrId($lcrId)
    {
        Assertion::notNull($lcrId, 'lcrId value "%s" is null, but non null value was expected.');
        Assertion::integerish($lcrId, 'lcrId value "%s" is not an integer or a number castable to integer.');
        Assertion::greaterOrEqualThan($lcrId, 0, 'lcrId provided "%s" is not greater or equal than "%s".');

        $this->lcrId = (int) $lcrId;

        return $this;
    }

    /**
     * Get lcrId
     *
     * @return integer
     */
    public function getLcrId()
    {
        return $this->lcrId;
    }

    /**
     * Set priority
     *
     * @param integer $priority
     *
     * @return self
     */
    protected function setPriority($priority)
    {
        Assertion::notNull($priority, 'priority value "%s" is null, but non null value was expected.');
        Assertion::integerish($priority, 'priority value "%s" is not an integer or a number castable to integer.');
        Assertion::greaterOrEqualThan($priority, 0, 'priority provided "%s" is not greater or equal than "%s".');

        $this->priority = (int) $priority;

        return $this;
    }

    /**
     * Get priority
     *
     * @return integer
     */
    public function getPriority()
    {
        return $this->priority;
    }

    /**
     * Set weight
     *
     * @param integer $weight
     *
     * @return self
     */
    protected function setWeight($weight)
    {
        Assertion::notNull($weight, 'weight value "%s" is null, but non null value was expected.');
        Assertion::integerish($weight, 'weight value "%s" is not an integer or a number castable to integer.');
        Assertion::greaterOrEqualThan($weight, 0, 'weight provided "%s" is not greater or equal than "%s".');

        $this->weight = (int) $weight;

        return $this;
    }

    /**
     * Get weight
     *
     * @return integer
     */
    public function getWeight()
    {
        return $this->weight;
    }

    /**
     * Set rule
     *
     * @param \Ivoz\Kam\Domain\Model\TrunksLcrRule\TrunksLcrRuleInterface $rule
     *
     * @return self
     */
    public function setRule(\Ivoz\Kam\Domain\Model\TrunksLcrRule\TrunksLcrRuleInterface $rule)
    {
        $this->rule = $rule;

        return $this;
    }

    /**
     * Get rule
     *
     * @return \Ivoz\Kam\Domain\Model\TrunksLcrRule\TrunksLcrRuleInterface
     */
    public function getRule()
    {
        return $this->rule;
    }

    /**
     * Set gw
     *
     * @param \Ivoz\Kam\Domain\Model\TrunksLcrGateway\TrunksLcrGatewayInterface $gw
     *
     * @return self
     */
    public function setGw(\Ivoz\Kam\Domain\Model\TrunksLcrGateway\TrunksLcrGatewayInterface $gw)
    {
        $this->gw = $gw;

        return $this;
    }

    /**
     * Get gw
     *
     * @return \Ivoz\Kam\Domain\Model\TrunksLcrGateway\TrunksLcrGatewayInterface
     */
    public function getGw()
    {
        return $this->gw;
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
     * @return \Ivoz\Provider\Domain\Model\OutgoingRouting\OutgoingRoutingInterface
     */
    public function getOutgoingRouting()
    {
        return $this->outgoingRouting;
    }

    // @codeCoverageIgnoreEnd
}
