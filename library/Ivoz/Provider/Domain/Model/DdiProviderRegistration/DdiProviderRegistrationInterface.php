<?php

namespace Ivoz\Provider\Domain\Model\DdiProviderRegistration;

use Ivoz\Provider\Domain\Model\DdiProvider\DdiProviderInterface;
use Ivoz\Kam\Domain\Model\TrunksUacreg\TrunksUacregInterface;
use Ivoz\Core\Domain\Model\LoggableEntityInterface;

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

    /**
     * Get username
     *
     * @return string
     */
    public function getUsername(): string;

    /**
     * Get domain
     *
     * @return string
     */
    public function getDomain(): string;

    /**
     * Get realm
     *
     * @return string
     */
    public function getRealm(): string;

    /**
     * Get authUsername
     *
     * @return string
     */
    public function getAuthUsername(): string;

    /**
     * Get authPassword
     *
     * @return string
     */
    public function getAuthPassword(): string;

    /**
     * Get authProxy
     *
     * @return string
     */
    public function getAuthProxy(): string;

    /**
     * Get expires
     *
     * @return int
     */
    public function getExpires(): int;

    /**
     * Get multiDdi
     *
     * @return bool | null
     */
    public function getMultiDdi(): ?bool;

    /**
     * Get contactUsername
     *
     * @return string
     */
    public function getContactUsername(): string;

    /**
     * Set ddiProvider
     *
     * @param DdiProviderInterface
     *
     * @return static
     */
    public function setDdiProvider(DdiProviderInterface $ddiProvider): DdiProviderRegistrationInterface;

    /**
     * Get ddiProvider
     *
     * @return DdiProviderInterface
     */
    public function getDdiProvider(): DdiProviderInterface;

    /**
     * @return bool
     */
    public function isInitialized(): bool;

    /**
     * @var TrunksUacregInterface
     * mappedBy ddiProviderRegistration
     */
    public function setTrunksUacreg(TrunksUacregInterface $trunksUacreg): DdiProviderRegistrationInterface;

    /**
     * Get trunksUacreg
     * @return TrunksUacregInterface
     */
    public function getTrunksUacreg(): ?TrunksUacregInterface;

}
