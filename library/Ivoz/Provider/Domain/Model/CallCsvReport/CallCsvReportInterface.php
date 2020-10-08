<?php

namespace Ivoz\Provider\Domain\Model\CallCsvReport;

use Ivoz\Core\Domain\Service\FileContainerInterface;
use Ivoz\Core\Domain\Model\LoggableEntityInterface;

interface CallCsvReportInterface extends FileContainerInterface, LoggableEntityInterface
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
     * @return \DateTime
     */
    public function getInDate(): \DateTime;

    /**
     * Get outDate
     *
     * @return \DateTime
     */
    public function getOutDate(): \DateTime;

    /**
     * Get createdOn
     *
     * @return \DateTime
     */
    public function getCreatedOn(): \DateTime;

    /**
     * Get company
     *
     * @return \Ivoz\Provider\Domain\Model\Company\CompanyInterface | null
     */
    public function getCompany();

    /**
     * Get brand
     *
     * @return \Ivoz\Provider\Domain\Model\Brand\BrandInterface | null
     */
    public function getBrand();

    /**
     * Get callCsvScheduler
     *
     * @return \Ivoz\Provider\Domain\Model\CallCsvScheduler\CallCsvSchedulerInterface | null
     */
    public function getCallCsvScheduler();

    /**
     * Get csv
     *
     * @return \Ivoz\Provider\Domain\Model\CallCsvReport\Csv
     */
    public function getCsv();

    /**
     * @return bool
     */
    public function isInitialized(): bool;

    /**
     * @param string $fldName
     * @param \Ivoz\Core\Domain\Service\TempFile $file
     *
     * @return void
     */
    public function addTmpFile(string $fldName, \Ivoz\Core\Domain\Service\TempFile $file);

    /**
     * @param \Ivoz\Core\Domain\Service\TempFile $file
     *
     * @throws \Exception
     *
     * @return void
     */
    public function removeTmpFile(\Ivoz\Core\Domain\Service\TempFile $file);

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
