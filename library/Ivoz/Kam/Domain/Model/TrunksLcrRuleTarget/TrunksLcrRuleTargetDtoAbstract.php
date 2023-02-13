<?php

namespace Ivoz\Kam\Domain\Model\TrunksLcrRuleTarget;

use Ivoz\Core\Domain\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\DtoNormalizer;
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
     * @var int|null
     */
    private $lcrId = 1;

    /**
     * @var int|null
     */
    private $priority = null;

    /**
     * @var int|null
     */
    private $weight = 1;

    /**
     * @var int|null
     */
    private $id = null;

    /**
     * @var TrunksLcrRuleDto | null
     */
    private $rule = null;

    /**
     * @var TrunksLcrGatewayDto | null
     */
    private $gw = null;

    /**
     * @var OutgoingRoutingDto | null
     */
    private $outgoingRouting = null;

    /**
     * @param string|int|null $id
     */
    public function __construct($id = null)
    {
        $this->setId($id);
    }

    /**
    * @inheritdoc
    */
    public static function getPropertyMap(string $context = '', string $role = null): array
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
     * @return array<string, mixed>
     */
    public function toArray(bool $hideSensitiveData = false): array
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

    public function setLcrId(int $lcrId): static
    {
        $this->lcrId = $lcrId;

        return $this;
    }

    public function getLcrId(): ?int
    {
        return $this->lcrId;
    }

    public function setPriority(int $priority): static
    {
        $this->priority = $priority;

        return $this;
    }

    public function getPriority(): ?int
    {
        return $this->priority;
    }

    public function setWeight(int $weight): static
    {
        $this->weight = $weight;

        return $this;
    }

    public function getWeight(): ?int
    {
        return $this->weight;
    }

    public function setId($id): static
    {
        $this->id = $id;

        return $this;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setRule(?TrunksLcrRuleDto $rule): static
    {
        $this->rule = $rule;

        return $this;
    }

    public function getRule(): ?TrunksLcrRuleDto
    {
        return $this->rule;
    }

    public function setRuleId($id): static
    {
        $value = !is_null($id)
            ? new TrunksLcrRuleDto($id)
            : null;

        return $this->setRule($value);
    }

    public function getRuleId()
    {
        if ($dto = $this->getRule()) {
            return $dto->getId();
        }

        return null;
    }

    public function setGw(?TrunksLcrGatewayDto $gw): static
    {
        $this->gw = $gw;

        return $this;
    }

    public function getGw(): ?TrunksLcrGatewayDto
    {
        return $this->gw;
    }

    public function setGwId($id): static
    {
        $value = !is_null($id)
            ? new TrunksLcrGatewayDto($id)
            : null;

        return $this->setGw($value);
    }

    public function getGwId()
    {
        if ($dto = $this->getGw()) {
            return $dto->getId();
        }

        return null;
    }

    public function setOutgoingRouting(?OutgoingRoutingDto $outgoingRouting): static
    {
        $this->outgoingRouting = $outgoingRouting;

        return $this;
    }

    public function getOutgoingRouting(): ?OutgoingRoutingDto
    {
        return $this->outgoingRouting;
    }

    public function setOutgoingRoutingId($id): static
    {
        $value = !is_null($id)
            ? new OutgoingRoutingDto($id)
            : null;

        return $this->setOutgoingRouting($value);
    }

    public function getOutgoingRoutingId()
    {
        if ($dto = $this->getOutgoingRouting()) {
            return $dto->getId();
        }

        return null;
    }
}
