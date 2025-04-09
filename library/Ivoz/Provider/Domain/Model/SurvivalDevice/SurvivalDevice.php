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

    protected function setProxy(?string $proxy): static
    {
        $proxy = trim((string)$proxy);

        if ($proxy === '') {
            throw new \DomainException('Proxy cannot be empty');
        }

        if (str_contains($proxy, ' ')) {
            throw new \DomainException('Proxy cannot contain spaces');
        }

        if (preg_match('/^(\d{1,3}\.){3}\d{1,3}$/', $proxy)) {
            Assertion::ipv4($proxy, FILTER_FLAG_IPV4);
            return parent::setProxy($proxy);
        }

        if (str_contains($proxy, ':')) {
            throw new \DomainException('Domain cannot contain colons');
        }

        if (!str_contains($proxy, '.')) {
            throw new \DomainException('Domain must contain at least one dot (.)');
        }

        if (str_ends_with($proxy, '.')) {
            throw new \DomainException('Domain must not end with a dot (.)');
        }

        return parent::setProxy($proxy);
    }

    protected function setOutboundProxy(?string $outboundProxy = null): static
    {
        $outboundProxy = trim((string)$outboundProxy);

        if ($outboundProxy === '') {
            throw new \DomainException('Outbound proxy cannot be empty');
        }

        if (str_contains($outboundProxy, ' ')) {
            throw new \DomainException('Outbound proxy cannot contain spaces');
        }

        $colonCount = substr_count($outboundProxy, ':');

        if ($colonCount > 1) {
            throw new \DomainException('Outbound proxy cannot contain more than one colon');
        }

        if ($colonCount === 1) {
            [$ip, $port] = explode(':', $outboundProxy, 2);
            Assertion::ipv4($ip);
            Assertion::between((int)$port, 1, 65535, 'Invalid port in outbound proxy');
        } else {
            Assertion::ipv4($outboundProxy);
        }

        return parent::setOutboundProxy($outboundProxy);
    }
}
