<?php

namespace Ivoz\Provider\Domain\Model\TransformationRule;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\Model\DtoNormalizer;
use Ivoz\Provider\Domain\Model\TransformationRuleSet\TransformationRuleSetDto;

/**
* TransformationRuleDtoAbstract
* @codeCoverageIgnore
*/
abstract class TransformationRuleDtoAbstract implements DataTransferObjectInterface
{
    use DtoNormalizer;

    /**
     * @var string
     */
    private $type;

    /**
     * @var string
     */
    private $description = '';

    /**
     * @var int | null
     */
    private $priority;

    /**
     * @var string | null
     */
    private $matchExpr;

    /**
     * @var string | null
     */
    private $replaceExpr;

    /**
     * @var int
     */
    private $id;

    /**
     * @var TransformationRuleSetDto | null
     */
    private $transformationRuleSet;

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
            'type' => 'type',
            'description' => 'description',
            'priority' => 'priority',
            'matchExpr' => 'matchExpr',
            'replaceExpr' => 'replaceExpr',
            'id' => 'id',
            'transformationRuleSetId' => 'transformationRuleSet'
        ];
    }

    /**
    * @return array
    */
    public function toArray($hideSensitiveData = false)
    {
        $response = [
            'type' => $this->getType(),
            'description' => $this->getDescription(),
            'priority' => $this->getPriority(),
            'matchExpr' => $this->getMatchExpr(),
            'replaceExpr' => $this->getReplaceExpr(),
            'id' => $this->getId(),
            'transformationRuleSet' => $this->getTransformationRuleSet()
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
     * @param string $type | null
     *
     * @return static
     */
    public function setType(?string $type = null): self
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getType(): ?string
    {
        return $this->type;
    }

    /**
     * @param string $description | null
     *
     * @return static
     */
    public function setDescription(?string $description = null): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getDescription(): ?string
    {
        return $this->description;
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
     * @param string $matchExpr | null
     *
     * @return static
     */
    public function setMatchExpr(?string $matchExpr = null): self
    {
        $this->matchExpr = $matchExpr;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getMatchExpr(): ?string
    {
        return $this->matchExpr;
    }

    /**
     * @param string $replaceExpr | null
     *
     * @return static
     */
    public function setReplaceExpr(?string $replaceExpr = null): self
    {
        $this->replaceExpr = $replaceExpr;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getReplaceExpr(): ?string
    {
        return $this->replaceExpr;
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
     * @param TransformationRuleSetDto | null
     *
     * @return static
     */
    public function setTransformationRuleSet(?TransformationRuleSetDto $transformationRuleSet = null): self
    {
        $this->transformationRuleSet = $transformationRuleSet;

        return $this;
    }

    /**
     * @return TransformationRuleSetDto | null
     */
    public function getTransformationRuleSet(): ?TransformationRuleSetDto
    {
        return $this->transformationRuleSet;
    }

    /**
     * @return static
     */
    public function setTransformationRuleSetId($id): self
    {
        $value = !is_null($id)
            ? new TransformationRuleSetDto($id)
            : null;

        return $this->setTransformationRuleSet($value);
    }

    /**
     * @return mixed | null
     */
    public function getTransformationRuleSetId()
    {
        if ($dto = $this->getTransformationRuleSet()) {
            return $dto->getId();
        }

        return null;
    }

}
