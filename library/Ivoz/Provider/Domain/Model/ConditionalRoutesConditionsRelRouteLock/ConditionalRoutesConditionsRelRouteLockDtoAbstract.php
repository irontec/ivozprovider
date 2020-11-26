<?php

namespace Ivoz\Provider\Domain\Model\ConditionalRoutesConditionsRelRouteLock;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\Model\DtoNormalizer;
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
     * @var int
     */
    private $id;

    /**
     * @var ConditionalRoutesConditionDto | null
     */
    private $condition;

    /**
     * @var RouteLockDto | null
     */
    private $routeLock;

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
            'id' => 'id',
            'conditionId' => 'condition',
            'routeLockId' => 'routeLock'
        ];
    }

    /**
    * @return array
    */
    public function toArray($hideSensitiveData = false)
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
     * @param ConditionalRoutesConditionDto | null
     *
     * @return static
     */
    public function setCondition(?ConditionalRoutesConditionDto $condition = null): self
    {
        $this->condition = $condition;

        return $this;
    }

    /**
     * @return ConditionalRoutesConditionDto | null
     */
    public function getCondition(): ?ConditionalRoutesConditionDto
    {
        return $this->condition;
    }

    /**
     * @return static
     */
    public function setConditionId($id): self
    {
        $value = !is_null($id)
            ? new ConditionalRoutesConditionDto($id)
            : null;

        return $this->setCondition($value);
    }

    /**
     * @return mixed | null
     */
    public function getConditionId()
    {
        if ($dto = $this->getCondition()) {
            return $dto->getId();
        }

        return null;
    }

    /**
     * @param RouteLockDto | null
     *
     * @return static
     */
    public function setRouteLock(?RouteLockDto $routeLock = null): self
    {
        $this->routeLock = $routeLock;

        return $this;
    }

    /**
     * @return RouteLockDto | null
     */
    public function getRouteLock(): ?RouteLockDto
    {
        return $this->routeLock;
    }

    /**
     * @return static
     */
    public function setRouteLockId($id): self
    {
        $value = !is_null($id)
            ? new RouteLockDto($id)
            : null;

        return $this->setRouteLock($value);
    }

    /**
     * @return mixed | null
     */
    public function getRouteLockId()
    {
        if ($dto = $this->getRouteLock()) {
            return $dto->getId();
        }

        return null;
    }

}
