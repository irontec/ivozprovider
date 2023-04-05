<?php

namespace Ivoz\Provider\Domain\Model\Recording;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;
use Ivoz\Core\Domain\Service\FileContainerInterface;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Domain\DataTransferObjectInterface;
use Ivoz\Core\Domain\ForeignKeyTransformerInterface;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use Ivoz\Core\Domain\Service\TempFile;

/**
* RecordingInterface
*/
interface RecordingInterface extends LoggableEntityInterface, FileContainerInterface
{
    public const TYPE_ONDEMAND = 'ondemand';

    public const TYPE_DDI = 'ddi';

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

    public static function createDto(string|int|null $id = null): RecordingDto;

    /**
     * @internal use EntityTools instead
     * @param null|RecordingInterface $entity
     */
    public static function entityToDto(?EntityInterface $entity, int $depth = 0): ?RecordingDto;

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param RecordingDto $dto
     */
    public static function fromDto(DataTransferObjectInterface $dto, ForeignKeyTransformerInterface $fkTransformer): static;

    /**
     * @internal use EntityTools instead
     */
    public function toDto(int $depth = 0): RecordingDto;

    public function getCallid(): ?string;

    public function getCalldate(): \DateTime;

    public function getType(): string;

    public function getDuration(): float;

    public function getCaller(): ?string;

    public function getCallee(): ?string;

    public function getRecorder(): ?string;

    public function getRecordedFile(): RecordedFile;

    public function setCompany(CompanyInterface $company): static;

    public function getCompany(): CompanyInterface;

    /**
     * @return void
     */
    public function addTmpFile(string $fldName, TempFile $file);

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
