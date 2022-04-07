<?php

namespace Ivoz\Ast\Domain\Model\PsEndpoint;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Provider\Domain\Model\Terminal\TerminalInterface;
use Ivoz\Provider\Domain\Model\Friend\FriendInterface;
use Ivoz\Provider\Domain\Model\ResidentialDevice\ResidentialDeviceInterface;
use Ivoz\Provider\Domain\Model\RetailAccount\RetailAccountInterface;

/**
* PsEndpointInterface
*/
interface PsEndpointInterface extends LoggableEntityInterface
{
    public const DIRECTMEDIA_YES = 'yes';

    public const DIRECTMEDIA_NO = 'no';

    public const DIRECTMEDIAMETHOD_UPDATE = 'update';

    public const DIRECTMEDIAMETHOD_INVITE = 'invite';

    public const DIRECTMEDIAMETHOD_REINVITE = 'reinvite';

    public const SENDDIVERSION_YES = 'yes';

    public const SENDDIVERSION_NO = 'no';

    public const SENDPAI_YES = 'yes';

    public const SENDPAI_NO = 'no';

    public const ONEHUNDREDREL_NO = 'no';

    public const ONEHUNDREDREL_REQUIRED = 'required';

    public const ONEHUNDREDREL_YES = 'yes';

    public const TRUSTIDINBOUND_NO = 'no';

    public const TRUSTIDINBOUND_YES = 'yes';

    public const T38UDPTL_YES = 'yes';

    public const T38UDPTL_NO = 'no';

    public const T38UDPTLEC_NONE = 'none';

    public const T38UDPTLEC_FEC = 'fec';

    public const T38UDPTLEC_REDUNDANCY = 'redundancy';

    public const T38UDPTLNAT_YES = 'yes';

    public const T38UDPTLNAT_NO = 'no';

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

    public static function createDto(string|int|null $id = null): PsEndpointDto;

    /**
     * @internal use EntityTools instead
     * @param null|PsEndpointInterface $entity
     */
    public static function entityToDto(?EntityInterface $entity, int $depth = 0): ?PsEndpointDto;

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param PsEndpointDto $dto
     */
    public static function fromDto(DataTransferObjectInterface $dto, ForeignKeyTransformerInterface $fkTransformer): static;

    /**
     * @internal use EntityTools instead
     */
    public function toDto(int $depth = 0): PsEndpointDto;

    public function getSorceryId(): string;

    public function getFromDomain(): ?string;

    public function getAors(): ?string;

    public function getCallerid(): ?string;

    public function getContext(): string;

    public function getDisallow(): string;

    public function getAllow(): string;

    public function getDirectMedia(): ?string;

    public function getDirectMediaMethod(): ?string;

    public function getMailboxes(): ?string;

    public function getNamedPickupGroup(): ?string;

    public function getSubscribeContext(): ?string;

    public function getHintExtension(): ?string;

    public function getSendDiversion(): ?string;

    public function getSendPai(): ?string;

    public function getOneHundredRel(): string;

    public function getOutboundProxy(): ?string;

    public function getTrustIdInbound(): ?string;

    public function getT38Udptl(): string;

    public function getT38UdptlEc(): string;

    public function getT38UdptlMaxdatagram(): int;

    public function getT38UdptlNat(): string;

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
