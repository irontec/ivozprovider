<?php

namespace Ivoz\Provider\Domain\Model\MusicOnHold;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;
use Ivoz\Core\Domain\Service\FileContainerInterface;
use Ivoz\Core\Domain\Service\TempFile;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Domain\DataTransferObjectInterface;
use Ivoz\Core\Domain\ForeignKeyTransformerInterface;
use Ivoz\Provider\Domain\Model\Brand\BrandInterface;

/**
* MusicOnHoldInterface
*/
interface MusicOnHoldInterface extends LoggableEntityInterface, FileContainerInterface
{
    public const STATUS_PENDING = 'pending';

    public const STATUS_ENCODING = 'encoding';

    public const STATUS_READY = 'ready';

    public const STATUS_ERROR = 'error';

    /**
     * @codeCoverageIgnore
     * @return array<string, mixed>
     */
    public function getChangeSet(): array;

    /**
     * @return array
     */
    public function getFileObjects(?int $filter = null): array;

    /**
     * Get id
     * @codeCoverageIgnore
     * @return integer
     */
    public function getId(): ?int;

    /**
     * @return string
     */
    public function getOwner();

    /**
     * Add TempFile and set status to pending
     *
     * @param string $fldName
     * @param \Ivoz\Core\Domain\Service\TempFile $file
     *
     * @return void
     */
    public function addTmpFile(string $fldName, TempFile $file);

    public function setCompany(?CompanyInterface $company = null): static;

    /**
     * @param int | null $id
     */
    public static function createDto($id = null): MusicOnHoldDto;

    /**
     * @internal use EntityTools instead
     * @param null|MusicOnHoldInterface $entity
     */
    public static function entityToDto(?EntityInterface $entity, int $depth = 0): ?MusicOnHoldDto;

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param MusicOnHoldDto $dto
     */
    public static function fromDto(DataTransferObjectInterface $dto, ForeignKeyTransformerInterface $fkTransformer): static;

    /**
     * @internal use EntityTools instead
     */
    public function toDto(int $depth = 0): MusicOnHoldDto;

    public function getName(): string;

    public function getStatus(): ?string;

    public function getOriginalFile(): OriginalFile;

    public function getEncodedFile(): EncodedFile;

    public function setBrand(?BrandInterface $brand = null): static;

    public function getBrand(): ?BrandInterface;

    public function getCompany(): ?CompanyInterface;

    /**
     * @throws \Exception
     * @return void
     */
    public function removeTmpFile(TempFile $file);

    /**
     * @return \Ivoz\Core\Domain\Service\TempFile[]
     */
    public function getTempFiles();

    /**
     * @param string $fldName
     * @return null | \Ivoz\Core\Domain\Service\TempFile
     */
    public function getTempFileByFieldName($fldName);
}
