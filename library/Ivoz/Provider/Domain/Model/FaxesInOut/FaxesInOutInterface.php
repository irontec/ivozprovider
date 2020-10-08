<?php

namespace Ivoz\Provider\Domain\Model\FaxesInOut;

use Ivoz\Core\Domain\Service\FileContainerInterface;
use Ivoz\Core\Domain\Model\LoggableEntityInterface;

interface FaxesInOutInterface extends FileContainerInterface, LoggableEntityInterface
{
    const TYPE_IN = 'In';
    const TYPE_OUT = 'Out';


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
     * Set calldate
     *
     * @param \DateTime | null $calldate
     *
     * @return self
     */
    public function setCalldate($calldate = null);

    /**
     * Get the numberValue in E.164 format when routing to 'number'
     *
     * @return string
     */
    public function getDstE164();

    /**
     * Get calldate
     *
     * @return \DateTime
     */
    public function getCalldate(): \DateTime;

    /**
     * Get src
     *
     * @return string | null
     */
    public function getSrc();

    /**
     * Get dst
     *
     * @return string | null
     */
    public function getDst();

    /**
     * Get type
     *
     * @return string | null
     */
    public function getType();

    /**
     * Get pages
     *
     * @return string | null
     */
    public function getPages();

    /**
     * Get status
     *
     * @return string | null
     */
    public function getStatus();

    /**
     * Get fax
     *
     * @return \Ivoz\Provider\Domain\Model\Fax\FaxInterface
     */
    public function getFax();

    /**
     * Get dstCountry
     *
     * @return \Ivoz\Provider\Domain\Model\Country\CountryInterface | null
     */
    public function getDstCountry();

    /**
     * Get file
     *
     * @return \Ivoz\Provider\Domain\Model\FaxesInOut\File
     */
    public function getFile();

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
