<?php

namespace Ivoz\Provider\Domain\Service\HuntGroupMember;

use Ivoz\Core\Domain\Service\LifecycleEventHandlerInterface;
use Ivoz\Provider\Domain\Model\HuntGroupMember\HuntGroupMemberInterface;

interface HuntGroupMemberLifecycleEventHandlerInterface extends LifecycleEventHandlerInterface
{
    public function execute(HuntGroupMemberInterface $huntGroupMember): void;
}
