<?php

namespace Ivoz\Kam\Domain\Model\AccCdr;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;

/**
 * AccCdrAbstract
 * @codeCoverageIgnore
 */
abstract class AccCdrAbstract
{
    /**
     * @var string
     */
    protected $proxy;

    /**
     * @column start_time_utc
     * @var \DateTime
     */
    protected $startTimeUtc;

    /**
     * @column end_time_utc
     * @var \DateTime
     */
    protected $endTimeUtc;

    /**
     * @column start_time
     * @var \DateTime
     */
    protected $startTime;

    /**
     * @column end_time
     * @var \DateTime
     */
    protected $endTime;

    /**
     * @var float
     */
    protected $duration = '0.000';

    /**
     * @var string
     */
    protected $caller;

    /**
     * @var string
     */
    protected $callee;

    /**
     * @var string
     */
    protected $referee;

    /**
     * @var string
     */
    protected $referrer;

    /**
     * @var string
     */
    protected $asiden;

    /**
     * @var string
     */
    protected $asaddress;

    /**
     * @var string
     */
    protected $callid;

    /**
     * @var string
     */
    protected $callidHash;

    /**
     * @var string
     */
    protected $xcallid;

    /**
     * @var string
     */
    protected $parsed = 'no';

    /**
     * @var string
     */
    protected $diversion;

    /**
     * @var string
     */
    protected $peeringContractId;

    /**
     * @var string
     */
    protected $bounced = 'no';

    /**
     * @var boolean
     */
    protected $externallyRated;

    /**
     * @var boolean
     */
    protected $metered = '0';

    /**
     * @var \DateTime
     */
    protected $meteringDate;

    /**
     * @var string
     */
    protected $pricingPlanName;

    /**
     * @var string
     */
    protected $targetPatternName;

    /**
     * @var string
     */
    protected $price;

    /**
     * @var string
     */
    protected $pricingPlanDetails;

    /**
     * @var string
     */
    protected $direction;

    /**
     * @var \DateTime
     */
    protected $reMeteringDate;

    /**
     * @var \Ivoz\Provider\Domain\Model\PricingPlan\PricingPlanInterface
     */
    protected $pricingPlan;

    /**
     * @var \Ivoz\Provider\Domain\Model\TargetPattern\TargetPatternInterface
     */
    protected $targetPattern;

    /**
     * @var \Ivoz\Provider\Domain\Model\Invoice\InvoiceInterface
     */
    protected $invoice;

    /**
     * @var \Ivoz\Provider\Domain\Model\Brand\BrandInterface
     */
    protected $brand;

    /**
     * @var \Ivoz\Provider\Domain\Model\Company\CompanyInterface
     */
    protected $company;


    /**
     * Changelog tracking purpose
     * @var array
     */
    protected $_initialValues = [];

    /**
     * Constructor
     */
    public function __construct(
        $startTimeUtc,
        $endTimeUtc,
        $startTime,
        $endTime,
        $duration,
        $bounced
    ) {
        $this->setStartTimeUtc($startTimeUtc);
        $this->setEndTimeUtc($endTimeUtc);
        $this->setStartTime($startTime);
        $this->setEndTime($endTime);
        $this->setDuration($duration);
        $this->setBounced($bounced);

        $this->initChangelog();
    }

    /**
     * @param string $fieldName
     * @return mixed
     * @throws \Exception
     */
    public function initChangelog()
    {
        $values = $this->__toArray();
        if (!$this->getId()) {
            // Empty values for entities with no Id
            foreach ($values as $key => $val) {
                $values[$key] = null;
            }
        }

        $this->_initialValues = $values;
    }

    /**
     * @param string $fieldName
     * @return mixed
     * @throws \Exception
     */
    public function hasChanged($dbFieldName)
    {
        if (!array_key_exists($dbFieldName, $this->_initialValues)) {
            throw new \Exception($dbFieldName . ' field was not found');
        }
        $currentValues = $this->__toArray();

        return $currentValues[$dbFieldName] != $this->_initialValues[$dbFieldName];
    }

