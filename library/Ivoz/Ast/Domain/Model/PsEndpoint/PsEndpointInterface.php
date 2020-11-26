<?php

namespace Ivoz\Ast\Domain\Model\PsEndpoint;

use Ivoz\Provider\Domain\Model\Terminal\TerminalInterface;
use Ivoz\Provider\Domain\Model\Friend\FriendInterface;
use Ivoz\Provider\Domain\Model\ResidentialDevice\ResidentialDeviceInterface;
use Ivoz\Provider\Domain\Model\RetailAccount\RetailAccountInterface;
use Ivoz\Core\Domain\Model\LoggableEntityInterface;

/**
* PsEndpointInterface
*/
interface PsEndpointInterface extends LoggableEntityInterface
{
    const DIRECTMEDIAMETHOD_UPDATE = 'update';

    const DIRECTMEDIAMETHOD_INVITE = 'invite';

    const DIRECTMEDIAMETHOD_REINVITE = 'reinvite';

    const T38UDPTL_YES = 'yes';

    const T38UDPTL_NO = 'no';

    const T38UDPTLEC_NONE = 'none';

    const T38UDPTLEC_FEC = 'fec';

    const T38UDPTLEC_REDUNDANCY = 'redundancy';

    const T38UDPTLNAT_YES = 'yes';

    const T38UDPTLNAT_NO = 'no';

    /**
     * @codeCoverageIgnore
     * @return array
     */
    public function getChangeSet();

    /**
     * Get sorceryId
     *
     * @return string
     */
    public function getSorceryId(): string;

    /**
     * Get fromDomain
     *
     * @return string | null
     */
    public function getFromDomain(): ?string;

    /**
     * Get aors
     *
     * @return string | null
     */
    public function getAors(): ?string;

    /**
     * Get callerid
     *
     * @return string | null
     */
    public function getCallerid(): ?string;

    /**
     * Get context
     *
     * @return string
     */
    public function getContext(): string;

    /**
     * Get disallow
     *
     * @return string
     */
    public function getDisallow(): string;

    /**
     * Get allow
     *
     * @return string
     */
    public function getAllow(): string;

    /**
     * Get directMedia
     *
     * @return string | null
     */
    public function getDirectMedia(): ?string;

    /**
     * Get directMediaMethod
     *
     * @return string | null
     */
    public function getDirectMediaMethod(): ?string;

    /**
     * Get mailboxes
     *
     * @return string | null
     */
    public function getMailboxes(): ?string;

    /**
     * Get namedPickupGroup
     *
     * @return string | null
     */
    public function getNamedPickupGroup(): ?string;

    /**
     * Get sendDiversion
     *
     * @return string | null
     */
    public function getSendDiversion(): ?string;

    /**
     * Get sendPai
     *
     * @return string | null
     */
    public function getSendPai(): ?string;

    /**
     * Get oneHundredRel
     *
     * @return string
     */
    public function getOneHundredRel(): string;

    /**
     * Get outboundProxy
     *
     * @return string | null
     */
    public function getOutboundProxy(): ?string;

    /**
     * Get trustIdInbound
     *
     * @return string | null
     */
    public function getTrustIdInbound(): ?string;

    /**
     * Get t38Udptl
     *
     * @return string
     */
    public function getT38Udptl(): string;

    /**
     * Get t38UdptlEc
     *
     * @return string
     */
    public function getT38UdptlEc(): string;

    /**
     * Get t38UdptlMaxdatagram
     *
     * @return int
     */
    public function getT38UdptlMaxdatagram(): int;

    /**
     * Get t38UdptlNat
     *
     * @return string
     */
    public function getT38UdptlNat(): string;

    /**
     * Set terminal
     *
     * @param TerminalInterface | null
     *
     * @return static
     */
    public function setTerminal(?TerminalInterface $terminal = null): PsEndpointInterface;

    /**
     * Get terminal
     *
     * @return TerminalInterface | null
     */
    public function getTerminal(): ?TerminalInterface;

    /**
     * Set friend
     *
     * @param FriendInterface | null
     *
     * @return static
     */
    public function setFriend(?FriendInterface $friend = null): PsEndpointInterface;

    /**
     * Get friend
     *
     * @return FriendInterface | null
     */
    public function getFriend(): ?FriendInterface;

    /**
     * Set residentialDevice
     *
     * @param ResidentialDeviceInterface | null
     *
     * @return static
     */
    public function setResidentialDevice(?ResidentialDeviceInterface $residentialDevice = null): PsEndpointInterface;

    /**
     * Get residentialDevice
     *
     * @return ResidentialDeviceInterface | null
     */
    public function getResidentialDevice(): ?ResidentialDeviceInterface;

    /**
     * Set retailAccount
     *
     * @param RetailAccountInterface | null
     *
     * @return static
     */
    public function setRetailAccount(?RetailAccountInterface $retailAccount = null): PsEndpointInterface;

    /**
     * Get retailAccount
     *
     * @return RetailAccountInterface | null
     */
    public function getRetailAccount(): ?RetailAccountInterface;

    /**
     * @return bool
     */
    public function isInitialized(): bool;

}
