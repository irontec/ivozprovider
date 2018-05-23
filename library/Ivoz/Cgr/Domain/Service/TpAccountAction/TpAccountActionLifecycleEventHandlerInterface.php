<?php

namespace Ivoz\Cgr\Domain\Service\TpAccountAction;

use Ivoz\Cgr\Domain\Model\TpAccountAction\TpAccountActionInterface;
use Ivoz\Core\Domain\Service\LifecycleEventHandlerInterface;

interface TpAccountActionLifecycleEventHandlerInterface extends LifecycleEventHandlerInterface
{
    public function execute(TpAccountActionInterface $entity);
}