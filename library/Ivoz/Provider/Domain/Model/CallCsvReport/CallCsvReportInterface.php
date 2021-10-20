<?php

namespace Ivoz\Provider\Domain\Model\CallCsvReport;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;
use Ivoz\Core\Domain\Service\FileContainerInterface;
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
     * @return array
     */
    public function getChangeSet(): array;

    /**
     * @return array
     */
    public function getFileObjects(?int $filter = null): array;

    /**
     * @return \Ivoz\Provider\Domain\Model\Timezone\TimezoneInterface
     */
    public function getTimezone();

    public function getSentTo(): string;

    /**
     * @return \DateTime|\DateTimeImmutable
     */
    public function getInDate(): \DateTimeInterface;

    /**
     * @return \DateTime|\DateTimeImmutable
     */
    public function getOutDate(): \DateTimeInterface;

    /**
     * @return \DateTime|\DateTimeImmutable
     */
    public function getCreatedOn(): \DateTimeInterface;

    public function getCsv(): Csv;

    public function getCompany(): ?CompanyInterface;

    public function getBrand(): ?BrandInterface;

    public function getCallCsvScheduler(): ?CallCsvSchedulerInterface;

    public function isInitialized(): bool;

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
