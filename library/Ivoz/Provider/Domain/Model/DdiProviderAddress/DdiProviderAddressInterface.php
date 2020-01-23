<?php

namespace Ivoz\Provider\Domain\Model\DdiProviderAddress;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;

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
    public function setIp($ip = null);

    /**
     * Get ip
     *
     * @return string | null
     */
    public function getIp();

    /**
     * Get description
     *
     * @return string | null
     */
    public function getDescription();

    /**
     * Get trunksAddress
     *
     * @return \Ivoz\Kam\Domain\Model\TrunksAddress\TrunksAddressInterface
     */
    public function getTrunksAddress();

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
}
