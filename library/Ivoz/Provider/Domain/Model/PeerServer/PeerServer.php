<?php

namespace Ivoz\Provider\Domain\Model\PeerServer;

/**
 * PeerServer
 */
class PeerServer extends PeerServerAbstract implements PeerServerInterface
{
    use PeerServerTrait;

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
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    public function getFlags()
    {
        return $this->getSendPAI() + ($this->getSendRPID()*2);
    }

    /**
     * get first lcrGateways
     *
     * @return \Ivoz\Provider\Domain\Model\LcrGateway\LcrGatewayInterface
     */
    public function getLcrGateway()
    {
        $lcrGateways = $this->getLcrGateways();

        return array_shift($lcrGateways);
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

