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
    protected $duration = 0.0;

    /**
     * @var string | null
     */
    protected $caller;

    /**
     * @var string | null
     */
    protected $callee;

    /**
     * @var string | null
     */
    protected $callid;

    /**
     * @var string | null
     */
    protected $callidHash;

    /**
     * @var string | null
     */
    protected $xcallid;

    /**
     * @var string | null
     */
    protected $diversion;

    /**
     * @var boolean | null
     */
    protected $bounced;

    /**
     * @var boolean | null
     */
    protected $parsed = false;

    /**
     * @var \DateTime
     */
    protected $parserScheduledAt;

    /**
     * comment: enum:inbound|outbound
     * @var string | null
     */
    protected $direction;

    /**
     * @var string | null
     */
    protected $cgrid;

    /**
     * @var \Ivoz\Provider\Domain\Model\Brand\BrandInterface | null
     */
    protected $brand;

    /**
     * @var \Ivoz\Provider\Domain\Model\Company\CompanyInterface | null
     */
    protected $company;

    /**
     * @var \Ivoz\Provider\Domain\Model\Carrier\CarrierInterface | null
     */
    protected $carrier;

    /**
     * @var \Ivoz\Provider\Domain\Model\RetailAccount\RetailAccountInterface | null
     */
    protected $retailAccount;

    /**
     * @var \Ivoz\Provider\Domain\Model\ResidentialDevice\ResidentialDeviceInterface | null
     */
    protected $residentialDevice;

    /**
     * @var \Ivoz\Provider\Domain\Model\User\UserInterface | null
     */
    protected $user;

    /**
     * @var \Ivoz\Provider\Domain\Model\Friend\FriendInterface | null
     */
    protected $friend;

    /**
     * @var \Ivoz\Provider\Domain\Model\Fax\FaxInterface | null
     */
    protected $fax;

    /**
     * @var \Ivoz\Provider\Domain\Model\Ddi\DdiInterface | null
     */
    protected $ddi;

    /**
     * @var \Ivoz\Provider\Domain\Model\DdiProvider\DdiProviderInterface | null
     */
    protected $ddiProvider;


    use ChangelogTrait;

    /**
     * Constructor
     */
    protected function __construct(
        $startTime,
        $endTime,
        $duration,
        $parserScheduledAt
    ) {
        $this->setStartTime($startTime);
        $this->setEndTime($endTime);
        $this->setDuration($duration);
        $this->setParserScheduledAt($parserScheduledAt);
    }

    abstract public function getId();

    public function __toString()
    {
        return sprintf(
            "%s#%s",
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
     * @internal use EntityTools instead
     * @param TrunksCdrInterface|null $entity
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

        /** @var TrunksCdrDto $dto */
        $dto = $entity->toDto($depth-1);

        return $dto;
    }

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param TrunksCdrDto $dto
     * @return self
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        \Ivoz\Core\Application\ForeignKeyTransformerInterface $fkTransformer
    ) {
        Assertion::isInstanceOf($dto, TrunksCdrDto::class);

        $self = new static(
            $dto->getStartTime(),
            $dto->getEndTime(),
            $dto->getDuration(),
            $dto->getParserScheduledAt()
        );

        $self
            ->setCaller($dto->getCaller())
            ->setCallee($dto->getCallee())
            ->setCallid($dto->getCallid())
            ->setCallidHash($dto->getCallidHash())
            ->setXcallid($dto->getXcallid())
            ->setDiversion($dto->getDiversion())
            ->setBounced($dto->getBounced())
            ->setParsed($dto->getParsed())
            ->setDirection($dto->getDirection())
            ->setCgrid($dto->getCgrid())
            ->setBrand($fkTransformer->transform($dto->getBrand()))
            ->setCompany($fkTransformer->transform($dto->getCompany()))
            ->setCarrier($fkTransformer->transform($dto->getCarrier()))
            ->setRetailAccount($fkTransformer->transform($dto->getRetailAccount()))
            ->setResidentialDevice($fkTransformer->transform($dto->getResidentialDevice()))
            ->setUser($fkTransformer->transform($dto->getUser()))
            ->setFriend($fkTransformer->transform($dto->getFriend()))
            ->setFax($fkTransformer->transform($dto->getFax()))
            ->setDdi($fkTransformer->transform($dto->getDdi()))
            ->setDdiProvider($fkTransformer->transform($dto->getDdiProvider()))
        ;

        $self->initChangelog();

        return $self;
    }

    /**
     * @internal use EntityTools instead
     * @param TrunksCdrDto $dto
     * @return self
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        \Ivoz\Core\Application\ForeignKeyTransformerInterface $fkTransformer
    ) {
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
            ->setParsed($dto->getParsed())
            ->setParserScheduledAt($dto->getParserScheduledAt())
            ->setDirection($dto->getDirection())
            ->setCgrid($dto->getCgrid())
            ->setBrand($fkTransformer->transform($dto->getBrand()))
            ->setCompany($fkTransformer->transform($dto->getCompany()))
            ->setCarrier($fkTransformer->transform($dto->getCarrier()))
            ->setRetailAccount($fkTransformer->transform($dto->getRetailAccount()))
            ->setResidentialDevice($fkTransformer->transform($dto->getResidentialDevice()))
            ->setUser($fkTransformer->transform($dto->getUser()))
            ->setFriend($fkTransformer->transform($dto->getFriend()))
            ->setFax($fkTransformer->transform($dto->getFax()))
            ->setDdi($fkTransformer->transform($dto->getDdi()))
            ->setDdiProvider($fkTransformer->transform($dto->getDdiProvider()));



        return $this;
    }

    /**
     * @internal use EntityTools instead
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
            ->setParsed(self::getParsed())
            ->setParserScheduledAt(self::getParserScheduledAt())
            ->setDirection(self::getDirection())
            ->setCgrid(self::getCgrid())
            ->setBrand(\Ivoz\Provider\Domain\Model\Brand\Brand::entityToDto(self::getBrand(), $depth))
            ->setCompany(\Ivoz\Provider\Domain\Model\Company\Company::entityToDto(self::getCompany(), $depth))
            ->setCarrier(\Ivoz\Provider\Domain\Model\Carrier\Carrier::entityToDto(self::getCarrier(), $depth))
            ->setRetailAccount(\Ivoz\Provider\Domain\Model\RetailAccount\RetailAccount::entityToDto(self::getRetailAccount(), $depth))
            ->setResidentialDevice(\Ivoz\Provider\Domain\Model\ResidentialDevice\ResidentialDevice::entityToDto(self::getResidentialDevice(), $depth))
            ->setUser(\Ivoz\Provider\Domain\Model\User\User::entityToDto(self::getUser(), $depth))
            ->setFriend(\Ivoz\Provider\Domain\Model\Friend\Friend::entityToDto(self::getFriend(), $depth))
            ->setFax(\Ivoz\Provider\Domain\Model\Fax\Fax::entityToDto(self::getFax(), $depth))
            ->setDdi(\Ivoz\Provider\Domain\Model\Ddi\Ddi::entityToDto(self::getDdi(), $depth))
            ->setDdiProvider(\Ivoz\Provider\Domain\Model\DdiProvider\DdiProvider::entityToDto(self::getDdiProvider(), $depth));
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
            'parsed' => self::getParsed(),
            'parserScheduledAt' => self::getParserScheduledAt(),
            'direction' => self::getDirection(),
            'cgrid' => self::getCgrid(),
            'brandId' => self::getBrand() ? self::getBrand()->getId() : null,
            'companyId' => self::getCompany() ? self::getCompany()->getId() : null,
            'carrierId' => self::getCarrier() ? self::getCarrier()->getId() : null,
            'retailAccountId' => self::getRetailAccount() ? self::getRetailAccount()->getId() : null,
            'residentialDeviceId' => self::getResidentialDevice() ? self::getResidentialDevice()->getId() : null,
            'userId' => self::getUser() ? self::getUser()->getId() : null,
            'friendId' => self::getFriend() ? self::getFriend()->getId() : null,
            'faxId' => self::getFax() ? self::getFax()->getId() : null,
            'ddiId' => self::getDdi() ? self::getDdi()->getId() : null,
            'ddiProviderId' => self::getDdiProvider() ? self::getDdiProvider()->getId() : null
        ];
    }
    // @codeCoverageIgnoreStart

    /**
     * Set startTime
     *
     * @param \DateTime $startTime
     *
     * @return static
     */
    protected function setStartTime($startTime)
    {
        Assertion::notNull($startTime, 'startTime value "%s" is null, but non null value was expected.');
        $startTime = \Ivoz\Core\Domain\Model\Helper\DateTimeHelper::createOrFix(
            $startTime,
            '2000-01-01 00:00:00'
        );

        if ($this->startTime == $startTime) {
            return $this;
        }

        $this->startTime = $startTime;

        return $this;
    }

    /**
     * Get startTime
     *
     * @return \DateTime
     */
    public function getStartTime(): \DateTime
    {
        return clone $this->startTime;
    }

    /**
     * Set endTime
     *
     * @param \DateTime $endTime
     *
     * @return static
     */
    protected function setEndTime($endTime)
    {
        Assertion::notNull($endTime, 'endTime value "%s" is null, but non null value was expected.');
        $endTime = \Ivoz\Core\Domain\Model\Helper\DateTimeHelper::createOrFix(
            $endTime,
            '2000-01-01 00:00:00'
        );

        if ($this->endTime == $endTime) {
            return $this;
        }

        $this->endTime = $endTime;

        return $this;
    }

    /**
     * Get endTime
     *
     * @return \DateTime
     */
    public function getEndTime(): \DateTime
    {
        return clone $this->endTime;
    }

    /**
     * Set duration
     *
     * @param float $duration
     *
     * @return static
     */
    protected function setDuration($duration)
    {
        Assertion::notNull($duration, 'duration value "%s" is null, but non null value was expected.');
        Assertion::numeric($duration);

        $this->duration = (float) $duration;

        return $this;
    }

    /**
     * Get duration
     *
     * @return float
     */
    public function getDuration(): float
    {
        return $this->duration;
    }

    /**
     * Set caller
     *
     * @param string $caller | null
     *
     * @return static
     */
    protected function setCaller($caller = null)
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
     * @return string | null
     */
    public function getCaller()
    {
        return $this->caller;
    }

    /**
     * Set callee
     *
     * @param string $callee | null
     *
     * @return static
     */
    protected function setCallee($callee = null)
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
     * @return string | null
     */
    public function getCallee()
    {
        return $this->callee;
    }

    /**
     * Set callid
     *
     * @param string $callid | null
     *
     * @return static
     */
    protected function setCallid($callid = null)
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
     * @return string | null
     */
    public function getCallid()
    {
        return $this->callid;
    }

    /**
     * Set callidHash
     *
     * @param string $callidHash | null
     *
     * @return static
     */
    protected function setCallidHash($callidHash = null)
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
     * @return string | null
     */
    public function getCallidHash()
    {
        return $this->callidHash;
    }

    /**
     * Set xcallid
     *
     * @param string $xcallid | null
     *
     * @return static
     */
    protected function setXcallid($xcallid = null)
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
     * @return string | null
     */
    public function getXcallid()
    {
        return $this->xcallid;
    }

    /**
     * Set diversion
     *
     * @param string $diversion | null
     *
     * @return static
     */
    protected function setDiversion($diversion = null)
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
     * @return string | null
     */
    public function getDiversion()
    {
        return $this->diversion;
    }

    /**
     * Set bounced
     *
     * @param boolean $bounced | null
     *
     * @return static
     */
    protected function setBounced($bounced = null)
    {
        if (!is_null($bounced)) {
            Assertion::between(intval($bounced), 0, 1, 'bounced provided "%s" is not a valid boolean value.');
            $bounced = (bool) $bounced;
        }

        $this->bounced = $bounced;

        return $this;
    }

    /**
     * Get bounced
     *
     * @return boolean | null
     */
    public function getBounced()
    {
        return $this->bounced;
    }

    /**
     * Set parsed
     *
     * @param boolean $parsed | null
     *
     * @return static
     */
    protected function setParsed($parsed = null)
    {
        if (!is_null($parsed)) {
            Assertion::between(intval($parsed), 0, 1, 'parsed provided "%s" is not a valid boolean value.');
            $parsed = (bool) $parsed;
        }

        $this->parsed = $parsed;

        return $this;
    }

    /**
     * Get parsed
     *
     * @return boolean | null
     */
    public function getParsed()
    {
        return $this->parsed;
    }

    /**
     * Set parserScheduledAt
     *
     * @param \DateTime $parserScheduledAt
     *
     * @return static
     */
    protected function setParserScheduledAt($parserScheduledAt)
    {
        Assertion::notNull($parserScheduledAt, 'parserScheduledAt value "%s" is null, but non null value was expected.');
        $parserScheduledAt = \Ivoz\Core\Domain\Model\Helper\DateTimeHelper::createOrFix(
            $parserScheduledAt,
            'CURRENT_TIMESTAMP'
        );

        if ($this->parserScheduledAt == $parserScheduledAt) {
            return $this;
        }

        $this->parserScheduledAt = $parserScheduledAt;

        return $this;
    }

    /**
     * Get parserScheduledAt
     *
     * @return \DateTime
     */
    public function getParserScheduledAt(): \DateTime
    {
        return clone $this->parserScheduledAt;
    }

    /**
     * Set direction
     *
     * @param string $direction | null
     *
     * @return static
     */
    protected function setDirection($direction = null)
    {
        if (!is_null($direction)) {
            Assertion::choice($direction, [
                TrunksCdrInterface::DIRECTION_INBOUND,
                TrunksCdrInterface::DIRECTION_OUTBOUND
            ], 'directionvalue "%s" is not an element of the valid values: %s');
        }

        $this->direction = $direction;

        return $this;
    }

    /**
     * Get direction
     *
     * @return string | null
     */
    public function getDirection()
    {
        return $this->direction;
    }

    /**
     * Set cgrid
     *
     * @param string $cgrid | null
     *
     * @return static
     */
    protected function setCgrid($cgrid = null)
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
     * @return string | null
     */
    public function getCgrid()
    {
        return $this->cgrid;
    }

    /**
     * Set brand
     *
     * @param \Ivoz\Provider\Domain\Model\Brand\BrandInterface $brand | null
     *
     * @return static
     */
    protected function setBrand(\Ivoz\Provider\Domain\Model\Brand\BrandInterface $brand = null)
    {
        $this->brand = $brand;

        return $this;
    }

    /**
     * Get brand
     *
     * @return \Ivoz\Provider\Domain\Model\Brand\BrandInterface | null
     */
    public function getBrand()
    {
        return $this->brand;
    }

    /**
     * Set company
     *
     * @param \Ivoz\Provider\Domain\Model\Company\CompanyInterface $company | null
     *
     * @return static
     */
    protected function setCompany(\Ivoz\Provider\Domain\Model\Company\CompanyInterface $company = null)
    {
        $this->company = $company;

        return $this;
    }

    /**
     * Get company
     *
     * @return \Ivoz\Provider\Domain\Model\Company\CompanyInterface | null
     */
    public function getCompany()
    {
        return $this->company;
    }

    /**
     * Set carrier
     *
     * @param \Ivoz\Provider\Domain\Model\Carrier\CarrierInterface $carrier | null
     *
     * @return static
     */
    protected function setCarrier(\Ivoz\Provider\Domain\Model\Carrier\CarrierInterface $carrier = null)
    {
        $this->carrier = $carrier;

        return $this;
    }

    /**
     * Get carrier
     *
     * @return \Ivoz\Provider\Domain\Model\Carrier\CarrierInterface | null
     */
    public function getCarrier()
    {
        return $this->carrier;
    }

    /**
     * Set retailAccount
     *
     * @param \Ivoz\Provider\Domain\Model\RetailAccount\RetailAccountInterface $retailAccount | null
     *
     * @return static
     */
    protected function setRetailAccount(\Ivoz\Provider\Domain\Model\RetailAccount\RetailAccountInterface $retailAccount = null)
    {
        $this->retailAccount = $retailAccount;

        return $this;
    }

    /**
     * Get retailAccount
     *
     * @return \Ivoz\Provider\Domain\Model\RetailAccount\RetailAccountInterface | null
     */
    public function getRetailAccount()
    {
        return $this->retailAccount;
    }

    /**
     * Set residentialDevice
     *
     * @param \Ivoz\Provider\Domain\Model\ResidentialDevice\ResidentialDeviceInterface $residentialDevice | null
     *
     * @return static
     */
    protected function setResidentialDevice(\Ivoz\Provider\Domain\Model\ResidentialDevice\ResidentialDeviceInterface $residentialDevice = null)
    {
        $this->residentialDevice = $residentialDevice;

        return $this;
    }

    /**
     * Get residentialDevice
     *
     * @return \Ivoz\Provider\Domain\Model\ResidentialDevice\ResidentialDeviceInterface | null
     */
    public function getResidentialDevice()
    {
        return $this->residentialDevice;
    }

    /**
     * Set user
     *
     * @param \Ivoz\Provider\Domain\Model\User\UserInterface $user | null
     *
     * @return static
     */
    protected function setUser(\Ivoz\Provider\Domain\Model\User\UserInterface $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \Ivoz\Provider\Domain\Model\User\UserInterface | null
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set friend
     *
     * @param \Ivoz\Provider\Domain\Model\Friend\FriendInterface $friend | null
     *
     * @return static
     */
    protected function setFriend(\Ivoz\Provider\Domain\Model\Friend\FriendInterface $friend = null)
    {
        $this->friend = $friend;

        return $this;
    }

    /**
     * Get friend
     *
     * @return \Ivoz\Provider\Domain\Model\Friend\FriendInterface | null
     */
    public function getFriend()
    {
        return $this->friend;
    }

    /**
     * Set fax
     *
     * @param \Ivoz\Provider\Domain\Model\Fax\FaxInterface $fax | null
     *
     * @return static
     */
    protected function setFax(\Ivoz\Provider\Domain\Model\Fax\FaxInterface $fax = null)
    {
        $this->fax = $fax;

        return $this;
    }

    /**
     * Get fax
     *
     * @return \Ivoz\Provider\Domain\Model\Fax\FaxInterface | null
     */
    public function getFax()
    {
        return $this->fax;
    }

    /**
     * Set ddi
     *
     * @param \Ivoz\Provider\Domain\Model\Ddi\DdiInterface $ddi | null
     *
     * @return static
     */
    protected function setDdi(\Ivoz\Provider\Domain\Model\Ddi\DdiInterface $ddi = null)
    {
        $this->ddi = $ddi;

        return $this;
    }

    /**
     * Get ddi
     *
     * @return \Ivoz\Provider\Domain\Model\Ddi\DdiInterface | null
     */
    public function getDdi()
    {
        return $this->ddi;
    }

    /**
     * Set ddiProvider
     *
     * @param \Ivoz\Provider\Domain\Model\DdiProvider\DdiProviderInterface $ddiProvider | null
     *
     * @return static
     */
    protected function setDdiProvider(\Ivoz\Provider\Domain\Model\DdiProvider\DdiProviderInterface $ddiProvider = null)
    {
        $this->ddiProvider = $ddiProvider;

        return $this;
    }

    /**
     * Get ddiProvider
     *
     * @return \Ivoz\Provider\Domain\Model\DdiProvider\DdiProviderInterface | null
     */
    public function getDdiProvider()
    {
        return $this->ddiProvider;
    }

    // @codeCoverageIgnoreEnd
}
