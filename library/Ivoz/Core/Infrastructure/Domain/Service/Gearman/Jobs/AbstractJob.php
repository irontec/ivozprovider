<?php

namespace Ivoz\Core\Infrastructure\Domain\Service\Gearman\Jobs;

use Ivoz\Core\Infrastructure\Domain\Service\Gearman\Manager;

abstract class AbstractJob
{
    const INMEDIATE_METHOD = 'WorkerXmlrpc~immediate';
    const DELAYED_METHOD = 'WorkerXmlrpc~delayed';

    const METHODS = [
        self::INMEDIATE_METHOD,
        self::DELAYED_METHOD,
    ];

    /**
     * @var array
     */
    protected $mainVariables = array();

    /**
     * @var string
     */
    protected $method;

    /**
     * @var Manager
     */
    protected $manager;

    /**
     * @var array
     */
    protected $settings;

    /**
     * AbstractJob constructor.
     *
     * @param Manager $manager
     * @param array $settings
     */
    public function __construct(Manager $manager, array $settings)
    {
        $this->manager = $manager;
        $this->settings = $settings;
    }

    /**
     * @param string $methodName
     *
     * @return void
     */
    public function setMethod($methodName)
    {
        $this->method = $methodName;
    }

    /**
     * @return array
     */
    public function __sleep()
    {
        return $this->mainVariables;
    }

    /**
     * Send Gearman Job request to server
     *
     * @return void
     */
    public function send()
    {
        $this->manager::setOptions($this->settings);

        $gearmandClient = $this->manager::getClient();
        $gearmandClient->doBackground(
            $this->method,
            igbinary_serialize($this)
        );
    }
}
