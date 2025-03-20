<?php

namespace Ivoz\Provider\Domain\Model\SurvivalDevice;

use Assert\Assertion;

/**
 * SurvivalDevice
 */
class SurvivalDevice extends SurvivalDeviceAbstract implements SurvivalDeviceInterface
{
    use SurvivalDeviceTrait;

    /**
     * @codeCoverageIgnore
     * @return array<string, mixed>
     */
    public function getChangeSet(): array
    {
        return parent::getChangeSet();
    }

    /**
     * Get id
     * @codeCoverageIgnore
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    protected function sanitizeValues(): void
    {
        $this->sanitizeProxyLogic();
    }

    protected function setUdpPort(int $udpPort): static
    {
        Assertion::between($udpPort, 1, 65535, "Invalid udp port number: $udpPort. Must be between 1 and 65535");
        return parent::setUdpPort($udpPort);
    }

    protected function setTcpPort(int $tcpPort): static
    {
        Assertion::between($tcpPort, 1, 65535, "Invalid tcp port number: $tcpPort. Must be between 1 and 65535");
        return parent::setTcpPort($tcpPort);
    }

    protected function setTlsPort(int $tlsPort): static
    {
        Assertion::between($tlsPort, 1, 65535, "Invalid tls port number: $tlsPort. Must be between 1 and 65535");
        return parent::setTlsPort($tlsPort);
    }

    protected function setWssPort(int $wssPort): static
    {
        Assertion::between($wssPort, 1, 65535, "Invalid wss port number: $wssPort. Must be between 1 and 65535");
        return parent::setWssPort($wssPort);
    }

    protected function setProxy(string $proxy): static
    {
        $proxy = trim($proxy);
        if (empty($proxy)) {
            throw new \DomainException('Proxy cannot be empty');
        }

        return parent::setProxy($proxy);
    }

    protected function sanitizeProxyLogic(): void
    {
        $outboundProxy = $this->getOutboundProxy();
        if (is_null($outboundProxy)) {
            return;
        }

        $emptyOutboundProxy = empty(
            trim($outboundProxy)
        );
        if ($emptyOutboundProxy) {
            throw new \DomainException('Outbound Proxy cannot be empty.');
        }

        $sipProxyIncludesPort = strpos($this->getProxy(), ':') !== false;
        if ($sipProxyIncludesPort) {
            throw new \DomainException('When Outbound Proxy is used, SIP Proxy must not include a port.', 70003);
        }
    }
}
