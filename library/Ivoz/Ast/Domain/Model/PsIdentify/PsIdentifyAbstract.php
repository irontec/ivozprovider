<?php

declare(strict_types=1);

namespace Ivoz\Ast\Domain\Model\PsIdentify;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Provider\Domain\Model\Terminal\TerminalInterface;
use Ivoz\Provider\Domain\Model\Friend\FriendInterface;
use Ivoz\Provider\Domain\Model\ResidentialDevice\ResidentialDeviceInterface;
use Ivoz\Provider\Domain\Model\RetailAccount\RetailAccountInterface;
use Ivoz\Provider\Domain\Model\Terminal\Terminal;
use Ivoz\Provider\Domain\Model\Friend\Friend;
use Ivoz\Provider\Domain\Model\ResidentialDevice\ResidentialDevice;
use Ivoz\Provider\Domain\Model\RetailAccount\RetailAccount;

/**
* PsIdentifyAbstract
* @codeCoverageIgnore
*/
abstract class PsIdentifyAbstract
{
    use ChangelogTrait;

    /**
     * @var string
     * column: sorcery_id
     */
    protected $sorceryId;

    /**
     * @var ?string
     */
    protected $endpoint = null;

    /**
     * @var ?string
     */
    protected $match = null;

    /**
     * @var ?string
     * column: match_header
     */
    protected $matchHeader = null;

    /**
     * @var string
     * column: srv_lookups
     */
    protected $srvLookups = 'false';

    /**
     * @var ?TerminalInterface
     * inversedBy psIdentify
     */
    protected $terminal = null;

    /**
     * @var ?FriendInterface
     * inversedBy psIdentify
     */
    protected $friend = null;

    /**
     * @var ?ResidentialDeviceInterface
     * inversedBy psIdentify
     */
    protected $residentialDevice = null;

    /**
     * @var ?RetailAccountInterface
     * inversedBy psIdentify
     */
    protected $retailAccount = null;

    /**
     * Constructor
     */
    protected function __construct(
        string $sorceryId,
        string $srvLookups
    ) {
        $this->setSorceryId($sorceryId);
        $this->setSrvLookups($srvLookups);
    }

    abstract public function getId(): null|string|int;

    public function __toString(): string
    {
        return sprintf(
            "%s#%s",
            "PsIdentify",
            (string) $this->getId()
        );
    }

    /**
     * @throws \Exception
     */
    protected function sanitizeValues(): void
    {
    }

    public static function createDto(string|int|null $id = null): PsIdentifyDto
    {
        return new PsIdentifyDto($id);
    }

    /**
     * @internal use EntityTools instead
     * @param null|PsIdentifyInterface $entity
     */
    public static function entityToDto(?EntityInterface $entity, int $depth = 0): ?PsIdentifyDto
    {
        if (!$entity) {
            return null;
        }

        Assertion::isInstanceOf($entity, PsIdentifyInterface::class);

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
     * @param PsIdentifyDto $dto
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
        Assertion::isInstanceOf($dto, PsIdentifyDto::class);

        $self = new static(
            $dto->getSorceryId(),
            $dto->getSrvLookups()
        );

        $self
            ->setEndpoint($dto->getEndpoint())
            ->setMatch($dto->getMatch())
            ->setMatchHeader($dto->getMatchHeader())
            ->setTerminal($fkTransformer->transform($dto->getTerminal()))
            ->setFriend($fkTransformer->transform($dto->getFriend()))
            ->setResidentialDevice($fkTransformer->transform($dto->getResidentialDevice()))
            ->setRetailAccount($fkTransformer->transform($dto->getRetailAccount()));

        $self->initChangelog();

        return $self;
    }

