<?php

namespace Ivoz\Provider\Domain\Model\DestinationRateGroup;

use Ivoz\Core\Domain\Service\TempFile;
use Ivoz\Provider\Domain\Model\Brand\BrandInterface;
use Ivoz\Provider\Domain\Model\Currency\CurrencyInterface;
use Ivoz\Provider\Domain\Model\DestinationRate\DestinationRateInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Criteria;
use Ivoz\Core\Domain\Model\LoggableEntityInterface;
use Ivoz\Core\Domain\Service\FileContainerInterface;

/**
* DestinationRateGroupInterface
*/
interface DestinationRateGroupInterface extends LoggableEntityInterface, FileContainerInterface
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
    public function addTmpFile(string $fldName, TempFile $file);

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
    public function getStatus(): ?string;

    /**
     * Get lastExecutionError
     *
     * @return string | null
     */
    public function getLastExecutionError(): ?string;

    /**
     * Get deductibleConnectionFee
     *
     * @return bool
     */
    public function getDeductibleConnectionFee(): bool;

    /**
     * Get name
     *
     * @return Name
     */
    public function getName(): Name;

    /**
     * Get description
     *
     * @return Description
     */
    public function getDescription(): Description;

    /**
     * Get file
     *
     * @return File
     */
    public function getFile(): File;

    /**
     * Get brand
     *
     * @return BrandInterface
     */
    public function getBrand(): BrandInterface;

    /**
     * Get currency
     *
     * @return CurrencyInterface | null
     */
    public function getCurrency(): ?CurrencyInterface;

    /**
     * @return bool
     */
    public function isInitialized(): bool;

    /**
     * Add destinationRate
     *
     * @param DestinationRateInterface $destinationRate
     *
     * @return static
     */
    public function addDestinationRate(DestinationRateInterface $destinationRate): DestinationRateGroupInterface;

    /**
     * Remove destinationRate
     *
     * @param DestinationRateInterface $destinationRate
     *
     * @return static
     */
    public function removeDestinationRate(DestinationRateInterface $destinationRate): DestinationRateGroupInterface;

    /**
     * Replace destinationRates
     *
     * @param ArrayCollection $destinationRates of DestinationRateInterface
     *
     * @return static
     */
    public function replaceDestinationRates(ArrayCollection $destinationRates): DestinationRateGroupInterface;

    /**
     * Get destinationRates
     * @param Criteria | null $criteria
     * @return DestinationRateInterface[]
     */
    public function getDestinationRates(?Criteria $criteria = null): array;

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
