<?php

namespace Ivoz\Provider\Domain\Model\DdiProviderAddress;

use Ivoz\Provider\Domain\Model\DdiProvider\DdiProviderInterface;
use Ivoz\Kam\Domain\Model\TrunksAddress\TrunksAddressInterface;
use Ivoz\Core\Domain\Model\LoggableEntityInterface;

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
    public function setIp(string $ip = null): DdiProviderAddressInterface;

    /**
     * Get ip
     *
     * @return string | null
     */
    public function getIp(): ?string;

    /**
     * Get description
     *
     * @return string | null
     */
    public function getDescription(): ?string;

    /**
     * Set ddiProvider
     *
     * @param DdiProviderInterface
     *
     * @return static
     */
    public function setDdiProvider(DdiProviderInterface $ddiProvider): DdiProviderAddressInterface;

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
     * @var TrunksAddressInterface
     * mappedBy ddiProviderAddress
     */
    public function setTrunksAddress(TrunksAddressInterface $trunksAddress): DdiProviderAddressInterface;

    /**
     * Get trunksAddress
     * @return TrunksAddressInterface
     */
    public function getTrunksAddress(): ?TrunksAddressInterface;

}
