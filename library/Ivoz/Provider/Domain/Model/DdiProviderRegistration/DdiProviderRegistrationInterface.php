<?php

namespace Ivoz\Provider\Domain\Model\DdiProviderRegistration;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;
use Ivoz\Provider\Domain\Model\DdiProvider\DdiProviderInterface;
use Ivoz\Kam\Domain\Model\TrunksUacreg\TrunksUacregInterface;

/**
* DdiProviderRegistrationInterface
*/
interface DdiProviderRegistrationInterface extends LoggableEntityInterface
{
    /**
     * @codeCoverageIgnore
     * @return array
     */
    public function getChangeSet();

    public function getUsername(): string;

    public function getDomain(): string;

    public function getRealm(): string;

    public function getAuthUsername(): string;

    public function getAuthPassword(): string;

    public function getAuthProxy(): string;

    public function getExpires(): int;

    public function getMultiDdi(): ?bool;

    public function getContactUsername(): string;

    public function setDdiProvider(DdiProviderInterface $ddiProvider): static;

    public function getDdiProvider(): DdiProviderInterface;

    /**
     * @return bool
     */
    public function isInitialized(): bool;

    public function setTrunksUacreg(TrunksUacregInterface $trunksUacreg): static;

    public function getTrunksUacreg(): ?TrunksUacregInterface;

}
