<?php

namespace Ivoz\Ast\Domain\Model\PsIdentify;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;
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
     * @return array
     */
    public function getChangeSet();

    public function setMatchHeader(?string $matchHeader = null): static;

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
