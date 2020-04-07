<?php

namespace Ivoz\Provider\Domain\Model\ConditionalRoutesConditionsRelRouteLock;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\Model\DtoNormalizer;

/**
 * @codeCoverageIgnore
 */
abstract class ConditionalRoutesConditionsRelRouteLockDtoAbstract implements DataTransferObjectInterface
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var \Ivoz\Provider\Domain\Model\ConditionalRoutesCondition\ConditionalRoutesConditionDto | null
     */
    private $condition;

    /**
     * @var \Ivoz\Provider\Domain\Model\RouteLock\RouteLockDto | null
     */
    private $routeLock;


    use DtoNormalizer;

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
     * @return integer | null
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param \Ivoz\Provider\Domain\Model\ConditionalRoutesCondition\ConditionalRoutesConditionDto $condition
     *
     * @return static
     */
    public function setCondition(\Ivoz\Provider\Domain\Model\ConditionalRoutesCondition\ConditionalRoutesConditionDto $condition = null)
    {
        $this->condition = $condition;

        return $this;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\ConditionalRoutesCondition\ConditionalRoutesConditionDto | null
     */
    public function getCondition()
    {
        return $this->condition;
    }

    /**
     * @param mixed | null $id
     *
     * @return static
     */
    public function setConditionId($id)
    {
        $value = !is_null($id)
            ? new \Ivoz\Provider\Domain\Model\ConditionalRoutesCondition\ConditionalRoutesConditionDto($id)
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
     * @param \Ivoz\Provider\Domain\Model\RouteLock\RouteLockDto $routeLock
     *
     * @return static
     */
    public function setRouteLock(\Ivoz\Provider\Domain\Model\RouteLock\RouteLockDto $routeLock = null)
    {
        $this->routeLock = $routeLock;

        return $this;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\RouteLock\RouteLockDto | null
     */
    public function getRouteLock()
    {
        return $this->routeLock;
    }

    /**
     * @param mixed | null $id
     *
     * @return static
     */
    public function setRouteLockId($id)
    {
        $value = !is_null($id)
            ? new \Ivoz\Provider\Domain\Model\RouteLock\RouteLockDto($id)
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
