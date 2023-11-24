<?php

declare(strict_types=1);

namespace Ivoz\Provider\Domain\Model\UsersCdr;

use Assert\Assertion;
use Ivoz\Core\Domain\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Domain\ForeignKeyTransformerInterface;
use Ivoz\Core\Domain\Model\Helper\DateTimeHelper;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use Ivoz\Provider\Domain\Model\User\UserInterface;
use Ivoz\Provider\Domain\Model\Friend\FriendInterface;
use Ivoz\Provider\Domain\Model\Extension\ExtensionInterface;
use Ivoz\Provider\Domain\Model\Company\Company;
use Ivoz\Provider\Domain\Model\User\User;
use Ivoz\Provider\Domain\Model\Friend\Friend;
use Ivoz\Provider\Domain\Model\Extension\Extension;
use Ivoz\Kam\Domain\Model\UsersCdr\UsersCdr;

/**
* UsersCdrAbstract
* @codeCoverageIgnore
*/
abstract class UsersCdrAbstract
{
    use ChangelogTrait;

    /**
     * @var ?\DateTime
     */
    protected $startTime = null;

    /**
     * @var float
     */
    protected $duration = 0;

    /**
     * @var ?string
     * comment: enum:inbound|outbound
     */
    protected $direction = 'outbound';

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
    protected $owner = null;

    /**
     * @var ?string
     */
    protected $callid = null;

    /**
     * @var ?int
     */
    protected $brandId = null;

    /**
     * @var ?string
     * comment: enum:answered|missed|bussy
     */
    protected $disposition = 'answered';

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
     * @var ?ExtensionInterface
     */
    protected $extension = null;

    /**
     * @var ?\Ivoz\Kam\Domain\Model\UsersCdr\UsersCdrInterface
     */
    protected $kamUsersCdr = null;

    /**
     * Constructor
     */
    protected function __construct(
        float $duration
    ) {
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

    /**
     * @param int | null $id
     */
    public static function createDto($id = null): UsersCdrDto
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
        $duration = $dto->getDuration();
        Assertion::notNull($duration, 'getDuration value is null, but non null value was expected.');

        $self = new static(
            $duration
        );

        $self
            ->setStartTime($dto->getStartTime())
            ->setDirection($dto->getDirection())
            ->setCaller($dto->getCaller())
            ->setCallee($dto->getCallee())
            ->setOwner($dto->getOwner())
            ->setCallid($dto->getCallid())
            ->setBrandId($dto->getBrandId())
            ->setDisposition($dto->getDisposition())
            ->setCompany($fkTransformer->transform($dto->getCompany()))
            ->setUser($fkTransformer->transform($dto->getUser()))
            ->setFriend($fkTransformer->transform($dto->getFriend()))
            ->setExtension($fkTransformer->transform($dto->getExtension()))
            ->setKamUsersCdr($fkTransformer->transform($dto->getKamUsersCdr()));

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

        $duration = $dto->getDuration();
        Assertion::notNull($duration, 'getDuration value is null, but non null value was expected.');

        $this
            ->setStartTime($dto->getStartTime())
            ->setDuration($duration)
            ->setDirection($dto->getDirection())
            ->setCaller($dto->getCaller())
            ->setCallee($dto->getCallee())
            ->setOwner($dto->getOwner())
            ->setCallid($dto->getCallid())
            ->setBrandId($dto->getBrandId())
            ->setDisposition($dto->getDisposition())
            ->setCompany($fkTransformer->transform($dto->getCompany()))
            ->setUser($fkTransformer->transform($dto->getUser()))
            ->setFriend($fkTransformer->transform($dto->getFriend()))
            ->setExtension($fkTransformer->transform($dto->getExtension()))
            ->setKamUsersCdr($fkTransformer->transform($dto->getKamUsersCdr()));

        return $this;
    }

