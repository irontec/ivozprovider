<?php

namespace Ivoz\Provider\Domain\Model\DestinationRate;

use Ivoz\Core\Domain\Model\EntityInterface;
use Doctrine\Common\Collections\Collection;

interface DestinationRateInterface extends EntityInterface
{
    /**
     * @return array
     */
    public function getFileObjects();

    /**
     * Add TempFile and set status to pending
     *
     * @param $fldName
     * @param TempFile $file
     */
    public function addTmpFile($fldName, \Ivoz\Core\Domain\Service\TempFile $file);

    /**
     * Set tag
     *
     * @param string $tag
     *
     * @return self
     */
    public function setTag($tag = null);

    /**
     * Get tag
     *
     * @return string
     */
    public function getTag();

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
    public function setBrand(\Ivoz\Provider\Domain\Model\Brand\BrandInterface $brand);

    /**
     * Get brand
     *
     * @return \Ivoz\Provider\Domain\Model\Brand\BrandInterface
     */
    public function getBrand();

    /**
     * Set name
     *
     * @param \Ivoz\Provider\Domain\Model\DestinationRate\Name $name
     *
     * @return self
     */
    public function setName(\Ivoz\Provider\Domain\Model\DestinationRate\Name $name);

    /**
     * Get name
     *
     * @return \Ivoz\Provider\Domain\Model\DestinationRate\Name
     */
    public function getName();

    /**
     * Set description
     *
     * @param \Ivoz\Provider\Domain\Model\DestinationRate\Description $description
     *
     * @return self
     */
    public function setDescription(\Ivoz\Provider\Domain\Model\DestinationRate\Description $description);

    /**
     * Get description
     *
     * @return \Ivoz\Provider\Domain\Model\DestinationRate\Description
     */
    public function getDescription();

    /**
     * Set file
     *
     * @param \Ivoz\Provider\Domain\Model\DestinationRate\File $file
     *
     * @return self
     */
    public function setFile(\Ivoz\Provider\Domain\Model\DestinationRate\File $file);

    /**
     * Get file
     *
     * @return \Ivoz\Provider\Domain\Model\DestinationRate\File
     */
    public function getFile();

    /**
     * Add tpDestinationRate
     *
     * @param \Ivoz\Cgr\Domain\Model\TpDestinationRate\TpDestinationRateInterface $tpDestinationRate
     *
     * @return DestinationRateTrait
     */
    public function addTpDestinationRate(\Ivoz\Cgr\Domain\Model\TpDestinationRate\TpDestinationRateInterface $tpDestinationRate);

    /**
     * Remove tpDestinationRate
     *
     * @param \Ivoz\Cgr\Domain\Model\TpDestinationRate\TpDestinationRateInterface $tpDestinationRate
     */
    public function removeTpDestinationRate(\Ivoz\Cgr\Domain\Model\TpDestinationRate\TpDestinationRateInterface $tpDestinationRate);

    /**
     * Replace tpDestinationRates
     *
     * @param \Ivoz\Cgr\Domain\Model\TpDestinationRate\TpDestinationRateInterface[] $tpDestinationRates
     * @return self
     */
    public function replaceTpDestinationRates(Collection $tpDestinationRates);

    /**
     * Get tpDestinationRates
     *
     * @return \Ivoz\Cgr\Domain\Model\TpDestinationRate\TpDestinationRateInterface[]
     */
    public function getTpDestinationRates(\Doctrine\Common\Collections\Criteria $criteria = null);

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

