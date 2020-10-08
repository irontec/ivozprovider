<?php

namespace Ivoz\Provider\Domain\Model\DestinationRateGroup;

use Ivoz\Core\Domain\Service\FileContainerInterface;
use Ivoz\Core\Domain\Model\LoggableEntityInterface;
use Doctrine\Common\Collections\Criteria;
use Doctrine\Common\Collections\ArrayCollection;

interface DestinationRateGroupInterface extends FileContainerInterface, LoggableEntityInterface
{
    const STATUS_WAITING = 'waiting';
    const STATUS_INPROGRESS = 'inProgress';
    const STATUS_IMPORTED = 'imported';
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
    public function addTmpFile(string $fldName, \Ivoz\Core\Domain\Service\TempFile $file);

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
     * @return string
     */
    public function getRoundingMethod();

    /**
     * Get status
     *
     * @return string | null
     */
    public function getStatus();

    /**
     * Get lastExecutionError
     *
     * @return string | null
     */
    public function getLastExecutionError();

    /**
     * Get deductibleConnectionFee
     *
     * @return boolean
     */
    public function getDeductibleConnectionFee(): bool;

    /**
     * Get brand
     *
     * @return \Ivoz\Provider\Domain\Model\Brand\BrandInterface
     */
    public function getBrand();

    /**
     * Get currency
     *
     * @return \Ivoz\Provider\Domain\Model\Currency\CurrencyInterface | null
     */
    public function getCurrency();

    /**
     * Get name
     *
     * @return \Ivoz\Provider\Domain\Model\DestinationRateGroup\Name
     */
    public function getName();

    /**
     * Get description
     *
     * @return \Ivoz\Provider\Domain\Model\DestinationRateGroup\Description
     */
    public function getDescription();

    /**
     * Get file
     *
     * @return \Ivoz\Provider\Domain\Model\DestinationRateGroup\File
     */
    public function getFile();

    /**
     * @return bool
     */
    public function isInitialized(): bool;

    /**
     * Add destinationRate
     *
     * @param \Ivoz\Provider\Domain\Model\DestinationRate\DestinationRateInterface $destinationRate
     *
     * @return static
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
     * @param ArrayCollection $destinationRates of Ivoz\Provider\Domain\Model\DestinationRate\DestinationRateInterface
     * @return static
     */
    public function replaceDestinationRates(ArrayCollection $destinationRates);

    /**
     * Get destinationRates
     * @param Criteria | null $criteria
     * @return \Ivoz\Provider\Domain\Model\DestinationRate\DestinationRateInterface[]
     */
    public function getDestinationRates(\Doctrine\Common\Collections\Criteria $criteria = null);

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
