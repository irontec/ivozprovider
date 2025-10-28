<?php

namespace Ivoz\Provider\Domain\Model\RetailAccount;

use Assert\Assertion;
use Doctrine\Common\Collections\Criteria;

/**
 * RetailAccount
 */
class RetailAccount extends RetailAccountAbstract implements RetailAccountInterface
{
    use RetailAccountTrait;

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
        $this->setDomain(
            $this
                ->getCompany()
                ->getBrand()
                ->getDomain()
        );

        if ($this->isDirectConnectivity()) {
            if (!$this->getTransport()) {
                throw new \DomainException('Invalid empty transport');
            }

            $hasIpPort = $this->getIp() && $this->getPort();
            if (!$this->getRuriDomain() && !$hasIpPort) {
                throw new \DomainException('R-URI or IP + port must be provided');
            }

            if (!$this->getProxyUser()) {
                throw new \DomainException('Invalid empty proxy_user');
            }
        } else {
            if (!$this->getPassword()) {
                throw new \DomainException('Password cannot be empty for retail accounts with no direct connectivity');
            }

            $this->setTrustSDP(false);
            $this->setRuriDomain(null);
            $this->setIp(null);
            $this->setPort(null);
            $this->setProxyUser(null);
        }

        $this->validateIpPortRuriCombination();
    }

    private function validateIpPortRuriCombination(): void
    {
        $hasIp = !empty($this->getIp());
        $hasPort = !empty($this->getPort());
        $hasRURI = !empty($this->getRuriDomain());

        if (!$hasIp && !$hasPort && !$hasRURI) {
            return;
        }

        if ($hasIp && $hasPort) {
            return;
        }

        if ($hasRURI && !$hasIp) {
            return;
        }

        throw new \DomainException('Invalid field combination: use uri, port+uri, ip+port, or ip+port+uri');
    }

    /**
     * @return bool
     */
    public function isDirectConnectivity(): bool
    {
        return $this->getDirectConnectivity() === self::DIRECTCONNECTIVITY_YES;
    }

    /**
     * {@inheritDoc}
     */
    public function setName(string $name): static
    {
        Assertion::regex($name, '/^[a-zA-Z0-9_*]+$/');
        return parent::setName($name);
    }

    /**
     * {@inheritDoc}
     */
    public function setIp(?string $ip = null): static
    {
        if (!empty($ip)) {
            Assertion::ip($ip);
        } else {
            $ip = null;
        }

        return parent::setIp($ip);
    }

    /**
     * {@inheritDoc}
     */
    public function setPassword(?string $password = null): static
    {
        if ($password) {
            $password = trim($password);
        }

        if (empty($password)) {
            return parent::setPassword(null);
        }

        Assertion::regex(
            $password,
            '/^(?=.*[A-Z].*[A-Z].*[A-Z])(?=.*[+*_-])(?=.*[0-9].*[0-9].*[0-9])(?=.*[a-z].*[a-z].*[a-z]).{10,}$/'
        );

        return parent::setPassword($password);
    }

    public function setPort(?int $port = null): static
    {
        if (!empty($port)) {
            Assertion::lessThan($port, pow(2, 16), 'port provided "%s" is not lower than "%s".');
        } else {
            $port = null;
        }

        return parent::setPort($port);
    }

    /**
     * {@inheritDoc}
     */
    public function setRuriDomain(?string $ruriDomain = null): static
    {
        if (empty($ruriDomain)) {
            $ruriDomain = null;
        } else {
            Assertion::notContains($ruriDomain, ' ');
        }

        return parent::setRuriDomain($ruriDomain);
    }

    /**
     * @return string
     */
    public function getSorcery(): string
    {
        return sprintf(
            "b%dc%drt%d_%s",
            (int) $this->getCompany()->getBrand()->getId(),
            (int) $this->getCompany()->getId(),
            (int) $this->getId(),
            $this->getName()
        );
    }

    /**
     * Get Ddi associated with this retail Account
     *
     * @param string $ddieE164
     * @return \Ivoz\Provider\Domain\Model\Ddi\DdiInterface | null
     */
    public function getDdi($ddieE164)
    {
        $criteria = new Criteria();

        if ($ddieE164) {
            $criteria->where(
                Criteria::expr()->eq(
                    'ddie164',
                    $ddieE164
                )
            );
        }

        $ddis = $this->getDdis($criteria);

        return array_shift($ddis);
    }
}
