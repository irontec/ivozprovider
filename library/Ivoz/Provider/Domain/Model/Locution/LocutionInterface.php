<?php

namespace Ivoz\Provider\Domain\Model\Locution;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;
use Ivoz\Core\Domain\Service\FileContainerInterface;
use Ivoz\Core\Domain\Service\TempFile;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;

/**
* LocutionInterface
*/
interface LocutionInterface extends LoggableEntityInterface, FileContainerInterface
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
     * @codeCoverageIgnore
     * @return int
     */
    public function getId(): ?int;

    /**
     * Add TempFile and set status to pending
     *
     * @param string $fldName
     * @param \Ivoz\Core\Domain\Service\TempFile $file
     *
     * @return void
     */
    public function addTmpFile(string $fldName, TempFile $file);

    public static function createDto(string|int|null $id = null): LocutionDto;

    /**
     * @internal use EntityTools instead
     * @param null|LocutionInterface $entity
     */
    public static function entityToDto(?EntityInterface $entity, int $depth = 0): ?LocutionDto;

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param LocutionDto $dto
     */
    public static function fromDto(DataTransferObjectInterface $dto, ForeignKeyTransformerInterface $fkTransformer): static;

    /**
     * @internal use EntityTools instead
     */
    public function toDto(int $depth = 0): LocutionDto;

    public function getName(): string;

    public function getStatus(): ?string;

    public function getEncodedFile(): EncodedFile;

    public function getOriginalFile(): OriginalFile;

    public function getCompany(): CompanyInterface;

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
     * @var string $fldName
     * @return null | \Ivoz\Core\Domain\Service\TempFile
     */
    public function getTempFileByFieldName($fldName);
}
