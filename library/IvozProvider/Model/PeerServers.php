<?php

/**
 * Application Model
 *
 * @package IvozProvider\Model
 * @subpackage Model
 * @author Luis Felipe Garcia
 * @copyright ZF model generator
 * @license http://framework.zend.com/license/new-bsd     New BSD License
 */

/**
 * [entity]
 *
 * @package IvozProvider\Model
 * @subpackage Model
 * @author Luis Felipe Garcia
 */
 
namespace IvozProvider\Model;
class PeerServers extends Raw\PeerServers
{
    /**
     * This method is called just after parent's constructor
     */
    public function init()
    {
    }

    public function getFlags()
    {
        return $this->getSendPAI() + ($this->getSendRPID()*2);
    }

    public function getLcrGateway()
    {
        $lcrGateways = $this->getLcrGateways();
        return array_shift($lcrGateways);
    }

    public function getName()
    {
        return sprintf("b%dp%ds%d",
            $this->getBrandId(),
            $this->getPeeringContractId(),
            $this->getId());
    }

}
