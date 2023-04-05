<?php

namespace Ivoz\Kam\Domain\Model\TrunksLcrRule;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;
use Ivoz\Provider\Domain\Model\OutgoingRouting\OutgoingRoutingInterface;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Domain\DataTransferObjectInterface;
use Ivoz\Core\Domain\ForeignKeyTransformerInterface;
use Ivoz\Provider\Domain\Model\RoutingPattern\RoutingPatternInterface;
use Ivoz\Provider\Domain\Model\RoutingPatternGroupsRelPattern\RoutingPatternGroupsRelPatternInterface;

/**
* TrunksLcrRuleInterface
*/
interface TrunksLcrRuleInterface extends LoggableEntityInterface
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
     * Return LcrRule FromUri string based on OutgoingRouting configuration
     *
     * @param \Ivoz\Provider\Domain\Model\OutgoingRouting\OutgoingRoutingInterface $outgoingRouting
     * @return string
     */
    public static function getFromUriForOutgoingRouting(OutgoingRoutingInterface $outgoingRouting): string;

    public static function createDto(string|int|null $id = null): TrunksLcrRuleDto;

    /**
     * @internal use EntityTools instead
     * @param null|TrunksLcrRuleInterface $entity
     */
    public static function entityToDto(?EntityInterface $entity, int $depth = 0): ?TrunksLcrRuleDto;

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param TrunksLcrRuleDto $dto
     */
    public static function fromDto(DataTransferObjectInterface $dto, ForeignKeyTransformerInterface $fkTransformer): static;

    /**
     * @internal use EntityTools instead
     */
    public function toDto(int $depth = 0): TrunksLcrRuleDto;

    public function getLcrId(): int;

    public function getPrefix(): ?string;

    public function getFromUri(): ?string;

    public function getRequestUri(): ?string;

    public function getMtTvalue(): ?string;

    public function getStopper(): int;

    public function getEnabled(): int;

    public function setRoutingPattern(?RoutingPatternInterface $routingPattern = null): static;

    public function getRoutingPattern(): ?RoutingPatternInterface;

    public function getRoutingPatternGroupsRelPattern(): ?RoutingPatternGroupsRelPatternInterface;

    public function setOutgoingRouting(OutgoingRoutingInterface $outgoingRouting): static;

    public function getOutgoingRouting(): OutgoingRoutingInterface;
}
