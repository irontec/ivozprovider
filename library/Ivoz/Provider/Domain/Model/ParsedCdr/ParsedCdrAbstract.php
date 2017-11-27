<?php

namespace Ivoz\Provider\Domain\Model\ParsedCdr;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;

/**
 * ParsedCdrAbstract
 * @codeCoverageIgnore
 */
abstract class ParsedCdrAbstract
{
    /**
     * @var integer
     */
    protected $statId;

    /**
     * @var integer
     */
    protected $xstatId;

    /**
     * @var string
     */
    protected $statType;

    /**
     * @var string
     */
    protected $initialLeg;

    /**
     * @var string
     */
    protected $initialLegHash;

    /**
     * @var string
     */
    protected $cid;

    /**
     * @var string
     */
    protected $cidHash;

    /**
     * @var string
     */
    protected $xcid;

    /**
     * @var string
     */
    protected $xcidHash;

    /**
     * @var string
     */
    protected $proxies;

    /**
     * @var string
     */
    protected $type;

    /**
     * @var string
     */
    protected $subtype;

    /**
     * @var \DateTime
     */
    protected $calldate;

    /**
     * @var integer
     */
    protected $duration;

    /**
     * @var string
     */
    protected $aParty;

    /**
     * @var string
     */
    protected $bParty;

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
    protected $xCaller;

    /**
     * @var string
     */
    protected $xCallee;

    /**
     * @var string
     */
    protected $initialReferrer;

    /**
     * @var string
     */
    protected $referrer;

    /**
     * @var string
     */
    protected $referee;

    /**
     * @var string
     */
    protected $lastForwarder;

    /**
     * @var \Ivoz\Provider\Domain\Model\Brand\BrandInterface
     */
    protected $brand;

    /**
     * @var \Ivoz\Provider\Domain\Model\Company\CompanyInterface
     */
    protected $company;

    /**
     * @var \Ivoz\Provider\Domain\Model\PeeringContract\PeeringContractInterface
     */
    protected $peeringContract;


    /**
     * Changelog tracking purpose
     * @var array
     */
    protected $_initialValues = [];

