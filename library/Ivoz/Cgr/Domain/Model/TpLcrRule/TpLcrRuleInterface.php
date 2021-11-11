<?php

namespace Ivoz\Cgr\Domain\Model\TpLcrRule;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Provider\Domain\Model\OutgoingRouting\OutgoingRoutingInterface;

/**
* TpLcrRuleInterface
*/
interface TpLcrRuleInterface extends LoggableEntityInterface
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

    public static function createDto(string|int|null $id = null): TpLcrRuleDto;

    /**
     * @internal use EntityTools instead
     * @param null|TpLcrRuleInterface $entity
     */
    public static function entityToDto(?EntityInterface $entity, int $depth = 0): ?TpLcrRuleDto;

    /**
     * Factory method
     * @internal use EntityTools instead
     */
    public static function fromDto(DataTransferObjectInterface $dto, ForeignKeyTransformerInterface $fkTransformer): static;

    /**
     * @internal use EntityTools instead
     */
    public function toDto(int $depth = 0): TpLcrRuleDto;

    public function getTpid(): string;

    public function getDirection(): string;

    public function getTenant(): string;

    public function getCategory(): string;

    public function getAccount(): string;

    public function getSubject(): ?string;

    public function getDestinationTag(): ?string;

    public function getRpCategory(): string;

    public function getStrategy(): string;

    public function getStrategyParams(): ?string;

    /**
     * @return \DateTime|\DateTimeImmutable
     */
    public function getActivationTime(): \DateTimeInterface;

    public function getWeight(): float;

    /**
     * @return \DateTime|\DateTimeImmutable
     */
    public function getCreatedAt(): \DateTimeInterface;

    public function setOutgoingRouting(?OutgoingRoutingInterface $outgoingRouting = null): static;

    public function getOutgoingRouting(): ?OutgoingRoutingInterface;

    public function isInitialized(): bool;
}
