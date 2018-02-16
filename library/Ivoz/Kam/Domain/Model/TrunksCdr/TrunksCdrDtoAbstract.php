<?php

namespace Ivoz\Kam\Domain\Model\TrunksCdr;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Core\Application\CollectionTransformerInterface;
use Ivoz\Core\Application\Model\DtoNormalizer;

/**
 * @codeCoverageIgnore
 */
abstract class TrunksCdrDtoAbstract implements DataTransferObjectInterface
{
    /**
     * @var \DateTime
     */
    private $startTime = '2000-01-01 00:00:00';

    /**
     * @var \DateTime
     */
    private $endTime = '2000-01-01 00:00:00';

    /**
     * @var float
     */
    private $duration = '0.000';

    /**
     * @var string
     */
    private $caller;

    /**
     * @var string
     */
    private $callee;

    /**
     * @var string
     */
    private $referee;

    /**
     * @var string
     */
    private $referrer;

    /**
     * @var string
     */
    private $callid;

    /**
     * @var string
     */
    private $callidHash;

    /**
     * @var string
     */
    private $xcallid;

    /**
     * @var string
     */
    private $diversion;

    /**
     * @var boolean
     */
    private $bounced;

    /**
     * @var string
     */
    private $price;

    /**
     * @var string
     */
    private $priceDetails;

    /**
     * @var string
     */
    private $direction;

    /**
     * @var string
     */
    private $cgrid;

    /**
     * @var integer
     */
    private $id;

    /**
     * @var \Ivoz\Provider\Domain\Model\Invoice\InvoiceDto | null
     */
    private $invoice;

    /**
     * @var \Ivoz\Provider\Domain\Model\Brand\BrandDto | null
     */
    private $brand;

    /**
     * @var \Ivoz\Provider\Domain\Model\Company\CompanyDto | null
     */
    private $company;

    /**
     * @var \Ivoz\Provider\Domain\Model\PeeringContract\PeeringContractDto | null
     */
    private $peeringContract;

    /**
     * @var \Ivoz\Cgr\Domain\Model\Destination\DestinationDto | null
     */
    private $destination;

    /**
     * @var \Ivoz\Cgr\Domain\Model\DestinationRate\DestinationRateDto | null
     */
    private $destinationRate;


    use DtoNormalizer;

    public function __construct($id = null)
    {
        $this->setId($id);
    }

    /**
     * @inheritdoc
     */
    public static function getPropertyMap(string $context = '')
    {
        if ($context === self::CONTEXT_COLLECTION) {
            return ['id' => 'id'];
        }

        return [
            'startTime' => 'startTime',
            'endTime' => 'endTime',
            'duration' => 'duration',
            'caller' => 'caller',
            'callee' => 'callee',
            'referee' => 'referee',
            'referrer' => 'referrer',
            'callid' => 'callid',
            'callidHash' => 'callidHash',
            'xcallid' => 'xcallid',
            'diversion' => 'diversion',
            'bounced' => 'bounced',
            'price' => 'price',
            'priceDetails' => 'priceDetails',
            'direction' => 'direction',
            'cgrid' => 'cgrid',
            'id' => 'id',
            'invoiceId' => 'invoice',
            'brandId' => 'brand',
            'companyId' => 'company',
            'peeringContractId' => 'peeringContract',
            'destinationId' => 'destination',
            'destinationRateId' => 'destinationRate'
        ];
    }

    /**
     * @return array
     */
    public function toArray($hideSensitiveData = false)
    {
        return [
            'startTime' => $this->getStartTime(),
            'endTime' => $this->getEndTime(),
            'duration' => $this->getDuration(),
            'caller' => $this->getCaller(),
            'callee' => $this->getCallee(),
            'referee' => $this->getReferee(),
            'referrer' => $this->getReferrer(),
            'callid' => $this->getCallid(),
            'callidHash' => $this->getCallidHash(),
            'xcallid' => $this->getXcallid(),
            'diversion' => $this->getDiversion(),
            'bounced' => $this->getBounced(),
            'price' => $this->getPrice(),
            'priceDetails' => $this->getPriceDetails(),
            'direction' => $this->getDirection(),
            'cgrid' => $this->getCgrid(),
            'id' => $this->getId(),
            'invoice' => $this->getInvoice(),
            'brand' => $this->getBrand(),
            'company' => $this->getCompany(),
            'peeringContract' => $this->getPeeringContract(),
            'destination' => $this->getDestination(),
            'destinationRate' => $this->getDestinationRate()
        ];
    }

    /**
     * {@inheritDoc}
     */
    public function transformForeignKeys(ForeignKeyTransformerInterface $transformer)
    {
        $this->invoice = $transformer->transform('Ivoz\\Provider\\Domain\\Model\\Invoice\\Invoice', $this->getInvoiceId());
        $this->brand = $transformer->transform('Ivoz\\Provider\\Domain\\Model\\Brand\\Brand', $this->getBrandId());
        $this->company = $transformer->transform('Ivoz\\Provider\\Domain\\Model\\Company\\Company', $this->getCompanyId());
        $this->peeringContract = $transformer->transform('Ivoz\\Provider\\Domain\\Model\\PeeringContract\\PeeringContract', $this->getPeeringContractId());
        $this->destination = $transformer->transform('Ivoz\\Cgr\\Domain\\Model\\Destination\\Destination', $this->getDestinationId());
        $this->destinationRate = $transformer->transform('Ivoz\\Cgr\\Domain\\Model\\DestinationRate\\DestinationRate', $this->getDestinationRateId());
    }