    public function getInitialValue($dbFieldName)
    {
        if (!array_key_exists($dbFieldName, $this->_initialValues)) {
            throw new \Exception($dbFieldName . ' field was not found');
        }

        return $this->_initialValues[$dbFieldName];
    }

    /**
     * @return array
     */
    protected function getChangeSet()
    {
        $changes = [];
        $currentValues = $this->__toArray();
        foreach ($currentValues as $key => $value) {

            if ($this->_initialValues[$key] == $currentValues[$key]) {
                continue;
            }

            $value = $currentValues[$key];
            if ($value instanceof \DateTime) {
                $value = $value->format('Y-m-d H:i:s');
            }

            $changes[$key] = $value;
        }

        return $changes;
    }

    /**
     * @return AccCdrDTO
     */
    public static function createDTO()
    {
        return new AccCdrDTO();
    }

    /**
     * Factory method
     * @param DataTransferObjectInterface $dto
     * @return self
     */
    public static function fromDTO(DataTransferObjectInterface $dto)
    {
        /**
         * @var $dto AccCdrDTO
         */
        Assertion::isInstanceOf($dto, AccCdrDTO::class);

        $self = new static(
            $dto->getStartTimeUtc(),
            $dto->getEndTimeUtc(),
            $dto->getStartTime(),
            $dto->getEndTime(),
            $dto->getDuration(),
            $dto->getBounced());

        return $self
            ->setProxy($dto->getProxy())
            ->setCaller($dto->getCaller())
            ->setCallee($dto->getCallee())
            ->setReferee($dto->getReferee())
            ->setReferrer($dto->getReferrer())
            ->setAsiden($dto->getAsiden())
            ->setAsaddress($dto->getAsaddress())
            ->setCallid($dto->getCallid())
            ->setCallidHash($dto->getCallidHash())
            ->setXcallid($dto->getXcallid())
            ->setParsed($dto->getParsed())
            ->setDiversion($dto->getDiversion())
            ->setPeeringContractId($dto->getPeeringContractId())
            ->setExternallyRated($dto->getExternallyRated())
            ->setMetered($dto->getMetered())
            ->setMeteringDate($dto->getMeteringDate())
            ->setPricingPlanName($dto->getPricingPlanName())
            ->setTargetPatternName($dto->getTargetPatternName())
            ->setPrice($dto->getPrice())
            ->setPricingPlanDetails($dto->getPricingPlanDetails())
            ->setDirection($dto->getDirection())
            ->setReMeteringDate($dto->getReMeteringDate())
            ->setPricingPlan($dto->getPricingPlan())
            ->setTargetPattern($dto->getTargetPattern())
            ->setInvoice($dto->getInvoice())
            ->setBrand($dto->getBrand())
            ->setCompany($dto->getCompany())
        ;
    }

    /**
     * @param DataTransferObjectInterface $dto
     * @return self
     */
    public function updateFromDTO(DataTransferObjectInterface $dto)
    {
        /**
         * @var $dto AccCdrDTO
         */
        Assertion::isInstanceOf($dto, AccCdrDTO::class);

        $this
            ->setProxy($dto->getProxy())
            ->setStartTimeUtc($dto->getStartTimeUtc())
            ->setEndTimeUtc($dto->getEndTimeUtc())
            ->setStartTime($dto->getStartTime())
            ->setEndTime($dto->getEndTime())
            ->setDuration($dto->getDuration())
            ->setCaller($dto->getCaller())
            ->setCallee($dto->getCallee())
            ->setReferee($dto->getReferee())
            ->setReferrer($dto->getReferrer())
            ->setAsiden($dto->getAsiden())
            ->setAsaddress($dto->getAsaddress())
            ->setCallid($dto->getCallid())
            ->setCallidHash($dto->getCallidHash())
            ->setXcallid($dto->getXcallid())
            ->setParsed($dto->getParsed())
            ->setDiversion($dto->getDiversion())
            ->setPeeringContractId($dto->getPeeringContractId())
            ->setBounced($dto->getBounced())
            ->setExternallyRated($dto->getExternallyRated())
            ->setMetered($dto->getMetered())
            ->setMeteringDate($dto->getMeteringDate())
            ->setPricingPlanName($dto->getPricingPlanName())
            ->setTargetPatternName($dto->getTargetPatternName())
            ->setPrice($dto->getPrice())
            ->setPricingPlanDetails($dto->getPricingPlanDetails())
            ->setDirection($dto->getDirection())
            ->setReMeteringDate($dto->getReMeteringDate())
            ->setPricingPlan($dto->getPricingPlan())
            ->setTargetPattern($dto->getTargetPattern())
            ->setInvoice($dto->getInvoice())
            ->setBrand($dto->getBrand())
            ->setCompany($dto->getCompany());


        return $this;
    }

