<?php

namespace Ivoz\Cgr\Domain\Service;

use Ivoz\Cgr\Domain\Job\RaterReloadInterface;
use Ivoz\Core\Domain\Service\LifecycleEventHandlerInterface;

abstract class CgratesReloadNotificator implements LifecycleEventHandlerInterface
{
    public const ON_COMMIT_PRIORITY = self::PRIORITY_NORMAL;

    public function __construct(
        private RaterReloadInterface $cgratesReloadJob
    ) {
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
     *
     * @return void
     */
    protected function reload(string $tpid, bool $disableDestinations = true): void
    {
        $this
            ->cgratesReloadJob
            ->setTpid($tpid)
            ->setDisableDestinations($disableDestinations)
            ->send();
    }
}
