<?php

namespace Ivoz\Provider\Domain\Model\SurvivalDevice;

use Assert\Assertion;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;

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

        Assertion::notEmpty($proxy, 'Proxy cannot be empty');

        Assertion::false(
            str_contains($proxy, ' '),
            'Sip Proxy cannot contain spaces'
        );

        $isIpLike = (bool) preg_match('/^\d{1,3}(\.\d{1,3}){3}$/', $proxy);

        $isHostName = preg_match(
            '~^(?=.{1,253}$)(?!\-)([\pL\pN\pM]+(-[\pL\pN\pM]+)*\.)+[\pL\pN\pM]{2,}$~ixuD',
            $proxy
        );

        $isIPv4 = (bool) filter_var($proxy, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4);

        $isValidHost = ($isHostName && !$isIpLike) || $isIPv4;

        Assertion::true(
            $isValidHost,
            'Sip Proxy must be a valid host name or IPv4 address'
        );

        return parent::setProxy($proxy);
    }

    protected function setOutboundProxy(?string $outboundProxy = null): static
    {
        if (empty($outboundProxy)) {
            return parent::setOutboundProxy(null);
        }

        $outboundProxy = trim($outboundProxy);

        $sipOutboundProxyParts = explode(':', $outboundProxy);

        Assertion::true(
            count($sipOutboundProxyParts) <= 2,
            'Outbound Proxy cannot contain more than one colon'
        );

        if (count($sipOutboundProxyParts) === 2) {
            $port = $sipOutboundProxyParts[1];

            Assertion::integerish($port, 'Outbound Proxy port must be an integer-like value');
            $port = (int) $port;

            Assertion::between(
                $port,
                1,
                65535,
                'Outbound Proxy port must be a number between 1 and 65535'
            );
        }

        $ip = $sipOutboundProxyParts[0];
        $isIp = (bool) filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4);
        Assertion::true(
            $isIp,
            'Outbound Proxy must be a valid IPv4 address'
        );

        return parent::setOutboundProxy($outboundProxy);
    }

    protected function sanitizeProxyLogic(): void
    {
        $outboundProxy = $this->getOutboundProxy();
        if (is_null($outboundProxy)) {
            return;
        }

        $sipProxyIncludesPort = strpos($this->getProxy(), ':') !== false;
        if ($sipProxyIncludesPort) {
            throw new \DomainException('When Outbound Proxy is used, SIP Proxy must not include a port.', 70003);
        }
    }

    protected function setCompany(CompanyInterface $company): static
    {
        if ($company->getType() !== CompanyInterface::TYPE_VPBX) {
            throw new \DomainException('SurvivalDevice can only be associated with vpbx companies');
        }

        return parent::setCompany($company);
    }
}
