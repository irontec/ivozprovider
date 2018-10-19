<?php

namespace Ivoz\Provider\Domain\Model\BillableCall;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Core\Application\CollectionTransformerInterface;
use Ivoz\Core\Application\Model\DtoNormalizer;

/**
 * @codeCoverageIgnore
 */
abstract class BillableCallDtoAbstract implements DataTransferObjectInterface
{
    /**
     * @var string
     */
    private $callid;

    /**
     * @var \DateTime
     */
    private $startTime;

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
    private $cost;

    /**
     * @var string
     */
    private $price;

    /**
     * @var array
     */
    private $priceDetails;

    /**
     * @var string
     */
    private $carrierName;

    /**
     * @var string
     */
    private $destinationName;

    /**
     * @var string
     */
    private $ratingPlanName;

    /**
     * @var string
     */
    private $endpointType;

    /**
     * @var integer
     */
    private $endpointId;

    /**
     * @var integer
     */
    private $id;

    /**
     * @var \Ivoz\Provider\Domain\Model\Brand\BrandDto | null
     */
    private $brand;

    /**
     * @var \Ivoz\Provider\Domain\Model\Company\CompanyDto | null
     */
    private $company;

    /**
     * @var \Ivoz\Provider\Domain\Model\Carrier\CarrierDto | null
     */
    private $carrier;

    /**
     * @var \Ivoz\Provider\Domain\Model\Destination\DestinationDto | null
     */
    private $destination;

    /**
     * @var \Ivoz\Provider\Domain\Model\RatingPlanGroup\RatingPlanGroupDto | null
     */
    private $ratingPlanGroup;

    /**
     * @var \Ivoz\Provider\Domain\Model\Invoice\InvoiceDto | null
     */
    private $invoice;