    /**
     * @internal use EntityTools instead
     */
    public function toDto(int $depth = 0): UsersCdrDto
    {
        return self::createDto()
            ->setStartTime(self::getStartTime())
            ->setDuration(self::getDuration())
            ->setDirection(self::getDirection())
            ->setCaller(self::getCaller())
            ->setCallee(self::getCallee())
            ->setOwner(self::getOwner())
            ->setCallid(self::getCallid())
            ->setBrandId(self::getBrandId())
            ->setDisposition(self::getDisposition())
            ->setCompany(Company::entityToDto(self::getCompany(), $depth))
            ->setUser(User::entityToDto(self::getUser(), $depth))
            ->setFriend(Friend::entityToDto(self::getFriend(), $depth))
            ->setExtension(Extension::entityToDto(self::getExtension(), $depth))
            ->setKamUsersCdr(UsersCdr::entityToDto(self::getKamUsersCdr(), $depth));
    }

    /**
     * @return array<string, mixed>
     */
    protected function __toArray(): array
    {
        return [
            'startTime' => self::getStartTime(),
            'duration' => self::getDuration(),
            'direction' => self::getDirection(),
            'caller' => self::getCaller(),
            'callee' => self::getCallee(),
            'owner' => self::getOwner(),
            'callid' => self::getCallid(),
            'brandId' => self::getBrandId(),
            'disposition' => self::getDisposition(),
            'companyId' => self::getCompany()?->getId(),
            'userId' => self::getUser()?->getId(),
            'friendId' => self::getFriend()?->getId(),
            'extensionId' => self::getExtension()?->getId(),
            'kamUsersCdrId' => self::getKamUsersCdr()?->getId()
        ];
    }

    protected function setStartTime(string|\DateTimeInterface|null $startTime = null): static
    {
        if (!is_null($startTime)) {

            /** @var ?\DateTime */
            $startTime = DateTimeHelper::createOrFix(
                $startTime,
                null
            );

            if ($this->isInitialized() && $this->startTime == $startTime) {
                return $this;
            }
        }

        $this->startTime = $startTime;

        return $this;
    }

    public function getStartTime(): ?\DateTime
    {
        return !is_null($this->startTime) ? clone $this->startTime : null;
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
        if (!is_null($direction)) {
            Assertion::maxLength($direction, 8, 'direction value "%s" is too long, it should have no more than %d characters, but has %d characters.');
            Assertion::choice(
                $direction,
                [
                    UsersCdrInterface::DIRECTION_INBOUND,
                    UsersCdrInterface::DIRECTION_OUTBOUND,
                ],
                'directionvalue "%s" is not an element of the valid values: %s'
            );
        }

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

    protected function setOwner(?string $owner = null): static
    {
        if (!is_null($owner)) {
            Assertion::maxLength($owner, 128, 'owner value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->owner = $owner;

        return $this;
    }

    public function getOwner(): ?string
    {
        return $this->owner;
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

    protected function setBrandId(?int $brandId = null): static
    {
        if (!is_null($brandId)) {
            Assertion::greaterOrEqualThan($brandId, 0, 'brandId provided "%s" is not greater or equal than "%s".');
        }

        $this->brandId = $brandId;

        return $this;
    }

    public function getBrandId(): ?int
    {
        return $this->brandId;
    }

    protected function setDisposition(?string $disposition = null): static
    {
        if (!is_null($disposition)) {
            Assertion::maxLength($disposition, 8, 'disposition value "%s" is too long, it should have no more than %d characters, but has %d characters.');
            Assertion::choice(
                $disposition,
                [
                    UsersCdrInterface::DISPOSITION_ANSWERED,
                    UsersCdrInterface::DISPOSITION_MISSED,
                    UsersCdrInterface::DISPOSITION_BUSSY,
                ],
                'dispositionvalue "%s" is not an element of the valid values: %s'
            );
        }

        $this->disposition = $disposition;

        return $this;
    }

    public function getDisposition(): ?string
    {
        return $this->disposition;
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

    protected function setExtension(?ExtensionInterface $extension = null): static
    {
        $this->extension = $extension;

        return $this;
    }

    public function getExtension(): ?ExtensionInterface
    {
        return $this->extension;
    }

    protected function setKamUsersCdr(?\Ivoz\Kam\Domain\Model\UsersCdr\UsersCdrInterface $kamUsersCdr = null): static
    {
        $this->kamUsersCdr = $kamUsersCdr;

        return $this;
    }

    public function getKamUsersCdr(): ?\Ivoz\Kam\Domain\Model\UsersCdr\UsersCdrInterface
    {
        return $this->kamUsersCdr;
    }
}
