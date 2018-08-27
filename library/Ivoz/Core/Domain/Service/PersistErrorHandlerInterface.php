<?php

namespace Ivoz\Core\Domain\Service;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\EntityInterface;

interface PersistErrorHandlerInterface
{
    public function handle(\Exception $exception);
}