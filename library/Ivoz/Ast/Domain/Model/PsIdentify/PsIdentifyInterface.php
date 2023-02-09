<?php

namespace Ivoz\Ast\Domain\Model\PsIdentify;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Provider\Domain\Model\Terminal\TerminalInterface;
use Ivoz\Provider\Domain\Model\Friend\FriendInterface;
use Ivoz\Provider\Domain\Model\ResidentialDevice\ResidentialDeviceInterface;
use Ivoz\Provider\Domain\Model\RetailAccount\RetailAccountInterface;

/**
* PsIdentifyInterface
*/
interface PsIdentifyInterface extends LoggableEntityInterface
{
    /**
     * @codeCoverageIgnore
     * @return array<string, mixed>
     */
    public function getChangeSet(): array;

    /**
     * Get id
     * @codeCoverageIgnore
     * @return integer
     */
    public function getId(): ?int;

    public function setMatchHeader(?string $matchHeader = null): static;

    public static function createDto(string|int|null $id = null): PsIdentifyDto;

    /**
     * @internal use EntityTools instead
     * @param null|PsIdentifyInterface $entity
     */
    public static function entityToDto(?EntityInterface $entity, int $depth = 0): ?PsIdentifyDto;

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param PsIdentifyDto $dto
     */
    public static function fromDto(DataTransferObjectInterface $dto, ForeignKeyTransformerInterface $fkTransformer): static;

    /**
     * @internal use EntityTools instead
     */
    public function toDto(int $depth = 0): PsIdentifyDto;

    public function getSorceryId(): string;

    public function getEndpoint(): ?string;

    public function getMatch(): ?string;

    public function getMatchHeader(): ?string;

    public function getSrvLookups(): string;

    public function setTerminal(?TerminalInterface $terminal = null): static;

    public function getTerminal(): ?TerminalInterface;

    public function setFriend(?FriendInterface $friend = null): static;

    public function getFriend(): ?FriendInterface;

    public function setResidentialDevice(?ResidentialDeviceInterface $residentialDevice = null): static;

    public function getResidentialDevice(): ?ResidentialDeviceInterface;

    public function setRetailAccount(?RetailAccountInterface $retailAccount = null): static;

    public function getRetailAccount(): ?RetailAccountInterface;

    public function isInitialized(): bool;
}
