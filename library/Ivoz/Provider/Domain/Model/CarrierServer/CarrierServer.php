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
        if (!is_numeric($port) or !$port) {
            $port = 5060;
        }

        // Save validated values
        $this->setHostname($hostname);
        $this->setIp($ip);
        $this->setPort($port);
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

    protected function setAuthPassword($authPassword = null)
    {
        if ($authPassword) {
            $authPassword = trim($authPassword);
        }

        return parent::setAuthPassword($authPassword);
    }
}
