<?php

namespace Ivoz\Cgr\Domain\Service\TpAccountAction;

use Ivoz\Cgr\Domain\Model\TpAccountAction\TpAccountActionInterface;

interface TpAccountActionLifecycleEventHandlerInterface
{
    public function execute(TpAccountActionInterface $entity);
}