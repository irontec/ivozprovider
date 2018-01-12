<?php

namespace Ivoz\Kam\Domain\Model\AccCdr;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Core\Application\CollectionTransformerInterface;
use Ivoz\Core\Application\Model\DtoNormalizer;

/**
 * @codeCoverageIgnore
 */
abstract class AccCdrDtoAbstract implements DataTransferObjectInterface
{
    /**
     * @var string
     */
    private $proxy;

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
    private $asiden;

    /**
     * @var string
     */
    private $asaddress;

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
    private $parsed = 'no';

    /**
     * @var string
     */
    private $diversion;

    /**
     * @var string
     */
    private $peeringContractId;

    /**
     * @var string
     */
    private $bounced = 'no';

    /**
     * @var boolean
     */
    private $externallyRated;

    /**
     * @var boolean
     */
    private $metered = '0';

    /**
     * @var \DateTime
     */
    private $meteringDate;

    /**
     * @var string
     */
    private $pricingPlanName;

    /**
     * @var string
     */
    private $targetPatternName;

    /**
     * @var string
     */
    private $price;

    /**
     * @var string
     */
    private $pricingPlanDetails;

    /**
     * @var string
     */
    private $direction;

    /**
     * @var \DateTime
     */
    private $reMeteringDate;

    /**
     * @var integer
     */
    private $id;

    /**
     * @var \Ivoz\Provider\Domain\Model\PricingPlan\PricingPlanDto | null
     */
    private $pricingPlan;

