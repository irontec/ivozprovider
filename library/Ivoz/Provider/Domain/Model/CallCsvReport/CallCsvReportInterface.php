<?php

namespace Ivoz\Provider\Domain\Model\CallCsvReport;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;
use Ivoz\Core\Domain\Service\FileContainerInterface;
use Ivoz\Provider\Domain\Model\Timezone\TimezoneInterface;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use Ivoz\Provider\Domain\Model\Brand\BrandInterface;
use Ivoz\Provider\Domain\Model\CallCsvScheduler\CallCsvSchedulerInterface;
use Ivoz\Core\Domain\Service\TempFile;

/**
* CallCsvReportInterface
*/
interface CallCsvReportInterface extends LoggableEntityInterface, FileContainerInterface
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

    /**
     * @return array
     */
    public function getFileObjects(?int $filter = null): array;

    public function getTimezone(): ?TimezoneInterface;

    public static function createDto(string|int|null $id = null): CallCsvReportDto;

    /**
     * @internal use EntityTools instead
     * @param null|CallCsvReportInterface $entity
     */
    public static function entityToDto(?EntityInterface $entity, int $depth = 0): ?CallCsvReportDto;

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param CallCsvReportDto $dto
     */
    public static function fromDto(DataTransferObjectInterface $dto, ForeignKeyTransformerInterface $fkTransformer): static;

    /**
     * @internal use EntityTools instead
     */
    public function toDto(int $depth = 0): CallCsvReportDto;

    public function getSentTo(): string;

    public function getInDate(): \DateTime;

    public function getOutDate(): \DateTime;

    public function getCreatedOn(): \DateTime;

    public function getCsv(): Csv;

    public function getCompany(): ?CompanyInterface;

    public function getBrand(): ?BrandInterface;

    public function getCallCsvScheduler(): ?CallCsvSchedulerInterface;

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
     * @var string $fldName
     * @return null | \Ivoz\Core\Domain\Service\TempFile
     */
    public function getTempFileByFieldName($fldName);
}
