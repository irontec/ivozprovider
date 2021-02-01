<?php

namespace Ivoz\Cgr\Domain\Service;

use Ivoz\Core\Domain\Service\LifecycleEventHandlerInterface;
use Ivoz\Provider\Infrastructure\Gearman\Jobs\Cgrates;

abstract class CgratesReloadNotificator implements LifecycleEventHandlerInterface
{
    const ON_COMMIT_PRIORITY = self::PRIORITY_NORMAL;

    /**
     * @var Cgrates
     */
    protected $cgratesReloadJob;

    /**
     * CgratesReloadNotificator constructor.
     *
     * @param Cgrates $cgratesReloadJob
     */
    public function __construct(
        Cgrates $cgratesReloadJob
    ) {
        $this->cgratesReloadJob = $cgratesReloadJob;
    }

    /**
     * @return array
     */
    public static function getSubscribedEvents()
    {
        return [
            self::EVENT_ON_COMMIT => self::ON_COMMIT_PRIORITY
        ];
    }

    /**
     * @param string $tpid
     * @param bool $disableDestinations
     */
    protected function reload(string $tpid, bool $disableDestinations = true)
    {
        $this
            ->cgratesReloadJob
            ->setTpid($tpid)
            ->setDisableDestinations($disableDestinations)
            ->send();
    }
}
