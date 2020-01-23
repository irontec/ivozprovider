<?php

namespace Ivoz\Provider\Domain\Model\RoutingPatternGroupsRelPattern;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;

/**
 * RoutingPatternGroupsRelPatternAbstract
 * @codeCoverageIgnore
 */
abstract class RoutingPatternGroupsRelPatternAbstract
{
    /**
     * @var \Ivoz\Provider\Domain\Model\RoutingPattern\RoutingPatternInterface | null
     */
    protected $routingPattern;

    /**
     * @var \Ivoz\Provider\Domain\Model\RoutingPatternGroup\RoutingPatternGroupInterface | null
     */
    protected $routingPatternGroup;


    use ChangelogTrait;

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
     * @param null $id
     * @return RoutingPatternGroupsRelPatternDto
     */
    public static function createDto($id = null)
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
        $dto = $entity->toDto($depth-1);

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
        \Ivoz\Core\Application\ForeignKeyTransformerInterface $fkTransformer
    ) {
        Assertion::isInstanceOf($dto, RoutingPatternGroupsRelPatternDto::class);

        $self = new static();

        $self
            ->setRoutingPattern($fkTransformer->transform($dto->getRoutingPattern()))
            ->setRoutingPatternGroup($fkTransformer->transform($dto->getRoutingPatternGroup()))
        ;

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
        \Ivoz\Core\Application\ForeignKeyTransformerInterface $fkTransformer
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
     * @return RoutingPatternGroupsRelPatternDto
     */
    public function toDto($depth = 0)
    {
        return self::createDto()
            ->setRoutingPattern(\Ivoz\Provider\Domain\Model\RoutingPattern\RoutingPattern::entityToDto(self::getRoutingPattern(), $depth))
            ->setRoutingPatternGroup(\Ivoz\Provider\Domain\Model\RoutingPatternGroup\RoutingPatternGroup::entityToDto(self::getRoutingPatternGroup(), $depth));
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
    // @codeCoverageIgnoreStart

    /**
     * Set routingPattern
     *
     * @param \Ivoz\Provider\Domain\Model\RoutingPattern\RoutingPatternInterface $routingPattern | null
     *
     * @return static
     */
    public function setRoutingPattern(\Ivoz\Provider\Domain\Model\RoutingPattern\RoutingPatternInterface $routingPattern = null)
    {
        $this->routingPattern = $routingPattern;

        return $this;
    }

    /**
     * Get routingPattern
     *
     * @return \Ivoz\Provider\Domain\Model\RoutingPattern\RoutingPatternInterface | null
     */
    public function getRoutingPattern()
    {
        return $this->routingPattern;
    }

    /**
     * Set routingPatternGroup
     *
     * @param \Ivoz\Provider\Domain\Model\RoutingPatternGroup\RoutingPatternGroupInterface $routingPatternGroup | null
     *
     * @return static
     */
    public function setRoutingPatternGroup(\Ivoz\Provider\Domain\Model\RoutingPatternGroup\RoutingPatternGroupInterface $routingPatternGroup = null)
    {
        $this->routingPatternGroup = $routingPatternGroup;

        return $this;
    }

    /**
     * Get routingPatternGroup
     *
     * @return \Ivoz\Provider\Domain\Model\RoutingPatternGroup\RoutingPatternGroupInterface | null
     */
    public function getRoutingPatternGroup()
    {
        return $this->routingPatternGroup;
    }

    // @codeCoverageIgnoreEnd
}
