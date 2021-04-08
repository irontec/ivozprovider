<?php

namespace Ivoz\Provider\Domain\Model\Invoice;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;
use Ivoz\Core\Domain\Service\FileContainerInterface;
use Ivoz\Provider\Domain\Model\InvoiceTemplate\InvoiceTemplateInterface;
use Ivoz\Provider\Domain\Model\Brand\BrandInterface;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use Ivoz\Provider\Domain\Model\InvoiceNumberSequence\InvoiceNumberSequenceInterface;
use Ivoz\Provider\Domain\Model\InvoiceScheduler\InvoiceSchedulerInterface;
use Ivoz\Provider\Domain\Model\FixedCostsRelInvoice\FixedCostsRelInvoiceInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Criteria;
use Ivoz\Core\Domain\Service\TempFile;

/**
* InvoiceInterface
*/
interface InvoiceInterface extends LoggableEntityInterface, FileContainerInterface
{
    const STATUS_WAITING = 'waiting';

    const STATUS_PROCESSING = 'processing';

    const STATUS_CREATED = 'created';

    const STATUS_ERROR = 'error';

    /**
     * @codeCoverageIgnore
     * @return array
     */
    public function getChangeSet();

    /**
     * @return array
     */
    public function getFileObjects(?int $filter = null);

    /**
     * @return bool
     */
    public function isWaiting(): bool;

    public function setNumber(?string $number = null): static;

    public function mustRunInvoicer(): bool;

    public function mustCheckValidity(): bool;

    public function getNumber(): ?string;

    public function getInDate(): ?\DateTime;

    public function getOutDate(): ?\DateTime;

    public function getTotal(): ?float;

    public function getTaxRate(): ?float;

    public function getTotalWithTax(): ?float;

    public function getStatus(): ?string;

    public function getStatusMsg(): ?string;

    public function getPdf(): Pdf;

    public function getInvoiceTemplate(): ?InvoiceTemplateInterface;

    public function getBrand(): BrandInterface;

    public function getCompany(): CompanyInterface;

    public function getNumberSequence(): ?InvoiceNumberSequenceInterface;

    public function getScheduler(): ?InvoiceSchedulerInterface;

    /**
     * @return bool
     */
    public function isInitialized(): bool;

    public function addRelFixedCost(FixedCostsRelInvoiceInterface $relFixedCost): InvoiceInterface;

    public function removeRelFixedCost(FixedCostsRelInvoiceInterface $relFixedCost): InvoiceInterface;

    public function replaceRelFixedCosts(ArrayCollection $relFixedCosts): InvoiceInterface;

    public function getRelFixedCosts(?Criteria $criteria = null): array;

    /**
     * @return void
     */
    public function addTmpFile(string $fldName, TempFile $file);

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
