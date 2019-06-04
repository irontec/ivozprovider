<?php

namespace Ivoz\Core\Infrastructure\Domain\Service\Gearman\Jobs;

use Ivoz\Core\Infrastructure\Domain\Service\Gearman\Manager;

class Cgrates extends AbstractJob
{
    private static $alreadySent = false;

    /**
     * @var string
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

    public function setTpid($tpid): self
    {
        $this->tpid = $tpid;
        return $this;
    }

    public function getTpid(): string
    {
        return $this->tpid;
    }

    /**
     * @return void
     */
    public function send()
    {
        if (self::$alreadySent) {
            return;
        }
        self::$alreadySent = true;

        parent::send();
    }
}
