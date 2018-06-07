<?php

namespace Ivoz\Provider\Domain\Model\PeerServer;
use Assert\Assertion;

/**
 * PeerServer
 */
class PeerServer extends PeerServerAbstract implements PeerServerInterface
{
    use PeerServerTrait;

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
        $this->sanitizeBrandByPeeringContract();
        $this->sanitizeAuth();
        $this->sanitizeProxyLogic();
    }

    protected function sanitizeBrandByPeeringContract()
    {
        $isNew = !$this->getId();
        $isNotNewAndPeeringContractHasChanged =
            !$isNew
            && $this->hasChanged('peeringContractId');

        if ($isNotNewAndPeeringContractHasChanged || !$this->getBrand()->getId()) {
            $peerContract = $this->getPeeringContract();
            if (!$peerContract) {
                throw new \DomainException('Unknown PeeringContract');
            }
            $brand = $peerContract->getBrand();
            if (!$brand) {
                throw new \DomainException('Unknown Brand');
            }
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
                'b%dp%ds%d',
                $this->getBrand()->getId(),
                $this->getPeeringContract()->getId(),
                $this->getId()
            );
    }

}

