<?php

namespace Ivoz\Core\Domain\Service;

interface LifecycleEventHandlerInterface
{
    const EVENT_PRE_PERSIST = 'pre_persist';
    const EVENT_POST_PERSIST = 'post_persist';
    const EVENT_POST_REMOVE = 'post_remove';
    const EVENT_ON_COMMIT = 'on_commit';

    const EVENT_TYPES = [
        self::EVENT_PRE_PERSIST,
        self::EVENT_POST_PERSIST,
        self::EVENT_POST_REMOVE,
        self::EVENT_ON_COMMIT
    ];

    /**
     * @return array of eventName => priority
     */
    public static function getSubscribedEvents();
}