    /**
     * @var \Ivoz\Provider\Domain\Model\TargetPattern\TargetPatternDto | null
     */
    private $targetPattern;

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
            'proxy' => 'proxy',
            'startTime' => 'startTime',
            'endTime' => 'endTime',
            'duration' => 'duration',
            'caller' => 'caller',
            'callee' => 'callee',
            'referee' => 'referee',
            'referrer' => 'referrer',
            'asiden' => 'asiden',
            'asaddress' => 'asaddress',
            'callid' => 'callid',
            'callidHash' => 'callidHash',
            'xcallid' => 'xcallid',
            'parsed' => 'parsed',
            'diversion' => 'diversion',
            'peeringContractId' => 'peeringContractId',
            'bounced' => 'bounced',
            'externallyRated' => 'externallyRated',
            'metered' => 'metered',
            'meteringDate' => 'meteringDate',
            'pricingPlanName' => 'pricingPlanName',
            'targetPatternName' => 'targetPatternName',
            'price' => 'price',
            'pricingPlanDetails' => 'pricingPlanDetails',
            'direction' => 'direction',
            'reMeteringDate' => 'reMeteringDate',
            'id' => 'id',
            'pricingPlanId' => 'pricingPlan',
            'targetPatternId' => 'targetPattern',
            'invoiceId' => 'invoice',
            'brandId' => 'brand',
            'companyId' => 'company'
        ];
    }

    /**
     * @return array
     */
    public function toArray()
    {
        return [
            'proxy' => $this->getProxy(),
            'startTime' => $this->getStartTime(),
            'endTime' => $this->getEndTime(),
            'duration' => $this->getDuration(),
            'caller' => $this->getCaller(),
            'callee' => $this->getCallee(),
            'referee' => $this->getReferee(),
            'referrer' => $this->getReferrer(),
            'asiden' => $this->getAsiden(),
            'asaddress' => $this->getAsaddress(),
            'callid' => $this->getCallid(),
            'callidHash' => $this->getCallidHash(),
            'xcallid' => $this->getXcallid(),
            'parsed' => $this->getParsed(),
            'diversion' => $this->getDiversion(),
            'peeringContractId' => $this->getPeeringContractId(),
            'bounced' => $this->getBounced(),
            'externallyRated' => $this->getExternallyRated(),
            'metered' => $this->getMetered(),
            'meteringDate' => $this->getMeteringDate(),
            'pricingPlanName' => $this->getPricingPlanName(),
            'targetPatternName' => $this->getTargetPatternName(),
            'price' => $this->getPrice(),
            'pricingPlanDetails' => $this->getPricingPlanDetails(),
            'direction' => $this->getDirection(),
            'reMeteringDate' => $this->getReMeteringDate(),
            'id' => $this->getId(),
            'pricingPlan' => $this->getPricingPlan(),
            'targetPattern' => $this->getTargetPattern(),
            'invoice' => $this->getInvoice(),
            'brand' => $this->getBrand(),
            'company' => $this->getCompany()
        ];
    }

    /**
     * {@inheritDoc}
     */
    public function transformForeignKeys(ForeignKeyTransformerInterface $transformer)
    {
        $this->pricingPlan = $transformer->transform('Ivoz\\Provider\\Domain\\Model\\PricingPlan\\PricingPlan', $this->getPricingPlanId());
        $this->targetPattern = $transformer->transform('Ivoz\\Provider\\Domain\\Model\\TargetPattern\\TargetPattern', $this->getTargetPatternId());
        $this->invoice = $transformer->transform('Ivoz\\Provider\\Domain\\Model\\Invoice\\Invoice', $this->getInvoiceId());
        $this->brand = $transformer->transform('Ivoz\\Provider\\Domain\\Model\\Brand\\Brand', $this->getBrandId());
        $this->company = $transformer->transform('Ivoz\\Provider\\Domain\\Model\\Company\\Company', $this->getCompanyId());
    }

    /**
     * {@inheritDoc}
     */
    public function transformCollections(CollectionTransformerInterface $transformer)
    {

    }

    /**
     * @param string $proxy
     *
     * @return static
     */
    public function setProxy($proxy = null)
    {
        $this->proxy = $proxy;

        return $this;
    }

    /**
     * @return string
     */
    public function getProxy()
    {
        return $this->proxy;
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
     * @param string $asiden
     *
     * @return static
     */
    public function setAsiden($asiden = null)
    {
        $this->asiden = $asiden;

        return $this;
    }

    /**
     * @return string
     */
    public function getAsiden()
    {
        return $this->asiden;
    }

    /**
     * @param string $asaddress
     *
     * @return static
     */
    public function setAsaddress($asaddress = null)
    {
        $this->asaddress = $asaddress;

        return $this;
    }

    /**
     * @return string
     */
    public function getAsaddress()
    {
        return $this->asaddress;
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
     * @param string $parsed
     *
     * @return static
     */
    public function setParsed($parsed = null)
    {
        $this->parsed = $parsed;

        return $this;
    }

    /**
     * @return string
     */
    public function getParsed()
    {
        return $this->parsed;
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
     * @param string $peeringContractId
     *
     * @return static
     */
    public function setPeeringContractId($peeringContractId = null)
    {
        $this->peeringContractId = $peeringContractId;

        return $this;
    }

    /**
     * @return string
     */
    public function getPeeringContractId()
    {
        return $this->peeringContractId;
    }

    /**
     * @param string $bounced
     *
     * @return static
     */
    public function setBounced($bounced = null)
    {
        $this->bounced = $bounced;

        return $this;
    }

    /**
     * @return string
     */
    public function getBounced()
    {
        return $this->bounced;
    }

    /**
     * @param boolean $externallyRated
     *
     * @return static
     */
    public function setExternallyRated($externallyRated = null)
    {
        $this->externallyRated = $externallyRated;

        return $this;
    }

    /**
     * @return boolean
     */
    public function getExternallyRated()
    {
        return $this->externallyRated;
    }

    /**
     * @param boolean $metered
     *
     * @return static
     */
    public function setMetered($metered = null)
    {
        $this->metered = $metered;

        return $this;
    }

    /**
     * @return boolean
     */
    public function getMetered()
    {
        return $this->metered;
    }

    /**
     * @param \DateTime $meteringDate
     *
     * @return static
     */
    public function setMeteringDate($meteringDate = null)
    {
        $this->meteringDate = $meteringDate;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getMeteringDate()
    {
        return $this->meteringDate;
    }

    /**
     * @param string $pricingPlanName
     *
     * @return static
     */
    public function setPricingPlanName($pricingPlanName = null)
    {
        $this->pricingPlanName = $pricingPlanName;

        return $this;
    }

    /**
     * @return string
     */
    public function getPricingPlanName()
    {
        return $this->pricingPlanName;
    }

    /**
     * @param string $targetPatternName
     *
     * @return static
     */
    public function setTargetPatternName($targetPatternName = null)
    {
        $this->targetPatternName = $targetPatternName;

        return $this;
    }

    /**
     * @return string
     */
    public function getTargetPatternName()
    {
        return $this->targetPatternName;
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
     * @param string $pricingPlanDetails
     *
     * @return static
     */
    public function setPricingPlanDetails($pricingPlanDetails = null)
    {
        $this->pricingPlanDetails = $pricingPlanDetails;

        return $this;
    }

    /**
     * @return string
     */
    public function getPricingPlanDetails()
    {
        return $this->pricingPlanDetails;
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
     * @param \DateTime $reMeteringDate
     *
     * @return static
     */
    public function setReMeteringDate($reMeteringDate = null)
    {
        $this->reMeteringDate = $reMeteringDate;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getReMeteringDate()
    {
        return $this->reMeteringDate;
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
     * @param \Ivoz\Provider\Domain\Model\PricingPlan\PricingPlanDto $pricingPlan
     *
     * @return static
     */
    public function setPricingPlan(\Ivoz\Provider\Domain\Model\PricingPlan\PricingPlanDto $pricingPlan = null)
    {
        $this->pricingPlan = $pricingPlan;

        return $this;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\PricingPlan\PricingPlanDto
     */
    public function getPricingPlan()
    {
        return $this->pricingPlan;
    }

        /**
         * @param integer $id | null
         *
         * @return static
         */
        public function setPricingPlanId($id)
        {
            $value = !is_null($id)
                ? new \Ivoz\Provider\Domain\Model\PricingPlan\PricingPlanDto($id)
                : null;

            return $this->setPricingPlan($value);
        }

        /**
         * @return integer | null
         */
        public function getPricingPlanId()
        {
            if ($dto = $this->getPricingPlan()) {
                return $dto->getId();
            }

            return null;
        }

    /**
     * @param \Ivoz\Provider\Domain\Model\TargetPattern\TargetPatternDto $targetPattern
     *
     * @return static
     */
    public function setTargetPattern(\Ivoz\Provider\Domain\Model\TargetPattern\TargetPatternDto $targetPattern = null)
    {
        $this->targetPattern = $targetPattern;

        return $this;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\TargetPattern\TargetPatternDto
     */
    public function getTargetPattern()
    {
        return $this->targetPattern;
    }

        /**
         * @param integer $id | null
         *
         * @return static
         */
        public function setTargetPatternId($id)
        {
            $value = !is_null($id)
                ? new \Ivoz\Provider\Domain\Model\TargetPattern\TargetPatternDto($id)
                : null;

            return $this->setTargetPattern($value);
        }

        /**
         * @return integer | null
         */
        public function getTargetPatternId()
        {
            if ($dto = $this->getTargetPattern()) {
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
}