    /**
     * @var \Ivoz\Kam\Domain\Model\TrunksCdr\TrunksCdrDto | null
     */
    private $trunksCdr;


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
            'callid' => 'callid',
            'startTime' => 'startTime',
            'duration' => 'duration',
            'caller' => 'caller',
            'callee' => 'callee',
            'cost' => 'cost',
            'price' => 'price',
            'priceDetails' => 'priceDetails',
            'carrierName' => 'carrierName',
            'destinationName' => 'destinationName',
            'ratingPlanName' => 'ratingPlanName',
            'endpointType' => 'endpointType',
            'endpointId' => 'endpointId',
            'id' => 'id',
            'brandId' => 'brand',
            'companyId' => 'company',
            'carrierId' => 'carrier',
            'destinationId' => 'destination',
            'ratingPlanGroupId' => 'ratingPlanGroup',
            'invoiceId' => 'invoice',
            'trunksCdrId' => 'trunksCdr'
        ];
    }

    /**
     * @return array
     */
    public function toArray($hideSensitiveData = false)
    {
        return [
            'callid' => $this->getCallid(),
            'startTime' => $this->getStartTime(),
            'duration' => $this->getDuration(),
            'caller' => $this->getCaller(),
            'callee' => $this->getCallee(),
            'cost' => $this->getCost(),
            'price' => $this->getPrice(),
            'priceDetails' => $this->getPriceDetails(),
            'carrierName' => $this->getCarrierName(),
            'destinationName' => $this->getDestinationName(),
            'ratingPlanName' => $this->getRatingPlanName(),
            'endpointType' => $this->getEndpointType(),
            'endpointId' => $this->getEndpointId(),
            'id' => $this->getId(),
            'brand' => $this->getBrand(),
            'company' => $this->getCompany(),
            'carrier' => $this->getCarrier(),
            'destination' => $this->getDestination(),
            'ratingPlanGroup' => $this->getRatingPlanGroup(),
            'invoice' => $this->getInvoice(),
            'trunksCdr' => $this->getTrunksCdr()
        ];
    }

    /**
     * {@inheritDoc}
     */
    public function transformForeignKeys(ForeignKeyTransformerInterface $transformer)
    {
        $this->brand = $transformer->transform('Ivoz\\Provider\\Domain\\Model\\Brand\\Brand', $this->getBrandId());
        $this->company = $transformer->transform('Ivoz\\Provider\\Domain\\Model\\Company\\Company', $this->getCompanyId());
        $this->carrier = $transformer->transform('Ivoz\\Provider\\Domain\\Model\\Carrier\\Carrier', $this->getCarrierId());
        $this->destination = $transformer->transform('Ivoz\\Provider\\Domain\\Model\\Destination\\Destination', $this->getDestinationId());
        $this->ratingPlanGroup = $transformer->transform('Ivoz\\Provider\\Domain\\Model\\RatingPlanGroup\\RatingPlanGroup', $this->getRatingPlanGroupId());
        $this->invoice = $transformer->transform('Ivoz\\Provider\\Domain\\Model\\Invoice\\Invoice', $this->getInvoiceId());
        $this->trunksCdr = $transformer->transform('Ivoz\\Kam\\Domain\\Model\\TrunksCdr\\TrunksCdr', $this->getTrunksCdrId());
    }

    /**
     * {@inheritDoc}
     */
    public function transformCollections(CollectionTransformerInterface $transformer)
    {
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
     * @param string $cost
     *
     * @return static
     */
    public function setCost($cost = null)
    {
        $this->cost = $cost;

        return $this;
    }

    /**
     * @return string
     */
    public function getCost()
    {
        return $this->cost;
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
     * @param array $priceDetails
     *
     * @return static
     */
    public function setPriceDetails($priceDetails = null)
    {
        $this->priceDetails = $priceDetails;

        return $this;
    }

    /**
     * @return array
     */
    public function getPriceDetails()
    {
        return $this->priceDetails;
    }

    /**
     * @param string $carrierName
     *
     * @return static
     */
    public function setCarrierName($carrierName = null)
    {
        $this->carrierName = $carrierName;

        return $this;
    }

    /**
     * @return string
     */
    public function getCarrierName()
    {
        return $this->carrierName;
    }

    /**
     * @param string $destinationName
     *
     * @return static
     */
    public function setDestinationName($destinationName = null)
    {
        $this->destinationName = $destinationName;

        return $this;
    }

    /**
     * @return string
     */
    public function getDestinationName()
    {
        return $this->destinationName;
    }

    /**
     * @param string $ratingPlanName
     *
     * @return static
     */
    public function setRatingPlanName($ratingPlanName = null)
    {
        $this->ratingPlanName = $ratingPlanName;

        return $this;
    }

    /**
     * @return string
     */
    public function getRatingPlanName()
    {
        return $this->ratingPlanName;
    }

    /**
     * @param string $endpointType
     *
     * @return static
     */
    public function setEndpointType($endpointType = null)
    {
        $this->endpointType = $endpointType;

        return $this;
    }

    /**
     * @return string
     */
    public function getEndpointType()
    {
        return $this->endpointType;
    }

    /**
     * @param integer $endpointId
     *
     * @return static
     */
    public function setEndpointId($endpointId = null)
    {
        $this->endpointId = $endpointId;

        return $this;
    }

    /**
     * @return integer
     */
    public function getEndpointId()
    {
        return $this->endpointId;
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
     * @param \Ivoz\Provider\Domain\Model\Carrier\CarrierDto $carrier
     *
     * @return static
     */
    public function setCarrier(\Ivoz\Provider\Domain\Model\Carrier\CarrierDto $carrier = null)
    {
        $this->carrier = $carrier;

        return $this;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\Carrier\CarrierDto
     */
    public function getCarrier()
    {
        return $this->carrier;
    }

    /**
     * @param integer $id | null
     *
     * @return static
     */
    public function setCarrierId($id)
    {
        $value = !is_null($id)
            ? new \Ivoz\Provider\Domain\Model\Carrier\CarrierDto($id)
            : null;

        return $this->setCarrier($value);
    }

    /**
     * @return integer | null
     */
    public function getCarrierId()
    {
        if ($dto = $this->getCarrier()) {
            return $dto->getId();
        }

        return null;
    }

    /**
     * @param \Ivoz\Provider\Domain\Model\Destination\DestinationDto $destination
     *
     * @return static
     */
    public function setDestination(\Ivoz\Provider\Domain\Model\Destination\DestinationDto $destination = null)
    {
        $this->destination = $destination;

        return $this;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\Destination\DestinationDto
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
            ? new \Ivoz\Provider\Domain\Model\Destination\DestinationDto($id)
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
     * @param \Ivoz\Provider\Domain\Model\RatingPlanGroup\RatingPlanGroupDto $ratingPlanGroup
     *
     * @return static
     */
    public function setRatingPlanGroup(\Ivoz\Provider\Domain\Model\RatingPlanGroup\RatingPlanGroupDto $ratingPlanGroup = null)
    {
        $this->ratingPlanGroup = $ratingPlanGroup;

        return $this;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\RatingPlanGroup\RatingPlanGroupDto
     */
    public function getRatingPlanGroup()
    {
        return $this->ratingPlanGroup;
    }

    /**
     * @param integer $id | null
     *
     * @return static
     */
    public function setRatingPlanGroupId($id)
    {
        $value = !is_null($id)
            ? new \Ivoz\Provider\Domain\Model\RatingPlanGroup\RatingPlanGroupDto($id)
            : null;

        return $this->setRatingPlanGroup($value);
    }

    /**
     * @return integer | null
     */
    public function getRatingPlanGroupId()
    {
        if ($dto = $this->getRatingPlanGroup()) {
            return $dto->getId();
        }

        return null;
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
     * @param \Ivoz\Kam\Domain\Model\TrunksCdr\TrunksCdrDto $trunksCdr
     *
     * @return static
     */
    public function setTrunksCdr(\Ivoz\Kam\Domain\Model\TrunksCdr\TrunksCdrDto $trunksCdr = null)
    {
        $this->trunksCdr = $trunksCdr;

        return $this;
    }

    /**
     * @return \Ivoz\Kam\Domain\Model\TrunksCdr\TrunksCdrDto
     */
    public function getTrunksCdr()
    {
        return $this->trunksCdr;
    }

    /**
     * @param integer $id | null
     *
     * @return static
     */
    public function setTrunksCdrId($id)
    {
        $value = !is_null($id)
            ? new \Ivoz\Kam\Domain\Model\TrunksCdr\TrunksCdrDto($id)
            : null;

        return $this->setTrunksCdr($value);
    }

    /**
     * @return integer | null
     */
    public function getTrunksCdrId()
    {
        if ($dto = $this->getTrunksCdr()) {
            return $dto->getId();
        }

        return null;
    }
}
