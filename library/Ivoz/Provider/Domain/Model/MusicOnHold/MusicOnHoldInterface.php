<?php

namespace Ivoz\Provider\Domain\Model\MusicOnHold;

use Ivoz\Core\Domain\Service\FileContainerInterface;
use Ivoz\Core\Domain\Model\LoggableEntityInterface;

interface MusicOnHoldInterface extends FileContainerInterface, LoggableEntityInterface
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
     * @return string
     */
    public function getOwner();

    /**
     * Add TempFile and set status to pending
     *
     * @param $fldName
     * @param TempFile $file
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
     * Set brand
     *
     * @param \Ivoz\Provider\Domain\Model\Brand\BrandInterface $brand
     *
     * @return self
     */
    public function setBrand(\Ivoz\Provider\Domain\Model\Brand\BrandInterface $brand = null);

    /**
     * Get brand
     *
     * @return \Ivoz\Provider\Domain\Model\Brand\BrandInterface | null
     */
    public function getBrand();

    /**
     * Set company
     *
     * @param \Ivoz\Provider\Domain\Model\Company\CompanyInterface $company
     *
     * @return self
     */
    public function setCompany(\Ivoz\Provider\Domain\Model\Company\CompanyInterface $company = null);

    /**
     * Get company
     *
     * @return \Ivoz\Provider\Domain\Model\Company\CompanyInterface | null
     */
    public function getCompany();

    /**
     * Set originalFile
     *
     * @param \Ivoz\Provider\Domain\Model\MusicOnHold\OriginalFile $originalFile
     *
     * @return self
     */
    public function setOriginalFile(\Ivoz\Provider\Domain\Model\MusicOnHold\OriginalFile $originalFile);

    /**
     * Get originalFile
     *
     * @return \Ivoz\Provider\Domain\Model\MusicOnHold\OriginalFile
     */
    public function getOriginalFile();

    /**
     * Set encodedFile
     *
     * @param \Ivoz\Provider\Domain\Model\MusicOnHold\EncodedFile $encodedFile
     *
     * @return self
     */
    public function setEncodedFile(\Ivoz\Provider\Domain\Model\MusicOnHold\EncodedFile $encodedFile);

    /**
     * Get encodedFile
     *
     * @return \Ivoz\Provider\Domain\Model\MusicOnHold\EncodedFile
     */
    public function getEncodedFile();

    /**
     * @param TempFile $file
     * @throws \Exception
     */
    public function removeTmpFile(\Ivoz\Core\Domain\Service\TempFile $file);

    /**
     * @return TempFile[]
     */
    public function getTempFiles();

    /**
     * @var string $fldName
     * @return null | TempFile
     */
    public function getTempFileByFieldName($fldName);
}
