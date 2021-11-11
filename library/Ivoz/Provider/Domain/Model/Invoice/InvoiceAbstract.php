<?php

declare(strict_types=1);

namespace Ivoz\Provider\Domain\Model\Invoice;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Core\Domain\Model\Helper\DateTimeHelper;
use Ivoz\Provider\Domain\Model\Invoice\Pdf;
use Ivoz\Provider\Domain\Model\InvoiceTemplate\InvoiceTemplateInterface;
use Ivoz\Provider\Domain\Model\Brand\BrandInterface;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use Ivoz\Provider\Domain\Model\InvoiceNumberSequence\InvoiceNumberSequenceInterface;
use Ivoz\Provider\Domain\Model\InvoiceScheduler\InvoiceSchedulerInterface;
use Ivoz\Provider\Domain\Model\InvoiceTemplate\InvoiceTemplate;
use Ivoz\Provider\Domain\Model\Brand\Brand;
use Ivoz\Provider\Domain\Model\Company\Company;
use Ivoz\Provider\Domain\Model\InvoiceNumberSequence\InvoiceNumberSequence;
use Ivoz\Provider\Domain\Model\InvoiceScheduler\InvoiceScheduler;

/**
* InvoiceAbstract
* @codeCoverageIgnore
*/
abstract class InvoiceAbstract
{
    use ChangelogTrait;

    /**
     * @var ?string
     */
    protected $number = null;

    /**
     * @var ?\DateTime
     */
    protected $inDate = null;

    /**
     * @var ?\DateTime
     */
    protected $outDate = null;

    /**
     * @var ?float
     */
    protected $total = null;

    /**
     * @var ?float
     */
    protected $taxRate = null;

    /**
     * @var ?float
     */
    protected $totalWithTax = null;

    /**
     * @var ?string
     * comment: enum:waiting|processing|created|error
     */
    protected $status = null;

    /**
     * @var ?string
     */
    protected $statusMsg = null;

    /**
     * @var Pdf
     */
    protected $pdf;

    /**
     * @var ?InvoiceTemplateInterface
     */
    protected $invoiceTemplate = null;

    /**
     * @var BrandInterface
     */
    protected $brand;

    /**
     * @var CompanyInterface
     */
    protected $company;

    /**
     * @var ?InvoiceNumberSequenceInterface
     */
    protected $numberSequence = null;

    /**
     * @var ?InvoiceSchedulerInterface
     */
    protected $scheduler = null;

    /**
     * Constructor
     */
    protected function __construct(
        Pdf $pdf
    ) {
        $this->pdf = $pdf;
    }

    abstract public function getId(): null|string|int;

    public function __toString(): string
    {
        return sprintf(
            "%s#%s",
            "Invoice",
            (string) $this->getId()
        );
    }

    /**
     * @throws \Exception
     */
    protected function sanitizeValues(): void
    {
    }

    public static function createDto(string|int|null $id = null): InvoiceDto
    {
        return new InvoiceDto($id);
    }

    /**
     * @internal use EntityTools instead
     * @param null|InvoiceInterface $entity
     */
    public static function entityToDto(?EntityInterface $entity, int $depth = 0): ?InvoiceDto
    {
        if (!$entity) {
            return null;
        }

        Assertion::isInstanceOf($entity, InvoiceInterface::class);

        if ($depth < 1) {
            return static::createDto($entity->getId());
        }

        if ($entity instanceof \Doctrine\ORM\Proxy\Proxy && !$entity->__isInitialized()) {
            return static::createDto($entity->getId());
        }

        $dto = $entity->toDto($depth - 1);

        return $dto;
    }

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param InvoiceDto $dto
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
        Assertion::isInstanceOf($dto, InvoiceDto::class);

        $pdf = new Pdf(
            $dto->getPdfFileSize(),
            $dto->getPdfMimeType(),
            $dto->getPdfBaseName()
        );

        $self = new static(
            $pdf
        );

        $self
            ->setNumber($dto->getNumber())
            ->setInDate($dto->getInDate())
            ->setOutDate($dto->getOutDate())
            ->setTotal($dto->getTotal())
            ->setTaxRate($dto->getTaxRate())
            ->setTotalWithTax($dto->getTotalWithTax())
            ->setStatus($dto->getStatus())
            ->setStatusMsg($dto->getStatusMsg())
            ->setInvoiceTemplate($fkTransformer->transform($dto->getInvoiceTemplate()))
            ->setBrand($fkTransformer->transform($dto->getBrand()))
            ->setCompany($fkTransformer->transform($dto->getCompany()))
            ->setNumberSequence($fkTransformer->transform($dto->getNumberSequence()))
            ->setScheduler($fkTransformer->transform($dto->getScheduler()));

