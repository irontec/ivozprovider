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
     * @var int|null
     */
    private $priority;

    /**
     * @var string|null
     */
    private $matchExpr;

    /**
     * @var string|null
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

    public function setType(string $type): static
    {
        $this->type = $type;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setPriority(?int $priority): static
    {
        $this->priority = $priority;

        return $this;
    }

    public function getPriority(): ?int
    {
        return $this->priority;
    }

    public function setMatchExpr(?string $matchExpr): static
    {
        $this->matchExpr = $matchExpr;

        return $this;
    }

    public function getMatchExpr(): ?string
    {
        return $this->matchExpr;
    }

    public function setReplaceExpr(?string $replaceExpr): static
    {
        $this->replaceExpr = $replaceExpr;

        return $this;
    }

    public function getReplaceExpr(): ?string
    {
        return $this->replaceExpr;
    }

    public function setId($id): static
    {
        $this->id = $id;

        return $this;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setTransformationRuleSet(?TransformationRuleSetDto $transformationRuleSet): static
    {
        $this->transformationRuleSet = $transformationRuleSet;

        return $this;
    }

    public function getTransformationRuleSet(): ?TransformationRuleSetDto
    {
        return $this->transformationRuleSet;
    }

    public function setTransformationRuleSetId($id): static
    {
        $value = !is_null($id)
            ? new TransformationRuleSetDto($id)
            : null;

        return $this->setTransformationRuleSet($value);
    }

    public function getTransformationRuleSetId()
    {
        if ($dto = $this->getTransformationRuleSet()) {
            return $dto->getId();
        }

        return null;
    }
}
