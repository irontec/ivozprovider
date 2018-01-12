<?php

namespace Ivoz\Core\Infrastructure\Domain\Service\Gearman\Jobs;

use Ivoz\Core\Infrastructure\Domain\Service\Gearman\Manager;

abstract class AbstractJob
{
    // Nombre de variables que queremos se serializen
    protected $_mainVariables = array();

    protected $_method;
    protected $_bootstrap;

    /**
     * @var Manager
     */
    protected $manager;

    /**
     * @var array
     */
    protected $settings;

    public function __construct(Manager $manager, array $settings)
    {
        $this->manager = $manager;
        $this->settings = $settings;
    }

    public function setMethod($methodName)
    {
        $this->_method = $methodName;
    }

    public function __sleep()
    {
        return $this->_mainVariables;
    }

    public function send()
    {
        $this->manager::setOptions($this->settings);

        $gearmandClient = $this->manager::getClient();
        $gearmandClient->doBackground(
            $this->_method,
            igbinary_serialize($this)
        );
    }
}
