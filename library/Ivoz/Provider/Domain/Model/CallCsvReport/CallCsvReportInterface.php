<?php

namespace Ivoz\Provider\Domain\Model\CallCsvReport;

use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use Ivoz\Provider\Domain\Model\Brand\BrandInterface;
use Ivoz\Provider\Domain\Model\CallCsvScheduler\CallCsvSchedulerInterface;
use Ivoz\Core\Domain\Service\TempFile;
use Ivoz\Core\Domain\Model\LoggableEntityInterface;
use Ivoz\Core\Domain\Service\FileContainerInterface;

/**
* CallCsvReportInterface
*/
interface CallCsvReportInterface extends LoggableEntityInterface, FileContainerInterface
{
    /**
     * @codeCoverageIgnore
     * @return array
     */
    public function getChangeSet();

    /**
     * @return array
     */
    public function getFileObjects(int $filter = null);

    /**
     * @return \Ivoz\Provider\Domain\Model\Timezone\TimezoneInterface
     */
    public function getTimezone();

    /**
     * Get sentTo
     *
     * @return string
     */
    public function getSentTo(): string;

    /**
     * Get inDate
     *
     * @return \DateTimeInterface
     */
    public function getInDate(): \DateTimeInterface;

    /**
     * Get outDate
     *
     * @return \DateTimeInterface
     */
    public function getOutDate(): \DateTimeInterface;

    /**
     * Get createdOn
     *
     * @return \DateTimeInterface
     */
    public function getCreatedOn(): \DateTimeInterface;

    /**
     * Get csv
     *
     * @return Csv
     */
    public function getCsv(): Csv;

    /**
     * Get company
     *
     * @return CompanyInterface | null
     */
    public function getCompany(): ?CompanyInterface;

    /**
     * Get brand
     *
     * @return BrandInterface | null
     */
    public function getBrand(): ?BrandInterface;

    /**
     * Get callCsvScheduler
     *
     * @return CallCsvSchedulerInterface | null
     */
    public function getCallCsvScheduler(): ?CallCsvSchedulerInterface;

    /**
     * @return bool
     */
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
