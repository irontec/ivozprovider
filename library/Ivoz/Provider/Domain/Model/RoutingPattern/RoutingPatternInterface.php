<?php

namespace Ivoz\Provider\Domain\Model\RoutingPattern;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Provider\Domain\Model\Brand\BrandInterface;
use Ivoz\Provider\Domain\Model\OutgoingRouting\OutgoingRoutingInterface;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\Criteria;
use Ivoz\Provider\Domain\Model\RoutingPatternGroupsRelPattern\RoutingPatternGroupsRelPatternInterface;
use Ivoz\Kam\Domain\Model\TrunksLcrRule\TrunksLcrRuleInterface;

/**
* RoutingPatternInterface
*/
interface RoutingPatternInterface extends LoggableEntityInterface
{
    /**
     * @codeCoverageIgnore
     * @return array<string, mixed>
     */
    public function getChangeSet(): array;

    /**
     * Get id
     * @codeCoverageIgnore
     * @return integer
     */
    public function getId(): ?int;

    /**
     * {@inheritDoc}
     */
    public function setPrefix(?string $prefix = null): static;

    public static function createDto(string|int|null $id = null): RoutingPatternDto;

    /**
     * @internal use EntityTools instead
     * @param null|RoutingPatternInterface $entity
     */
    public static function entityToDto(?EntityInterface $entity, int $depth = 0): ?RoutingPatternDto;

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param RoutingPatternDto $dto
     */
    public static function fromDto(DataTransferObjectInterface $dto, ForeignKeyTransformerInterface $fkTransformer): static;

    /**
     * @internal use EntityTools instead
     */
    public function toDto(int $depth = 0): RoutingPatternDto;

    public function getPrefix(): string;

    public function getName(): Name;

    public function getDescription(): Description;

    public function getBrand(): BrandInterface;

    public function addOutgoingRouting(OutgoingRoutingInterface $outgoingRouting): RoutingPatternInterface;

    public function removeOutgoingRouting(OutgoingRoutingInterface $outgoingRouting): RoutingPatternInterface;

    /**
     * @param Collection<array-key, OutgoingRoutingInterface> $outgoingRoutings
     */
    public function replaceOutgoingRoutings(Collection $outgoingRoutings): RoutingPatternInterface;

    /**
     * @return array<array-key, OutgoingRoutingInterface>
     */
    public function getOutgoingRoutings(?Criteria $criteria = null): array;

    public function addRelPatternGroup(RoutingPatternGroupsRelPatternInterface $relPatternGroup): RoutingPatternInterface;

    public function removeRelPatternGroup(RoutingPatternGroupsRelPatternInterface $relPatternGroup): RoutingPatternInterface;

    /**
     * @param Collection<array-key, RoutingPatternGroupsRelPatternInterface> $relPatternGroups
     */
    public function replaceRelPatternGroups(Collection $relPatternGroups): RoutingPatternInterface;

    /**
     * @return array<array-key, RoutingPatternGroupsRelPatternInterface>
     */
    public function getRelPatternGroups(?Criteria $criteria = null): array;

    public function addLcrRule(TrunksLcrRuleInterface $lcrRule): RoutingPatternInterface;

    public function removeLcrRule(TrunksLcrRuleInterface $lcrRule): RoutingPatternInterface;

    /**
     * @param Collection<array-key, TrunksLcrRuleInterface> $lcrRules
     */
    public function replaceLcrRules(Collection $lcrRules): RoutingPatternInterface;

    /**
     * @return array<array-key, TrunksLcrRuleInterface>
     */
    public function getLcrRules(?Criteria $criteria = null): array;
}
