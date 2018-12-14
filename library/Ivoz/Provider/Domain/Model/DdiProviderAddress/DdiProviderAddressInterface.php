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
     * Set trunksAddress
     *
     * @param \Ivoz\Kam\Domain\Model\TrunksAddress\TrunksAddressInterface $trunksAddress
     *
     * @return self
     */
    public function setTrunksAddress(\Ivoz\Kam\Domain\Model\TrunksAddress\TrunksAddressInterface $trunksAddress = null);

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
