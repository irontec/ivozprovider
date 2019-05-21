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
    public function getFileObjects();

    /**
     * @return \Ivoz\Provider\Domain\Model\Timezone\TimezoneInterface
     */
    public function getTimezone();

    /**
     * Get sentTo
     *
     * @return string
     */
    public function getSentTo();

    /**
     * Get inDate
     *
     * @return \DateTime
     */
    public function getInDate();

    /**
     * Get outDate
     *
     * @return \DateTime
     */
    public function getOutDate();

    /**
     * Get createdOn
     *
     * @return \DateTime
     */
    public function getCreatedOn();

    /**
     * Set company
     *
     * @param \Ivoz\Provider\Domain\Model\Company\CompanyInterface $company
     *
     * @return static
     */
    public function setCompany(\Ivoz\Provider\Domain\Model\Company\CompanyInterface $company = null);

    /**
     * Get company
     *
     * @return \Ivoz\Provider\Domain\Model\Company\CompanyInterface | null
     */
    public function getCompany();

    /**
     * Set brand
     *
     * @param \Ivoz\Provider\Domain\Model\Brand\BrandInterface $brand
     *
     * @return static
     */
    public function setBrand(\Ivoz\Provider\Domain\Model\Brand\BrandInterface $brand = null);

    /**
     * Get brand
     *
     * @return \Ivoz\Provider\Domain\Model\Brand\BrandInterface | null
     */
    public function getBrand();

    /**
     * Set callCsvScheduler
     *
     * @param \Ivoz\Provider\Domain\Model\CallCsvScheduler\CallCsvSchedulerInterface $callCsvScheduler
     *
     * @return static
     */
    public function setCallCsvScheduler(\Ivoz\Provider\Domain\Model\CallCsvScheduler\CallCsvSchedulerInterface $callCsvScheduler = null);

    /**
     * Get callCsvScheduler
     *
     * @return \Ivoz\Provider\Domain\Model\CallCsvScheduler\CallCsvSchedulerInterface | null
     */
    public function getCallCsvScheduler();

    /**
     * Set csv
     *
     * @param \Ivoz\Provider\Domain\Model\CallCsvReport\Csv $csv
     *
     * @return static
     */
    public function setCsv(\Ivoz\Provider\Domain\Model\CallCsvReport\Csv $csv);

    /**
     * Get csv
     *
     * @return \Ivoz\Provider\Domain\Model\CallCsvReport\Csv
     */
    public function getCsv();

    /**
     * @param string $fldName
     * @param \Ivoz\Core\Domain\Service\TempFile $file
     *
     * @return void
     */
    public function addTmpFile($fldName, \Ivoz\Core\Domain\Service\TempFile $file);

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
