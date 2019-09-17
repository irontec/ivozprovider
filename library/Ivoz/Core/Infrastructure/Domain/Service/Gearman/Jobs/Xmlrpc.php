<?php

namespace Ivoz\Core\Infrastructure\Domain\Service\Gearman\Jobs;

use Ivoz\Core\Infrastructure\Domain\Service\Gearman\Manager;
use Psr\Log\LoggerInterface;

class Xmlrpc extends AbstractJob
{
    /**
     * @var string
     */
    protected $rpcEntity;

    /**
     * @var string
     */
    protected $rpcPort;

    /**
     * @var string
     */
    protected $rpcMethod;

    /**
     * @var array
     */
    protected $mainVariables = array(
        'rpcEntity',
        'rpcPort',
        'rpcMethod'
    );

    /**
     * Xmlrpc constructor.
     *
     * @param string $method
     * @param Manager $manager
     * @param LoggerInterface $logger
     * @param array $settings
     */
    public function __construct(
        $method = "WorkerXmlrpc~immediate",
        Manager $manager,
        LoggerInterface $logger,
        array $settings
    ) {
        $this->method = $method;
        parent::__construct($manager, $logger, $settings);
    }

    /**
     * @param string $rpcEntity
     * @return $this
     */
    public function setRpcEntity($rpcEntity)
    {
        $this->rpcEntity = $rpcEntity;
        return $this;
    }

    /**
     * @return string
     */
    public function getRpcEntity()
    {
        return $this->rpcEntity;
    }

    /**
     * @param string $rpcPort
     * @return $this
     */
    public function setRpcPort($rpcPort)
    {
        $this->rpcPort = $rpcPort;
        return $this;
    }

    /**
     * @return string
     */
    public function getRpcPort()
    {
        return $this->rpcPort;
    }

    /**
     * @param string $rpcMethod
     * @return $this
     */
    public function setRpcMethod($rpcMethod)
    {
        $this->rpcMethod = $rpcMethod;
        return $this;
    }

    /**
     * @return string
     */
    public function getRpcMethod()
    {
        return $this->rpcMethod;
    }
}
