<?php

namespace Ivoz\Cgr\Infrastructure\Gearman\Jobs;

use Ivoz\Cgr\Domain\Job\RaterReloadInterface;
use Ivoz\Core\Infrastructure\Domain\Service\Gearman\Jobs\AbstractJob;

class Cgrates extends AbstractJob implements RaterReloadInterface
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

    public function getNotifyThresholdForAccount(): ?string
    {
        return $this->notifyThresholdForAccount;
    }

    public function setNotifyThresholdForAccount(?String $notifyThresholdForAccount): self
    {
        $this->notifyThresholdForAccount = $notifyThresholdForAccount;

        return $this;
    }

    public function getDisableDestinations(): bool
    {
        return $this->disableDestinations;
    }

    public function setDisableDestinations(bool $disableDestinations): self
    {
        $this->disableDestinations = $disableDestinations;

        return $this;
    }

    public function send(): void
    {
        if (self::$alreadySent) {
            return;
        }
        self::$alreadySent = true;

        parent::send();
    }
}
