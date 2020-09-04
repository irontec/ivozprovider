<?php

namespace Ivoz\Provider\Domain\Model\BillableCall;

use Ivoz\Core\Application\DataTransferObjectInterface;
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
     * @var \DateTime | string
     */
    private $startTime;

    /**
     * @var float
     */
    private $duration = 0.0;

    /**
     * @var string
     */
    private $caller;

    /**
     * @var string
     */
    private $callee;

    /**
     * @var float
     */
    private $cost;

    /**
     * @var float
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
     * @var string
     */
    private $endpointName;

    /**
     * @var string
     */
    private $direction = 'outbound';

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

    /**
     * @var \Ivoz\Provider\Domain\Model\Ddi\DdiDto | null
     */
    private $ddi;

    /**
     * @var \Ivoz\Provider\Domain\Model\DdiProvider\DdiProviderDto | null
     */
    private $ddiProvider;


    use DtoNormalizer;

    public function __construct($id = null)
    {
        $this->setId($id);
    }

    /**
     * @inheritdoc
     */
    public static function getPropertyMap(string $context = '', string $role = null)
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
            'endpointName' => 'endpointName',
            'direction' => 'direction',
            'id' => 'id',
            'brandId' => 'brand',
            'companyId' => 'company',
            'carrierId' => 'carrier',
            'destinationId' => 'destination',
            'ratingPlanGroupId' => 'ratingPlanGroup',
            'invoiceId' => 'invoice',
            'trunksCdrId' => 'trunksCdr',
            'ddiId' => 'ddi',
            'ddiProviderId' => 'ddiProvider'
        ];
    }

    /**
     * @return array
     */
    public function toArray($hideSensitiveData = false)
    {
        $response = [
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
            'endpointName' => $this->getEndpointName(),
            'direction' => $this->getDirection(),
            'id' => $this->getId(),
            'brand' => $this->getBrand(),
            'company' => $this->getCompany(),
            'carrier' => $this->getCarrier(),
            'destination' => $this->getDestination(),
            'ratingPlanGroup' => $this->getRatingPlanGroup(),
            'invoice' => $this->getInvoice(),
            'trunksCdr' => $this->getTrunksCdr(),
            'ddi' => $this->getDdi(),
            'ddiProvider' => $this->getDdiProvider()
        ];

        if (!$hideSensitiveData) {
            return $response;
        }

        foreach ($this->sensitiveFields as $sensitiveField) {
            if (!array_key_exists($sensitiveField, $response)) {
                throw new \Exception($sensitiveField . ' field was not found');
            }
            $response[$sensitiveField] = '*****';
        }

        return $response;
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
     * @return string | null
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
     * @return \DateTime | null
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
     * @return float | null
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
     * @return string | null
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
     * @return string | null
     */
    public function getCallee()
    {
        return $this->callee;
    }

    /**
     * @param float $cost
     *
     * @return static
     */
    public function setCost($cost = null)
    {
        $this->cost = $cost;

        return $this;
    }

    /**
     * @return float | null
     */
    public function getCost()
    {
        return $this->cost;
    }

    /**
     * @param float $price
     *
     * @return static
     */
    public function setPrice($price = null)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * @return float | null
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
     * @return array | null
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
     * @return string | null
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
     * @return string | null
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
     * @return string | null
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
     * @return string | null
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
     * @return integer | null
     */
    public function getEndpointId()
    {
        return $this->endpointId;
    }

    /**
     * @param string $endpointName
     *
     * @return static
     */
    public function setEndpointName($endpointName = null)
    {
        $this->endpointName = $endpointName;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getEndpointName()
    {
        return $this->endpointName;
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
     * @return string | null
     */
    public function getDirection()
    {
        return $this->direction;
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
     * @return integer | null
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
     * @return \Ivoz\Provider\Domain\Model\Brand\BrandDto | null
     */
    public function getBrand()
    {
        return $this->brand;
    }

    /**
     * @param mixed | null $id
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
     * @return mixed | null
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
     * @return \Ivoz\Provider\Domain\Model\Company\CompanyDto | null
     */
    public function getCompany()
    {
        return $this->company;
    }

    /**
     * @param mixed | null $id
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
     * @return mixed | null
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
     * @return \Ivoz\Provider\Domain\Model\Carrier\CarrierDto | null
     */
    public function getCarrier()
    {
        return $this->carrier;
    }

    /**
     * @param mixed | null $id
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
     * @return mixed | null
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
     * @return \Ivoz\Provider\Domain\Model\Destination\DestinationDto | null
     */
    public function getDestination()
    {
        return $this->destination;
    }

    /**
     * @param mixed | null $id
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
     * @return mixed | null
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
     * @return \Ivoz\Provider\Domain\Model\RatingPlanGroup\RatingPlanGroupDto | null
     */
    public function getRatingPlanGroup()
    {
        return $this->ratingPlanGroup;
    }

    /**
     * @param mixed | null $id
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
     * @return mixed | null
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
     * @return \Ivoz\Provider\Domain\Model\Invoice\InvoiceDto | null
     */
    public function getInvoice()
    {
        return $this->invoice;
    }

    /**
     * @param mixed | null $id
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
     * @return mixed | null
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
     * @return \Ivoz\Kam\Domain\Model\TrunksCdr\TrunksCdrDto | null
     */
    public function getTrunksCdr()
    {
        return $this->trunksCdr;
    }

    /**
     * @param mixed | null $id
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
     * @return mixed | null
     */
    public function getTrunksCdrId()
    {
        if ($dto = $this->getTrunksCdr()) {
            return $dto->getId();
        }

        return null;
    }

    /**
     * @param \Ivoz\Provider\Domain\Model\Ddi\DdiDto $ddi
     *
     * @return static
     */
    public function setDdi(\Ivoz\Provider\Domain\Model\Ddi\DdiDto $ddi = null)
    {
        $this->ddi = $ddi;

        return $this;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\Ddi\DdiDto | null
     */
    public function getDdi()
    {
        return $this->ddi;
    }

    /**
     * @param mixed | null $id
     *
     * @return static
     */
    public function setDdiId($id)
    {
        $value = !is_null($id)
            ? new \Ivoz\Provider\Domain\Model\Ddi\DdiDto($id)
            : null;

        return $this->setDdi($value);
    }

    /**
     * @return mixed | null
     */
    public function getDdiId()
    {
        if ($dto = $this->getDdi()) {
            return $dto->getId();
        }

        return null;
    }

    /**
     * @param \Ivoz\Provider\Domain\Model\DdiProvider\DdiProviderDto $ddiProvider
     *
     * @return static
     */
    public function setDdiProvider(\Ivoz\Provider\Domain\Model\DdiProvider\DdiProviderDto $ddiProvider = null)
    {
        $this->ddiProvider = $ddiProvider;

        return $this;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\DdiProvider\DdiProviderDto | null
     */
    public function getDdiProvider()
    {
        return $this->ddiProvider;
    }

    /**
     * @param mixed | null $id
     *
     * @return static
     */
    public function setDdiProviderId($id)
    {
        $value = !is_null($id)
            ? new \Ivoz\Provider\Domain\Model\DdiProvider\DdiProviderDto($id)
            : null;

        return $this->setDdiProvider($value);
    }

    /**
     * @return mixed | null
     */
    public function getDdiProviderId()
    {
        if ($dto = $this->getDdiProvider()) {
            return $dto->getId();
        }

        return null;
    }
}
