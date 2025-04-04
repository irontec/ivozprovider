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

    protected function setSipProxy(?string $sipProxy = null): static
    {
        if (!$sipProxy || trim($sipProxy) === '') {
            throw new \DomainException('Sip Proxy cannot be empty');
        }
    
        $sipProxy = trim($sipProxy);
    
        if (str_contains($sipProxy, ' ')) {
            throw new \DomainException('Sip Proxy cannot contain spaces');
        }
    
        $parts = explode(':', $sipProxy);
    
        if (count($parts) > 2) {
            throw new \DomainException('Sip Proxy cannot contain more than one colon');
        }
    
        [$host, $port] = $parts + [1 => null];
    
        $this->validateHost($host);
    
        if ($port !== null) {
            Assertion::between((int)trim($port), 1, 65535, 'Invalid port in SIP proxy');
        }
    
        return parent::setSipProxy($sipProxy);
    }
    
    private function validateHost(string $host): void
    {
        if (preg_match('/^(\d{1,3}\.){3}\d{1,3}$/', $host)) {
            Assertion::ipv4($host, 'Invalid IP in SIP proxy');
        } else {
            if (str_contains($host, ':')) {
                throw new \DomainException('Domain cannot contain colons');
            }
    
            if (!str_contains($host, '.')) {
                throw new \DomainException('Domain must contain at least one dot (.)');
            }
    
            if (str_ends_with($host, '.')) {
                throw new \DomainException('Domain must not end with a dot (.)');
            }
        }
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
