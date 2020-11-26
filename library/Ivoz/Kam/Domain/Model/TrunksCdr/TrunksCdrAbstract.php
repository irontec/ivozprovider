<?php
declare(strict_types = 1);

namespace Ivoz\Kam\Domain\Model\TrunksCdr;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;
use \Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Core\Domain\Model\Helper\DateTimeHelper;
use Ivoz\Provider\Domain\Model\Brand\BrandInterface;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use Ivoz\Provider\Domain\Model\Carrier\CarrierInterface;
use Ivoz\Provider\Domain\Model\RetailAccount\RetailAccountInterface;
use Ivoz\Provider\Domain\Model\ResidentialDevice\ResidentialDeviceInterface;
use Ivoz\Provider\Domain\Model\User\UserInterface;
use Ivoz\Provider\Domain\Model\Friend\FriendInterface;
use Ivoz\Provider\Domain\Model\Fax\FaxInterface;
use Ivoz\Provider\Domain\Model\Ddi\DdiInterface;
use Ivoz\Provider\Domain\Model\DdiProvider\DdiProviderInterface;
use Ivoz\Provider\Domain\Model\Brand\Brand;
use Ivoz\Provider\Domain\Model\Company\Company;
use Ivoz\Provider\Domain\Model\Carrier\Carrier;
use Ivoz\Provider\Domain\Model\RetailAccount\RetailAccount;
use Ivoz\Provider\Domain\Model\ResidentialDevice\ResidentialDevice;
use Ivoz\Provider\Domain\Model\User\User;
use Ivoz\Provider\Domain\Model\Friend\Friend;
use Ivoz\Provider\Domain\Model\Fax\Fax;
use Ivoz\Provider\Domain\Model\Ddi\Ddi;
use Ivoz\Provider\Domain\Model\DdiProvider\DdiProvider;

/**
* TrunksCdrAbstract
* @codeCoverageIgnore
*/
abstract class TrunksCdrAbstract
{
    use ChangelogTrait;

    /**
     * column: start_time
     * @var \DateTimeInterface
     */
    protected $startTime = '2000-01-01 00:00:00';

    /**
     * column: end_time
     * @var \DateTimeInterface
     */
    protected $endTime = '2000-01-01 00:00:00';

    /**
     * @var float
     */
    protected $duration = 0;

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
     * @var bool | null
     */
    protected $bounced;

    /**
     * @var bool | null
     */
    protected $parsed = false;

    /**
     * @var \DateTimeInterface
     */
    protected $parserScheduledAt = 'CURRENT_TIMESTAMP';

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
     * @var BrandInterface
     */
    protected $brand;

    /**
     * @var CompanyInterface
     */
    protected $company;

    /**
     * @var CarrierInterface
     */
    protected $carrier;

    /**
     * @var RetailAccountInterface
     */
    protected $retailAccount;

    /**
     * @var ResidentialDeviceInterface
     */
    protected $residentialDevice;

    /**
     * @var UserInterface
     */
    protected $user;

    /**
     * @var FriendInterface
     */
    protected $friend;

    /**
     * @var FaxInterface
     */
    protected $fax;

    /**
     * @var DdiInterface
     */
    protected $ddi;

    /**
     * @var DdiProviderInterface
     */
    protected $ddiProvider;

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
        ForeignKeyTransformerInterface $fkTransformer
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
            ->setDdiProvider($fkTransformer->transform($dto->getDdiProvider()));

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
        ForeignKeyTransformerInterface $fkTransformer
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
            ->setBrand(Brand::entityToDto(self::getBrand(), $depth))
            ->setCompany(Company::entityToDto(self::getCompany(), $depth))
            ->setCarrier(Carrier::entityToDto(self::getCarrier(), $depth))
            ->setRetailAccount(RetailAccount::entityToDto(self::getRetailAccount(), $depth))
            ->setResidentialDevice(ResidentialDevice::entityToDto(self::getResidentialDevice(), $depth))
            ->setUser(User::entityToDto(self::getUser(), $depth))
            ->setFriend(Friend::entityToDto(self::getFriend(), $depth))
            ->setFax(Fax::entityToDto(self::getFax(), $depth))
            ->setDdi(Ddi::entityToDto(self::getDdi(), $depth))
            ->setDdiProvider(DdiProvider::entityToDto(self::getDdiProvider(), $depth));
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

