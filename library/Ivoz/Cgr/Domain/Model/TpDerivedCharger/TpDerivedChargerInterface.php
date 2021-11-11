<?php

namespace Ivoz\Cgr\Domain\Model\TpDerivedCharger;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Provider\Domain\Model\Brand\BrandInterface;

/**
* TpDerivedChargerInterface
*/
interface TpDerivedChargerInterface extends LoggableEntityInterface
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

    public static function createDto(string|int|null $id = null): TpDerivedChargerDto;

    /**
     * @internal use EntityTools instead
     * @param null|TpDerivedChargerInterface $entity
     */
    public static function entityToDto(?EntityInterface $entity, int $depth = 0): ?TpDerivedChargerDto;

    /**
     * Factory method
     * @internal use EntityTools instead
     */
    public static function fromDto(DataTransferObjectInterface $dto, ForeignKeyTransformerInterface $fkTransformer): static;

    /**
     * @internal use EntityTools instead
     */
    public function toDto(int $depth = 0): TpDerivedChargerDto;

    public function getTpid(): string;

    public function getLoadid(): string;

    public function getDirection(): string;

    public function getTenant(): string;

    public function getCategory(): string;

    public function getAccount(): string;

    public function getSubject(): ?string;

    public function getDestinationIds(): ?string;

    public function getRunid(): string;

    public function getRunFilters(): string;

    public function getReqTypeField(): string;

    public function getDirectionField(): string;

    public function getTenantField(): string;

    public function getCategoryField(): string;

    public function getAccountField(): string;

    public function getSubjectField(): string;

    public function getDestinationField(): string;

    public function getSetupTimeField(): string;

    public function getPddField(): string;

    public function getAnswerTimeField(): string;

    public function getUsageField(): string;

    public function getSupplierField(): string;

    public function getDisconnectCauseField(): string;

    public function getRatedTimeField(): string;

    public function getCostField(): string;

    /**
     * @return \DateTime|\DateTimeImmutable
     */
    public function getCreatedAt(): \DateTimeInterface;

    public function getBrand(): BrandInterface;

    public function isInitialized(): bool;
}
