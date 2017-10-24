<?php

namespace Ivoz\Provider\Domain\Model\Locution;

use Ivoz\Core\Domain\Model\EntityInterface;

interface LocutionInterface extends EntityInterface
{
    /**
     * @return array
     */
    public function getFileObjects();

    public function getLocutionPath();

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
    public function setCompany(\Ivoz\Provider\Domain\Model\Company\CompanyInterface $company);

    /**
     * Get company
     *
     * @return \Ivoz\Provider\Domain\Model\Company\CompanyInterface
     */
    public function getCompany();

    /**
     * Set encodedFile
     *
     * @param EncodedFile $encodedFile
     *
     * @return self
     */
    public function setEncodedFile(\Ivoz\Provider\Domain\Model\Locution\EncodedFile $encodedFile);

    /**
     * Get encodedFile
     *
     * @return EncodedFile
     */
    public function getEncodedFile();

    /**
     * Set originalFile
     *
     * @param OriginalFile $originalFile
     *
     * @return self
     */
    public function setOriginalFile(\Ivoz\Provider\Domain\Model\Locution\OriginalFile $originalFile);

    /**
     * Get originalFile
     *
     * @return OriginalFile
     */
    public function getOriginalFile();

    public function addTmpFile(\Ivoz\Core\Domain\Service\TempFile $file);

    /**
     * @return TempFile[]
     */
    public function getTempFiles();

}

