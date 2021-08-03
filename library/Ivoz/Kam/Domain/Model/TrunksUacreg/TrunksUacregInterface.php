<?php

namespace Ivoz\Kam\Domain\Model\TrunksUacreg;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;
use Ivoz\Provider\Domain\Model\DdiProviderRegistration\DdiProviderRegistrationInterface;
use Ivoz\Provider\Domain\Model\Brand\BrandInterface;

/**
* TrunksUacregInterface
*/
interface TrunksUacregInterface extends LoggableEntityInterface
{
    /**
     * @return array
     */
    public function getChangeSet();

    /**
     * {@inheritDoc}
     */
    public function setAuthProxy(string $authProxy): static;

    /**
     * @inheritdoc
     */
    public function setLUuid(string $lUuid): static;

    public function getLUuid(): string;

    public function getLUsername(): string;

    public function getLDomain(): string;

    public function getRUsername(): string;

    public function getRDomain(): string;

    public function getRealm(): string;

    public function getAuthUsername(): string;

    public function getAuthPassword(): string;

    public function getAuthProxy(): string;

    public function getExpires(): int;

    public function getFlags(): int;

    public function getRegDelay(): int;

    public function getAuthHa1(): string;

    public function getSocket(): string;

    public function getContactAddr(): string;

    public function setDdiProviderRegistration(DdiProviderRegistrationInterface $ddiProviderRegistration): static;

    public function getDdiProviderRegistration(): DdiProviderRegistrationInterface;

    public function getBrand(): BrandInterface;

    public function isInitialized(): bool;
}
