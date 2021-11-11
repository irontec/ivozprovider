<?php

namespace Ivoz\Cgr\Domain\Model\TpCdr;

use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;

/**
* TpCdrInterface
*/
interface TpCdrInterface extends EntityInterface
{
    /**
     * Get id
     * @codeCoverageIgnore
     * @return integer
     */
    public function getId(): ?int;

    public function getDuration(): ?float;

    /**
     * @return array|null
     */
    public function getCostDetailsFirstTimespan();

    /**
     * @return \DateTime | null
     */
    public function getStartTime();

    /**
     * @return string
     */
    public function getRatingPlanTag(): string;

    /**
     * @return string
     */
    public function getMatchedDestinationTag(): string;

    public static function createDto(string|int|null $id = null): TpCdrDto;

    /**
     * @internal use EntityTools instead
     * @param null|TpCdrInterface $entity
     */
    public static function entityToDto(?EntityInterface $entity, int $depth = 0): ?TpCdrDto;

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param TpCdrDto $dto
     */
    public static function fromDto(DataTransferObjectInterface $dto, ForeignKeyTransformerInterface $fkTransformer): static;

    /**
     * @internal use EntityTools instead
     */
    public function toDto(int $depth = 0): TpCdrDto;

    public function getCgrid(): string;

    public function getRunId(): string;

    public function getOriginHost(): string;

    public function getSource(): string;

    public function getOriginId(): string;

    public function getTor(): string;

    public function getRequestType(): string;

    public function getTenant(): string;

    public function getCategory(): string;

    public function getAccount(): string;

    public function getSubject(): string;

    public function getDestination(): string;

    /**
     * @return \DateTime|\DateTimeImmutable
     */
    public function getSetupTime(): \DateTimeInterface;

    /**
     * @return \DateTime|\DateTimeImmutable
     */
    public function getAnswerTime(): \DateTimeInterface;

    public function getUsage(): int;

    public function getExtraFields(): string;

    public function getCostSource(): string;

    public function getCost(): float;

    public function getCostDetails(): array;

    public function getExtraInfo(): string;

    /**
     * @return \DateTime|\DateTimeImmutable
     */
    public function getCreatedAt(): ?\DateTimeInterface;

    /**
     * @return \DateTime|\DateTimeImmutable
     */
    public function getUpdatedAt(): ?\DateTimeInterface;

    /**
     * @return \DateTime|\DateTimeImmutable
     */
    public function getDeletedAt(): ?\DateTimeInterface;

    public function isInitialized(): bool;
}
