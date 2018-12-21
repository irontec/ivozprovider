<?php

namespace Ivoz\Provider\Domain\Model\DestinationRateGroup;

use Ivoz\Core\Domain\Service\FileContainerInterface;
use Ivoz\Core\Domain\Model\LoggableEntityInterface;
use Doctrine\Common\Collections\Collection;

interface DestinationRateGroupInterface extends FileContainerInterface, LoggableEntityInterface
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
     * Add TempFile and set status to pending
     *
     * @param $fldName
     * @param TempFile $file
     */
    public function addTmpFile($fldName, \Ivoz\Core\Domain\Service\TempFile $file);

    /**
     * @return string
     */
    public function getCgrTag();

    /**
     * @return string
     */
    public function getCurrencySymbol();

    /**
     * @return string
     */
    public function getCurrencyIden();

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
    public function setBrand(\Ivoz\Provider\Domain\Model\Brand\BrandInterface $brand);

    /**
     * Get brand
     *
     * @return \Ivoz\Provider\Domain\Model\Brand\BrandInterface
     */
    public function getBrand();

    /**
     * Set currency
     *
     * @param \Ivoz\Provider\Domain\Model\Currency\CurrencyInterface $currency
     *
     * @return self
     */
    public function setCurrency(\Ivoz\Provider\Domain\Model\Currency\CurrencyInterface $currency = null);

    /**
     * Get currency
     *
     * @return \Ivoz\Provider\Domain\Model\Currency\CurrencyInterface
     */
    public function getCurrency();

    /**
     * Set name
     *
     * @param \Ivoz\Provider\Domain\Model\DestinationRateGroup\Name $name
     *
     * @return self
     */
    public function setName(\Ivoz\Provider\Domain\Model\DestinationRateGroup\Name $name);

    /**
     * Get name
     *
     * @return \Ivoz\Provider\Domain\Model\DestinationRateGroup\Name
     */
    public function getName();

    /**
     * Set description
     *
     * @param \Ivoz\Provider\Domain\Model\DestinationRateGroup\Description $description
     *
     * @return self
     */
    public function setDescription(\Ivoz\Provider\Domain\Model\DestinationRateGroup\Description $description);

    /**
     * Get description
     *
     * @return \Ivoz\Provider\Domain\Model\DestinationRateGroup\Description
     */
    public function getDescription();

    /**
     * Set file
     *
     * @param \Ivoz\Provider\Domain\Model\DestinationRateGroup\File $file
     *
     * @return self
     */
    public function setFile(\Ivoz\Provider\Domain\Model\DestinationRateGroup\File $file);

    /**
     * Get file
     *
     * @return \Ivoz\Provider\Domain\Model\DestinationRateGroup\File
     */
    public function getFile();

    /**
     * Add destinationRate
     *
     * @param \Ivoz\Provider\Domain\Model\DestinationRate\DestinationRateInterface $destinationRate
     *
     * @return DestinationRateGroupTrait
     */
    public function addDestinationRate(\Ivoz\Provider\Domain\Model\DestinationRate\DestinationRateInterface $destinationRate);

    /**
     * Remove destinationRate
     *
     * @param \Ivoz\Provider\Domain\Model\DestinationRate\DestinationRateInterface $destinationRate
     */
    public function removeDestinationRate(\Ivoz\Provider\Domain\Model\DestinationRate\DestinationRateInterface $destinationRate);

    /**
     * Replace destinationRates
     *
     * @param \Ivoz\Provider\Domain\Model\DestinationRate\DestinationRateInterface[] $destinationRates
     * @return self
     */
    public function replaceDestinationRates(Collection $destinationRates);

    /**
     * Get destinationRates
     *
     * @return \Ivoz\Provider\Domain\Model\DestinationRate\DestinationRateInterface[]
     */
    public function getDestinationRates(\Doctrine\Common\Collections\Criteria $criteria = null);

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
