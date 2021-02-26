<?php

namespace Ivoz\Provider\Domain\Model\DdiProviderAddress;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;
use Ivoz\Provider\Domain\Model\DdiProvider\DdiProviderInterface;
use Ivoz\Kam\Domain\Model\TrunksAddress\TrunksAddressInterface;

/**
* DdiProviderAddressInterface
*/
interface DdiProviderAddressInterface extends LoggableEntityInterface
{
    /**
     * @codeCoverageIgnore
     * @return array
     */
    public function getChangeSet();

    /**
     * @inheritdoc
     */
    public function setIp(?string $ip = null): static;

    public function getIp(): ?string;

    public function getDescription(): ?string;

    public function setDdiProvider(DdiProviderInterface $ddiProvider): static;

    public function getDdiProvider(): DdiProviderInterface;

    /**
     * @return bool
     */
    public function isInitialized(): bool;

    public function setTrunksAddress(TrunksAddressInterface $trunksAddress): static;

    public function getTrunksAddress(): ?TrunksAddressInterface;

}
