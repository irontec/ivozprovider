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
     * @return array
     */
    public function getChangeSet()
    {
        $changeSet = parent::getChangeSet();
        if (isset($changeSet['auth_password'])) {
            $changeSet['auth_password'] = '****';
        }

        return $changeSet;
    }

    /**
     * Get id
     * @codeCoverageIgnore
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    protected function sanitizeValues()
    {
        $this->sanitizeBrandByCarrier();
        $this->sanitizeAuth();
        $this->sanitizeProxyLogic();
    }

    protected function sanitizeBrandByCarrier()
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

    protected function sanitizeAuth()
    {
        if ($this->getAuthNeeded() === 'no') {
            $this->setAuthUser(null);
            $this->setAuthPassword(null);
        }
    }

    protected function sanitizeProxyLogic()
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
    public function setIp($ip = null)
    {
        if (!is_null($ip)) {
            Assertion::ip($ip);
        }
        return parent::setIp($ip);
    }

    public function getName()
    {
        return
            sprintf(
                'b%dc%ds%d',
                $this->getBrand()->getId(),
                $this->getCarrier()->getId(),
                $this->getId()
            );
    }
}
