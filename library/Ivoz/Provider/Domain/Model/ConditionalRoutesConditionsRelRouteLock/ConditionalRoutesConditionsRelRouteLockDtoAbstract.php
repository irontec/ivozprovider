<?php

namespace Ivoz\Provider\Domain\Model\ConditionalRoutesConditionsRelRouteLock;

use Ivoz\Core\Domain\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\DtoNormalizer;
use Ivoz\Provider\Domain\Model\ConditionalRoutesCondition\ConditionalRoutesConditionDto;
use Ivoz\Provider\Domain\Model\RouteLock\RouteLockDto;

/**
* ConditionalRoutesConditionsRelRouteLockDtoAbstract
* @codeCoverageIgnore
*/
abstract class ConditionalRoutesConditionsRelRouteLockDtoAbstract implements DataTransferObjectInterface
{
    use DtoNormalizer;

    /**
     * @var int|null
     */
    private $id = null;

    /**
     * @var ConditionalRoutesConditionDto | null
     */
    private $condition = null;

    /**
     * @var RouteLockDto | null
     */
    private $routeLock = null;

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
            'id' => 'id',
            'conditionId' => 'condition',
            'routeLockId' => 'routeLock'
        ];
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(bool $hideSensitiveData = false): array
    {
        $response = [
            'id' => $this->getId(),
            'condition' => $this->getCondition(),
            'routeLock' => $this->getRouteLock()
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

    public function setId($id): static
    {
        $this->id = $id;

        return $this;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setCondition(?ConditionalRoutesConditionDto $condition): static
    {
        $this->condition = $condition;

        return $this;
    }

    public function getCondition(): ?ConditionalRoutesConditionDto
    {
        return $this->condition;
    }

    public function setConditionId($id): static
    {
        $value = !is_null($id)
            ? new ConditionalRoutesConditionDto($id)
            : null;

        return $this->setCondition($value);
    }

    public function getConditionId()
    {
        if ($dto = $this->getCondition()) {
            return $dto->getId();
        }

        return null;
    }

    public function setRouteLock(?RouteLockDto $routeLock): static
    {
        $this->routeLock = $routeLock;

        return $this;
    }

    public function getRouteLock(): ?RouteLockDto
    {
        return $this->routeLock;
    }

    public function setRouteLockId($id): static
    {
        $value = !is_null($id)
            ? new RouteLockDto($id)
            : null;

        return $this->setRouteLock($value);
    }

    public function getRouteLockId()
    {
        if ($dto = $this->getRouteLock()) {
            return $dto->getId();
        }

        return null;
    }
}
