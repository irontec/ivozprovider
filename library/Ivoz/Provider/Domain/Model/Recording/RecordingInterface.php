<?php

namespace Ivoz\Provider\Domain\Model\Recording;

use Ivoz\Core\Domain\Service\FileContainerInterface;
use Ivoz\Core\Domain\Model\LoggableEntityInterface;

interface RecordingInterface extends FileContainerInterface, LoggableEntityInterface
{
    const TYPE_ONDEMAND = 'ondemand';
    const TYPE_DDI = 'ddi';


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
     * Get callid
     *
     * @return string | null
     */
    public function getCallid();

    /**
     * Get calldate
     *
     * @return \DateTime
     */
    public function getCalldate();

    /**
     * Get type
     *
     * @return string
     */
    public function getType();

    /**
     * Get duration
     *
     * @return float
     */
    public function getDuration();

    /**
     * Get caller
     *
     * @return string | null
     */
    public function getCaller();

    /**
     * Get callee
     *
     * @return string | null
     */
    public function getCallee();

    /**
     * Get recorder
     *
     * @return string | null
     */
    public function getRecorder();

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
     * @return \Ivoz\Provider\Domain\Model\Company\CompanyInterface
     */
    public function getCompany();

    /**
     * Set recordedFile
     *
     * @param \Ivoz\Provider\Domain\Model\Recording\RecordedFile $recordedFile
     *
     * @return static
     */
    public function setRecordedFile(\Ivoz\Provider\Domain\Model\Recording\RecordedFile $recordedFile);

    /**
     * Get recordedFile
     *
     * @return \Ivoz\Provider\Domain\Model\Recording\RecordedFile
     */
    public function getRecordedFile();

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
