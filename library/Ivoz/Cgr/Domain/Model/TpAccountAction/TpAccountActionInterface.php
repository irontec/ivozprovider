<?php

namespace Ivoz\Cgr\Domain\Model\TpAccountAction;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use Ivoz\Provider\Domain\Model\Carrier\CarrierInterface;

/**
* TpAccountActionInterface
*/
interface TpAccountActionInterface extends LoggableEntityInterface
{
    /**
     * Get id
     * @codeCoverageIgnore
     * @return integer
     */
    public function getId(): ?int;

    /**
     * @codeCoverageIgnore
     * @return array<string, mixed>
     */
    public function getChangeSet(): array;

    public static function createDto(string|int|null $id = null): TpAccountActionDto;

    /**
     * @internal use EntityTools instead
     * @param null|TpAccountActionInterface $entity
     */
    public static function entityToDto(?EntityInterface $entity, int $depth = 0): ?TpAccountActionDto;

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param TpAccountActionDto $dto
     */
    public static function fromDto(DataTransferObjectInterface $dto, ForeignKeyTransformerInterface $fkTransformer): static;

    /**
     * @internal use EntityTools instead
     */
    public function toDto(int $depth = 0): TpAccountActionDto;

    public function getTpid(): string;

    public function getLoadid(): string;

    public function getTenant(): string;

    public function getAccount(): string;

    public function getActionPlanTag(): ?string;

    public function getActionTriggersTag(): ?string;

    public function getAllowNegative(): bool;

    public function getDisabled(): bool;

    public function getCreatedAt(): \DateTime;

    public function getCompany(): ?CompanyInterface;

    public function getCarrier(): ?CarrierInterface;

    public function isInitialized(): bool;
}
