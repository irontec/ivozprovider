<?php

namespace Ivoz\Core\Infrastructure\Domain\Service\Gearman\Jobs;

use Ivoz\Core\Infrastructure\Domain\Service\Gearman\Manager;

class Xmlrpc extends AbstractJob {

    protected $rpcEntity;

    protected $rpcPort;

    protected $rpcMethod;

    protected $_method;

    protected $_mainVariables = array(
        'rpcEntity',
        'rpcPort',
        'rpcMethod'
    );

    public function __construct(
        $method = "sendXMLRPC",
        Manager $manager,
        array $settings
    ) {
        $this->_method = $method;
        return parent::__construct($manager, $settings);
    }

    public function setRpcEntity($rpcEntity) {
        $this->rpcEntity = $rpcEntity;
        return $this;
    }

    public function getRpcEntity()
    {
        return $this->rpcEntity;
    }

    public function setRpcPort($rpcPort)
    {
        $this->rpcPort = $rpcPort;
        return $this;
    }

    public function getRpcPort()
    {
        return $this->rpcPort;
    }

    public function setRpcMethod($rpcMethod)
    {
        $this->rpcMethod = $rpcMethod;
        return $this;
    }

    public function getRpcMethod()
    {
        return $this->rpcMethod;
    }

}