    /**
     * Constructor
     */
    public function __construct($calldate)
    {
        $this->setCalldate($calldate);

        $this->sanitizeValues();
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
     * @return void
     * @throws \Exception
     */
    protected function sanitizeValues()
    {
    }

    /**
     * @return ParsedCdrDTO
     */
    public static function createDTO()
    {
        return new ParsedCdrDTO();
    }

    /**
     * Factory method
     * @param DataTransferObjectInterface $dto
     * @return self
     */
    public static function fromDTO(DataTransferObjectInterface $dto)
    {
        /**
         * @var $dto ParsedCdrDTO
         */
        Assertion::isInstanceOf($dto, ParsedCdrDTO::class);

        $self = new static(
            $dto->getCalldate());

        return $self
            ->setStatId($dto->getStatId())
            ->setXstatId($dto->getXstatId())
            ->setStatType($dto->getStatType())
            ->setInitialLeg($dto->getInitialLeg())
            ->setInitialLegHash($dto->getInitialLegHash())
            ->setCid($dto->getCid())
            ->setCidHash($dto->getCidHash())
            ->setXcid($dto->getXcid())
            ->setXcidHash($dto->getXcidHash())
            ->setProxies($dto->getProxies())
            ->setType($dto->getType())
            ->setSubtype($dto->getSubtype())
            ->setDuration($dto->getDuration())
            ->setAParty($dto->getAParty())
            ->setBParty($dto->getBParty())
            ->setCaller($dto->getCaller())
            ->setCallee($dto->getCallee())
            ->setXCaller($dto->getXCaller())
            ->setXCallee($dto->getXCallee())
            ->setInitialReferrer($dto->getInitialReferrer())
            ->setReferrer($dto->getReferrer())
            ->setReferee($dto->getReferee())
            ->setLastForwarder($dto->getLastForwarder())
            ->setBrand($dto->getBrand())
            ->setCompany($dto->getCompany())
            ->setPeeringContract($dto->getPeeringContract())
        ;
    }

    /**
     * @param DataTransferObjectInterface $dto
     * @return self
     */
    public function updateFromDTO(DataTransferObjectInterface $dto)
    {
        /**
         * @var $dto ParsedCdrDTO
         */
        Assertion::isInstanceOf($dto, ParsedCdrDTO::class);

        $this
            ->setStatId($dto->getStatId())
            ->setXstatId($dto->getXstatId())
            ->setStatType($dto->getStatType())
            ->setInitialLeg($dto->getInitialLeg())
            ->setInitialLegHash($dto->getInitialLegHash())
            ->setCid($dto->getCid())
            ->setCidHash($dto->getCidHash())
            ->setXcid($dto->getXcid())
            ->setXcidHash($dto->getXcidHash())
            ->setProxies($dto->getProxies())
            ->setType($dto->getType())
            ->setSubtype($dto->getSubtype())
            ->setCalldate($dto->getCalldate())
            ->setDuration($dto->getDuration())
            ->setAParty($dto->getAParty())
            ->setBParty($dto->getBParty())
            ->setCaller($dto->getCaller())
            ->setCallee($dto->getCallee())
            ->setXCaller($dto->getXCaller())
            ->setXCallee($dto->getXCallee())
            ->setInitialReferrer($dto->getInitialReferrer())
            ->setReferrer($dto->getReferrer())
            ->setReferee($dto->getReferee())
            ->setLastForwarder($dto->getLastForwarder())
            ->setBrand($dto->getBrand())
            ->setCompany($dto->getCompany())
            ->setPeeringContract($dto->getPeeringContract());



        $this->sanitizeValues();
        return $this;
    }

    /**
     * @return ParsedCdrDTO
     */
    public function toDTO()
    {
        return self::createDTO()
            ->setStatId($this->getStatId())
            ->setXstatId($this->getXstatId())
            ->setStatType($this->getStatType())
            ->setInitialLeg($this->getInitialLeg())
            ->setInitialLegHash($this->getInitialLegHash())
            ->setCid($this->getCid())
            ->setCidHash($this->getCidHash())
            ->setXcid($this->getXcid())
            ->setXcidHash($this->getXcidHash())
            ->setProxies($this->getProxies())
            ->setType($this->getType())
            ->setSubtype($this->getSubtype())
            ->setCalldate($this->getCalldate())
            ->setDuration($this->getDuration())
            ->setAParty($this->getAParty())
            ->setBParty($this->getBParty())
            ->setCaller($this->getCaller())
            ->setCallee($this->getCallee())
            ->setXCaller($this->getXCaller())
            ->setXCallee($this->getXCallee())
            ->setInitialReferrer($this->getInitialReferrer())
            ->setReferrer($this->getReferrer())
            ->setReferee($this->getReferee())
            ->setLastForwarder($this->getLastForwarder())
            ->setBrandId($this->getBrand() ? $this->getBrand()->getId() : null)
            ->setCompanyId($this->getCompany() ? $this->getCompany()->getId() : null)
            ->setPeeringContractId($this->getPeeringContract() ? $this->getPeeringContract()->getId() : null);
    }

    /**
     * @return array
     */
    protected function __toArray()
    {
        return [
            'statId' => self::getStatId(),
            'xstatId' => self::getXstatId(),
            'statType' => self::getStatType(),
            'initialLeg' => self::getInitialLeg(),
            'initialLegHash' => self::getInitialLegHash(),
            'cid' => self::getCid(),
            'cidHash' => self::getCidHash(),
            'xcid' => self::getXcid(),
            'xcidHash' => self::getXcidHash(),
            'proxies' => self::getProxies(),
            'type' => self::getType(),
            'subtype' => self::getSubtype(),
            'calldate' => self::getCalldate(),
            'duration' => self::getDuration(),
            'aParty' => self::getAParty(),
            'bParty' => self::getBParty(),
            'caller' => self::getCaller(),
            'callee' => self::getCallee(),
            'xCaller' => self::getXCaller(),
            'xCallee' => self::getXCallee(),
            'initialReferrer' => self::getInitialReferrer(),
            'referrer' => self::getReferrer(),
            'referee' => self::getReferee(),
            'lastForwarder' => self::getLastForwarder(),
            'brandId' => self::getBrand() ? self::getBrand()->getId() : null,
            'companyId' => self::getCompany() ? self::getCompany()->getId() : null,
            'peeringContractId' => self::getPeeringContract() ? self::getPeeringContract()->getId() : null
        ];
    }


    // @codeCoverageIgnoreStart

    /**
     * Set statId
     *
     * @param integer $statId
     *
     * @return self
     */
    public function setStatId($statId = null)
    {
        if (!is_null($statId)) {
            if (!is_null($statId)) {
                Assertion::integerish($statId, 'statId value "%s" is not an integer or a number castable to integer.');
                Assertion::greaterOrEqualThan($statId, 0, 'statId provided "%s" is not greater or equal than "%s".');
            }
        }

        $this->statId = $statId;

        return $this;
    }

    /**
     * Get statId
     *
     * @return integer
     */
    public function getStatId()
    {
        return $this->statId;
    }

    /**
     * Set xstatId
     *
     * @param integer $xstatId
     *
     * @return self
     */
    public function setXstatId($xstatId = null)
    {
        if (!is_null($xstatId)) {
            if (!is_null($xstatId)) {
                Assertion::integerish($xstatId, 'xstatId value "%s" is not an integer or a number castable to integer.');
                Assertion::greaterOrEqualThan($xstatId, 0, 'xstatId provided "%s" is not greater or equal than "%s".');
            }
        }

        $this->xstatId = $xstatId;

        return $this;
    }

    /**
     * Get xstatId
     *
     * @return integer
     */
    public function getXstatId()
    {
        return $this->xstatId;
    }

    /**
     * Set statType
     *
     * @param string $statType
     *
     * @return self
     */
    public function setStatType($statType = null)
    {
        if (!is_null($statType)) {
            Assertion::maxLength($statType, 256, 'statType value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->statType = $statType;

        return $this;
    }

    /**
     * Get statType
     *
     * @return string
     */
    public function getStatType()
    {
        return $this->statType;
    }

    /**
     * Set initialLeg
     *
     * @param string $initialLeg
     *
     * @return self
     */
    public function setInitialLeg($initialLeg = null)
    {
        if (!is_null($initialLeg)) {
            Assertion::maxLength($initialLeg, 255, 'initialLeg value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->initialLeg = $initialLeg;

        return $this;
    }

    /**
     * Get initialLeg
     *
     * @return string
     */
    public function getInitialLeg()
    {
        return $this->initialLeg;
    }

    /**
     * Set initialLegHash
     *
     * @param string $initialLegHash
     *
     * @return self
     */
    public function setInitialLegHash($initialLegHash = null)
    {
        if (!is_null($initialLegHash)) {
            Assertion::maxLength($initialLegHash, 128, 'initialLegHash value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->initialLegHash = $initialLegHash;

        return $this;
    }

    /**
     * Get initialLegHash
     *
     * @return string
     */
    public function getInitialLegHash()
    {
        return $this->initialLegHash;
    }

    /**
     * Set cid
     *
     * @param string $cid
     *
     * @return self
     */
    public function setCid($cid = null)
    {
        if (!is_null($cid)) {
            Assertion::maxLength($cid, 255, 'cid value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->cid = $cid;

        return $this;
    }

    /**
     * Get cid
     *
     * @return string
     */
    public function getCid()
    {
        return $this->cid;
    }

    /**
     * Set cidHash
     *
     * @param string $cidHash
     *
     * @return self
     */
    public function setCidHash($cidHash = null)
    {
        if (!is_null($cidHash)) {
            Assertion::maxLength($cidHash, 128, 'cidHash value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->cidHash = $cidHash;

        return $this;
    }

    /**
     * Get cidHash
     *
     * @return string
     */
    public function getCidHash()
    {
        return $this->cidHash;
    }

    /**
     * Set xcid
     *
     * @param string $xcid
     *
     * @return self
     */
    public function setXcid($xcid = null)
    {
        if (!is_null($xcid)) {
            Assertion::maxLength($xcid, 255, 'xcid value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->xcid = $xcid;

        return $this;
    }

    /**
     * Get xcid
     *
     * @return string
     */
    public function getXcid()
    {
        return $this->xcid;
    }

    /**
     * Set xcidHash
     *
     * @param string $xcidHash
     *
     * @return self
     */
    public function setXcidHash($xcidHash = null)
    {
        if (!is_null($xcidHash)) {
            Assertion::maxLength($xcidHash, 128, 'xcidHash value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->xcidHash = $xcidHash;

        return $this;
    }

    /**
     * Get xcidHash
     *
     * @return string
     */
    public function getXcidHash()
    {
        return $this->xcidHash;
    }

    /**
     * Set proxies
     *
     * @param string $proxies
     *
     * @return self
     */
    public function setProxies($proxies = null)
    {
        if (!is_null($proxies)) {
            Assertion::maxLength($proxies, 32, 'proxies value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->proxies = $proxies;

        return $this;
    }

    /**
     * Get proxies
     *
     * @return string
     */
    public function getProxies()
    {
        return $this->proxies;
    }

    /**
     * Set type
     *
     * @param string $type
     *
     * @return self
     */
    public function setType($type = null)
    {
        if (!is_null($type)) {
            Assertion::maxLength($type, 32, 'type value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set subtype
     *
     * @param string $subtype
     *
     * @return self
     */
    public function setSubtype($subtype = null)
    {
        if (!is_null($subtype)) {
            Assertion::maxLength($subtype, 64, 'subtype value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->subtype = $subtype;

        return $this;
    }

    /**
     * Get subtype
     *
     * @return string
     */
    public function getSubtype()
    {
        return $this->subtype;
    }

    /**
     * Set calldate
     *
     * @param \DateTime $calldate
     *
     * @return self
     */
    public function setCalldate($calldate)
    {
        Assertion::notNull($calldate, 'calldate value "%s" is null, but non null value was expected.');
        $calldate = \Ivoz\Core\Domain\Model\Helper\DateTimeHelper::createOrFix(
            $calldate,
            'CURRENT_TIMESTAMP'
        );

        $this->calldate = $calldate;

        return $this;
    }

    /**
     * Get calldate
     *
     * @return \DateTime
     */
    public function getCalldate()
    {
        return $this->calldate;
    }

    /**
     * Set duration
     *
     * @param integer $duration
     *
     * @return self
     */
    public function setDuration($duration = null)
    {
        if (!is_null($duration)) {
            if (!is_null($duration)) {
                Assertion::integerish($duration, 'duration value "%s" is not an integer or a number castable to integer.');
                Assertion::greaterOrEqualThan($duration, 0, 'duration provided "%s" is not greater or equal than "%s".');
            }
        }

        $this->duration = $duration;

        return $this;
    }

    /**
     * Get duration
     *
     * @return integer
     */
    public function getDuration()
    {
        return $this->duration;
    }

    /**
     * Set aParty
     *
     * @param string $aParty
     *
     * @return self
     */
    public function setAParty($aParty = null)
    {
        if (!is_null($aParty)) {
            Assertion::maxLength($aParty, 128, 'aParty value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->aParty = $aParty;

        return $this;
    }

    /**
     * Get aParty
     *
     * @return string
     */
    public function getAParty()
    {
        return $this->aParty;
    }

    /**
     * Set bParty
     *
     * @param string $bParty
     *
     * @return self
     */
    public function setBParty($bParty = null)
    {
        if (!is_null($bParty)) {
            Assertion::maxLength($bParty, 128, 'bParty value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->bParty = $bParty;

        return $this;
    }

    /**
     * Get bParty
     *
     * @return string
     */
    public function getBParty()
    {
        return $this->bParty;
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
            Assertion::maxLength($caller, 128, 'caller value "%s" is too long, it should have no more than %d characters, but has %d characters.');
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
            Assertion::maxLength($callee, 128, 'callee value "%s" is too long, it should have no more than %d characters, but has %d characters.');
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
     * Set xCaller
     *
     * @param string $xCaller
     *
     * @return self
     */
    public function setXCaller($xCaller = null)
    {
        if (!is_null($xCaller)) {
            Assertion::maxLength($xCaller, 128, 'xCaller value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->xCaller = $xCaller;

        return $this;
    }

    /**
     * Get xCaller
     *
     * @return string
     */
    public function getXCaller()
    {
        return $this->xCaller;
    }

    /**
     * Set xCallee
     *
     * @param string $xCallee
     *
     * @return self
     */
    public function setXCallee($xCallee = null)
    {
        if (!is_null($xCallee)) {
            Assertion::maxLength($xCallee, 128, 'xCallee value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->xCallee = $xCallee;

        return $this;
    }

    /**
     * Get xCallee
     *
     * @return string
     */
    public function getXCallee()
    {
        return $this->xCallee;
    }

    /**
     * Set initialReferrer
     *
     * @param string $initialReferrer
     *
     * @return self
     */
    public function setInitialReferrer($initialReferrer = null)
    {
        if (!is_null($initialReferrer)) {
            Assertion::maxLength($initialReferrer, 128, 'initialReferrer value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->initialReferrer = $initialReferrer;

        return $this;
    }

    /**
     * Get initialReferrer
     *
     * @return string
     */
    public function getInitialReferrer()
    {
        return $this->initialReferrer;
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
            Assertion::maxLength($referrer, 128, 'referrer value "%s" is too long, it should have no more than %d characters, but has %d characters.');
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
     * Set referee
     *
     * @param string $referee
     *
     * @return self
     */
    public function setReferee($referee = null)
    {
        if (!is_null($referee)) {
            Assertion::maxLength($referee, 128, 'referee value "%s" is too long, it should have no more than %d characters, but has %d characters.');
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
     * Set lastForwarder
     *
     * @param string $lastForwarder
     *
     * @return self
     */
    public function setLastForwarder($lastForwarder = null)
    {
        if (!is_null($lastForwarder)) {
            Assertion::maxLength($lastForwarder, 32, 'lastForwarder value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->lastForwarder = $lastForwarder;

        return $this;
    }

    /**
     * Get lastForwarder
     *
     * @return string
     */
    public function getLastForwarder()
    {
        return $this->lastForwarder;
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

    /**
     * Set peeringContract
     *
     * @param \Ivoz\Provider\Domain\Model\PeeringContract\PeeringContractInterface $peeringContract
     *
     * @return self
     */
    public function setPeeringContract(\Ivoz\Provider\Domain\Model\PeeringContract\PeeringContractInterface $peeringContract = null)
    {
        $this->peeringContract = $peeringContract;

        return $this;
    }

    /**
     * Get peeringContract
     *
     * @return \Ivoz\Provider\Domain\Model\PeeringContract\PeeringContractInterface
     */
    public function getPeeringContract()
    {
        return $this->peeringContract;
    }



    // @codeCoverageIgnoreEnd
}

