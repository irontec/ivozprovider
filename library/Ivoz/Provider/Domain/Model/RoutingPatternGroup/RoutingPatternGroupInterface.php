<?php

namespace Ivoz\Provider\Domain\Model\RoutingPatternGroup;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;
use Doctrine\Common\Collections\Criteria;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Provider\Domain\Model\Brand\BrandInterface;
use Ivoz\Provider\Domain\Model\RoutingPatternGroupsRelPattern\RoutingPatternGroupsRelPatternInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Ivoz\Provider\Domain\Model\OutgoingRouting\OutgoingRoutingInterface;

/**
* RoutingPatternGroupInterface
*/
interface RoutingPatternGroupInterface extends LoggableEntityInterface
{
    /**
     * @codeCoverageIgnore
     * @return array
     */
    public function getChangeSet(): array;

    /**
     * Get id
     * @codeCoverageIgnore
     * @return integer
     */
    public function getId(): ?int;

    /**
     * @param Criteria|null $criteria
     *
     * @return (\Ivoz\Provider\Domain\Model\RoutingPattern\RoutingPatternInterface|null)[]
     *
     * @psalm-return list<\Ivoz\Provider\Domain\Model\RoutingPattern\RoutingPatternInterface|null>
     */
    public function getRoutingPatterns(?Criteria $criteria = null): array;

    public static function createDto(string|int|null $id = null): RoutingPatternGroupDto;

    /**
     * @internal use EntityTools instead
     * @param null|RoutingPatternGroupInterface $entity
     */
    public static function entityToDto(?EntityInterface $entity, int $depth = 0): ?RoutingPatternGroupDto;

    /**
     * Factory method
     * @internal use EntityTools instead
     */
    public static function fromDto(DataTransferObjectInterface $dto, ForeignKeyTransformerInterface $fkTransformer): static;

    /**
     * @internal use EntityTools instead
     */
    public function toDto(int $depth = 0): RoutingPatternGroupDto;

    public function getName(): string;

    public function getDescription(): ?string;

    public function getBrand(): BrandInterface;

    public function isInitialized(): bool;

    public function addRelPattern(RoutingPatternGroupsRelPatternInterface $relPattern): RoutingPatternGroupInterface;

    public function removeRelPattern(RoutingPatternGroupsRelPatternInterface $relPattern): RoutingPatternGroupInterface;

    public function replaceRelPatterns(ArrayCollection $relPatterns): RoutingPatternGroupInterface;

    public function getRelPatterns(?Criteria $criteria = null): array;

    public function addOutgoingRouting(OutgoingRoutingInterface $outgoingRouting): RoutingPatternGroupInterface;

    public function removeOutgoingRouting(OutgoingRoutingInterface $outgoingRouting): RoutingPatternGroupInterface;

    public function replaceOutgoingRoutings(ArrayCollection $outgoingRoutings): RoutingPatternGroupInterface;

    public function getOutgoingRoutings(?Criteria $criteria = null): array;
}