    /**
     * @return AccCdrDTO
     */
    public function toDTO()
    {
        return self::createDTO()
            ->setProxy($this->getProxy())
            ->setStartTimeUtc($this->getStartTimeUtc())
            ->setEndTimeUtc($this->getEndTimeUtc())
            ->setStartTime($this->getStartTime())
            ->setEndTime($this->getEndTime())
            ->setDuration($this->getDuration())
            ->setCaller($this->getCaller())
            ->setCallee($this->getCallee())
            ->setReferee($this->getReferee())
            ->setReferrer($this->getReferrer())
            ->setAsiden($this->getAsiden())
            ->setAsaddress($this->getAsaddress())
            ->setCallid($this->getCallid())
            ->setCallidHash($this->getCallidHash())
            ->setXcallid($this->getXcallid())
            ->setParsed($this->getParsed())
            ->setDiversion($this->getDiversion())
            ->setPeeringContractId($this->getPeeringContractId())
            ->setBounced($this->getBounced())
            ->setExternallyRated($this->getExternallyRated())
            ->setMetered($this->getMetered())
            ->setMeteringDate($this->getMeteringDate())
            ->setPricingPlanName($this->getPricingPlanName())
            ->setTargetPatternName($this->getTargetPatternName())
            ->setPrice($this->getPrice())
            ->setPricingPlanDetails($this->getPricingPlanDetails())
            ->setDirection($this->getDirection())
            ->setReMeteringDate($this->getReMeteringDate())
            ->setPricingPlanId($this->getPricingPlan() ? $this->getPricingPlan()->getId() : null)
            ->setTargetPatternId($this->getTargetPattern() ? $this->getTargetPattern()->getId() : null)
            ->setInvoiceId($this->getInvoice() ? $this->getInvoice()->getId() : null)
            ->setBrandId($this->getBrand() ? $this->getBrand()->getId() : null)
            ->setCompanyId($this->getCompany() ? $this->getCompany()->getId() : null);
    }

    /**
     * @return array
     */
    protected function __toArray()
    {
        return [
            'proxy' => self::getProxy(),
            'start_time_utc' => self::getStartTimeUtc(),
            'end_time_utc' => self::getEndTimeUtc(),
            'start_time' => self::getStartTime(),
            'end_time' => self::getEndTime(),
            'duration' => self::getDuration(),
            'caller' => self::getCaller(),
            'callee' => self::getCallee(),
            'referee' => self::getReferee(),
            'referrer' => self::getReferrer(),
            'asIden' => self::getAsiden(),
            'asAddress' => self::getAsaddress(),
            'callid' => self::getCallid(),
            'callidHash' => self::getCallidHash(),
            'xcallid' => self::getXcallid(),
            'parsed' => self::getParsed(),
            'diversion' => self::getDiversion(),
            'peeringContractId' => self::getPeeringContractId(),
            'bounced' => self::getBounced(),
            'externallyRated' => self::getExternallyRated(),
            'metered' => self::getMetered(),
            'meteringDate' => self::getMeteringDate(),
            'pricingPlanName' => self::getPricingPlanName(),
            'targetPatternName' => self::getTargetPatternName(),
            'price' => self::getPrice(),
            'pricingPlanDetails' => self::getPricingPlanDetails(),
            'direction' => self::getDirection(),
            'reMeteringDate' => self::getReMeteringDate(),
            'pricingPlanId' => self::getPricingPlan() ? self::getPricingPlan()->getId() : null,
            'targetPatternId' => self::getTargetPattern() ? self::getTargetPattern()->getId() : null,
            'invoiceId' => self::getInvoice() ? self::getInvoice()->getId() : null,
            'brandId' => self::getBrand() ? self::getBrand()->getId() : null,
            'companyId' => self::getCompany() ? self::getCompany()->getId() : null
        ];
    }


