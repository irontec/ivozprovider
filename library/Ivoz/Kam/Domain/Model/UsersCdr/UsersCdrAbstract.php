<?php
declare(strict_types = 1);

namespace Ivoz\Kam\Domain\Model\UsersCdr;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;
use \Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Core\Domain\Model\Helper\DateTimeHelper;
use Ivoz\Provider\Domain\Model\Brand\BrandInterface;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use Ivoz\Provider\Domain\Model\User\UserInterface;
use Ivoz\Provider\Domain\Model\Friend\FriendInterface;
use Ivoz\Provider\Domain\Model\ResidentialDevice\ResidentialDeviceInterface;
use Ivoz\Provider\Domain\Model\RetailAccount\RetailAccountInterface;
use Ivoz\Provider\Domain\Model\Brand\Brand;
use Ivoz\Provider\Domain\Model\Company\Company;
use Ivoz\Provider\Domain\Model\User\User;
use Ivoz\Provider\Domain\Model\Friend\Friend;
use Ivoz\Provider\Domain\Model\ResidentialDevice\ResidentialDevice;
use Ivoz\Provider\Domain\Model\RetailAccount\RetailAccount;

/**
* UsersCdrAbstract
* @codeCoverageIgnore
*/
abstract class UsersCdrAbstract
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
    protected $direction;

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
    protected $diversion;

    /**
     * @var string | null
     */
    protected $referee;

    /**
     * @var string | null
     */
    protected $referrer;

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
     * @var bool
     */
    protected $hidden = false;

    /**
     * @var BrandInterface
     */
    protected $brand;

    /**
     * @var CompanyInterface
     */
    protected $company;

    /**
     * @var UserInterface
     */
    protected $user;

    /**
     * @var FriendInterface
     */
    protected $friend;

    /**
     * @var ResidentialDeviceInterface
     */
    protected $residentialDevice;

    /**
     * @var RetailAccountInterface
     */
    protected $retailAccount;

    /**
     * Constructor
     */
    protected function __construct(
        $startTime,
        $endTime,
        $duration,
        $hidden
    ) {
        $this->setStartTime($startTime);
        $this->setEndTime($endTime);
        $this->setDuration($duration);
        $this->setHidden($hidden);
    }

    abstract public function getId();

    public function __toString()
    {
        return sprintf(
            "%s#%s",
            "UsersCdr",
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
     * @return UsersCdrDto
     */
    public static function createDto($id = null)
    {
        return new UsersCdrDto($id);
    }

    /**
     * @internal use EntityTools instead
     * @param UsersCdrInterface|null $entity
     * @param int $depth
     * @return UsersCdrDto|null
     */
    public static function entityToDto(EntityInterface $entity = null, $depth = 0)
    {
        if (!$entity) {
            return null;
        }

        Assertion::isInstanceOf($entity, UsersCdrInterface::class);

        if ($depth < 1) {
            return static::createDto($entity->getId());
        }

        if ($entity instanceof \Doctrine\ORM\Proxy\Proxy && !$entity->__isInitialized()) {
            return static::createDto($entity->getId());
        }

        /** @var UsersCdrDto $dto */
        $dto = $entity->toDto($depth-1);

        return $dto;
    }

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param UsersCdrDto $dto
     * @return self
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ) {
        Assertion::isInstanceOf($dto, UsersCdrDto::class);

        $self = new static(
            $dto->getStartTime(),
            $dto->getEndTime(),
            $dto->getDuration(),
            $dto->getHidden()
        );

        $self
            ->setDirection($dto->getDirection())
            ->setCaller($dto->getCaller())
            ->setCallee($dto->getCallee())
            ->setDiversion($dto->getDiversion())
            ->setReferee($dto->getReferee())
            ->setReferrer($dto->getReferrer())
            ->setCallid($dto->getCallid())
            ->setCallidHash($dto->getCallidHash())
            ->setXcallid($dto->getXcallid())
            ->setBrand($fkTransformer->transform($dto->getBrand()))
            ->setCompany($fkTransformer->transform($dto->getCompany()))
            ->setUser($fkTransformer->transform($dto->getUser()))
            ->setFriend($fkTransformer->transform($dto->getFriend()))
            ->setResidentialDevice($fkTransformer->transform($dto->getResidentialDevice()))
            ->setRetailAccount($fkTransformer->transform($dto->getRetailAccount()));

        $self->initChangelog();

        return $self;
    }

    /**
     * @internal use EntityTools instead
     * @param UsersCdrDto $dto
     * @return self
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ) {
        Assertion::isInstanceOf($dto, UsersCdrDto::class);

        $this
            ->setStartTime($dto->getStartTime())
            ->setEndTime($dto->getEndTime())
            ->setDuration($dto->getDuration())
            ->setDirection($dto->getDirection())
            ->setCaller($dto->getCaller())
            ->setCallee($dto->getCallee())
            ->setDiversion($dto->getDiversion())
            ->setReferee($dto->getReferee())
            ->setReferrer($dto->getReferrer())
            ->setCallid($dto->getCallid())
            ->setCallidHash($dto->getCallidHash())
            ->setXcallid($dto->getXcallid())
            ->setHidden($dto->getHidden())
            ->setBrand($fkTransformer->transform($dto->getBrand()))
            ->setCompany($fkTransformer->transform($dto->getCompany()))
            ->setUser($fkTransformer->transform($dto->getUser()))
            ->setFriend($fkTransformer->transform($dto->getFriend()))
            ->setResidentialDevice($fkTransformer->transform($dto->getResidentialDevice()))
            ->setRetailAccount($fkTransformer->transform($dto->getRetailAccount()));

        return $this;
    }

    /**
     * @internal use EntityTools instead
     * @param int $depth
     * @return UsersCdrDto
     */
    public function toDto($depth = 0)
    {
        return self::createDto()
            ->setStartTime(self::getStartTime())
            ->setEndTime(self::getEndTime())
            ->setDuration(self::getDuration())
            ->setDirection(self::getDirection())
            ->setCaller(self::getCaller())
            ->setCallee(self::getCallee())
            ->setDiversion(self::getDiversion())
            ->setReferee(self::getReferee())
            ->setReferrer(self::getReferrer())
            ->setCallid(self::getCallid())
            ->setCallidHash(self::getCallidHash())
            ->setXcallid(self::getXcallid())
            ->setHidden(self::getHidden())
            ->setBrand(Brand::entityToDto(self::getBrand(), $depth))
            ->setCompany(Company::entityToDto(self::getCompany(), $depth))
            ->setUser(User::entityToDto(self::getUser(), $depth))
            ->setFriend(Friend::entityToDto(self::getFriend(), $depth))
            ->setResidentialDevice(ResidentialDevice::entityToDto(self::getResidentialDevice(), $depth))
            ->setRetailAccount(RetailAccount::entityToDto(self::getRetailAccount(), $depth));
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
            'direction' => self::getDirection(),
            'caller' => self::getCaller(),
            'callee' => self::getCallee(),
            'diversion' => self::getDiversion(),
            'referee' => self::getReferee(),
            'referrer' => self::getReferrer(),
            'callid' => self::getCallid(),
            'callidHash' => self::getCallidHash(),
            'xcallid' => self::getXcallid(),
            'hidden' => self::getHidden(),
            'brandId' => self::getBrand() ? self::getBrand()->getId() : null,
            'companyId' => self::getCompany() ? self::getCompany()->getId() : null,
            'userId' => self::getUser() ? self::getUser()->getId() : null,
            'friendId' => self::getFriend() ? self::getFriend()->getId() : null,
            'residentialDeviceId' => self::getResidentialDevice() ? self::getResidentialDevice()->getId() : null,
            'retailAccountId' => self::getRetailAccount() ? self::getRetailAccount()->getId() : null
        ];
    }

    /**
     * Set startTime
     *
     * @param \DateTimeInterface $startTime
     *
     * @return static
     */
    protected function setStartTime($startTime): UsersCdrInterface
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
    protected function setEndTime($endTime): UsersCdrInterface
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
    protected function setDuration(float $duration): UsersCdrInterface
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
     * Set direction
     *
     * @param string $direction | null
     *
     * @return static
     */
    protected function setDirection(?string $direction = null): UsersCdrInterface
    {
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
     * Set caller
     *
     * @param string $caller | null
     *
     * @return static
     */
    protected function setCaller(?string $caller = null): UsersCdrInterface
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
    protected function setCallee(?string $callee = null): UsersCdrInterface
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
     * Set diversion
     *
     * @param string $diversion | null
     *
     * @return static
     */
    protected function setDiversion(?string $diversion = null): UsersCdrInterface
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
     * Set referee
     *
     * @param string $referee | null
     *
     * @return static
     */
    protected function setReferee(?string $referee = null): UsersCdrInterface
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
     * @return string | null
     */
    public function getReferee(): ?string
    {
        return $this->referee;
    }

    /**
     * Set referrer
     *
     * @param string $referrer | null
     *
     * @return static
     */
    protected function setReferrer(?string $referrer = null): UsersCdrInterface
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
     * @return string | null
     */
    public function getReferrer(): ?string
    {
        return $this->referrer;
    }

    /**
     * Set callid
     *
     * @param string $callid | null
     *
     * @return static
     */
    protected function setCallid(?string $callid = null): UsersCdrInterface
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
    protected function setCallidHash(?string $callidHash = null): UsersCdrInterface
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
    protected function setXcallid(?string $xcallid = null): UsersCdrInterface
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
     * Set hidden
     *
     * @param bool $hidden
     *
     * @return static
     */
    protected function setHidden(bool $hidden): UsersCdrInterface
    {
        Assertion::between(intval($hidden), 0, 1, 'hidden provided "%s" is not a valid boolean value.');
        $hidden = (bool) $hidden;

        $this->hidden = $hidden;

        return $this;
    }

    /**
     * Get hidden
     *
     * @return bool
     */
    public function getHidden(): bool
    {
        return $this->hidden;
    }

    /**
     * Set brand
     *
     * @param BrandInterface | null
     *
     * @return static
     */
    protected function setBrand(?BrandInterface $brand = null): UsersCdrInterface
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
    protected function setCompany(?CompanyInterface $company = null): UsersCdrInterface
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
     * Set user
     *
     * @param UserInterface | null
     *
     * @return static
     */
    protected function setUser(?UserInterface $user = null): UsersCdrInterface
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
    protected function setFriend(?FriendInterface $friend = null): UsersCdrInterface
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
     * Set residentialDevice
     *
     * @param ResidentialDeviceInterface | null
     *
     * @return static
     */
    protected function setResidentialDevice(?ResidentialDeviceInterface $residentialDevice = null): UsersCdrInterface
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
     * Set retailAccount
     *
     * @param RetailAccountInterface | null
     *
     * @return static
     */
    protected function setRetailAccount(?RetailAccountInterface $retailAccount = null): UsersCdrInterface
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

}
