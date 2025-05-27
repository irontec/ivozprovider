<?php

namespace Ivoz\Provider\Domain\Model\CarrierServer;

use Assert\Assertion;

/**
 * CarrierServer
 */
class CarrierServer extends CarrierServerAbstract implements CarrierServerInterface
{
    use CarrierServerTrait;

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
     * @return integer
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    protected function sanitizeValues(): void
    {
        $this->sanitizeBrandByCarrier();
        $this->sanitizeAuth();
        $this->sanitizeProxyLogic();
    }

    protected function sanitizeBrandByCarrier(): void
    {
        $isNew = !$this->getId();
        $isNotNewAndCarrierHasChanged =
            !$isNew
            && $this->hasChanged('carrierId');

        if ($isNotNewAndCarrierHasChanged || !$this->getBrand()->getId()) {
            $brand = $this
                ->getCarrier()
                ->getBrand();

            $this->setBrand($brand);
        }
    }

    protected function sanitizeAuth(): void
    {
        if ($this->getAuthNeeded() === 'no') {
            $this->setAuthUser(null);
            $this->setAuthPassword(null);
        }
    }

    protected function sanitizeProxyLogic(): void
    {
        $sip_proxy = explode(':', $this->getSipProxy());
        $hostname = array_shift($sip_proxy);
        $port = array_shift($sip_proxy);
        if ($this->getOutboundProxy()) {
            $outbound_proxy = explode(':', $this->getOutboundProxy());
            $ip = array_shift($outbound_proxy);
            $obPort = array_shift($outbound_proxy);
            if (!is_null($port)) {
                throw new \DomainException('When Outbound Proxy is used, SIP Proxy must not include a port.', 70003);
            }
            $port = $obPort;
        } else {
            $ip = null;
            $this->setOutboundProxy(null);
        }

        // Save validated values
        $this->setHostname($hostname);
        $this->setIp($ip);
        $this->setPort(
            is_numeric($port)
            ? (int) $port
            : null
        );
    }

    /**
     * {@inheritDoc}
     */
    public function setIp(?string $ip = null): static
    {
        if (!is_null($ip)) {
            Assertion::ip($ip);
        }
        return parent::setIp($ip);
    }

    public function getName(): string
    {
        return
            sprintf(
                'b%dc%ds%d',
                (int) $this->getBrand()->getId(),
                (int) $this->getCarrier()->getId(),
                (int) $this->getId()
            );
    }

    protected function setAuthPassword(?string $authPassword = null): static
    {
        if ($authPassword) {
            $authPassword = trim($authPassword);
        }

        return parent::setAuthPassword($authPassword);
    }

    protected function setPort(?int $port = null): static
    {
        $port = $port ?? 5060;

        Assertion::between(
            $port,
            1,
            65535,
            'Port must be a number between 1 and 65535'
        );

        return parent::setPort($port);
    }

    protected function setSipProxy(?string $sipProxy = null): static
    {
        Assertion::notNull($sipProxy, 'Sip Proxy cannot be null');

        $sipProxy = trim($sipProxy);

        Assertion::notEmpty($sipProxy, 'Sip Proxy cannot be empty');

        Assertion::false(
            str_contains($sipProxy, ' '),
            'Sip Proxy cannot contain spaces'
        );

        $sipProxyParts = explode(':', $sipProxy);

        if (count($sipProxyParts) === 2) {
            $port = $sipProxyParts[1];
            Assertion::integerish($port, 'Port must be an integer-like value');
            $port = (int) $port;
            Assertion::between(
                $port,
                1,
                65535,
                'Port in Sip Proxy must be a number between 1 and 65535'
            );
        }

        Assertion::true(
            count($sipProxyParts) <= 2,
            'Sip Proxy cannot contain more than one colon'
        );

        $host = $sipProxyParts[0];

        $isIpLike = (bool) preg_match('/^\d{1,3}(\.\d{1,3}){3}$/', $host);
        $isHostName = preg_match(
            '~^(?=.{1,253}$)(?!\-)([\pL\pN\pM]+(-[\pL\pN\pM]+)*\.)+[\pL\pN\pM]{2,}$~ixuD',
            $host
        );
        $isIPv4 = (bool) filter_var($host, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4);

        $isValidHost = ($isHostName && !$isIpLike) || $isIPv4;

        Assertion::true(
            $isValidHost,
            'Sip Proxy must be a valid host name or IPv4 address'
        );

        return parent::setSipProxy($sipProxy);
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

        $host = $sipOutboundProxyParts[0];
        $isIp = (bool) filter_var($host, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4);
        Assertion::true(
            $isIp,
            'Outbound Proxy must be a valid IPv4 address'
        );

        return parent::setOutboundProxy($outboundProxy);
    }
}
