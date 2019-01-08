<?php

namespace Ivoz\Provider\Domain\Model\TransformationRule;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\Model\DtoNormalizer;

/**
 * @codeCoverageIgnore
 */
abstract class TransformationRuleDtoAbstract implements DataTransferObjectInterface
{
    /**
     * @var string
     */
    private $type;

    /**
     * @var string
     */
    private $description = '';

    /**
     * @var integer
     */
    private $priority;

    /**
     * @var string
     */
    private $matchExpr;

    /**
     * @var string
     */
    private $replaceExpr;

    /**
     * @var integer
     */
    private $id;

    /**
     * @var \Ivoz\Provider\Domain\Model\TransformationRuleSet\TransformationRuleSetDto | null
     */
    private $transformationRuleSet;


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
        return [
            'type' => $this->getType(),
            'description' => $this->getDescription(),
            'priority' => $this->getPriority(),
            'matchExpr' => $this->getMatchExpr(),
            'replaceExpr' => $this->getReplaceExpr(),
            'id' => $this->getId(),
            'transformationRuleSet' => $this->getTransformationRuleSet()
        ];
    }

    /**
     * @param string $type
     *
     * @return static
     */
    public function setType($type = null)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param string $description
     *
     * @return static
     */
    public function setDescription($description = null)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
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
     * @param string $matchExpr
     *
     * @return static
     */
    public function setMatchExpr($matchExpr = null)
    {
        $this->matchExpr = $matchExpr;

        return $this;
    }

    /**
     * @return string
     */
    public function getMatchExpr()
    {
        return $this->matchExpr;
    }

    /**
     * @param string $replaceExpr
     *
     * @return static
     */
    public function setReplaceExpr($replaceExpr = null)
    {
        $this->replaceExpr = $replaceExpr;

        return $this;
    }

    /**
     * @return string
     */
    public function getReplaceExpr()
    {
        return $this->replaceExpr;
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
     * @param \Ivoz\Provider\Domain\Model\TransformationRuleSet\TransformationRuleSetDto $transformationRuleSet
     *
     * @return static
     */
    public function setTransformationRuleSet(\Ivoz\Provider\Domain\Model\TransformationRuleSet\TransformationRuleSetDto $transformationRuleSet = null)
    {
        $this->transformationRuleSet = $transformationRuleSet;

        return $this;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\TransformationRuleSet\TransformationRuleSetDto
     */
    public function getTransformationRuleSet()
    {
        return $this->transformationRuleSet;
    }

    /**
     * @param integer $id | null
     *
     * @return static
     */
    public function setTransformationRuleSetId($id)
    {
        $value = !is_null($id)
            ? new \Ivoz\Provider\Domain\Model\TransformationRuleSet\TransformationRuleSetDto($id)
            : null;

        return $this->setTransformationRuleSet($value);
    }

    /**
     * @return integer | null
     */
    public function getTransformationRuleSetId()
    {
        if ($dto = $this->getTransformationRuleSet()) {
            return $dto->getId();
        }

        return null;
    }
}
