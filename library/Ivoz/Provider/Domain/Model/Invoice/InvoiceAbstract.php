<?php
declare(strict_types = 1);

namespace Ivoz\Provider\Domain\Model\Invoice;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;
use \Ivoz\Core\Application\ForeignKeyTransformerInterface;
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
     * @var string | null
     */
    protected $number;

    /**
     * @var \DateTimeInterface | null
     */
    protected $inDate;

    /**
     * @var \DateTimeInterface | null
     */
    protected $outDate;

    /**
     * @var float | null
     */
    protected $total;

    /**
     * @var float | null
     */
    protected $taxRate;

    /**
     * @var float | null
     */
    protected $totalWithTax;

    /**
     * comment: enum:waiting|processing|created|error
     * @var string | null
     */
    protected $status;

    /**
     * @var string | null
     */
    protected $statusMsg;

    /**
     * @var Pdf | null
     */
    protected $pdf;

    /**
     * @var InvoiceTemplateInterface
     */
    protected $invoiceTemplate;

    /**
     * @var BrandInterface
     */
    protected $brand;

    /**
     * @var CompanyInterface
     */
    protected $company;

    /**
     * @var InvoiceNumberSequenceInterface
     */
    protected $numberSequence;

    /**
     * @var InvoiceSchedulerInterface
     */
    protected $scheduler;

    /**
     * Constructor
     */
    protected function __construct(
        Pdf $pdf
    ) {
        $this->setPdf($pdf);
    }

    abstract public function getId();

    public function __toString()
    {
        return sprintf(
            "%s#%s",
            "Invoice",
            $this->getId()
        );
    }

    /**
     * @return void
     * @throws \Exception
     */
    protected function sanitizeValues()
    {
    }

    /**
     * @param null $id
     * @return InvoiceDto
     */
    public static function createDto($id = null)
    {
        return new InvoiceDto($id);
    }

    /**
     * @internal use EntityTools instead
     * @param InvoiceInterface|null $entity
     * @param int $depth
     * @return InvoiceDto|null
     */
    public static function entityToDto(EntityInterface $entity = null, $depth = 0)
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

        /** @var InvoiceDto $dto */
        $dto = $entity->toDto($depth-1);

        return $dto;
    }

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param InvoiceDto $dto
     * @return self
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ) {
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
     * @return self
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ) {
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
     * @param int $depth
     * @return InvoiceDto
     */
    public function toDto($depth = 0)
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

    /**
     * @return array
     */
    protected function __toArray()
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
            'invoiceTemplateId' => self::getInvoiceTemplate() ? self::getInvoiceTemplate()->getId() : null,
            'brandId' => self::getBrand()->getId(),
            'companyId' => self::getCompany()->getId(),
            'numberSequenceId' => self::getNumberSequence() ? self::getNumberSequence()->getId() : null,
            'schedulerId' => self::getScheduler() ? self::getScheduler()->getId() : null
        ];
    }

    /**
     * Set number
     *
     * @param string $number | null
     *
     * @return static
     */
    protected function setNumber(?string $number = null): InvoiceInterface
    {
        if (!is_null($number)) {
            Assertion::maxLength($number, 30, 'number value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->number = $number;

        return $this;
    }

    /**
     * Get number
     *
     * @return string | null
     */
    public function getNumber(): ?string
    {
        return $this->number;
    }

    /**
     * Set inDate
     *
     * @param \DateTimeInterface $inDate | null
     *
     * @return static
     */
    protected function setInDate($inDate = null): InvoiceInterface
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

            if ($this->inDate == $inDate) {
                return $this;
            }
        }

        $this->inDate = $inDate;

        return $this;
    }

    /**
     * Get inDate
     *
     * @return \DateTimeInterface | null
     */
    public function getInDate(): ?\DateTimeInterface
    {
        return !is_null($this->inDate) ? clone $this->inDate : null;
    }

    /**
     * Set outDate
     *
     * @param \DateTimeInterface $outDate | null
     *
     * @return static
     */
    protected function setOutDate($outDate = null): InvoiceInterface
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

            if ($this->outDate == $outDate) {
                return $this;
            }
        }

        $this->outDate = $outDate;

        return $this;
    }

    /**
     * Get outDate
     *
     * @return \DateTimeInterface | null
     */
    public function getOutDate(): ?\DateTimeInterface
    {
        return !is_null($this->outDate) ? clone $this->outDate : null;
    }

    /**
     * Set total
     *
     * @param float $total | null
     *
     * @return static
     */
    protected function setTotal(?float $total = null): InvoiceInterface
    {
        if (!is_null($total)) {
            $total = (float) $total;
        }

        $this->total = $total;

        return $this;
    }

    /**
     * Get total
     *
     * @return float | null
     */
    public function getTotal(): ?float
    {
        return $this->total;
    }

    /**
     * Set taxRate
     *
     * @param float $taxRate | null
     *
     * @return static
     */
    protected function setTaxRate(?float $taxRate = null): InvoiceInterface
    {
        if (!is_null($taxRate)) {
            $taxRate = (float) $taxRate;
        }

        $this->taxRate = $taxRate;

        return $this;
    }

    /**
     * Get taxRate
     *
     * @return float | null
     */
    public function getTaxRate(): ?float
    {
        return $this->taxRate;
    }

    /**
     * Set totalWithTax
     *
     * @param float $totalWithTax | null
     *
     * @return static
     */
    protected function setTotalWithTax(?float $totalWithTax = null): InvoiceInterface
    {
        if (!is_null($totalWithTax)) {
            $totalWithTax = (float) $totalWithTax;
        }

        $this->totalWithTax = $totalWithTax;

        return $this;
    }

    /**
     * Get totalWithTax
     *
     * @return float | null
     */
    public function getTotalWithTax(): ?float
    {
        return $this->totalWithTax;
    }

    /**
     * Set status
     *
     * @param string $status | null
     *
     * @return static
     */
    protected function setStatus(?string $status = null): InvoiceInterface
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

    /**
     * Get status
     *
     * @return string | null
     */
    public function getStatus(): ?string
    {
        return $this->status;
    }

    /**
     * Set statusMsg
     *
     * @param string $statusMsg | null
     *
     * @return static
     */
    protected function setStatusMsg(?string $statusMsg = null): InvoiceInterface
    {
        if (!is_null($statusMsg)) {
            Assertion::maxLength($statusMsg, 140, 'statusMsg value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->statusMsg = $statusMsg;

        return $this;
    }

    /**
     * Get statusMsg
     *
     * @return string | null
     */
    public function getStatusMsg(): ?string
    {
        return $this->statusMsg;
    }

    /**
     * Get pdf
     *
     * @return Pdf
     */
    public function getPdf(): Pdf
    {
        return $this->pdf;
    }

    /**
     * Set pdf
     *
     * @return static
     */
    protected function setPdf(Pdf $pdf): InvoiceInterface
    {
        $isEqual = $this->pdf && $this->pdf->equals($pdf);
        if ($isEqual) {
            return $this;
        }

        $this->pdf = $pdf;
        return $this;
    }

    /**
     * Set invoiceTemplate
     *
     * @param InvoiceTemplateInterface | null
     *
     * @return static
     */
    protected function setInvoiceTemplate(?InvoiceTemplateInterface $invoiceTemplate = null): InvoiceInterface
    {
        $this->invoiceTemplate = $invoiceTemplate;

        return $this;
    }

    /**
     * Get invoiceTemplate
     *
     * @return InvoiceTemplateInterface | null
     */
    public function getInvoiceTemplate(): ?InvoiceTemplateInterface
    {
        return $this->invoiceTemplate;
    }

    /**
     * Set brand
     *
     * @param BrandInterface
     *
     * @return static
     */
    protected function setBrand(BrandInterface $brand): InvoiceInterface
    {
        $this->brand = $brand;

        return $this;
    }

    /**
     * Get brand
     *
     * @return BrandInterface
     */
    public function getBrand(): BrandInterface
    {
        return $this->brand;
    }

    /**
     * Set company
     *
     * @param CompanyInterface
     *
     * @return static
     */
    protected function setCompany(CompanyInterface $company): InvoiceInterface
    {
        $this->company = $company;

        return $this;
    }

    /**
     * Get company
     *
     * @return CompanyInterface
     */
    public function getCompany(): CompanyInterface
    {
        return $this->company;
    }

    /**
     * Set numberSequence
     *
     * @param InvoiceNumberSequenceInterface | null
     *
     * @return static
     */
    protected function setNumberSequence(?InvoiceNumberSequenceInterface $numberSequence = null): InvoiceInterface
    {
        $this->numberSequence = $numberSequence;

        return $this;
    }

    /**
     * Get numberSequence
     *
     * @return InvoiceNumberSequenceInterface | null
     */
    public function getNumberSequence(): ?InvoiceNumberSequenceInterface
    {
        return $this->numberSequence;
    }

    /**
     * Set scheduler
     *
     * @param InvoiceSchedulerInterface | null
     *
     * @return static
     */
    protected function setScheduler(?InvoiceSchedulerInterface $scheduler = null): InvoiceInterface
    {
        $this->scheduler = $scheduler;

        return $this;
    }

    /**
     * Get scheduler
     *
     * @return InvoiceSchedulerInterface | null
     */
    public function getScheduler(): ?InvoiceSchedulerInterface
    {
        return $this->scheduler;
    }

}
