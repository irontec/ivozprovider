<?php

namespace Ivoz\Provider\Domain\Model\DdiProviderRegistration;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;

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
     * @return integer
     */
    public function getExpires(): int;

    /**
     * Get multiDdi
     *
     * @return boolean | null
     */
    public function getMultiDdi();

    /**
     * Get contactUsername
     *
     * @return string
     */
    public function getContactUsername(): string;

    /**
     * Get trunksUacreg
     *
     * @return \Ivoz\Kam\Domain\Model\TrunksUacreg\TrunksUacregInterface | null
     */
    public function getTrunksUacreg();

    /**
     * Set ddiProvider
     *
     * @param \Ivoz\Provider\Domain\Model\DdiProvider\DdiProviderInterface $ddiProvider
     *
     * @return static
     */
    public function setDdiProvider(\Ivoz\Provider\Domain\Model\DdiProvider\DdiProviderInterface $ddiProvider);

    /**
     * Get ddiProvider
     *
     * @return \Ivoz\Provider\Domain\Model\DdiProvider\DdiProviderInterface
     */
    public function getDdiProvider();

    /**
     * @return bool
     */
    public function isInitialized(): bool;
}
