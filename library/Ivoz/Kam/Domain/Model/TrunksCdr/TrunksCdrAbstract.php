<?php

namespace Ivoz\Kam\Domain\Model\TrunksCdr;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;

/**
 * TrunksCdrAbstract
 * @codeCoverageIgnore
 */
abstract class TrunksCdrAbstract
{
    /**
     * column: start_time
     * @var \DateTime
     */
    protected $startTime;

    /**
     * column: end_time
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
    protected $diversion;

    /**
     * @var boolean
     */
    protected $bounced;

    /**
     * @var boolean
     */
    protected $metered = '0';

    /**
     * @var string
     */
    protected $direction;

    /**
     * @var string
     */
    protected $cgrid;

    /**
     * @var \Ivoz\Provider\Domain\Model\Brand\BrandInterface
     */
    protected $brand;

    /**
     * @var \Ivoz\Provider\Domain\Model\Company\CompanyInterface
     */
    protected $company;

    /**
     * @var \Ivoz\Provider\Domain\Model\Carrier\CarrierInterface
     */
    protected $carrier;


    use ChangelogTrait;

    /**
     * Constructor
     */
    protected function __construct($startTime, $endTime, $duration)
    {
        $this->setStartTime($startTime);
        $this->setEndTime($endTime);
        $this->setDuration($duration);
    }

    abstract public function getId();

