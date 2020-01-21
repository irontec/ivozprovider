<?php

namespace Ivoz\Provider\Domain\Model\Invoice;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;

/**
 * InvoiceAbstract
 * @codeCoverageIgnore
 */
abstract class InvoiceAbstract
{
    /**
     * @var string | null
     */
    protected $number;

    /**
     * @var \DateTime | null
     */
    protected $inDate;

    /**
     * @var \DateTime | null
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
     * @var Pdf
     */
    protected $pdf;

    /**
     * @var \Ivoz\Provider\Domain\Model\InvoiceTemplate\InvoiceTemplateInterface | null
     */
    protected $invoiceTemplate;

    /**
     * @var \Ivoz\Provider\Domain\Model\Brand\BrandInterface
     */
    protected $brand;

    /**
     * @var \Ivoz\Provider\Domain\Model\Company\CompanyInterface
     */
    protected $company;

    /**
     * @var \Ivoz\Provider\Domain\Model\InvoiceNumberSequence\InvoiceNumberSequenceInterface | null
     */
    protected $numberSequence;

    /**
     * @var \Ivoz\Provider\Domain\Model\InvoiceScheduler\InvoiceSchedulerInterface | null
     */
    protected $scheduler;


    use ChangelogTrait;

    /**
     * Constructor
     */
    protected function __construct(Pdf $pdf)
    {
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
        \Ivoz\Core\Application\ForeignKeyTransformerInterface $fkTransformer
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
            ->setScheduler($fkTransformer->transform($dto->getScheduler()))
        ;

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
        \Ivoz\Core\Application\ForeignKeyTransformerInterface $fkTransformer
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
            ->setInvoiceTemplate(\Ivoz\Provider\Domain\Model\InvoiceTemplate\InvoiceTemplate::entityToDto(self::getInvoiceTemplate(), $depth))
            ->setBrand(\Ivoz\Provider\Domain\Model\Brand\Brand::entityToDto(self::getBrand(), $depth))
            ->setCompany(\Ivoz\Provider\Domain\Model\Company\Company::entityToDto(self::getCompany(), $depth))
            ->setNumberSequence(\Ivoz\Provider\Domain\Model\InvoiceNumberSequence\InvoiceNumberSequence::entityToDto(self::getNumberSequence(), $depth))
            ->setScheduler(\Ivoz\Provider\Domain\Model\InvoiceScheduler\InvoiceScheduler::entityToDto(self::getScheduler(), $depth));
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
            'brandId' => self::getBrand() ? self::getBrand()->getId() : null,
            'companyId' => self::getCompany() ? self::getCompany()->getId() : null,
            'numberSequenceId' => self::getNumberSequence() ? self::getNumberSequence()->getId() : null,
            'schedulerId' => self::getScheduler() ? self::getScheduler()->getId() : null
        ];
    }
    // @codeCoverageIgnoreStart

    /**
     * Set number
     *
     * @param string $number | null
     *
     * @return static
     */
    protected function setNumber($number = null)
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
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * Set inDate
     *
     * @param \DateTime $inDate | null
     *
     * @return static
     */
    protected function setInDate($inDate = null)
    {
        if (!is_null($inDate)) {
            $inDate = \Ivoz\Core\Domain\Model\Helper\DateTimeHelper::createOrFix(
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
     * @return \DateTime | null
     */
    public function getInDate()
    {
        return !is_null($this->inDate) ? clone $this->inDate : null;
    }

    /**
     * Set outDate
     *
     * @param \DateTime $outDate | null
     *
     * @return static
     */
    protected function setOutDate($outDate = null)
    {
        if (!is_null($outDate)) {
            $outDate = \Ivoz\Core\Domain\Model\Helper\DateTimeHelper::createOrFix(
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
     * @return \DateTime | null
     */
    public function getOutDate()
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
    protected function setTotal($total = null)
    {
        if (!is_null($total)) {
            Assertion::numeric($total);
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
    public function getTotal()
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
    protected function setTaxRate($taxRate = null)
    {
        if (!is_null($taxRate)) {
            Assertion::numeric($taxRate);
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
    public function getTaxRate()
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
    protected function setTotalWithTax($totalWithTax = null)
    {
        if (!is_null($totalWithTax)) {
            Assertion::numeric($totalWithTax);
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
    public function getTotalWithTax()
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
    protected function setStatus($status = null)
    {
        if (!is_null($status)) {
            Assertion::maxLength($status, 25, 'status value "%s" is too long, it should have no more than %d characters, but has %d characters.');
            Assertion::choice($status, [
                InvoiceInterface::STATUS_WAITING,
                InvoiceInterface::STATUS_PROCESSING,
                InvoiceInterface::STATUS_CREATED,
                InvoiceInterface::STATUS_ERROR
            ], 'statusvalue "%s" is not an element of the valid values: %s');
        }

        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return string | null
     */
    public function getStatus()
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
    protected function setStatusMsg($statusMsg = null)
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
    public function getStatusMsg()
    {
        return $this->statusMsg;
    }

    /**
     * Set invoiceTemplate
     *
     * @param \Ivoz\Provider\Domain\Model\InvoiceTemplate\InvoiceTemplateInterface $invoiceTemplate | null
     *
     * @return static
     */
    public function setInvoiceTemplate(\Ivoz\Provider\Domain\Model\InvoiceTemplate\InvoiceTemplateInterface $invoiceTemplate = null)
    {
        $this->invoiceTemplate = $invoiceTemplate;

        return $this;
    }

    /**
     * Get invoiceTemplate
     *
     * @return \Ivoz\Provider\Domain\Model\InvoiceTemplate\InvoiceTemplateInterface | null
     */
    public function getInvoiceTemplate()
    {
        return $this->invoiceTemplate;
    }

    /**
     * Set brand
     *
     * @param \Ivoz\Provider\Domain\Model\Brand\BrandInterface $brand
     *
     * @return static
     */
    public function setBrand(\Ivoz\Provider\Domain\Model\Brand\BrandInterface $brand)
    {
        $this->brand = $brand;

        return $this;
    }

    /**
     * Get brand
     *
     * @return \Ivoz\Provider\Domain\Model\Brand\BrandInterface
     */
    public function getBrand()
    {
        return $this->brand;
    }

    /**
     * Set company
     *
     * @param \Ivoz\Provider\Domain\Model\Company\CompanyInterface $company
     *
     * @return static
     */
    public function setCompany(\Ivoz\Provider\Domain\Model\Company\CompanyInterface $company)
    {
        $this->company = $company;

        return $this;
    }

    /**
     * Get company
     *
     * @return \Ivoz\Provider\Domain\Model\Company\CompanyInterface
     */
    public function getCompany()
    {
        return $this->company;
    }

    /**
     * Set numberSequence
     *
     * @param \Ivoz\Provider\Domain\Model\InvoiceNumberSequence\InvoiceNumberSequenceInterface $numberSequence | null
     *
     * @return static
     */
    public function setNumberSequence(\Ivoz\Provider\Domain\Model\InvoiceNumberSequence\InvoiceNumberSequenceInterface $numberSequence = null)
    {
        $this->numberSequence = $numberSequence;

        return $this;
    }

    /**
     * Get numberSequence
     *
     * @return \Ivoz\Provider\Domain\Model\InvoiceNumberSequence\InvoiceNumberSequenceInterface | null
     */
    public function getNumberSequence()
    {
        return $this->numberSequence;
    }

    /**
     * Set scheduler
     *
     * @param \Ivoz\Provider\Domain\Model\InvoiceScheduler\InvoiceSchedulerInterface $scheduler | null
     *
     * @return static
     */
    public function setScheduler(\Ivoz\Provider\Domain\Model\InvoiceScheduler\InvoiceSchedulerInterface $scheduler = null)
    {
        $this->scheduler = $scheduler;

        return $this;
    }

    /**
     * Get scheduler
     *
     * @return \Ivoz\Provider\Domain\Model\InvoiceScheduler\InvoiceSchedulerInterface | null
     */
    public function getScheduler()
    {
        return $this->scheduler;
    }

    /**
     * Set pdf
     *
     * @param \Ivoz\Provider\Domain\Model\Invoice\Pdf $pdf
     *
     * @return static
     */
    public function setPdf(Pdf $pdf)
    {
        $this->pdf = $pdf;
        return $this;
    }

    /**
     * Get pdf
     *
     * @return \Ivoz\Provider\Domain\Model\Invoice\Pdf
     */
    public function getPdf()
    {
        return $this->pdf;
    }
    // @codeCoverageIgnoreEnd
}
