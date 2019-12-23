<?php

namespace Ivoz\Core\Domain\Service;

interface PersistErrorHandlerInterface extends LifecycleEventHandlerInterface
{
    /**
     * @param \Exception $exception
     * @throws \Exception $exception
     * @return void
     */
    public function handle(\Throwable $exception);
}