    /**
     * @internal use EntityTools instead
     * @param PsIdentifyDto $dto
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
        Assertion::isInstanceOf($dto, PsIdentifyDto::class);

        $this
            ->setSorceryId($dto->getSorceryId())
            ->setEndpoint($dto->getEndpoint())
            ->setMatch($dto->getMatch())
            ->setMatchHeader($dto->getMatchHeader())
            ->setSrvLookups($dto->getSrvLookups())
            ->setTerminal($fkTransformer->transform($dto->getTerminal()))
            ->setFriend($fkTransformer->transform($dto->getFriend()))
            ->setResidentialDevice($fkTransformer->transform($dto->getResidentialDevice()))
            ->setRetailAccount($fkTransformer->transform($dto->getRetailAccount()));

        return $this;
    }

    /**
     * @internal use EntityTools instead
     */
    public function toDto(int $depth = 0): PsIdentifyDto
    {
        return self::createDto()
            ->setSorceryId(self::getSorceryId())
            ->setEndpoint(self::getEndpoint())
            ->setMatch(self::getMatch())
            ->setMatchHeader(self::getMatchHeader())
            ->setSrvLookups(self::getSrvLookups())
            ->setTerminal(Terminal::entityToDto(self::getTerminal(), $depth))
            ->setFriend(Friend::entityToDto(self::getFriend(), $depth))
            ->setResidentialDevice(ResidentialDevice::entityToDto(self::getResidentialDevice(), $depth))
            ->setRetailAccount(RetailAccount::entityToDto(self::getRetailAccount(), $depth));
    }

    protected function __toArray(): array
    {
        return [
            'sorcery_id' => self::getSorceryId(),
            'endpoint' => self::getEndpoint(),
            'match' => self::getMatch(),
            'match_header' => self::getMatchHeader(),
            'srv_lookups' => self::getSrvLookups(),
            'terminalId' => self::getTerminal()?->getId(),
            'friendId' => self::getFriend()?->getId(),
            'residentialDeviceId' => self::getResidentialDevice()?->getId(),
            'retailAccountId' => self::getRetailAccount()?->getId()
        ];
    }

    protected function setSorceryId(string $sorceryId): static
    {
        Assertion::maxLength($sorceryId, 40, 'sorceryId value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->sorceryId = $sorceryId;

        return $this;
    }

    public function getSorceryId(): string
    {
        return $this->sorceryId;
    }

    protected function setEndpoint(?string $endpoint = null): static
    {
        if (!is_null($endpoint)) {
            Assertion::maxLength($endpoint, 40, 'endpoint value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->endpoint = $endpoint;

        return $this;
    }

    public function getEndpoint(): ?string
    {
        return $this->endpoint;
    }

    protected function setMatch(?string $match = null): static
    {
        if (!is_null($match)) {
            Assertion::maxLength($match, 80, 'match value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->match = $match;

        return $this;
    }

    public function getMatch(): ?string
    {
        return $this->match;
    }

    protected function setMatchHeader(?string $matchHeader = null): static
    {
        if (!is_null($matchHeader)) {
            Assertion::maxLength($matchHeader, 100, 'matchHeader value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->matchHeader = $matchHeader;

        return $this;
    }

    public function getMatchHeader(): ?string
    {
        return $this->matchHeader;
    }

    protected function setSrvLookups(string $srvLookups): static
    {
        Assertion::maxLength($srvLookups, 10, 'srvLookups value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->srvLookups = $srvLookups;

        return $this;
    }

    public function getSrvLookups(): string
    {
        return $this->srvLookups;
    }

    public function setTerminal(?TerminalInterface $terminal = null): static
    {
        $this->terminal = $terminal;

        return $this;
    }

    public function getTerminal(): ?TerminalInterface
    {
        return $this->terminal;
    }

    public function setFriend(?FriendInterface $friend = null): static
    {
        $this->friend = $friend;

        return $this;
    }

    public function getFriend(): ?FriendInterface
    {
        return $this->friend;
    }

    public function setResidentialDevice(?ResidentialDeviceInterface $residentialDevice = null): static
    {
        $this->residentialDevice = $residentialDevice;

        return $this;
    }

    public function getResidentialDevice(): ?ResidentialDeviceInterface
    {
        return $this->residentialDevice;
    }

    public function setRetailAccount(?RetailAccountInterface $retailAccount = null): static
    {
        $this->retailAccount = $retailAccount;

        return $this;
    }

    public function getRetailAccount(): ?RetailAccountInterface
    {
        return $this->retailAccount;
    }
}