    // @codeCoverageIgnoreStart

    /**
     * Set proxy
     *
     * @param string $proxy
     *
     * @return self
     */
    public function setProxy($proxy = null)
    {
        if (!is_null($proxy)) {
            Assertion::maxLength($proxy, 64);
        }

        $this->proxy = $proxy;

        return $this;
    }

    /**
     * Get proxy
     *
     * @return string
     */
    public function getProxy()
    {
        return $this->proxy;
    }

    /**
     * Set startTimeUtc
     *
     * @param \DateTime $startTimeUtc
     *
     * @return self
     */
    public function setStartTimeUtc($startTimeUtc)
    {
        Assertion::notNull($startTimeUtc);
        $startTimeUtc = \Ivoz\Core\Domain\Model\Helper\DateTimeHelper::createOrFix(
            $startTimeUtc,
            '2000-01-01 00:00:00'
        );

        $this->startTimeUtc = $startTimeUtc;

        return $this;
    }

    /**
     * Get startTimeUtc
     *
     * @return \DateTime
     */
    public function getStartTimeUtc()
    {
        return $this->startTimeUtc;
    }

    /**
     * Set endTimeUtc
     *
     * @param \DateTime $endTimeUtc
     *
     * @return self
     */
    public function setEndTimeUtc($endTimeUtc)
    {
        Assertion::notNull($endTimeUtc);
        $endTimeUtc = \Ivoz\Core\Domain\Model\Helper\DateTimeHelper::createOrFix(
            $endTimeUtc,
            'CURRENT_TIMESTAMP'
        );

        $this->endTimeUtc = $endTimeUtc;

        return $this;
    }

    /**
     * Get endTimeUtc
     *
     * @return \DateTime
     */
    public function getEndTimeUtc()
    {
        return $this->endTimeUtc;
    }

    /**
     * Set startTime
     *
     * @param \DateTime $startTime
     *
     * @return self
     */
    public function setStartTime($startTime)
    {
        Assertion::notNull($startTime);
        $startTime = \Ivoz\Core\Domain\Model\Helper\DateTimeHelper::createOrFix(
            $startTime,
            '2000-01-01 00:00:00'
        );

        $this->startTime = $startTime;

        return $this;
    }

    /**
     * Get startTime
     *
     * @return \DateTime
     */
    public function getStartTime()
    {
        return $this->startTime;
    }

    /**
     * Set endTime
     *
     * @param \DateTime $endTime
     *
     * @return self
     */
    public function setEndTime($endTime)
    {
        Assertion::notNull($endTime);
        $endTime = \Ivoz\Core\Domain\Model\Helper\DateTimeHelper::createOrFix(
            $endTime,
            '2000-01-01 00:00:00'
        );

        $this->endTime = $endTime;

        return $this;
    }

    /**
     * Get endTime
     *
     * @return \DateTime
     */
    public function getEndTime()
    {
        return $this->endTime;
    }

    /**
     * Set duration
     *
     * @param float $duration
     *
     * @return self
     */
    public function setDuration($duration)
    {
        Assertion::notNull($duration);
        Assertion::numeric($duration);

        $this->duration = $duration;

        return $this;
    }

    /**
     * Get duration
     *
     * @return float
     */
    public function getDuration()
    {
        return $this->duration;
    }

