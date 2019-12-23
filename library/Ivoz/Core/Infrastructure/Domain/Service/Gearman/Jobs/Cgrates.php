<?php

namespace Ivoz\Core\Infrastructure\Domain\Service\Gearman\Jobs;

class Cgrates extends AbstractJob
{
    private static $alreadySent = false;

    /**
     * @var string
     */
    protected $tpid;

    /**
     * @var string | null
     */
    protected $notifyThresholdForAccount;

    /**
     * @var bool
     */
    protected $disableDestinations = false;

    /**
     * @var string
     */
    protected $method = "WorkerCgrates~reload";

    /**
     * @var array
     */
    protected $mainVariables = [
        'tpid',
        'notifyThresholdForAccount',
        'disableDestinations',
    ];

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
     * @return string | null
     */
    public function getNotifyThresholdForAccount()
    {
        return $this->notifyThresholdForAccount;
    }

    /**
     * @param string | null $notifyThresholdForAccount
     */
    public function setNotifyThresholdForAccount($notifyThresholdForAccount)
    {
        $this->notifyThresholdForAccount = $notifyThresholdForAccount;

        return $this;
    }

    /**
     * @return bool
     */
    public function getDisableDestinations(): bool
    {
        return $this->disableDestinations;
    }

    /**
     * @param bool $disableDestinations
     * @return self
     */
    public function setDisableDestinations(bool $disableDestinations)
    {
        $this->disableDestinations = $disableDestinations;

        return $this;
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
