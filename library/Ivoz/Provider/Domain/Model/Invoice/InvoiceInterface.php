<?php

namespace Ivoz\Provider\Domain\Model\Invoice;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;
use Ivoz\Core\Domain\Service\FileContainerInterface;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Provider\Domain\Model\InvoiceTemplate\InvoiceTemplateInterface;
use Ivoz\Provider\Domain\Model\Brand\BrandInterface;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use Ivoz\Provider\Domain\Model\InvoiceNumberSequence\InvoiceNumberSequenceInterface;
use Ivoz\Provider\Domain\Model\InvoiceScheduler\InvoiceSchedulerInterface;
use Ivoz\Provider\Domain\Model\FixedCostsRelInvoice\FixedCostsRelInvoiceInterface;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\Criteria;
use Ivoz\Core\Domain\Service\TempFile;

/**
* InvoiceInterface
*/
interface InvoiceInterface extends LoggableEntityInterface, FileContainerInterface
{
    public const STATUS_WAITING = 'waiting';

    public const STATUS_PROCESSING = 'processing';

    public const STATUS_CREATED = 'created';

    public const STATUS_ERROR = 'error';

    /**
     * @codeCoverageIgnore
     * @return array<string, mixed>
     */
    public function getChangeSet(): array;

    /**
     * @return array
     */
    public function getFileObjects(?int $filter = null): array;

    /**
     * Get id
     * @codeCoverageIgnore
     * @return integer
     */
    public function getId(): ?int;

    /**
     * @return bool
     */
    public function isWaiting(): bool;

    public function setNumber(?string $number = null): static;

    public function mustRunInvoicer(): bool;

    public function mustCheckValidity(): bool;

    public static function createDto(string|int|null $id = null): InvoiceDto;

    /**
     * @internal use EntityTools instead
     * @param null|InvoiceInterface $entity
     */
    public static function entityToDto(?EntityInterface $entity, int $depth = 0): ?InvoiceDto;

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param InvoiceDto $dto
     */
    public static function fromDto(DataTransferObjectInterface $dto, ForeignKeyTransformerInterface $fkTransformer): static;

    /**
     * @internal use EntityTools instead
     */
    public function toDto(int $depth = 0): InvoiceDto;

    public function getNumber(): ?string;

    /**
     * @return \DateTime|\DateTimeImmutable
     */
    public function getInDate(): ?\DateTimeInterface;

    /**
     * @return \DateTime|\DateTimeImmutable
     */
    public function getOutDate(): ?\DateTimeInterface;

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

    public function isInitialized(): bool;

    public function addRelFixedCost(FixedCostsRelInvoiceInterface $relFixedCost): InvoiceInterface;

    public function removeRelFixedCost(FixedCostsRelInvoiceInterface $relFixedCost): InvoiceInterface;

    /**
     * @param Collection<array-key, FixedCostsRelInvoiceInterface> $relFixedCosts
     */
    public function replaceRelFixedCosts(Collection $relFixedCosts): InvoiceInterface;

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