    /**
     * Set caller
     *
     * @param string $caller
     *
     * @return self
     */
    public function setCaller($caller = null)
    {
        if (!is_null($caller)) {
            Assertion::maxLength($caller, 128);
        }

        $this->caller = $caller;

        return $this;
    }

    /**
     * Get caller
     *
     * @return string
     */
    public function getCaller()
    {
        return $this->caller;
    }

    /**
     * Set callee
     *
     * @param string $callee
     *
     * @return self
     */
    public function setCallee($callee = null)
    {
        if (!is_null($callee)) {
            Assertion::maxLength($callee, 128);
        }

        $this->callee = $callee;

        return $this;
    }

    /**
     * Get callee
     *
     * @return string
     */
    public function getCallee()
    {
        return $this->callee;
    }

    /**
     * Set referee
     *
     * @param string $referee
     *
     * @return self
     */
    public function setReferee($referee = null)
    {
        if (!is_null($referee)) {
            Assertion::maxLength($referee, 128);
        }

        $this->referee = $referee;

        return $this;
    }

    /**
     * Get referee
     *
     * @return string
     */
    public function getReferee()
    {
        return $this->referee;
    }

    /**
     * Set referrer
     *
     * @param string $referrer
     *
     * @return self
     */
    public function setReferrer($referrer = null)
    {
        if (!is_null($referrer)) {
            Assertion::maxLength($referrer, 128);
        }

        $this->referrer = $referrer;

        return $this;
    }

    /**
     * Get referrer
     *
     * @return string
     */
    public function getReferrer()
    {
        return $this->referrer;
    }

    /**
     * Set asiden
     *
     * @param string $asiden
     *
     * @return self
     */
    public function setAsiden($asiden = null)
    {
        if (!is_null($asiden)) {
            Assertion::maxLength($asiden, 64);
        }

        $this->asiden = $asiden;

        return $this;
    }

    /**
     * Get asiden
     *
     * @return string
     */
    public function getAsiden()
    {
        return $this->asiden;
    }

    /**
     * Set asaddress
     *
     * @param string $asaddress
     *
     * @return self
     */
    public function setAsaddress($asaddress = null)
    {
        if (!is_null($asaddress)) {
            Assertion::maxLength($asaddress, 64);
        }

        $this->asaddress = $asaddress;

        return $this;
    }

    /**
     * Get asaddress
     *
     * @return string
     */
    public function getAsaddress()
    {
        return $this->asaddress;
    }

    /**
     * Set callid
     *
     * @param string $callid
     *
     * @return self
     */
    public function setCallid($callid = null)
    {
        if (!is_null($callid)) {
            Assertion::maxLength($callid, 255);
        }

        $this->callid = $callid;

        return $this;
    }

    /**
     * Get callid
     *
     * @return string
     */
    public function getCallid()
    {
        return $this->callid;
    }

    /**
     * Set callidHash
     *
     * @param string $callidHash
     *
     * @return self
     */
    public function setCallidHash($callidHash = null)
    {
        if (!is_null($callidHash)) {
            Assertion::maxLength($callidHash, 128);
        }

        $this->callidHash = $callidHash;

        return $this;
    }

    /**
     * Get callidHash
     *
     * @return string
     */
    public function getCallidHash()
    {
        return $this->callidHash;
    }

    /**
     * Set xcallid
     *
     * @param string $xcallid
     *
     * @return self
     */
    public function setXcallid($xcallid = null)
    {
        if (!is_null($xcallid)) {
            Assertion::maxLength($xcallid, 255);
        }

        $this->xcallid = $xcallid;

        return $this;
    }

    /**
     * Get xcallid
     *
     * @return string
     */
    public function getXcallid()
    {
        return $this->xcallid;
    }

    /**
     * Set parsed
     *
     * @param string $parsed
     *
     * @return self
     */
    public function setParsed($parsed = null)
    {
        if (!is_null($parsed)) {
        }

        $this->parsed = $parsed;

        return $this;
    }

