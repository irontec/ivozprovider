<?php

declare(strict_types=1);

namespace Ivoz\Kam\Domain\Model\UsersCdr;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Core\Domain\Model\Helper\DateTimeHelper;
use Ivoz\Provider\Domain\Model\Brand\BrandInterface;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use Ivoz\Provider\Domain\Model\User\UserInterface;
use Ivoz\Provider\Domain\Model\Friend\FriendInterface;
use Ivoz\Provider\Domain\Model\Brand\Brand;
use Ivoz\Provider\Domain\Model\Company\Company;
use Ivoz\Provider\Domain\Model\User\User;
use Ivoz\Provider\Domain\Model\Friend\Friend;

/**
* UsersCdrAbstract
* @codeCoverageIgnore
*/
abstract class UsersCdrAbstract
{
    use ChangelogTrait;

    /**
     * @var \DateTime
     * column: start_time
     */
    protected $startTime;

    /**
     * @var \DateTime
     * column: end_time
     */
    protected $endTime;

    /**
     * @var float
     */
    protected $duration = 0;

    /**
     * @var ?string
     */
    protected $direction = null;

    /**
     * @var ?string
     */
    protected $caller = null;

    /**
     * @var ?string
     */
    protected $callee = null;

    /**
     * @var ?string
     */
    protected $diversion = null;

    /**
     * @var ?string
     */
    protected $referee = null;

    /**
     * @var ?string
     */
    protected $referrer = null;

    /**
     * @var ?string
     */
    protected $callid = null;

    /**
     * @var ?string
     */
    protected $callidHash = null;

    /**
     * @var ?string
     */
    protected $xcallid = null;

    /**
     * @var ?BrandInterface
     */
    protected $brand = null;

    /**
     * @var ?CompanyInterface
     */
    protected $company = null;

    /**
     * @var ?UserInterface
     */
    protected $user = null;

    /**
     * @var ?FriendInterface
     */
    protected $friend = null;

    /**
     * Constructor
     */
    protected function __construct(
        \DateTimeInterface|string $startTime,
        \DateTimeInterface|string $endTime,
        float $duration
    ) {
        $this->setStartTime($startTime);
        $this->setEndTime($endTime);
        $this->setDuration($duration);
    }

    abstract public function getId(): null|string|int;

    public function __toString(): string
    {
        return sprintf(
            "%s#%s",
            "UsersCdr",
            (string) $this->getId()
        );
    }

    /**
     * @throws \Exception
     */
    protected function sanitizeValues(): void
    {
    }

    public static function createDto(string|int|null $id = null): UsersCdrDto
    {
        return new UsersCdrDto($id);
    }

    /**
     * @internal use EntityTools instead
     * @param null|UsersCdrInterface $entity
     */
    public static function entityToDto(?EntityInterface $entity, int $depth = 0): ?UsersCdrDto
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

        $dto = $entity->toDto($depth - 1);

