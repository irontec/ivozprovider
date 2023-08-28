<?php

namespace Ivoz\Provider\Domain\Model\Feature;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Domain\DataTransferObjectInterface;
use Ivoz\Core\Domain\ForeignKeyTransformerInterface;

/**
* FeatureInterface
*/
interface FeatureInterface extends LoggableEntityInterface
{
    public const QUEUES_IDEN = 'queues';
    public const RECORDINGS_IDEN = 'recordings';
    public const FAXES_IDEN = 'faxes';
    public const FRIENDS_IDEN = 'friends';
    public const CONFERENCES_IDEN = 'conferences';
    public const BILLING_IDEN = 'billing';
    public const INVOICES_IDEN = 'invoices';
    public const PROGRESS_IDEN = 'progress';
    public const RESIDENTIAL_IDEN = 'residential';
    public const WHOLESALE_IDEN = 'wholesale';
    public const RETAIL_IDEN = 'retail';
    public const VPBX_IDEN = 'vpbx';

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

    public static function createDto(string|int|null $id = null): FeatureDto;

    /**
     * @internal use EntityTools instead
     * @param null|FeatureInterface $entity
     */
    public static function entityToDto(?EntityInterface $entity, int $depth = 0): ?FeatureDto;

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param FeatureDto $dto
     */
    public static function fromDto(DataTransferObjectInterface $dto, ForeignKeyTransformerInterface $fkTransformer): static;

    /**
     * @internal use EntityTools instead
     */
    public function toDto(int $depth = 0): FeatureDto;

    public function getIden(): string;

    public function getName(): Name;
}
