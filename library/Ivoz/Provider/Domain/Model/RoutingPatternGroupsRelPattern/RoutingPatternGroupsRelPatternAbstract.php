<?php

declare(strict_types=1);

namespace Ivoz\Provider\Domain\Model\RoutingPatternGroupsRelPattern;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Provider\Domain\Model\RoutingPattern\RoutingPatternInterface;
use Ivoz\Provider\Domain\Model\RoutingPatternGroup\RoutingPatternGroupInterface;
use Ivoz\Provider\Domain\Model\RoutingPattern\RoutingPattern;
use Ivoz\Provider\Domain\Model\RoutingPatternGroup\RoutingPatternGroup;

/**
* RoutingPatternGroupsRelPatternAbstract
* @codeCoverageIgnore
*/
abstract class RoutingPatternGroupsRelPatternAbstract
{
    use ChangelogTrait;

    /**
     * @var RoutingPatternInterface | null
     * inversedBy relPatternGroups
     */
    protected $routingPattern;

    /**
     * @var RoutingPatternGroupInterface | null
     * inversedBy relPatterns
     */
    protected $routingPatternGroup;

    /**
     * Constructor
     */
    protected function __construct()
    {
    }

    abstract public function getId();

    public function __toString()
    {
        return sprintf(
            "%s#%s",
            "RoutingPatternGroupsRelPattern",
            $this->getId()
        );
    }

    /**
     * @return void
     * @throws \Exception
     */
    protected function sanitizeValues()
    {
    }

    /**
     * @param mixed $id
     */
    public static function createDto($id = null): RoutingPatternGroupsRelPatternDto
    {
        return new RoutingPatternGroupsRelPatternDto($id);
    }

    /**
     * @internal use EntityTools instead
     * @param RoutingPatternGroupsRelPatternInterface|null $entity
     * @param int $depth
     * @return RoutingPatternGroupsRelPatternDto|null
     */
    public static function entityToDto(EntityInterface $entity = null, $depth = 0)
    {
        if (!$entity) {
            return null;
        }

        Assertion::isInstanceOf($entity, RoutingPatternGroupsRelPatternInterface::class);

        if ($depth < 1) {
            return static::createDto($entity->getId());
        }

        if ($entity instanceof \Doctrine\ORM\Proxy\Proxy && !$entity->__isInitialized()) {
            return static::createDto($entity->getId());
        }

        /** @var RoutingPatternGroupsRelPatternDto $dto */
        $dto = $entity->toDto($depth - 1);

        return $dto;
    }

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param RoutingPatternGroupsRelPatternDto $dto
     * @return self
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ) {
        Assertion::isInstanceOf($dto, RoutingPatternGroupsRelPatternDto::class);

        $self = new static();

        $self
            ->setRoutingPattern($fkTransformer->transform($dto->getRoutingPattern()))
            ->setRoutingPatternGroup($fkTransformer->transform($dto->getRoutingPatternGroup()));

        $self->initChangelog();

        return $self;
    }

    /**
     * @internal use EntityTools instead
     * @param RoutingPatternGroupsRelPatternDto $dto
     * @return self
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ) {
        Assertion::isInstanceOf($dto, RoutingPatternGroupsRelPatternDto::class);

        $this
            ->setRoutingPattern($fkTransformer->transform($dto->getRoutingPattern()))
            ->setRoutingPatternGroup($fkTransformer->transform($dto->getRoutingPatternGroup()));

        return $this;
    }

    /**
     * @internal use EntityTools instead
     * @param int $depth
     */
    public function toDto($depth = 0): RoutingPatternGroupsRelPatternDto
    {
        return self::createDto()
            ->setRoutingPattern(RoutingPattern::entityToDto(self::getRoutingPattern(), $depth))
            ->setRoutingPatternGroup(RoutingPatternGroup::entityToDto(self::getRoutingPatternGroup(), $depth));
    }

    /**
     * @return array
     */
    protected function __toArray()
    {
        return [
            'routingPatternId' => self::getRoutingPattern() ? self::getRoutingPattern()->getId() : null,
            'routingPatternGroupId' => self::getRoutingPatternGroup() ? self::getRoutingPatternGroup()->getId() : null
        ];
    }

    public function setRoutingPattern(?RoutingPatternInterface $routingPattern = null): static
    {
        $this->routingPattern = $routingPattern;

        /** @var  $this */
        return $this;
    }

    public function getRoutingPattern(): ?RoutingPatternInterface
    {
        return $this->routingPattern;
    }

    public function setRoutingPatternGroup(?RoutingPatternGroupInterface $routingPatternGroup = null): static
    {
        $this->routingPatternGroup = $routingPatternGroup;

        /** @var  $this */
        return $this;
    }

    public function getRoutingPatternGroup(): ?RoutingPatternGroupInterface
    {
        return $this->routingPatternGroup;
    }
}