    public function __toString()
    {
        return sprintf("%s#%s",
            "TrunksCdr",
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
     * @return TrunksCdrDto
     */
    public static function createDto($id = null)
    {
        return new TrunksCdrDto($id);
    }

    /**
     * @param EntityInterface|null $entity
     * @param int $depth
     * @return TrunksCdrDto|null
     */
    public static function entityToDto(EntityInterface $entity = null, $depth = 0)
    {
        if (!$entity) {
            return null;
        }

        Assertion::isInstanceOf($entity, TrunksCdrInterface::class);

        if ($depth < 1) {
            return static::createDto($entity->getId());
        }

        if ($entity instanceof \Doctrine\ORM\Proxy\Proxy && !$entity->__isInitialized()) {
            return static::createDto($entity->getId());
        }

        return $entity->toDto($depth-1);
    }

    /**
     * Factory method
     * @param DataTransferObjectInterface $dto
     * @return self
     */
    public static function fromDto(DataTransferObjectInterface $dto)
    {
        /**
         * @var $dto TrunksCdrDto
         */
        Assertion::isInstanceOf($dto, TrunksCdrDto::class);

        $self = new static(
            $dto->getStartTime(),
            $dto->getEndTime(),
            $dto->getDuration());

        $self
            ->setCaller($dto->getCaller())
            ->setCallee($dto->getCallee())
            ->setCallid($dto->getCallid())
            ->setCallidHash($dto->getCallidHash())
            ->setXcallid($dto->getXcallid())
            ->setDiversion($dto->getDiversion())
            ->setBounced($dto->getBounced())
            ->setMetered($dto->getMetered())
            ->setDirection($dto->getDirection())
            ->setCgrid($dto->getCgrid())
            ->setBrand($dto->getBrand())
            ->setCompany($dto->getCompany())
            ->setCarrier($dto->getCarrier())
        ;

        $self->sanitizeValues();
        $self->initChangelog();

        return $self;
    }

    /**
     * @param DataTransferObjectInterface $dto
     * @return self
     */
    public function updateFromDto(DataTransferObjectInterface $dto)
    {
        /**
         * @var $dto TrunksCdrDto
         */
        Assertion::isInstanceOf($dto, TrunksCdrDto::class);

        $this
            ->setStartTime($dto->getStartTime())
            ->setEndTime($dto->getEndTime())
            ->setDuration($dto->getDuration())
            ->setCaller($dto->getCaller())
            ->setCallee($dto->getCallee())
            ->setCallid($dto->getCallid())
            ->setCallidHash($dto->getCallidHash())
            ->setXcallid($dto->getXcallid())
            ->setDiversion($dto->getDiversion())
            ->setBounced($dto->getBounced())
            ->setMetered($dto->getMetered())
            ->setDirection($dto->getDirection())
            ->setCgrid($dto->getCgrid())
            ->setBrand($dto->getBrand())
            ->setCompany($dto->getCompany())
            ->setCarrier($dto->getCarrier());



        $this->sanitizeValues();
        return $this;
    }

    /**
     * @param int $depth
     * @return TrunksCdrDto
     */
    public function toDto($depth = 0)
    {
        return self::createDto()
            ->setStartTime(self::getStartTime())
            ->setEndTime(self::getEndTime())
            ->setDuration(self::getDuration())
            ->setCaller(self::getCaller())
            ->setCallee(self::getCallee())
            ->setCallid(self::getCallid())
            ->setCallidHash(self::getCallidHash())
            ->setXcallid(self::getXcallid())
            ->setDiversion(self::getDiversion())
            ->setBounced(self::getBounced())
            ->setMetered(self::getMetered())
            ->setDirection(self::getDirection())
            ->setCgrid(self::getCgrid())
            ->setBrand(\Ivoz\Provider\Domain\Model\Brand\Brand::entityToDto(self::getBrand(), $depth))
            ->setCompany(\Ivoz\Provider\Domain\Model\Company\Company::entityToDto(self::getCompany(), $depth))
            ->setCarrier(\Ivoz\Provider\Domain\Model\Carrier\Carrier::entityToDto(self::getCarrier(), $depth));
    }

    /**
     * @return array
     */
    protected function __toArray()
    {
        return [
            'start_time' => self::getStartTime(),
            'end_time' => self::getEndTime(),
            'duration' => self::getDuration(),
            'caller' => self::getCaller(),
            'callee' => self::getCallee(),
            'callid' => self::getCallid(),
            'callidHash' => self::getCallidHash(),
            'xcallid' => self::getXcallid(),
            'diversion' => self::getDiversion(),
            'bounced' => self::getBounced(),
            'metered' => self::getMetered(),
            'direction' => self::getDirection(),
            'cgrid' => self::getCgrid(),
            'brandId' => self::getBrand() ? self::getBrand()->getId() : null,
            'companyId' => self::getCompany() ? self::getCompany()->getId() : null,
            'carrierId' => self::getCarrier() ? self::getCarrier()->getId() : null
        ];
    }


    // @codeCoverageIgnoreStart

    /**
     * @deprecated
     * Set startTime
     *
     * @param \DateTime $startTime
     *
     * @return self
     */
    public function setStartTime($startTime)
    {
        Assertion::notNull($startTime, 'startTime value "%s" is null, but non null value was expected.');
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
     * @deprecated
     * Set endTime
     *
     * @param \DateTime $endTime
     *
     * @return self
     */
    public function setEndTime($endTime)
    {
        Assertion::notNull($endTime, 'endTime value "%s" is null, but non null value was expected.');
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
     * @deprecated
     * Set duration
     *
     * @param float $duration
     *
     * @return self
     */
    public function setDuration($duration)
    {
        Assertion::notNull($duration, 'duration value "%s" is null, but non null value was expected.');
        Assertion::numeric($duration);
        $duration = (float) $duration;

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
     * @deprecated
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
     * @deprecated
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
     * @deprecated
     * Set callid
     *
     * @param string $callid
     *
     * @return self
     */
    public function setCallid($callid = null)
    {
        if (!is_null($callid)) {
            Assertion::maxLength($callid, 255, 'callid value "%s" is too long, it should have no more than %d characters, but has %d characters.');
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
     * @deprecated
     * Set callidHash
     *
     * @param string $callidHash
     *
     * @return self
     */
    public function setCallidHash($callidHash = null)
    {
        if (!is_null($callidHash)) {
            Assertion::maxLength($callidHash, 128, 'callidHash value "%s" is too long, it should have no more than %d characters, but has %d characters.');
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
     * @deprecated
     * Set xcallid
     *
     * @param string $xcallid
     *
     * @return self
     */
    public function setXcallid($xcallid = null)
    {
        if (!is_null($xcallid)) {
            Assertion::maxLength($xcallid, 255, 'xcallid value "%s" is too long, it should have no more than %d characters, but has %d characters.');
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
     * @deprecated
     * Set diversion
     *
     * @param string $diversion
     *
     * @return self
     */
    public function setDiversion($diversion = null)
    {
        if (!is_null($diversion)) {
            Assertion::maxLength($diversion, 64, 'diversion value "%s" is too long, it should have no more than %d characters, but has %d characters.');
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
     * @deprecated
     * Set bounced
     *
     * @param boolean $bounced
     *
     * @return self
     */
    public function setBounced($bounced = null)
    {
        if (!is_null($bounced)) {
            Assertion::between(intval($bounced), 0, 1, 'bounced provided "%s" is not a valid boolean value.');
        }

        $this->bounced = $bounced;

        return $this;
    }

    /**
     * Get bounced
     *
     * @return boolean
     */
    public function getBounced()
    {
        return $this->bounced;
    }

    /**
     * @deprecated
     * Set metered
     *
     * @param boolean $metered
     *
     * @return self
     */
    public function setMetered($metered = null)
    {
        if (!is_null($metered)) {
            Assertion::between(intval($metered), 0, 1, 'metered provided "%s" is not a valid boolean value.');
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
     * @deprecated
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
     * @deprecated
     * Set cgrid
     *
     * @param string $cgrid
     *
     * @return self
     */
    public function setCgrid($cgrid = null)
    {
        if (!is_null($cgrid)) {
            Assertion::maxLength($cgrid, 40, 'cgrid value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->cgrid = $cgrid;

        return $this;
    }

    /**
     * Get cgrid
     *
     * @return string
     */
    public function getCgrid()
    {
        return $this->cgrid;
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
     * Set carrier
     *
     * @param \Ivoz\Provider\Domain\Model\Carrier\CarrierInterface $carrier
     *
     * @return self
     */
    public function setCarrier(\Ivoz\Provider\Domain\Model\Carrier\CarrierInterface $carrier = null)
    {
        $this->carrier = $carrier;

        return $this;
    }

    /**
     * Get carrier
     *
     * @return \Ivoz\Provider\Domain\Model\Carrier\CarrierInterface
     */
    public function getCarrier()
    {
        return $this->carrier;
    }



    // @codeCoverageIgnoreEnd
}

