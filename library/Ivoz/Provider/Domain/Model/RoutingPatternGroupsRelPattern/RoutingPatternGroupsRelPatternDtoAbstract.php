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

    public function setId($id): static
    {
        $this->id = $id;

        return $this;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setRoutingPattern(?RoutingPatternDto $routingPattern): static
    {
        $this->routingPattern = $routingPattern;

        return $this;
    }

    public function getRoutingPattern(): ?RoutingPatternDto
    {
        return $this->routingPattern;
    }

    public function setRoutingPatternId($id): static
    {
        $value = !is_null($id)
            ? new RoutingPatternDto($id)
            : null;

        return $this->setRoutingPattern($value);
    }

    public function getRoutingPatternId()
    {
        if ($dto = $this->getRoutingPattern()) {
            return $dto->getId();
        }

        return null;
    }

    public function setRoutingPatternGroup(?RoutingPatternGroupDto $routingPatternGroup): static
    {
        $this->routingPatternGroup = $routingPatternGroup;

        return $this;
    }

    public function getRoutingPatternGroup(): ?RoutingPatternGroupDto
    {
        return $this->routingPatternGroup;
    }

    public function setRoutingPatternGroupId($id): static
    {
        $value = !is_null($id)
            ? new RoutingPatternGroupDto($id)
            : null;

        return $this->setRoutingPatternGroup($value);
    }

    public function getRoutingPatternGroupId()
    {
        if ($dto = $this->getRoutingPatternGroup()) {
            return $dto->getId();
        }

        return null;
    }
}