        $self->initChangelog();

        return $self;
    }

    /**
     * @internal use EntityTools instead
     * @param InvoiceDto $dto
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
        Assertion::isInstanceOf($dto, InvoiceDto::class);

        $pdf = new Pdf(
            $dto->getPdfFileSize(),
            $dto->getPdfMimeType(),
            $dto->getPdfBaseName()
        );

        $this
            ->setNumber($dto->getNumber())
            ->setInDate($dto->getInDate())
            ->setOutDate($dto->getOutDate())
            ->setTotal($dto->getTotal())
            ->setTaxRate($dto->getTaxRate())
            ->setTotalWithTax($dto->getTotalWithTax())
            ->setStatus($dto->getStatus())
            ->setStatusMsg($dto->getStatusMsg())
            ->setPdf($pdf)
            ->setInvoiceTemplate($fkTransformer->transform($dto->getInvoiceTemplate()))
            ->setBrand($fkTransformer->transform($dto->getBrand()))
            ->setCompany($fkTransformer->transform($dto->getCompany()))
            ->setNumberSequence($fkTransformer->transform($dto->getNumberSequence()))
            ->setScheduler($fkTransformer->transform($dto->getScheduler()));

        return $this;
    }

    /**
     * @internal use EntityTools instead
     */
    public function toDto(int $depth = 0): InvoiceDto
    {
        return self::createDto()
            ->setNumber(self::getNumber())
            ->setInDate(self::getInDate())
            ->setOutDate(self::getOutDate())
            ->setTotal(self::getTotal())
            ->setTaxRate(self::getTaxRate())
            ->setTotalWithTax(self::getTotalWithTax())
            ->setStatus(self::getStatus())
            ->setStatusMsg(self::getStatusMsg())
            ->setPdfFileSize(self::getPdf()->getFileSize())
            ->setPdfMimeType(self::getPdf()->getMimeType())
            ->setPdfBaseName(self::getPdf()->getBaseName())
            ->setInvoiceTemplate(InvoiceTemplate::entityToDto(self::getInvoiceTemplate(), $depth))
            ->setBrand(Brand::entityToDto(self::getBrand(), $depth))
            ->setCompany(Company::entityToDto(self::getCompany(), $depth))
            ->setNumberSequence(InvoiceNumberSequence::entityToDto(self::getNumberSequence(), $depth))
            ->setScheduler(InvoiceScheduler::entityToDto(self::getScheduler(), $depth));
    }

    protected function __toArray(): array
    {
        return [
            'number' => self::getNumber(),
            'inDate' => self::getInDate(),
            'outDate' => self::getOutDate(),
            'total' => self::getTotal(),
            'taxRate' => self::getTaxRate(),
            'totalWithTax' => self::getTotalWithTax(),
            'status' => self::getStatus(),
            'statusMsg' => self::getStatusMsg(),
            'pdfFileSize' => self::getPdf()->getFileSize(),
            'pdfMimeType' => self::getPdf()->getMimeType(),
            'pdfBaseName' => self::getPdf()->getBaseName(),
            'invoiceTemplateId' => self::getInvoiceTemplate()?->getId(),
            'brandId' => self::getBrand()->getId(),
            'companyId' => self::getCompany()->getId(),
            'numberSequenceId' => self::getNumberSequence()?->getId(),
            'schedulerId' => self::getScheduler()?->getId()
        ];
    }

    protected function setNumber(?string $number = null): static
    {
        if (!is_null($number)) {
            Assertion::maxLength($number, 30, 'number value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->number = $number;

        return $this;
    }

    public function getNumber(): ?string
    {
        return $this->number;
    }

    protected function setInDate($inDate = null): static
    {
        if (!is_null($inDate)) {
            Assertion::notNull(
                $inDate,
                'inDate value "%s" is null, but non null value was expected.'
            );
            $inDate = DateTimeHelper::createOrFix(
                $inDate,
                null
            );

            if ($this->isInitialized() && $this->inDate == $inDate) {
                return $this;
            }
        }

        $this->inDate = $inDate;

        return $this;
    }

    /**
     * @return \DateTime|\DateTimeImmutable
     */
    public function getInDate(): ?\DateTimeInterface
    {
        return !is_null($this->inDate) ? clone $this->inDate : null;
    }

    protected function setOutDate($outDate = null): static
    {
        if (!is_null($outDate)) {
            Assertion::notNull(
                $outDate,
                'outDate value "%s" is null, but non null value was expected.'
            );
            $outDate = DateTimeHelper::createOrFix(
                $outDate,
                null
            );

            if ($this->isInitialized() && $this->outDate == $outDate) {
                return $this;
            }
        }

        $this->outDate = $outDate;

        return $this;
    }

    /**
     * @return \DateTime|\DateTimeImmutable
     */
    public function getOutDate(): ?\DateTimeInterface
    {
        return !is_null($this->outDate) ? clone $this->outDate : null;
    }

    protected function setTotal(?float $total = null): static
    {
        if (!is_null($total)) {
            $total = (float) $total;
        }

        $this->total = $total;

        return $this;
    }

    public function getTotal(): ?float
    {
        return $this->total;
    }

    protected function setTaxRate(?float $taxRate = null): static
    {
        if (!is_null($taxRate)) {
            $taxRate = (float) $taxRate;
        }

        $this->taxRate = $taxRate;

        return $this;
    }

    public function getTaxRate(): ?float
    {
        return $this->taxRate;
    }

    protected function setTotalWithTax(?float $totalWithTax = null): static
    {
        if (!is_null($totalWithTax)) {
            $totalWithTax = (float) $totalWithTax;
        }

        $this->totalWithTax = $totalWithTax;

        return $this;
    }

    public function getTotalWithTax(): ?float
    {
        return $this->totalWithTax;
    }

    protected function setStatus(?string $status = null): static
    {
        if (!is_null($status)) {
            Assertion::maxLength($status, 25, 'status value "%s" is too long, it should have no more than %d characters, but has %d characters.');
            Assertion::choice(
                $status,
                [
                    InvoiceInterface::STATUS_WAITING,
                    InvoiceInterface::STATUS_PROCESSING,
                    InvoiceInterface::STATUS_CREATED,
                    InvoiceInterface::STATUS_ERROR,
                ],
                'statusvalue "%s" is not an element of the valid values: %s'
            );
        }

        $this->status = $status;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    protected function setStatusMsg(?string $statusMsg = null): static
    {
        if (!is_null($statusMsg)) {
            Assertion::maxLength($statusMsg, 140, 'statusMsg value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->statusMsg = $statusMsg;

        return $this;
    }

    public function getStatusMsg(): ?string
    {
        return $this->statusMsg;
    }

    public function getPdf(): Pdf
    {
        return $this->pdf;
    }

    protected function setPdf(Pdf $pdf): static
    {
        $isEqual = $this->pdf->equals($pdf);
        if ($isEqual) {
            return $this;
        }

        $this->pdf = $pdf;
        return $this;
    }

    protected function setInvoiceTemplate(?InvoiceTemplateInterface $invoiceTemplate = null): static
    {
        $this->invoiceTemplate = $invoiceTemplate;

        return $this;
    }

    public function getInvoiceTemplate(): ?InvoiceTemplateInterface
    {
        return $this->invoiceTemplate;
    }

    protected function setBrand(BrandInterface $brand): static
    {
        $this->brand = $brand;

        return $this;
    }

    public function getBrand(): BrandInterface
    {
        return $this->brand;
    }

    protected function setCompany(CompanyInterface $company): static
    {
        $this->company = $company;

        return $this;
    }

    public function getCompany(): CompanyInterface
    {
        return $this->company;
    }

    protected function setNumberSequence(?InvoiceNumberSequenceInterface $numberSequence = null): static
    {
        $this->numberSequence = $numberSequence;

        return $this;
    }

    public function getNumberSequence(): ?InvoiceNumberSequenceInterface
    {
        return $this->numberSequence;
    }

    protected function setScheduler(?InvoiceSchedulerInterface $scheduler = null): static
    {
        $this->scheduler = $scheduler;

        return $this;
    }

    public function getScheduler(): ?InvoiceSchedulerInterface
    {
        return $this->scheduler;
    }
}
