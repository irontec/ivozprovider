<?php

namespace Ivoz\Kam\Domain\Model\TrunksLcrRuleTarget;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\Model\DtoNormalizer;
use Ivoz\Kam\Domain\Model\TrunksLcrRule\TrunksLcrRuleDto;
use Ivoz\Kam\Domain\Model\TrunksLcrGateway\TrunksLcrGatewayDto;
use Ivoz\Provider\Domain\Model\OutgoingRouting\OutgoingRoutingDto;

/**
* TrunksLcrRuleTargetDtoAbstract
* @codeCoverageIgnore
*/
abstract class TrunksLcrRuleTargetDtoAbstract implements DataTransferObjectInterface
{
    use DtoNormalizer;

    /**
     * @var int
     */
    private $lcrId = 1;

    /**
     * @var int
     */
    private $priority;

    /**
     * @var int
     */
    private $weight = 1;

    /**
     * @var int
     */
    private $id;

    /**
     * @var TrunksLcrRuleDto | null
     */
    private $rule;

    /**
     * @var TrunksLcrGatewayDto | null
     */
    private $gw;

    /**
     * @var OutgoingRoutingDto | null
     */
    private $outgoingRouting;

    public function __construct($id = null)
    {
        $this->setId($id);
    }

    /**
    * @inheritdoc
    */
    public static function getPropertyMap(string $context = '', string $role = null)
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
        $response = [
            'lcrId' => $this->getLcrId(),
            'priority' => $this->getPriority(),
            'weight' => $this->getWeight(),
            'id' => $this->getId(),
            'rule' => $this->getRule(),
            'gw' => $this->getGw(),
            'outgoingRouting' => $this->getOutgoingRouting()
        ];

        if (!$hideSensitiveData) {
            return $response;
        }

        foreach ($this->sensitiveFields as $sensitiveField) {
            if (!array_key_exists($sensitiveField, $response)) {
                throw new \Exception($sensitiveField . ' field was not found');
            }
            $response[$sensitiveField] = '*****';
        }

        return $response;
    }

    /**
     * @param int $lcrId | null
     *
     * @return static
     */
    public function setLcrId(?int $lcrId = null): self
    {
        $this->lcrId = $lcrId;

        return $this;
    }

    /**
     * @return int | null
     */
    public function getLcrId(): ?int
    {
        return $this->lcrId;
    }

    /**
     * @param int $priority | null
     *
     * @return static
     */
    public function setPriority(?int $priority = null): self
    {
        $this->priority = $priority;

        return $this;
    }

    /**
     * @return int | null
     */
    public function getPriority(): ?int
    {
        return $this->priority;
    }

    /**
     * @param int $weight | null
     *
     * @return static
     */
    public function setWeight(?int $weight = null): self
    {
        $this->weight = $weight;

        return $this;
    }

    /**
     * @return int | null
     */
    public function getWeight(): ?int
    {
        return $this->weight;
    }

    /**
     * @param int $id | null
     *
     * @return static
     */
    public function setId(?int $id = null): self
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return int | null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param TrunksLcrRuleDto | null
     *
     * @return static
     */
    public function setRule(?TrunksLcrRuleDto $rule = null): self
    {
        $this->rule = $rule;

        return $this;
    }

    /**
     * @return TrunksLcrRuleDto | null
     */
    public function getRule(): ?TrunksLcrRuleDto
    {
        return $this->rule;
    }

    /**
     * @return static
     */
    public function setRuleId($id): self
    {
        $value = !is_null($id)
            ? new TrunksLcrRuleDto($id)
            : null;

        return $this->setRule($value);
    }

    /**
     * @return mixed | null
     */
    public function getRuleId()
    {
        if ($dto = $this->getRule()) {
            return $dto->getId();
        }

        return null;
    }

    /**
     * @param TrunksLcrGatewayDto | null
     *
     * @return static
     */
    public function setGw(?TrunksLcrGatewayDto $gw = null): self
    {
        $this->gw = $gw;

        return $this;
    }

    /**
     * @return TrunksLcrGatewayDto | null
     */
    public function getGw(): ?TrunksLcrGatewayDto
    {
        return $this->gw;
    }

    /**
     * @return static
     */
    public function setGwId($id): self
    {
        $value = !is_null($id)
            ? new TrunksLcrGatewayDto($id)
            : null;

        return $this->setGw($value);
    }

    /**
     * @return mixed | null
     */
    public function getGwId()
    {
        if ($dto = $this->getGw()) {
            return $dto->getId();
        }

        return null;
    }

    /**
     * @param OutgoingRoutingDto | null
     *
     * @return static
     */
    public function setOutgoingRouting(?OutgoingRoutingDto $outgoingRouting = null): self
    {
        $this->outgoingRouting = $outgoingRouting;

        return $this;
    }

    /**
     * @return OutgoingRoutingDto | null
     */
    public function getOutgoingRouting(): ?OutgoingRoutingDto
    {
        return $this->outgoingRouting;
    }

    /**
     * @return static
     */
    public function setOutgoingRoutingId($id): self
    {
        $value = !is_null($id)
            ? new OutgoingRoutingDto($id)
            : null;

        return $this->setOutgoingRouting($value);
    }

    /**
     * @return mixed | null
     */
    public function getOutgoingRoutingId()
    {
        if ($dto = $this->getOutgoingRouting()) {
            return $dto->getId();
        }

        return null;
    }

}