    /**
     * {@inheritDoc}
     */
    public function transformCollections(CollectionTransformerInterface $transformer)
    {

    }

    /**
     * @param \DateTime $startTime
     *
     * @return static
     */
    public function setStartTime($startTime = null)
    {
        $this->startTime = $startTime;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getStartTime()
    {
        return $this->startTime;
    }

    /**
     * @param \DateTime $endTime
     *
     * @return static
     */
    public function setEndTime($endTime = null)
    {
        $this->endTime = $endTime;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getEndTime()
    {
        return $this->endTime;
    }

    /**
     * @param float $duration
     *
     * @return static
     */
    public function setDuration($duration = null)
    {
        $this->duration = $duration;

        return $this;
    }

    /**
     * @return float
     */
    public function getDuration()
    {
        return $this->duration;
    }

    /**
     * @param string $caller
     *
     * @return static
     */
    public function setCaller($caller = null)
    {
        $this->caller = $caller;

        return $this;
    }

    /**
     * @return string
     */
    public function getCaller()
    {
        return $this->caller;
    }

    /**
     * @param string $callee
     *
     * @return static
     */
    public function setCallee($callee = null)
    {
        $this->callee = $callee;

        return $this;
    }

    /**
     * @return string
     */
    public function getCallee()
    {
        return $this->callee;
    }

    /**
     * @param string $referee
     *
     * @return static
     */
    public function setReferee($referee = null)
    {
        $this->referee = $referee;

        return $this;
    }

    /**
     * @return string
     */
    public function getReferee()
    {
        return $this->referee;
    }

    /**
     * @param string $referrer
     *
     * @return static
     */
    public function setReferrer($referrer = null)
    {
        $this->referrer = $referrer;

        return $this;
    }

    /**
     * @return string
     */
    public function getReferrer()
    {
        return $this->referrer;
    }

    /**
     * @param string $callid
     *
     * @return static
     */
    public function setCallid($callid = null)
    {
        $this->callid = $callid;

        return $this;
    }

    /**
     * @return string
     */
    public function getCallid()
    {
        return $this->callid;
    }

    /**
     * @param string $callidHash
     *
     * @return static
     */
    public function setCallidHash($callidHash = null)
    {
        $this->callidHash = $callidHash;

        return $this;
    }

    /**
     * @return string
     */
    public function getCallidHash()
    {
        return $this->callidHash;
    }

    /**
     * @param string $xcallid
     *
     * @return static
     */
    public function setXcallid($xcallid = null)
    {
        $this->xcallid = $xcallid;

        return $this;
    }

    /**
     * @return string
     */
    public function getXcallid()
    {
        return $this->xcallid;
    }

    /**
     * @param string $diversion
     *
     * @return static
     */
    public function setDiversion($diversion = null)
    {
        $this->diversion = $diversion;

        return $this;
    }

    /**
     * @return string
     */
    public function getDiversion()
    {
        return $this->diversion;
    }

    /**
     * @param boolean $bounced
     *
     * @return static
     */
    public function setBounced($bounced = null)
    {
        $this->bounced = $bounced;

        return $this;
    }

    /**
     * @return boolean
     */
    public function getBounced()
    {
        return $this->bounced;
    }

    /**
     * @param string $price
     *
     * @return static
     */
    public function setPrice($price = null)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * @return string
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param string $priceDetails
     *
     * @return static
     */
    public function setPriceDetails($priceDetails = null)
    {
        $this->priceDetails = $priceDetails;

        return $this;
    }

    /**
     * @return string
     */
    public function getPriceDetails()
    {
        return $this->priceDetails;
    }

    /**
     * @param string $direction
     *
     * @return static
     */
    public function setDirection($direction = null)
    {
        $this->direction = $direction;

        return $this;
    }

    /**
     * @return string
     */
    public function getDirection()
    {
        return $this->direction;
    }

    /**
     * @param string $cgrid
     *
     * @return static
     */
    public function setCgrid($cgrid = null)
    {
        $this->cgrid = $cgrid;

        return $this;
    }

    /**
     * @return string
     */
    public function getCgrid()
    {
        return $this->cgrid;
    }

    /**
     * @param integer $id
     *
     * @return static
     */
    public function setId($id = null)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param \Ivoz\Provider\Domain\Model\Invoice\InvoiceDto $invoice
     *
     * @return static
     */
    public function setInvoice(\Ivoz\Provider\Domain\Model\Invoice\InvoiceDto $invoice = null)
    {
        $this->invoice = $invoice;

        return $this;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\Invoice\InvoiceDto
     */
    public function getInvoice()
    {
        return $this->invoice;
    }

    /**
     * @param integer $id | null
     *
     * @return static
     */
    public function setInvoiceId($id)
    {
        $value = !is_null($id)
            ? new \Ivoz\Provider\Domain\Model\Invoice\InvoiceDto($id)
            : null;

        return $this->setInvoice($value);
    }

    /**
     * @return integer | null
     */
    public function getInvoiceId()
    {
        if ($dto = $this->getInvoice()) {
            return $dto->getId();
        }

        return null;
    }

    /**
     * @param \Ivoz\Provider\Domain\Model\Brand\BrandDto $brand
     *
     * @return static
     */
    public function setBrand(\Ivoz\Provider\Domain\Model\Brand\BrandDto $brand = null)
    {
        $this->brand = $brand;

        return $this;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\Brand\BrandDto
     */
    public function getBrand()
    {
        return $this->brand;
    }

    /**
     * @param integer $id | null
     *
     * @return static
     */
    public function setBrandId($id)
    {
        $value = !is_null($id)
            ? new \Ivoz\Provider\Domain\Model\Brand\BrandDto($id)
            : null;

        return $this->setBrand($value);
    }

    /**
     * @return integer | null
     */
    public function getBrandId()
    {
        if ($dto = $this->getBrand()) {
            return $dto->getId();
        }

        return null;
    }

    /**
     * @param \Ivoz\Provider\Domain\Model\Company\CompanyDto $company
     *
     * @return static
     */
    public function setCompany(\Ivoz\Provider\Domain\Model\Company\CompanyDto $company = null)
    {
        $this->company = $company;

        return $this;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\Company\CompanyDto
     */
    public function getCompany()
    {
        return $this->company;
    }

    /**
     * @param integer $id | null
     *
     * @return static
     */
    public function setCompanyId($id)
    {
        $value = !is_null($id)
            ? new \Ivoz\Provider\Domain\Model\Company\CompanyDto($id)
            : null;

        return $this->setCompany($value);
    }

    /**
     * @return integer | null
     */
    public function getCompanyId()
    {
        if ($dto = $this->getCompany()) {
            return $dto->getId();
        }

        return null;
    }

    /**
     * @param \Ivoz\Provider\Domain\Model\PeeringContract\PeeringContractDto $peeringContract
     *
     * @return static
     */
    public function setPeeringContract(\Ivoz\Provider\Domain\Model\PeeringContract\PeeringContractDto $peeringContract = null)
    {
        $this->peeringContract = $peeringContract;

        return $this;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\PeeringContract\PeeringContractDto
     */
    public function getPeeringContract()
    {
        return $this->peeringContract;
    }

    /**
     * @param integer $id | null
     *
     * @return static
     */
    public function setPeeringContractId($id)
    {
        $value = !is_null($id)
            ? new \Ivoz\Provider\Domain\Model\PeeringContract\PeeringContractDto($id)
            : null;

        return $this->setPeeringContract($value);
    }

    /**
     * @return integer | null
     */
    public function getPeeringContractId()
    {
        if ($dto = $this->getPeeringContract()) {
            return $dto->getId();
        }

        return null;
    }

    /**
     * @param \Ivoz\Cgr\Domain\Model\Destination\DestinationDto $destination
     *
     * @return static
     */
    public function setDestination(\Ivoz\Cgr\Domain\Model\Destination\DestinationDto $destination = null)
    {
        $this->destination = $destination;

        return $this;
    }

    /**
     * @return \Ivoz\Cgr\Domain\Model\Destination\DestinationDto
     */
    public function getDestination()
    {
        return $this->destination;
    }

    /**
     * @param integer $id | null
     *
     * @return static
     */
    public function setDestinationId($id)
    {
        $value = !is_null($id)
            ? new \Ivoz\Cgr\Domain\Model\Destination\DestinationDto($id)
            : null;

        return $this->setDestination($value);
    }

    /**
     * @return integer | null
     */
    public function getDestinationId()
    {
        if ($dto = $this->getDestination()) {
            return $dto->getId();
        }

        return null;
    }

    /**
     * @param \Ivoz\Cgr\Domain\Model\DestinationRate\DestinationRateDto $destinationRate
     *
     * @return static
     */
    public function setDestinationRate(\Ivoz\Cgr\Domain\Model\DestinationRate\DestinationRateDto $destinationRate = null)
    {
        $this->destinationRate = $destinationRate;

        return $this;
    }

    /**
     * @return \Ivoz\Cgr\Domain\Model\DestinationRate\DestinationRateDto
     */
    public function getDestinationRate()
    {
        return $this->destinationRate;
    }

    /**
     * @param integer $id | null
     *
     * @return static
     */
    public function setDestinationRateId($id)
    {
        $value = !is_null($id)
            ? new \Ivoz\Cgr\Domain\Model\DestinationRate\DestinationRateDto($id)
            : null;

        return $this->setDestinationRate($value);
    }

    /**
     * @return integer | null
     */
    public function getDestinationRateId()
    {
        if ($dto = $this->getDestinationRate()) {
            return $dto->getId();
        }

        return null;
    }
}


