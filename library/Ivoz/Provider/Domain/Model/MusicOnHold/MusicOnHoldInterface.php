<?php

namespace Ivoz\Provider\Domain\Model\MusicOnHold;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;

interface MusicOnHoldInterface extends LoggableEntityInterface
{
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
     * Set name
     *
     * @param string $name
     *
     * @return self
     */
    public function setName($name);

    /**
     * Get name
     *
     * @return string
     */
    public function getName();

    /**
     * Set status
     *
     * @param string $status
     *
     * @return self
     */
    public function setStatus($status = null);

    /**
     * Get status
     *
     * @return string
     */
    public function getStatus();

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
     * @return \Ivoz\Provider\Domain\Model\Company\CompanyInterface
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

    public function addTmpFile($fldName, \Ivoz\Core\Domain\Service\TempFile $file);

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

