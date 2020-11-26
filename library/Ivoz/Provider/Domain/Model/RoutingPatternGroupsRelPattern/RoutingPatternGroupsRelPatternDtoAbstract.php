<?php

namespace Ivoz\Provider\Domain\Model\RoutingPatternGroupsRelPattern;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\Model\DtoNormalizer;
use Ivoz\Provider\Domain\Model\RoutingPattern\RoutingPatternDto;
use Ivoz\Provider\Domain\Model\RoutingPatternGroup\RoutingPatternGroupDto;

/**
* RoutingPatternGroupsRelPatternDtoAbstract
* @codeCoverageIgnore
*/
abstract class RoutingPatternGroupsRelPatternDtoAbstract implements DataTransferObjectInterface
{
    use DtoNormalizer;

    /**
     * @var int
     */
    private $id;

    /**
     * @var RoutingPatternDto | null
     */
    private $routingPattern;

    /**
     * @var RoutingPatternGroupDto | null
     */
    private $routingPatternGroup;

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
            'routingPatternId' => 'routingPattern',
            'routingPatternGroupId' => 'routingPatternGroup'
        ];
    }

    /**
    * @return array
    */
    public function toArray($hideSensitiveData = false)
    {
        $response = [
            'id' => $this->getId(),
            'routingPattern' => $this->getRoutingPattern(),
            'routingPatternGroup' => $this->getRoutingPatternGroup()
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
     * @param RoutingPatternDto | null
     *
     * @return static
     */
    public function setRoutingPattern(?RoutingPatternDto $routingPattern = null): self
    {
        $this->routingPattern = $routingPattern;

        return $this;
    }

    /**
     * @return RoutingPatternDto | null
     */
    public function getRoutingPattern(): ?RoutingPatternDto
    {
        return $this->routingPattern;
    }

    /**
     * @return static
     */
    public function setRoutingPatternId($id): self
    {
        $value = !is_null($id)
            ? new RoutingPatternDto($id)
            : null;

        return $this->setRoutingPattern($value);
    }

    /**
     * @return mixed | null
     */
    public function getRoutingPatternId()
    {
        if ($dto = $this->getRoutingPattern()) {
            return $dto->getId();
        }

        return null;
    }

    /**
     * @param RoutingPatternGroupDto | null
     *
     * @return static
     */
    public function setRoutingPatternGroup(?RoutingPatternGroupDto $routingPatternGroup = null): self
    {
        $this->routingPatternGroup = $routingPatternGroup;

        return $this;
    }

    /**
     * @return RoutingPatternGroupDto | null
     */
    public function getRoutingPatternGroup(): ?RoutingPatternGroupDto
    {
        return $this->routingPatternGroup;
    }

    /**
     * @return static
     */
    public function setRoutingPatternGroupId($id): self
    {
        $value = !is_null($id)
            ? new RoutingPatternGroupDto($id)
            : null;

        return $this->setRoutingPatternGroup($value);
    }

    /**
     * @return mixed | null
     */
    public function getRoutingPatternGroupId()
    {
        if ($dto = $this->getRoutingPatternGroup()) {
            return $dto->getId();
        }

        return null;
    }

}
