<?php

namespace Ivoz\Provider\Domain\Model\LcrRuleTarget;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;

/**
 * LcrRuleTargetAbstract
 * @codeCoverageIgnore
 */
abstract class LcrRuleTargetAbstract
{
    /**
     * @column lcr_id
     * @var integer
     */
    protected $lcrId = '1';

    /**
     * @var boolean
     */
    protected $priority;

    /**
     * @var integer
     */
    protected $weight = '1';

    /**
     * @var \Ivoz\Provider\Domain\Model\LcrRule\LcrRuleInterface
     */
    protected $rule;

    /**
     * @var \Ivoz\Provider\Domain\Model\LcrGateway\LcrGatewayInterface
     */
    protected $gw;

    /**
     * @var \Ivoz\Provider\Domain\Model\OutgoingRouting\OutgoingRoutingInterface
     */
    protected $outgoingRouting;


    /**
     * Changelog tracking purpose
     * @var array
     */
    protected $_initialValues = [];

    /**
     * Constructor
     */
    public function __construct($lcrId, $priority, $weight)
    {
        $this->setLcrId($lcrId);
        $this->setPriority($priority);
        $this->setWeight($weight);

        $this->initChangelog();
    }

    /**
     * @param string $fieldName
     * @return mixed
     * @throws \Exception
     */
    public function initChangelog()
    {
        $values = $this->__toArray();
        if (!$this->getId()) {
            // Empty values for entities with no Id
            foreach ($values as $key => $val) {
                $values[$key] = null;
            }
        }

        $this->_initialValues = $values;
    }

    /**
     * @param string $fieldName
     * @return mixed
     * @throws \Exception
     */
    public function hasChanged($dbFieldName)
    {
        if (!array_key_exists($dbFieldName, $this->_initialValues)) {
            throw new \Exception($dbFieldName . ' field was not found');
        }
        $currentValues = $this->__toArray();

        return $currentValues[$dbFieldName] != $this->_initialValues[$dbFieldName];
    }

    public function getInitialValue($dbFieldName)
    {
        if (!array_key_exists($dbFieldName, $this->_initialValues)) {
            throw new \Exception($dbFieldName . ' field was not found');
        }

        return $this->_initialValues[$dbFieldName];
    }

    /**
     * @return array
     */
    protected function getChangeSet()
    {
        $changes = [];
        $currentValues = $this->__toArray();
        foreach ($currentValues as $key => $value) {

            if ($this->_initialValues[$key] == $currentValues[$key]) {
                continue;
            }

            $value = $currentValues[$key];
            if ($value instanceof \DateTime) {
                $value = $value->format('Y-m-d H:i:s');
            }

            $changes[$key] = $value;
        }

        return $changes;
    }

    /**
     * @return LcrRuleTargetDTO
     */
    public static function createDTO()
    {
        return new LcrRuleTargetDTO();
    }

    /**
     * Factory method
     * @param DataTransferObjectInterface $dto
     * @return self
     */
    public static function fromDTO(DataTransferObjectInterface $dto)
    {
        /**
         * @var $dto LcrRuleTargetDTO
         */
        Assertion::isInstanceOf($dto, LcrRuleTargetDTO::class);

        $self = new static(
            $dto->getLcrId(),
            $dto->getPriority(),
            $dto->getWeight());

        return $self
            ->setRule($dto->getRule())
            ->setGw($dto->getGw())
            ->setOutgoingRouting($dto->getOutgoingRouting())
        ;
    }

    /**
     * @param DataTransferObjectInterface $dto
     * @return self
     */
    public function updateFromDTO(DataTransferObjectInterface $dto)
    {
        /**
         * @var $dto LcrRuleTargetDTO
         */
        Assertion::isInstanceOf($dto, LcrRuleTargetDTO::class);

        $this
            ->setLcrId($dto->getLcrId())
            ->setPriority($dto->getPriority())
            ->setWeight($dto->getWeight())
            ->setRule($dto->getRule())
            ->setGw($dto->getGw())
            ->setOutgoingRouting($dto->getOutgoingRouting());


        return $this;
    }

    /**
     * @return LcrRuleTargetDTO
     */
    public function toDTO()
    {
        return self::createDTO()
            ->setLcrId($this->getLcrId())
            ->setPriority($this->getPriority())
            ->setWeight($this->getWeight())
            ->setRuleId($this->getRule() ? $this->getRule()->getId() : null)
            ->setGwId($this->getGw() ? $this->getGw()->getId() : null)
            ->setOutgoingRoutingId($this->getOutgoingRouting() ? $this->getOutgoingRouting()->getId() : null);
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
    public function setLcrId($lcrId)
    {
        Assertion::notNull($lcrId);
        Assertion::integerish($lcrId);
        Assertion::greaterOrEqualThan($lcrId, 0);

        $this->lcrId = $lcrId;

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
     * @param boolean $priority
     *
     * @return self
     */
    public function setPriority($priority)
    {
        Assertion::notNull($priority);
        Assertion::between(intval($priority), 0, 1);

        $this->priority = $priority;

        return $this;
    }

    /**
     * Get priority
     *
     * @return boolean
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
    public function setWeight($weight)
    {
        Assertion::notNull($weight);
        Assertion::integerish($weight);
        Assertion::greaterOrEqualThan($weight, 0);

        $this->weight = $weight;

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
     * @param \Ivoz\Provider\Domain\Model\LcrRule\LcrRuleInterface $rule
     *
     * @return self
     */
    public function setRule(\Ivoz\Provider\Domain\Model\LcrRule\LcrRuleInterface $rule)
    {
        $this->rule = $rule;

        return $this;
    }

    /**
     * Get rule
     *
     * @return \Ivoz\Provider\Domain\Model\LcrRule\LcrRuleInterface
     */
    public function getRule()
    {
        return $this->rule;
    }

    /**
     * Set gw
     *
     * @param \Ivoz\Provider\Domain\Model\LcrGateway\LcrGatewayInterface $gw
     *
     * @return self
     */
    public function setGw(\Ivoz\Provider\Domain\Model\LcrGateway\LcrGatewayInterface $gw)
    {
        $this->gw = $gw;

        return $this;
    }

    /**
     * Get gw
     *
     * @return \Ivoz\Provider\Domain\Model\LcrGateway\LcrGatewayInterface
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
    public function setOutgoingRouting(\Ivoz\Provider\Domain\Model\OutgoingRouting\OutgoingRoutingInterface $outgoingRouting)
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

