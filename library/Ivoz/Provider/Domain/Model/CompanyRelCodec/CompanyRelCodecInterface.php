<?php

namespace Ivoz\Provider\Domain\Model\CompanyRelCodec;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Domain\DataTransferObjectInterface;
use Ivoz\Core\Domain\ForeignKeyTransformerInterface;
use Ivoz\Provider\Domain\Model\Codec\CodecInterface;

/**
* CompanyRelCodecInterface
*/
interface CompanyRelCodecInterface extends LoggableEntityInterface
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

    public function setCompany(?CompanyInterface $company = null): static;

    /**
     * @param int | null $id
     */
    public static function createDto($id = null): CompanyRelCodecDto;

    /**
     * @internal use EntityTools instead
     * @param null|CompanyRelCodecInterface $entity
     */
    public static function entityToDto(?EntityInterface $entity, int $depth = 0): ?CompanyRelCodecDto;

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param CompanyRelCodecDto $dto
     */
    public static function fromDto(DataTransferObjectInterface $dto, ForeignKeyTransformerInterface $fkTransformer): static;

    /**
     * @internal use EntityTools instead
     */
    public function toDto(int $depth = 0): CompanyRelCodecDto;

    public function getCompany(): ?CompanyInterface;

    public function getCodec(): CodecInterface;
}
