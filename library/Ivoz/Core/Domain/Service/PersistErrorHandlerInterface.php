<?php

namespace Ivoz\Core\Domain\Service;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\EntityInterface;

interface PersistErrorHandlerInterface extends LifecycleEventHandlerInterface
{
    /**
     * @param \Exception $exception
     * @throws \Exception $exception
     * @return void
     */
    public function handle(\Exception $exception);
}
