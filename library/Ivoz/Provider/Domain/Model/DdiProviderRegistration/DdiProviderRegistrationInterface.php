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
    public function getUsername();

    /**
     * Get domain
     *
     * @return string
     */
    public function getDomain();

    /**
     * Get realm
     *
     * @return string
     */
    public function getRealm();

    /**
     * Get authUsername
     *
     * @return string
     */
    public function getAuthUsername();

    /**
     * Get authPassword
     *
     * @return string
     */
    public function getAuthPassword();

    /**
     * Get authProxy
     *
     * @return string
     */
    public function getAuthProxy();

    /**
     * Get expires
     *
     * @return integer
     */
    public function getExpires();

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
    public function getContactUsername();

    /**
     * Set trunksUacreg
     *
     * @param \Ivoz\Kam\Domain\Model\TrunksUacreg\TrunksUacregInterface $trunksUacreg
     *
     * @return self
     */
    public function setTrunksUacreg(\Ivoz\Kam\Domain\Model\TrunksUacreg\TrunksUacregInterface $trunksUacreg = null);

    /**
     * Get trunksUacreg
     *
     * @return \Ivoz\Kam\Domain\Model\TrunksUacreg\TrunksUacregInterface
     */
    public function getTrunksUacreg();

    /**
     * Set ddiProvider
     *
     * @param \Ivoz\Provider\Domain\Model\DdiProvider\DdiProviderInterface $ddiProvider
     *
     * @return self
     */
    public function setDdiProvider(\Ivoz\Provider\Domain\Model\DdiProvider\DdiProviderInterface $ddiProvider = null);

    /**
     * Get ddiProvider
     *
     * @return \Ivoz\Provider\Domain\Model\DdiProvider\DdiProviderInterface
     */
    public function getDdiProvider();
}