    /**
     * Get parsed
     *
     * @return string
     */
    public function getParsed()
    {
        return $this->parsed;
    }

    /**
     * Set diversion
     *
     * @param string $diversion
     *
     * @return self
     */
    public function setDiversion($diversion = null)
    {
        if (!is_null($diversion)) {
            Assertion::maxLength($diversion, 64);
        }

        $this->diversion = $diversion;

        return $this;
    }

    /**
     * Get diversion
     *
     * @return string
     */
    public function getDiversion()
    {
        return $this->diversion;
    }

    /**
     * Set peeringContractId
     *
     * @param string $peeringContractId
     *
     * @return self
     */
    public function setPeeringContractId($peeringContractId = null)
    {
        if (!is_null($peeringContractId)) {
            Assertion::maxLength($peeringContractId, 64);
        }

        $this->peeringContractId = $peeringContractId;

        return $this;
    }

    /**
     * Get peeringContractId
     *
     * @return string
     */
    public function getPeeringContractId()
    {
        return $this->peeringContractId;
    }

    /**
     * Set bounced
     *
     * @param string $bounced
     *
     * @return self
     */
    public function setBounced($bounced)
    {
        Assertion::notNull($bounced);

        $this->bounced = $bounced;

        return $this;
    }

    /**
     * Get bounced
     *
     * @return string
     */
    public function getBounced()
    {
        return $this->bounced;
    }

    /**
     * Set externallyRated
     *
     * @param boolean $externallyRated
     *
     * @return self
     */
    public function setExternallyRated($externallyRated = null)
    {
        if (!is_null($externallyRated)) {
            Assertion::between(intval($externallyRated), 0, 1);
        }

        $this->externallyRated = $externallyRated;

        return $this;
    }

    /**
     * Get externallyRated
     *
     * @return boolean
     */
    public function getExternallyRated()
    {
        return $this->externallyRated;
    }

    /**
     * Set metered
     *
     * @param boolean $metered
     *
     * @return self
     */
    public function setMetered($metered = null)
    {
        if (!is_null($metered)) {
            Assertion::between(intval($metered), 0, 1);
        }

        $this->metered = $metered;

        return $this;
    }

    /**
     * Get metered
     *
     * @return boolean
     */
    public function getMetered()
    {
        return $this->metered;
    }

    /**
     * Set meteringDate
     *
     * @param \DateTime $meteringDate
     *
     * @return self
     */
    public function setMeteringDate($meteringDate = null)
    {
        if (!is_null($meteringDate)) {
        $meteringDate = \Ivoz\Core\Domain\Model\Helper\DateTimeHelper::createOrFix(
            $meteringDate,
            null
        );
        }

        $this->meteringDate = $meteringDate;

        return $this;
    }

    /**
     * Get meteringDate
     *
     * @return \DateTime
     */
    public function getMeteringDate()
    {
        return $this->meteringDate;
    }

    /**
     * Set pricingPlanName
     *
     * @param string $pricingPlanName
     *
     * @return self
     */
    public function setPricingPlanName($pricingPlanName = null)
    {
        if (!is_null($pricingPlanName)) {
            Assertion::maxLength($pricingPlanName, 55);
        }

        $this->pricingPlanName = $pricingPlanName;

        return $this;
    }

    /**
     * Get pricingPlanName
     *
     * @return string
     */
    public function getPricingPlanName()
    {
        return $this->pricingPlanName;
    }

    /**
     * Set targetPatternName
     *
     * @param string $targetPatternName
     *
     * @return self
     */
    public function setTargetPatternName($targetPatternName = null)
    {
        if (!is_null($targetPatternName)) {
            Assertion::maxLength($targetPatternName, 55);
        }

        $this->targetPatternName = $targetPatternName;

        return $this;
    }

    /**
     * Get targetPatternName
     *
     * @return string
     */
    public function getTargetPatternName()
    {
        return $this->targetPatternName;
    }