        return $dto;
    }

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param UsersCdrDto $dto
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
        Assertion::isInstanceOf($dto, UsersCdrDto::class);
        $startTime = $dto->getStartTime();
        Assertion::notNull($startTime, 'getStartTime value is null, but non null value was expected.');
        $endTime = $dto->getEndTime();
        Assertion::notNull($endTime, 'getEndTime value is null, but non null value was expected.');
        $duration = $dto->getDuration();
        Assertion::notNull($duration, 'getDuration value is null, but non null value was expected.');

        $self = new static(
            $startTime,
            $endTime,
            $duration
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
            ->setFriend($fkTransformer->transform($dto->getFriend()));

        $self->initChangelog();

        return $self;
    }

    /**
     * @internal use EntityTools instead
     * @param UsersCdrDto $dto
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
        Assertion::isInstanceOf($dto, UsersCdrDto::class);

        $startTime = $dto->getStartTime();
        Assertion::notNull($startTime, 'getStartTime value is null, but non null value was expected.');
        $endTime = $dto->getEndTime();
        Assertion::notNull($endTime, 'getEndTime value is null, but non null value was expected.');
        $duration = $dto->getDuration();
        Assertion::notNull($duration, 'getDuration value is null, but non null value was expected.');

        $this
            ->setStartTime($startTime)
            ->setEndTime($endTime)
            ->setDuration($duration)
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
            ->setFriend($fkTransformer->transform($dto->getFriend()));

        return $this;
    }

    /**
     * @internal use EntityTools instead
     */
    public function toDto(int $depth = 0): UsersCdrDto
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
            ->setBrand(Brand::entityToDto(self::getBrand(), $depth))
            ->setCompany(Company::entityToDto(self::getCompany(), $depth))
            ->setUser(User::entityToDto(self::getUser(), $depth))
            ->setFriend(Friend::entityToDto(self::getFriend(), $depth));
    }

    /**
     * @return array<string, mixed>
     */
    protected function __toArray(): array
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
            'brandId' => self::getBrand()?->getId(),
            'companyId' => self::getCompany()?->getId(),
            'userId' => self::getUser()?->getId(),
            'friendId' => self::getFriend()?->getId()
        ];
    }

    protected function setStartTime(string|\DateTimeInterface $startTime): static
    {

        /** @var \DateTime */
        $startTime = DateTimeHelper::createOrFix(
            $startTime,
            '2000-01-01 00:00:00'
        );

        if ($this->isInitialized() && $this->startTime == $startTime) {
            return $this;
        }

        $this->startTime = $startTime;

        return $this;
    }

    public function getStartTime(): \DateTime
    {
        return clone $this->startTime;
    }

    protected function setEndTime(string|\DateTimeInterface $endTime): static
    {

        /** @var \DateTime */
        $endTime = DateTimeHelper::createOrFix(
            $endTime,
            '2000-01-01 00:00:00'
        );

        if ($this->isInitialized() && $this->endTime == $endTime) {
            return $this;
        }

        $this->endTime = $endTime;

        return $this;
    }

    public function getEndTime(): \DateTime
    {
        return clone $this->endTime;
    }

    protected function setDuration(float $duration): static
    {
        $this->duration = $duration;

        return $this;
    }

    public function getDuration(): float
    {
        return $this->duration;
    }

    protected function setDirection(?string $direction = null): static
    {
        $this->direction = $direction;

        return $this;
    }

    public function getDirection(): ?string
    {
        return $this->direction;
    }

    protected function setCaller(?string $caller = null): static
    {
        if (!is_null($caller)) {
            Assertion::maxLength($caller, 128, 'caller value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->caller = $caller;

        return $this;
    }

    public function getCaller(): ?string
    {
        return $this->caller;
    }

    protected function setCallee(?string $callee = null): static
    {
        if (!is_null($callee)) {
            Assertion::maxLength($callee, 128, 'callee value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->callee = $callee;

        return $this;
    }

    public function getCallee(): ?string
    {
        return $this->callee;
    }

    protected function setDiversion(?string $diversion = null): static
    {
        if (!is_null($diversion)) {
            Assertion::maxLength($diversion, 64, 'diversion value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->diversion = $diversion;

        return $this;
    }

    public function getDiversion(): ?string
    {
        return $this->diversion;
    }

    protected function setReferee(?string $referee = null): static
    {
        if (!is_null($referee)) {
            Assertion::maxLength($referee, 128, 'referee value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->referee = $referee;

        return $this;
    }

    public function getReferee(): ?string
    {
        return $this->referee;
    }

    protected function setReferrer(?string $referrer = null): static
    {
        if (!is_null($referrer)) {
            Assertion::maxLength($referrer, 128, 'referrer value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->referrer = $referrer;

        return $this;
    }

    public function getReferrer(): ?string
    {
        return $this->referrer;
    }

    protected function setCallid(?string $callid = null): static
    {
        if (!is_null($callid)) {
            Assertion::maxLength($callid, 255, 'callid value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->callid = $callid;

        return $this;
    }

    public function getCallid(): ?string
    {
        return $this->callid;
    }

    protected function setCallidHash(?string $callidHash = null): static
    {
        if (!is_null($callidHash)) {
            Assertion::maxLength($callidHash, 128, 'callidHash value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->callidHash = $callidHash;

        return $this;
    }

    public function getCallidHash(): ?string
    {
        return $this->callidHash;
    }

    protected function setXcallid(?string $xcallid = null): static
    {
        if (!is_null($xcallid)) {
            Assertion::maxLength($xcallid, 255, 'xcallid value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->xcallid = $xcallid;

        return $this;
    }

    public function getXcallid(): ?string
    {
        return $this->xcallid;
    }

    protected function setBrand(?BrandInterface $brand = null): static
    {
        $this->brand = $brand;

        return $this;
    }

    public function getBrand(): ?BrandInterface
    {
        return $this->brand;
    }

    protected function setCompany(?CompanyInterface $company = null): static
    {
        $this->company = $company;

        return $this;
    }

    public function getCompany(): ?CompanyInterface
    {
        return $this->company;
    }

    protected function setUser(?UserInterface $user = null): static
    {
        $this->user = $user;

        return $this;
    }

    public function getUser(): ?UserInterface
    {
        return $this->user;
    }

    protected function setFriend(?FriendInterface $friend = null): static
    {
        $this->friend = $friend;

        return $this;
    }

    public function getFriend(): ?FriendInterface
    {
        return $this->friend;
    }
}
