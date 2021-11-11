<?php

namespace Ivoz\Kam\Domain\Model\TrunksLcrRuleTarget;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Kam\Domain\Model\TrunksLcrRule\TrunksLcrRuleInterface;
use Ivoz\Kam\Domain\Model\TrunksLcrGateway\TrunksLcrGatewayInterface;
use Ivoz\Provider\Domain\Model\OutgoingRouting\OutgoingRoutingInterface;

/**
* TrunksLcrRuleTargetInterface
*/
interface TrunksLcrRuleTargetInterface extends LoggableEntityInterface
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

    public static function createDto(string|int|null $id = null): TrunksLcrRuleTargetDto;

    /**
     * @internal use EntityTools instead
     * @param null|TrunksLcrRuleTargetInterface $entity
     */
    public static function entityToDto(?EntityInterface $entity, int $depth = 0): ?TrunksLcrRuleTargetDto;

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param TrunksLcrRuleTargetDto $dto
     */
    public static function fromDto(DataTransferObjectInterface $dto, ForeignKeyTransformerInterface $fkTransformer): static;

    /**
     * @internal use EntityTools instead
     */
    public function toDto(int $depth = 0): TrunksLcrRuleTargetDto;

    public function getLcrId(): int;

    public function getPriority(): int;

    public function getWeight(): int;

    public function getRule(): TrunksLcrRuleInterface;

    public function getGw(): TrunksLcrGatewayInterface;

    public function setOutgoingRouting(OutgoingRoutingInterface $outgoingRouting): static;

    public function getOutgoingRouting(): OutgoingRoutingInterface;

    public function isInitialized(): bool;
}