    /**
     * Set price
     *
     * @param string $price
     *
     * @return self
     */
    public function setPrice($price = null)
    {
        if (!is_null($price)) {
            if (!is_null($price)) {
                Assertion::numeric($price);
            }
        }

        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return string
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set pricingPlanDetails
     *
     * @param string $pricingPlanDetails
     *
     * @return self
     */
    public function setPricingPlanDetails($pricingPlanDetails = null)
    {
        if (!is_null($pricingPlanDetails)) {
            Assertion::maxLength($pricingPlanDetails, 65535);
        }

        $this->pricingPlanDetails = $pricingPlanDetails;

        return $this;
    }

    /**
     * Get pricingPlanDetails
     *
     * @return string
     */
    public function getPricingPlanDetails()
    {
        return $this->pricingPlanDetails;
    }

    /**
     * Set direction
     *
     * @param string $direction
     *
     * @return self
     */
    public function setDirection($direction = null)
    {
        if (!is_null($direction)) {
        }

        $this->direction = $direction;

        return $this;
    }

    /**
     * Get direction
     *
     * @return string
     */
    public function getDirection()
    {
        return $this->direction;
    }

    /**
     * Set reMeteringDate
     *
     * @param \DateTime $reMeteringDate
     *
     * @return self
     */
    public function setReMeteringDate($reMeteringDate = null)
    {
        if (!is_null($reMeteringDate)) {
        $reMeteringDate = \Ivoz\Core\Domain\Model\Helper\DateTimeHelper::createOrFix(
            $reMeteringDate,
            null
        );
        }

        $this->reMeteringDate = $reMeteringDate;

        return $this;
    }

    /**
     * Get reMeteringDate
     *
     * @return \DateTime
     */
    public function getReMeteringDate()
    {
        return $this->reMeteringDate;
    }

    /**
     * Set pricingPlan
     *
     * @param \Ivoz\Provider\Domain\Model\PricingPlan\PricingPlanInterface $pricingPlan
     *
     * @return self
     */
    public function setPricingPlan(\Ivoz\Provider\Domain\Model\PricingPlan\PricingPlanInterface $pricingPlan = null)
    {
        $this->pricingPlan = $pricingPlan;

        return $this;
    }

    /**
     * Get pricingPlan
     *
     * @return \Ivoz\Provider\Domain\Model\PricingPlan\PricingPlanInterface
     */
    public function getPricingPlan()
    {
        return $this->pricingPlan;
    }

    /**
     * Set targetPattern
     *
     * @param \Ivoz\Provider\Domain\Model\TargetPattern\TargetPatternInterface $targetPattern
     *
     * @return self
     */
    public function setTargetPattern(\Ivoz\Provider\Domain\Model\TargetPattern\TargetPatternInterface $targetPattern = null)
    {
        $this->targetPattern = $targetPattern;

        return $this;
    }

    /**
     * Get targetPattern
     *
     * @return \Ivoz\Provider\Domain\Model\TargetPattern\TargetPatternInterface
     */
    public function getTargetPattern()
    {
        return $this->targetPattern;
    }

    /**
     * Set invoice
     *
     * @param \Ivoz\Provider\Domain\Model\Invoice\InvoiceInterface $invoice
     *
     * @return self
     */
    public function setInvoice(\Ivoz\Provider\Domain\Model\Invoice\InvoiceInterface $invoice = null)
    {
        $this->invoice = $invoice;

        return $this;
    }

    /**
     * Get invoice
     *
     * @return \Ivoz\Provider\Domain\Model\Invoice\InvoiceInterface
     */
    public function getInvoice()
    {
        return $this->invoice;
    }

    /**
     * Set brand
     *
     * @param \Ivoz\Provider\Domain\Model\Brand\BrandInterface $brand
     *
     * @return self
     */
    public function setBrand(\Ivoz\Provider\Domain\Model\Brand\BrandInterface $brand = null)
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
     * @return self
     */
    public function setCompany(\Ivoz\Provider\Domain\Model\Company\CompanyInterface $company = null)
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



    // @codeCoverageIgnoreEnd
}

