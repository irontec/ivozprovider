<?php

namespace Ivoz\Provider\Domain\Model\GenericMusicOnHold;

use Ivoz\Core\Domain\Model\EntityInterface;

interface GenericMusicOnHoldInterface extends EntityInterface
{
    /**
     * @return array
     */
    public function getFileObjects();

    public function getOwner();

    /**
     * @return array
     */
    public function getChangeSet();

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
     * @return \Ivoz\Provider\Domain\Model\Brand\BrandInterface
     */
    public function getBrand();

    /**
     * Set originalFile
     *
     * @param \Ivoz\Provider\Domain\Model\GenericMusicOnHold\OriginalFile $originalFile
     *
     * @return self
     */
    public function setOriginalFile(\Ivoz\Provider\Domain\Model\GenericMusicOnHold\OriginalFile $originalFile);

    /**
     * Get originalFile
     *
     * @return \Ivoz\Provider\Domain\Model\GenericMusicOnHold\OriginalFile
     */
    public function getOriginalFile();

    /**
     * Set encodedFile
     *
     * @param \Ivoz\Provider\Domain\Model\GenericMusicOnHold\EncodedFile $encodedFile
     *
     * @return self
     */
    public function setEncodedFile(\Ivoz\Provider\Domain\Model\GenericMusicOnHold\EncodedFile $encodedFile);

    /**
     * Get encodedFile
     *
     * @return \Ivoz\Provider\Domain\Model\GenericMusicOnHold\EncodedFile
     */
    public function getEncodedFile();

    public function addTmpFile(\Ivoz\Core\Domain\Service\TempFile $file);

    /**
     * @return TempFile[]
     */
    public function getTempFiles();

}

