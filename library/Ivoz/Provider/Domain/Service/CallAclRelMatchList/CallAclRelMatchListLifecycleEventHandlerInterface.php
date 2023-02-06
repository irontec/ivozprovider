<?php

namespace Ivoz\Provider\Domain\Service\CallAclRelMatchList;

use Ivoz\Core\Domain\Service\LifecycleEventHandlerInterface;
use Ivoz\Provider\Domain\Model\CallAclRelMatchList\CallAclRelMatchListInterface;

interface CallAclRelMatchListLifecycleEventHandlerInterface extends LifecycleEventHandlerInterface
{
    public function execute(CallAclRelMatchListInterface $relMatchList);
}
