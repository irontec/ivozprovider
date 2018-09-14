<?php

namespace Ivoz\Core\Infrastructure\Domain\Service\Gearman\Jobs;

use Ivoz\Core\Infrastructure\Domain\Service\Gearman\Manager;

class Cgrates extends AbstractJob
{
    private static $alreadySent = false;

    /**
     * @var integer
     */
    protected $tpid;

    /**
     * @var string
     */
    protected $method = "WorkerCgrates~reload";

    /**
     * @var array
     */
    protected $mainVariables = array(
        'tpid',
    );

    /**
     * Recoder constructor.
     *
     * @param Manager $manager
     * @param array $settings
     */
    public function __construct(Manager $manager, array $settings)
    {
        return parent::__construct($manager, $settings);
    }

    public function setTpid($tpid)
    {
        $this->tpid = $tpid;
        return $this;
    }

    public function getTpid()
    {
        return $this->tpid;
    }

    public function send()
    {
        if (self::$alreadySent) {
            return;
        }
        self::$alreadySent = true;

        parent::send();
    }
}
