<?php

namespace Ivoz\Provider\Domain\Model\GenericMusicOnHold;

use Ivoz\Core\Domain\Model\EntityInterface;

interface GenericMusicOnHoldInterface extends EntityInterface
{
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
     * @param OriginalFile $originalFile
     *
     * @return self
     */
    public function setOriginalFile(\Ivoz\Provider\Domain\Model\GenericMusicOnHold\OriginalFile $originalFile);

    /**
     * Get originalFile
     *
     * @return OriginalFile
     */
    public function getOriginalFile();

    /**
     * Set encodedFile
     *
     * @param EncodedFile $encodedFile
     *
     * @return self
     */
    public function setEncodedFile(\Ivoz\Provider\Domain\Model\GenericMusicOnHold\EncodedFile $encodedFile);

    /**
     * Get encodedFile
     *
     * @return EncodedFile
     */
    public function getEncodedFile();

}

