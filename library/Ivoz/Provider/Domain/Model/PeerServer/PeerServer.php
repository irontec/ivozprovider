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

    /**
     * {@inheritDoc}
     */
    public function setParams($params = null)
    {
        if (!empty($params)) {
            Assertion::regex($params, '/^;[^\s]+$/');
        }
        return parent::setParams($params);
    }

    public function getFlags()
    {
        return $this->getSendPAI() + ($this->getSendRPID()*2);
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

