<?php

namespace Ivoz\Provider\Domain\Model\ResidentialDevice;

use Assert\Assertion;
use Doctrine\Common\Collections\Criteria;
use Ivoz\Provider\Domain\Model\Ddi\DdiInterface;

/**
 * ResidentialDevice
 */
class ResidentialDevice extends ResidentialDeviceAbstract implements ResidentialDeviceInterface
{
    use ResidentialDeviceTrait;

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
        $this->setBrand(
            $this
                ->getCompany()
                ->getBrand()
        );

        $this->setDomain(
            $this
                ->getCompany()
                ->getBrand()
                ->getDomain()
        );

        if ($this->isDirectConnectivity() && !$this->getTransport()) {
            throw new \DomainException('Invalid empty transport');
        }
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
        }
        return parent::setIp($ip);
    }

    /**
     * {@inheritDoc}
     */
    public function setPassword(?string $password = null): static
    {
        if (!empty($password)) {
            Assertion::regex(
                $password,
                '/^(?=.*[A-Z].*[A-Z].*[A-Z])(?=.*[+*_-])(?=.*[0-9].*[0-9].*[0-9])(?=.*[a-z].*[a-z].*[a-z]).{10,}$/'
            );
        }
        return parent::setPassword($password);
    }

    public function setPort(?int $port = null): static
    {
        if (!empty($port)) {
            Assertion::lessThan($port, pow(2, 16), 'port provided "%s" is not lower than "%s".');
        }

        return parent::setPort($port);
    }

    /**
     * @return string
     */
    public function getContact(): string
    {
        return sprintf(
            "sip:%s@%s",
            $this->getName(),
            $this->getDomain()
        );
    }

    /**
     * @return string
     */
    public function getSorcery(): string
    {
        return sprintf(
            "b%dc%dr%d_%s",
            (int) $this->getCompany()->getBrand()->getId(),
            (int) $this->getCompany()->getId(),
            (int) $this->getId(),
            $this->getName()
        );
    }

    /**
     * @return string
     */
    public function getLanguageCode(): string
    {
        $language = $this->getLanguage();
        if ($language) {
            return $language->getIden();
        }

        return $this->getCompany()->getLanguageCode();
    }

    /**
     * @return string | null
     */
    public function getOutgoingDdiNumber()
    {
        $ddi = $this->getOutgoingDdi();
        if ($ddi) {
            return $ddi->getDdiE164();
        }

        return null;
    }

    /**
     * Get Residential Device outgoingDdi
     * If no Ddi is assigned, retrieve company's default Ddi
     * @return \Ivoz\Provider\Domain\Model\Ddi\DdiInterface | NULL
     */
    public function getOutgoingDdi(): ?DdiInterface
    {
        $ddi = parent::getOutgoingDdi();
        if (!is_null($ddi)) {
            return $ddi;
        }

        return $this
            ->getCompany()
            ->getOutgoingDdi();
    }

    /**
     * Get Ddi associated with this residential device
     *
     * @return \Ivoz\Provider\Domain\Model\Ddi\DdiInterface
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