    /**
     * Set startTime
     *
     * @param \DateTimeInterface $startTime
     *
     * @return static
     */
    protected function setStartTime($startTime): TrunksCdrInterface
    {

        $startTime = DateTimeHelper::createOrFix(
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
     * @return \DateTimeInterface
     */
    public function getStartTime(): \DateTimeInterface
    {
        return clone $this->startTime;
    }

    /**
     * Set endTime
     *
     * @param \DateTimeInterface $endTime
     *
     * @return static
     */
    protected function setEndTime($endTime): TrunksCdrInterface
    {

        $endTime = DateTimeHelper::createOrFix(
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
     * @return \DateTimeInterface
     */
    public function getEndTime(): \DateTimeInterface
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
    protected function setDuration(float $duration): TrunksCdrInterface
    {
        $this->duration = $duration;

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
    protected function setCaller(?string $caller = null): TrunksCdrInterface
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
    public function getCaller(): ?string
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
    protected function setCallee(?string $callee = null): TrunksCdrInterface
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
    public function getCallee(): ?string
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
    protected function setCallid(?string $callid = null): TrunksCdrInterface
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
    public function getCallid(): ?string
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
    protected function setCallidHash(?string $callidHash = null): TrunksCdrInterface
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
    public function getCallidHash(): ?string
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
    protected function setXcallid(?string $xcallid = null): TrunksCdrInterface
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
    public function getXcallid(): ?string
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
    protected function setDiversion(?string $diversion = null): TrunksCdrInterface
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
    public function getDiversion(): ?string
    {
        return $this->diversion;
    }

    /**
     * Set bounced
     *
     * @param bool $bounced | null
     *
     * @return static
     */
    protected function setBounced(?bool $bounced = null): TrunksCdrInterface
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
     * @return bool | null
     */
    public function getBounced(): ?bool
    {
        return $this->bounced;
    }

    /**
     * Set parsed
     *
     * @param bool $parsed | null
     *
     * @return static
     */
    protected function setParsed(?bool $parsed = null): TrunksCdrInterface
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
     * @return bool | null
     */
    public function getParsed(): ?bool
    {
        return $this->parsed;
    }

    /**
     * Set parserScheduledAt
     *
     * @param \DateTimeInterface $parserScheduledAt
     *
     * @return static
     */
    protected function setParserScheduledAt($parserScheduledAt): TrunksCdrInterface
    {

        $parserScheduledAt = DateTimeHelper::createOrFix(
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
     * @return \DateTimeInterface
     */
    public function getParserScheduledAt(): \DateTimeInterface
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
    protected function setDirection(?string $direction = null): TrunksCdrInterface
    {
        if (!is_null($direction)) {
            Assertion::choice(
                $direction,
                [
                    TrunksCdrInterface::DIRECTION_INBOUND,
                    TrunksCdrInterface::DIRECTION_OUTBOUND,
                ],
                'directionvalue "%s" is not an element of the valid values: %s'
            );
        }

        $this->direction = $direction;

        return $this;
    }

    /**
     * Get direction
     *
     * @return string | null
     */
    public function getDirection(): ?string
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
    protected function setCgrid(?string $cgrid = null): TrunksCdrInterface
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
    public function getCgrid(): ?string
    {
        return $this->cgrid;
    }

    /**
     * Set brand
     *
     * @param BrandInterface | null
     *
     * @return static
     */
    protected function setBrand(?BrandInterface $brand = null): TrunksCdrInterface
    {
        $this->brand = $brand;

        return $this;
    }

    /**
     * Get brand
     *
     * @return BrandInterface | null
     */
    public function getBrand(): ?BrandInterface
    {
        return $this->brand;
    }

    /**
     * Set company
     *
     * @param CompanyInterface | null
     *
     * @return static
     */
    protected function setCompany(?CompanyInterface $company = null): TrunksCdrInterface
    {
        $this->company = $company;

        return $this;
    }

    /**
     * Get company
     *
     * @return CompanyInterface | null
     */
    public function getCompany(): ?CompanyInterface
    {
        return $this->company;
    }

    /**
     * Set carrier
     *
     * @param CarrierInterface | null
     *
     * @return static
     */
    protected function setCarrier(?CarrierInterface $carrier = null): TrunksCdrInterface
    {
        $this->carrier = $carrier;

        return $this;
    }

    /**
     * Get carrier
     *
     * @return CarrierInterface | null
     */
    public function getCarrier(): ?CarrierInterface
    {
        return $this->carrier;
    }

    /**
     * Set retailAccount
     *
     * @param RetailAccountInterface | null
     *
     * @return static
     */
    protected function setRetailAccount(?RetailAccountInterface $retailAccount = null): TrunksCdrInterface
    {
        $this->retailAccount = $retailAccount;

        return $this;
    }

    /**
     * Get retailAccount
     *
     * @return RetailAccountInterface | null
     */
    public function getRetailAccount(): ?RetailAccountInterface
    {
        return $this->retailAccount;
    }

    /**
     * Set residentialDevice
     *
     * @param ResidentialDeviceInterface | null
     *
     * @return static
     */
    protected function setResidentialDevice(?ResidentialDeviceInterface $residentialDevice = null): TrunksCdrInterface
    {
        $this->residentialDevice = $residentialDevice;

        return $this;
    }

    /**
     * Get residentialDevice
     *
     * @return ResidentialDeviceInterface | null
     */
    public function getResidentialDevice(): ?ResidentialDeviceInterface
    {
        return $this->residentialDevice;
    }

    /**
     * Set user
     *
     * @param UserInterface | null
     *
     * @return static
     */
    protected function setUser(?UserInterface $user = null): TrunksCdrInterface
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return UserInterface | null
     */
    public function getUser(): ?UserInterface
    {
        return $this->user;
    }

    /**
     * Set friend
     *
     * @param FriendInterface | null
     *
     * @return static
     */
    protected function setFriend(?FriendInterface $friend = null): TrunksCdrInterface
    {
        $this->friend = $friend;

        return $this;
    }

    /**
     * Get friend
     *
     * @return FriendInterface | null
     */
    public function getFriend(): ?FriendInterface
    {
        return $this->friend;
    }

    /**
     * Set fax
     *
     * @param FaxInterface | null
     *
     * @return static
     */
    protected function setFax(?FaxInterface $fax = null): TrunksCdrInterface
    {
        $this->fax = $fax;

        return $this;
    }

    /**
     * Get fax
     *
     * @return FaxInterface | null
     */
    public function getFax(): ?FaxInterface
    {
        return $this->fax;
    }

    /**
     * Set ddi
     *
     * @param DdiInterface | null
     *
     * @return static
     */
    protected function setDdi(?DdiInterface $ddi = null): TrunksCdrInterface
    {
        $this->ddi = $ddi;

        return $this;
    }

    /**
     * Get ddi
     *
     * @return DdiInterface | null
     */
    public function getDdi(): ?DdiInterface
    {
        return $this->ddi;
    }

    /**
     * Set ddiProvider
     *
     * @param DdiProviderInterface | null
     *
     * @return static
     */
    protected function setDdiProvider(?DdiProviderInterface $ddiProvider = null): TrunksCdrInterface
    {
        $this->ddiProvider = $ddiProvider;

        return $this;
    }

    /**
     * Get ddiProvider
     *
     * @return DdiProviderInterface | null
     */
    public function getDdiProvider(): ?DdiProviderInterface
    {
        return $this->ddiProvider;
    }

}
