<?php

namespace Ivoz\Cgr\Domain\Model\TpCdrStat;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Provider\Domain\Model\Carrier\CarrierInterface;

/**
* TpCdrStatInterface
*/
interface TpCdrStatInterface extends LoggableEntityInterface
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

    public static function createDto(string|int|null $id = null): TpCdrStatDto;

    /**
     * @internal use EntityTools instead
     * @param null|TpCdrStatInterface $entity
     */
    public static function entityToDto(?EntityInterface $entity, int $depth = 0): ?TpCdrStatDto;

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param TpCdrStatDto $dto
     */
    public static function fromDto(DataTransferObjectInterface $dto, ForeignKeyTransformerInterface $fkTransformer): static;

    /**
     * @internal use EntityTools instead
     */
    public function toDto(int $depth = 0): TpCdrStatDto;

    public function getTpid(): string;

    public function getTag(): string;

    public function getQueueLength(): int;

    public function getTimeWindow(): string;

    public function getSaveInterval(): string;

    public function getMetrics(): string;

    public function getSetupInterval(): string;

    public function getTors(): string;

    public function getCdrHosts(): string;

    public function getCdrSources(): string;

    public function getReqTypes(): string;

    public function getDirections(): string;

    public function getTenants(): string;

    public function getCategories(): string;

    public function getAccounts(): string;

    public function getSubjects(): string;

    public function getDestinationIds(): string;

    public function getPpdInterval(): string;

    public function getUsageInterval(): string;

    public function getSuppliers(): string;

    public function getDisconnectCauses(): string;

    public function getMediationRunids(): string;

    public function getRatedAccounts(): string;

    public function getRatedSubjects(): string;

    public function getCostInterval(): string;

    public function getActionTriggers(): string;

    public function getCreatedAt(): \DateTime;

    public function setCarrier(CarrierInterface $carrier): static;

    public function getCarrier(): CarrierInterface;
}
