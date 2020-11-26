<?php

namespace Ivoz\Provider\Domain\Model\Recording;

use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use Ivoz\Core\Domain\Service\TempFile;
use Ivoz\Core\Domain\Model\LoggableEntityInterface;
use Ivoz\Core\Domain\Service\FileContainerInterface;

/**
* RecordingInterface
*/
interface RecordingInterface extends LoggableEntityInterface, FileContainerInterface
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
    public function getFileObjects(int $filter = null);

    /**
     * Get callid
     *
     * @return string | null
     */
    public function getCallid(): ?string;

    /**
     * Get calldate
     *
     * @return \DateTimeInterface
     */
    public function getCalldate(): \DateTimeInterface;

    /**
     * Get type
     *
     * @return string
     */
    public function getType(): string;

    /**
     * Get duration
     *
     * @return float
     */
    public function getDuration(): float;

    /**
     * Get caller
     *
     * @return string | null
     */
    public function getCaller(): ?string;

    /**
     * Get callee
     *
     * @return string | null
     */
    public function getCallee(): ?string;

    /**
     * Get recorder
     *
     * @return string | null
     */
    public function getRecorder(): ?string;

    /**
     * Get recordedFile
     *
     * @return RecordedFile
     */
    public function getRecordedFile(): RecordedFile;

    /**
     * Set company
     *
     * @param CompanyInterface
     *
     * @return static
     */
    public function setCompany(CompanyInterface $company): RecordingInterface;

    /**
     * Get company
     *
     * @return CompanyInterface
     */
    public function getCompany(): CompanyInterface;

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
