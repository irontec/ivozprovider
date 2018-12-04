<?php

namespace Ivoz\Provider\Domain\Model\RoutingPatternGroupsRelPattern;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\Model\DtoNormalizer;

/**
 * @codeCoverageIgnore
 */
abstract class RoutingPatternGroupsRelPatternDtoAbstract implements DataTransferObjectInterface
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var \Ivoz\Provider\Domain\Model\RoutingPattern\RoutingPatternDto | null
     */
    private $routingPattern;

    /**
     * @var \Ivoz\Provider\Domain\Model\RoutingPatternGroup\RoutingPatternGroupDto | null
     */
    private $routingPatternGroup;


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
            'id' => 'id',
            'routingPatternId' => 'routingPattern',
            'routingPatternGroupId' => 'routingPatternGroup'
        ];
    }

    /**
     * @return array
     */
    public function toArray($hideSensitiveData = false)
    {
        return [
            'id' => $this->getId(),
            'routingPattern' => $this->getRoutingPattern(),
            'routingPatternGroup' => $this->getRoutingPatternGroup()
        ];
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
     * @param \Ivoz\Provider\Domain\Model\RoutingPattern\RoutingPatternDto $routingPattern
     *
     * @return static
     */
    public function setRoutingPattern(\Ivoz\Provider\Domain\Model\RoutingPattern\RoutingPatternDto $routingPattern = null)
    {
        $this->routingPattern = $routingPattern;

        return $this;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\RoutingPattern\RoutingPatternDto
     */
    public function getRoutingPattern()
    {
        return $this->routingPattern;
    }

    /**
     * @param integer $id | null
     *
     * @return static
     */
    public function setRoutingPatternId($id)
    {
        $value = !is_null($id)
            ? new \Ivoz\Provider\Domain\Model\RoutingPattern\RoutingPatternDto($id)
            : null;

        return $this->setRoutingPattern($value);
    }

    /**
     * @return integer | null
     */
    public function getRoutingPatternId()
    {
        if ($dto = $this->getRoutingPattern()) {
            return $dto->getId();
        }

        return null;
    }

    /**
     * @param \Ivoz\Provider\Domain\Model\RoutingPatternGroup\RoutingPatternGroupDto $routingPatternGroup
     *
     * @return static
     */
    public function setRoutingPatternGroup(\Ivoz\Provider\Domain\Model\RoutingPatternGroup\RoutingPatternGroupDto $routingPatternGroup = null)
    {
        $this->routingPatternGroup = $routingPatternGroup;

        return $this;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\RoutingPatternGroup\RoutingPatternGroupDto
     */
    public function getRoutingPatternGroup()
    {
        return $this->routingPatternGroup;
    }

    /**
     * @param integer $id | null
     *
     * @return static
     */
    public function setRoutingPatternGroupId($id)
    {
        $value = !is_null($id)
            ? new \Ivoz\Provider\Domain\Model\RoutingPatternGroup\RoutingPatternGroupDto($id)
            : null;

        return $this->setRoutingPatternGroup($value);
    }

    /**
     * @return integer | null
     */
    public function getRoutingPatternGroupId()
    {
        if ($dto = $this->getRoutingPatternGroup()) {
            return $dto->getId();
        }

        return null;
    }
}
