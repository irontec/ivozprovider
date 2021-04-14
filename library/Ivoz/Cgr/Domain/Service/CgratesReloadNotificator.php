<?php

namespace Ivoz\Cgr\Domain\Service;

use Ivoz\Cgr\Domain\Job\RaterReloadInterface;
use Ivoz\Core\Domain\Service\LifecycleEventHandlerInterface;

abstract class CgratesReloadNotificator implements LifecycleEventHandlerInterface
{
    const ON_COMMIT_PRIORITY = self::PRIORITY_NORMAL;

    protected $cgratesReloadJob;

    public function __construct(
        RaterReloadInterface $cgratesReloadJob
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
