<?php

namespace Ivoz\Provider\Domain\Model\BillableCallHistoric;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\Model\DtoNormalizer;

/**
 * @codeCoverageIgnore
 */
abstract class BillableCallHistoricDtoAbstract implements DataTransferObjectInterface
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
    private $brand;

    /**
     * @var integer
     */
    private $company;

    /**
     * @var integer
     */
    private $carrier;

    /**
     * @var integer
     */
    private $destination;

    /**
     * @var integer
     */
    private $ratingPlanGroup;

    /**
     * @var integer
     */
    private $invoice;

    /**
     * @var integer
     */
    private $trunksCdr;

    /**
     * @var integer
     */
    private $ddi;

    /**
     * @var integer
     */
    private $ddiProvider;

    /**
     * @var integer
     */
    private $id;


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
            'brand' => 'brand',
            'company' => 'company',
            'carrier' => 'carrier',
            'destination' => 'destination',
            'ratingPlanGroup' => 'ratingPlanGroup',
            'invoice' => 'invoice',
            'trunksCdr' => 'trunksCdr',
            'ddi' => 'ddi',
            'ddiProvider' => 'ddiProvider',
            'id' => 'id'
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
            'brand' => $this->getBrand(),
            'company' => $this->getCompany(),
            'carrier' => $this->getCarrier(),
            'destination' => $this->getDestination(),
            'ratingPlanGroup' => $this->getRatingPlanGroup(),
            'invoice' => $this->getInvoice(),
            'trunksCdr' => $this->getTrunksCdr(),
            'ddi' => $this->getDdi(),
            'ddiProvider' => $this->getDdiProvider(),
            'id' => $this->getId()
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
     * @param integer $brand
     *
     * @return static
     */
    public function setBrand($brand = null)
    {
        $this->brand = $brand;

        return $this;
    }

    /**
     * @return integer | null
     */
    public function getBrand()
    {
        return $this->brand;
    }

    /**
     * @param integer $company
     *
     * @return static
     */
    public function setCompany($company = null)
    {
        $this->company = $company;

        return $this;
    }

    /**
     * @return integer | null
     */
    public function getCompany()
    {
        return $this->company;
    }

    /**
     * @param integer $carrier
     *
     * @return static
     */
    public function setCarrier($carrier = null)
    {
        $this->carrier = $carrier;

        return $this;
    }

    /**
     * @return integer | null
     */
    public function getCarrier()
    {
        return $this->carrier;
    }

    /**
     * @param integer $destination
     *
     * @return static
     */
    public function setDestination($destination = null)
    {
        $this->destination = $destination;

        return $this;
    }

    /**
     * @return integer | null
     */
    public function getDestination()
    {
        return $this->destination;
    }

    /**
     * @param integer $ratingPlanGroup
     *
     * @return static
     */
    public function setRatingPlanGroup($ratingPlanGroup = null)
    {
        $this->ratingPlanGroup = $ratingPlanGroup;

        return $this;
    }

    /**
     * @return integer | null
     */
    public function getRatingPlanGroup()
    {
        return $this->ratingPlanGroup;
    }

    /**
     * @param integer $invoice
     *
     * @return static
     */
    public function setInvoice($invoice = null)
    {
        $this->invoice = $invoice;

        return $this;
    }

    /**
     * @return integer | null
     */
    public function getInvoice()
    {
        return $this->invoice;
    }

    /**
     * @param integer $trunksCdr
     *
     * @return static
     */
    public function setTrunksCdr($trunksCdr = null)
    {
        $this->trunksCdr = $trunksCdr;

        return $this;
    }

    /**
     * @return integer | null
     */
    public function getTrunksCdr()
    {
        return $this->trunksCdr;
    }

    /**
     * @param integer $ddi
     *
     * @return static
     */
    public function setDdi($ddi = null)
    {
        $this->ddi = $ddi;

        return $this;
    }

    /**
     * @return integer | null
     */
    public function getDdi()
    {
        return $this->ddi;
    }

    /**
     * @param integer $ddiProvider
     *
     * @return static
     */
    public function setDdiProvider($ddiProvider = null)
    {
        $this->ddiProvider = $ddiProvider;

        return $this;
    }

    /**
     * @return integer | null
     */
    public function getDdiProvider()
    {
        return $this->ddiProvider;
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
}
