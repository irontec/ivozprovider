<?php

namespace Ivoz\Provider\Domain\Model\FaxesInOut;

use Ivoz\Provider\Domain\Model\Fax\FaxInterface;
use Ivoz\Provider\Domain\Model\Country\CountryInterface;
use Ivoz\Core\Domain\Service\TempFile;
use Ivoz\Core\Domain\Model\LoggableEntityInterface;
use Ivoz\Core\Domain\Service\FileContainerInterface;

/**
* FaxesInOutInterface
*/
interface FaxesInOutInterface extends LoggableEntityInterface, FileContainerInterface
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
    public function setCalldate($calldate = null): FaxesInOutInterface;

    /**
     * Get the numberValue in E.164 format when routing to 'number'
     *
     * @return string
     */
    public function getDstE164();

    /**
     * Get calldate
     *
     * @return \DateTimeInterface
     */
    public function getCalldate(): \DateTimeInterface;

    /**
     * Get src
     *
     * @return string | null
     */
    public function getSrc(): ?string;

    /**
     * Get dst
     *
     * @return string | null
     */
    public function getDst(): ?string;

    /**
     * Get type
     *
     * @return string | null
     */
    public function getType(): ?string;

    /**
     * Get pages
     *
     * @return string | null
     */
    public function getPages(): ?string;

    /**
     * Get status
     *
     * @return string | null
     */
    public function getStatus(): ?string;

    /**
     * Get file
     *
     * @return File
     */
    public function getFile(): File;

    /**
     * Get fax
     *
     * @return FaxInterface
     */
    public function getFax(): FaxInterface;

    /**
     * Get dstCountry
     *
     * @return CountryInterface | null
     */
    public function getDstCountry(): ?CountryInterface;

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
