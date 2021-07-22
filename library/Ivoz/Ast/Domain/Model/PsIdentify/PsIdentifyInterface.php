<?php

namespace Ivoz\Ast\Domain\Model\PsIdentify;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;
use Ivoz\Provider\Domain\Model\Terminal\Terminal;
use Ivoz\Provider\Domain\Model\Friend\Friend;
use Ivoz\Provider\Domain\Model\ResidentialDevice\ResidentialDevice;
use Ivoz\Provider\Domain\Model\RetailAccount\RetailAccount;

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

    public function setTerminal(?Terminal $terminal = null): static;

    public function getTerminal(): ?Terminal;

    public function setFriend(?Friend $friend = null): static;

    public function getFriend(): ?Friend;

    public function setResidentialDevice(?ResidentialDevice $residentialDevice = null): static;

    public function getResidentialDevice(): ?ResidentialDevice;

    public function setRetailAccount(?RetailAccount $retailAccount = null): static;

    public function getRetailAccount(): ?RetailAccount;

    public function isInitialized(): bool;
}
