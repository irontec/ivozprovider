<?php

namespace Ivoz\Kam\Domain\Model\TrunksLcrRuleTarget;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\Model\DtoNormalizer;

/**
 * @codeCoverageIgnore
 */
abstract class TrunksLcrRuleTargetDtoAbstract implements DataTransferObjectInterface
{
    /**
     * @var integer
     */
    private $lcrId = '1';

    /**
     * @var integer
     */
    private $priority;

    /**
     * @var integer
     */
    private $weight = '1';

    /**
     * @var integer
     */
    private $id;

    /**
     * @var \Ivoz\Kam\Domain\Model\TrunksLcrRule\TrunksLcrRuleDto | null
     */
    private $rule;

    /**
     * @var \Ivoz\Kam\Domain\Model\TrunksLcrGateway\TrunksLcrGatewayDto | null
     */
    private $gw;

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
    public static function getPropertyMap(string $context = '')
    {
        if ($context === self::CONTEXT_COLLECTION) {
            return ['id' => 'id'];
        }

        return [
            'lcrId' => 'lcrId',
            'priority' => 'priority',
            'weight' => 'weight',
            'id' => 'id',
            'ruleId' => 'rule',
            'gwId' => 'gw',
            'outgoingRoutingId' => 'outgoingRouting'
        ];
    }

    /**
     * @return array
     */
    public function toArray($hideSensitiveData = false)
    {
        return [
            'lcrId' => $this->getLcrId(),
            'priority' => $this->getPriority(),
            'weight' => $this->getWeight(),
            'id' => $this->getId(),
            'rule' => $this->getRule(),
            'gw' => $this->getGw(),
            'outgoingRouting' => $this->getOutgoingRouting()
        ];
    }

    /**
     * @param integer $lcrId
     *
     * @return static
     */
    public function setLcrId($lcrId = null)
    {
        $this->lcrId = $lcrId;

        return $this;
    }

    /**
     * @return integer
     */
    public function getLcrId()
    {
        return $this->lcrId;
    }

    /**
     * @param integer $priority
     *
     * @return static
     */
    public function setPriority($priority = null)
    {
        $this->priority = $priority;

        return $this;
    }

    /**
     * @return integer
     */
    public function getPriority()
    {
        return $this->priority;
    }

    /**
     * @param integer $weight
     *
     * @return static
     */
    public function setWeight($weight = null)
    {
        $this->weight = $weight;

        return $this;
    }

    /**
     * @return integer
     */
    public function getWeight()
    {
        return $this->weight;
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
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param \Ivoz\Kam\Domain\Model\TrunksLcrRule\TrunksLcrRuleDto $rule
     *
     * @return static
     */
    public function setRule(\Ivoz\Kam\Domain\Model\TrunksLcrRule\TrunksLcrRuleDto $rule = null)
    {
        $this->rule = $rule;

        return $this;
    }

    /**
     * @return \Ivoz\Kam\Domain\Model\TrunksLcrRule\TrunksLcrRuleDto
     */
    public function getRule()
    {
        return $this->rule;
    }

    /**
     * @param integer $id | null
     *
     * @return static
     */
    public function setRuleId($id)
    {
        $value = !is_null($id)
            ? new \Ivoz\Kam\Domain\Model\TrunksLcrRule\TrunksLcrRuleDto($id)
            : null;

        return $this->setRule($value);
    }

    /**
     * @return integer | null
     */
    public function getRuleId()
    {
        if ($dto = $this->getRule()) {
            return $dto->getId();
        }

        return null;
    }

    /**
     * @param \Ivoz\Kam\Domain\Model\TrunksLcrGateway\TrunksLcrGatewayDto $gw
     *
     * @return static
     */
    public function setGw(\Ivoz\Kam\Domain\Model\TrunksLcrGateway\TrunksLcrGatewayDto $gw = null)
    {
        $this->gw = $gw;

        return $this;
    }

    /**
     * @return \Ivoz\Kam\Domain\Model\TrunksLcrGateway\TrunksLcrGatewayDto
     */
    public function getGw()
    {
        return $this->gw;
    }

    /**
     * @param integer $id | null
     *
     * @return static
     */
    public function setGwId($id)
    {
        $value = !is_null($id)
            ? new \Ivoz\Kam\Domain\Model\TrunksLcrGateway\TrunksLcrGatewayDto($id)
            : null;

        return $this->setGw($value);
    }

    /**
     * @return integer | null
     */
    public function getGwId()
    {
        if ($dto = $this->getGw()) {
            return $dto->getId();
        }

        return null;
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
     * @return \Ivoz\Provider\Domain\Model\OutgoingRouting\OutgoingRoutingDto
     */
    public function getOutgoingRouting()
    {
        return $this->outgoingRouting;
    }

    /**
     * @param integer $id | null
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
     * @return integer | null
     */
    public function getOutgoingRoutingId()
    {
        if ($dto = $this->getOutgoingRouting()) {
            return $dto->getId();
        }

        return null;
    }
}
