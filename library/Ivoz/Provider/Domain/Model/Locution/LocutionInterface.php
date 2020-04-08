<?php

namespace Ivoz\Provider\Domain\Model\Locution;

use Ivoz\Core\Domain\Service\FileContainerInterface;
use Ivoz\Core\Domain\Model\LoggableEntityInterface;

interface LocutionInterface extends FileContainerInterface, LoggableEntityInterface
{
    const STATUS_PENDING = 'pending';
    const STATUS_ENCODING = 'encoding';
    const STATUS_READY = 'ready';
    const STATUS_ERROR = 'error';


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
     * Add TempFile and set status to pending
     *
     * @param string $fldName
     * @param \Ivoz\Core\Domain\Service\TempFile $file
     */
    public function addTmpFile($fldName, \Ivoz\Core\Domain\Service\TempFile $file);

    /**
     * Get name
     *
     * @return string
     */
    public function getName();

    /**
     * Get status
     *
     * @return string | null
     */
    public function getStatus();

    /**
     * Get company
     *
     * @return \Ivoz\Provider\Domain\Model\Company\CompanyInterface
     */
    public function getCompany();

    /**
     * Get encodedFile
     *
     * @return \Ivoz\Provider\Domain\Model\Locution\EncodedFile
     */
    public function getEncodedFile();

    /**
     * Get originalFile
     *
     * @return \Ivoz\Provider\Domain\Model\Locution\OriginalFile
     */
    public function getOriginalFile();

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
