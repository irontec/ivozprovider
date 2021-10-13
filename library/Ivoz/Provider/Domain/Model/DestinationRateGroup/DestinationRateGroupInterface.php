<?php

namespace Ivoz\Provider\Domain\Model\DestinationRateGroup;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;
use Ivoz\Core\Domain\Service\FileContainerInterface;
use Ivoz\Core\Domain\Service\TempFile;
use Ivoz\Provider\Domain\Model\Brand\BrandInterface;
use Ivoz\Provider\Domain\Model\Currency\CurrencyInterface;
use Ivoz\Provider\Domain\Model\DestinationRate\DestinationRateInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Criteria;

/**
* DestinationRateGroupInterface
*/
interface DestinationRateGroupInterface extends LoggableEntityInterface, FileContainerInterface
{
    public const STATUS_WAITING = 'waiting';

    public const STATUS_INPROGRESS = 'inProgress';

    public const STATUS_IMPORTED = 'imported';

    public const STATUS_ERROR = 'error';

    /**
     * @codeCoverageIgnore
     * @return array
     */
    public function getChangeSet(): array;

    /**
     * @return array
     */
    public function getFileObjects(?int $filter = null): array;

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
    public function getCgrTag(): string;

    /**
     * @return string
     */
    public function getCurrencySymbol(): string;

    /**
     * @return string
     */
    public function getCurrencyIden(): string;

    /**
     * @return string
     */
    public function getRoundingMethod();

    public function getStatus(): ?string;

    public function getLastExecutionError(): ?string;

    public function getDeductibleConnectionFee(): bool;

    public function getName(): Name;

    public function getDescription(): Description;

    public function getFile(): File;

    public function getBrand(): BrandInterface;

    public function getCurrency(): ?CurrencyInterface;

    public function isInitialized(): bool;

    public function addDestinationRate(DestinationRateInterface $destinationRate): DestinationRateGroupInterface;

    public function removeDestinationRate(DestinationRateInterface $destinationRate): DestinationRateGroupInterface;

    public function replaceDestinationRates(ArrayCollection $destinationRates): DestinationRateGroupInterface;

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
